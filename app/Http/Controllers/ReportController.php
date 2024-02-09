<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth')->except('show', 'showTab');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getLaporan = Report::where('sender_id', auth()->user()->id)->orWhereHas('reciver', function ($query) {
            $query->where('reciver_id', auth()->user()->id);
        })->with('reciver')
            ->get();

        $getLaporan->each(function ($laporan) {
            $recivers = User::whereIn('id', $laporan->reciver->pluck('reciver_id'))->get();
            $nameRecivers = $recivers->pluck('name')->toArray();
            $avatarRecivers = $recivers->pluck('avatar_url')->toArray();
            $emailRecivers = $recivers->pluck('email')->toArray();

            $laporan->email_recivers = $emailRecivers[0] ?? null;
            $laporan->avatar_recivers = $avatarRecivers[0] ?? null;
            $laporan->reciver_names = '';
            $count = 1;

            foreach ($nameRecivers as $reciver) {
                if ($count === 1) {
                    $laporan->reciver_names .= $reciver;
                } else {
                    $laporan->reciver_names .= ' & ' . count($recivers) - 1 . ' others';
                }
                $count++;
            }
        });

        $getLaporan = $getLaporan->sortByDesc('created_at');
        $totalLaporan = [
            'totalAll' => $getLaporan->count(),
            'totalUnread' => $getLaporan->where('status', 'terkirim')->count(),
            'totalPersonal' => $getLaporan->where('reciver_id', Auth::user()->id)->count(),
        ];

        $detailLaporan = null;

        // dd($getLaporan);
        return view('reports.index', compact('getLaporan', 'detailLaporan', 'totalLaporan'));
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
        $request->validated([
            'Sender_id' => 'required',
            'recipient' => 'required',
            'Subject' => 'required',
            'Message' => 'required',
            'roomType' => 'required',
        ]);

        // dd($request->all());

        // Filter out "Choose Your Reciver"
        $filteredRecipients = array_filter($request->recipient, function ($recipient) {
            return $recipient !== 'Choose Your Reciver';
        });

        // Remove duplicate recipient IDs
        $uniqueRecipients = array_unique($filteredRecipients);

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

        return Redirect::route('report.index')->with('success', 'Laporan berhasil dikirim');
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
            $count = 1;

            foreach ($nameRecivers as $reciver) {
                if ($count === 1) {
                    $laporan->reciver_names .= $reciver;
                } else {
                    $laporan->reciver_names .= ' & ' . count($recivers) - 1 . ' others';
                }
                $count++;
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
        //
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
