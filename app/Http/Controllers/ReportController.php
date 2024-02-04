<?php

namespace App\Http\Controllers;

use App\Models\ReportReciver;
use App\Models\User;
use App\Models\Report;
use App\Http\Controllers\Controller;
use function Laravel\Prompts\select;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getLaporan = Report::whereHas('reciver', function ($query) {
            $query->where('reciver_id', auth()->user()->id);
        })->get();

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
        $request->validated([
            'Sender_id' => 'required',
            'recipient' => 'required',
            'Subject' => 'required',
            'Message' => 'required',
        ]);

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
        $report->save();

        // Attach unique recipients to the report
        foreach ($uniqueRecipients as $recipient) {
            $reportRecipient = new ReportReciver();
            $reportRecipient->report_id = $report->id;
            $reportRecipient->reciver_id = $recipient;
            $reportRecipient->save();
        }

        return Redirect::route('reportShow')->with('success', 'Laporan berhasil dikirim');
    }


    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
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
}
