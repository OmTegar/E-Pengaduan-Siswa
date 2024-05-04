<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\ReportReciver;
use function Termwind\render;

use App\Http\Controllers\Controller;

use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginateControl = 15;

        $getLaporan = Report::orderByDesc('created_at')
            ->without('attachments')
            ->where(function ($query) {
                $query->where('sender_id', Auth::user()->id)
                    ->orWhereHas('reciver', function ($query) {
                        $query->where('reciver_id', Auth::user()->id);
                    });
            })
            ->paginate($paginateControl);
        $getLaporan->each(function ($laporan) {
            $recivers = User::whereIn('id', $laporan->reciver->pluck('reciver_id'))->get();
            $nameRecivers = $recivers->pluck('name')->toArray();
            $avatarRecivers = $recivers->pluck('avatar_url')->toArray();
            $emailRecivers = $recivers->pluck('email')->toArray();

            $laporan->avatar_recivers = $avatarRecivers[0] ?? null;
            $laporan->email_recivers = $emailRecivers[0] ?? null;
            $laporan->reciver_names = '';

            if (count($nameRecivers) > 1) {
                $laporan->reciver_names = implode(' & ', array_slice($nameRecivers, 0, 1)); // Tambahkan satu nama penerima pertama
                $laporan->reciver_names .= ' & ' . (count($nameRecivers) - 1) . ' others'; // Tambahkan jumlah penerima lainnya
            } else {
                // Jika hanya ada satu penerima, gunakan namanya langsung
                $laporan->reciver_names = $nameRecivers[0] ?? null;
            }
        });
        // dd($getLaporan);
        return view('reports.index', compact('getLaporan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $dataGuru = User::where('role_id', 2)->select('id', 'name')->get();
        // dd($dataGuru);
        return view('reports.create', compact('dataGuru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request) : RedirectResponse
    public function store(StoreReportRequest $request): RedirectResponse
    {
        try {
            $request->validated([
                'Sender_id' => 'required',
                'recipient' => 'required',
                'Subject' => 'required',
                'Message' => 'required',
                'roomType' => 'required',
                'attachment'=>'nullable'
            ]);

            dd($request->all());
        } catch (Throwable $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }

        try {
            // Remove duplicate recipient IDs
            $uniqueRecipients = array_unique($request->recipient);
            // Create a new Report
            $report = new Report();
            $report->sender_id = $request->Sender_id;
            $report->subject = $request->Subject;
            $report->message = $request->Message;
            $report->roomType = $request->roomType[0];
            $report->save();

            // Attach unique recipients to the report
            foreach ($uniqueRecipients as $recipient) {
                $reportRecipient = new ReportReciver();
                $reportRecipient->report_id = $report->id;
                $reportRecipient->reciver_id = $recipient;
                $reportRecipient->save();
            }

            if ($request->hasFile('attachment')) {
                dd('oke file');
                // Handle file upload and storage logic here
                foreach ($request->file('attachment') as $file) {
                    // Save or process each file as needed
                }
            }

            return Redirect::route('report.index')->with('success', 'Laporan berhasil dikirim');
        } catch (Throwable $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        // Fetch the report with the specified UUID and its reciver relationship
        $detailLaporan = Report::where('id', $uuid)->with('reciver')->get();

        if ($detailLaporan->first()->status === 'terkirim') {
            if ($detailLaporan->first()->sender_id !== Auth::user()->id) {
                $detailLaporan->first()->update(['status' => 'dibaca']);
            }
        }
        $detailLaporan->each(function ($laporan) {
            $recivers = User::whereIn('id', $laporan->reciver->pluck('reciver_id'))->get();
            $nameRecivers = $recivers->pluck('name')->toArray();
            $avatarRecivers = $recivers->pluck('avatar_url')->toArray();
            $emailRecivers = $recivers->pluck('email')->toArray();

            $laporan->email_recivers = $emailRecivers[0] ?? null;
            $laporan->avatar_recivers = $avatarRecivers[0] ?? null;
            $laporan->reciver_names = '';

            // Jika ada lebih dari satu penerima, tambahkan '& x others' di akhir
            if (count($nameRecivers) > 1) {
                $laporan->reciver_names = implode(' & ', array_slice($nameRecivers, 0, 1)); // Tambahkan satu nama penerima pertama
                $laporan->reciver_names .= ' & ' . (count($nameRecivers) - 1) . ' others'; // Tambahkan jumlah penerima lainnya
            } else {
                // Jika hanya ada satu penerima, gunakan namanya langsung
                $laporan->reciver_names = $nameRecivers[0] ?? null;
            }
        });


        $detailLaporan = $detailLaporan->first();
        // dd($detailLaporan);

        if (!$detailLaporan) {
            // Handle the case where the report is not found
            return response()->json(['error' => 'Report not found'], 404);
        }

        // Render the view 'layouts.detailReportOpen' with the data '$detailLaporan'
        return view('layouts.detailLaporanTab', compact('detailLaporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return Redirect::route('report.index')->with('success', 'Laporan berhasil Dihapus');
    }

    public function strore_document(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:pdf|max:2048',
        ]);

        $documentName = time() . '.' . $request->document->extension();
        $request->document->move(public_path('documents'), $documentName);

        return back()
            ->with('success', 'You have successfully upload file.')
            ->with('file', $documentName);
    }
}
