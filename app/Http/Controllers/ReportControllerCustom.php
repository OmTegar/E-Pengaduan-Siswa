<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReportControllerCustom extends Controller
{

    public function unreadReport()
    {
        $title = 'Laporan Belum Dibaca';
        $paginateControl = 30;

        $getLaporan = Report::orderByDesc('created_at')
            ->without('attachments')
            ->where(function ($query) {
                $query->where('sender_id', Auth::user()->id)
                    ->orWhereHas('reciver', function ($query) {
                        $query->where('reciver_id', Auth::user()->id);
                    });
            })
            ->where('status', 'terkirim')
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
        return view('reports.index', compact('getLaporan', 'title'));
    }

    public function progressingReport()
    {
        $title = 'Laporan Sedang Diproses';
        $paginateControl = 30;

        $getLaporan = Report::orderByDesc('created_at')
            ->without('attachments')
            ->where(function ($query) {
                $query->where('sender_id', Auth::user()->id)
                    ->orWhereHas('reciver', function ($query) {
                        $query->where('reciver_id', Auth::user()->id);
                    });
            })
            ->where('status', 'diproses')
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
        return view('reports.index', compact('getLaporan', 'title'));
    }

    public function selesaiReport()
    {
        $title = 'Laporan Selesai';
        $paginateControl = 30;

        $getLaporan = Report::orderByDesc('created_at')
            ->without('attachments')
            ->where(function ($query) {
                $query->where('sender_id', Auth::user()->id)
                    ->orWhereHas('reciver', function ($query) {
                        $query->where('reciver_id', Auth::user()->id);
                    });
            })
            ->where('status', 'selesai')
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
        return view('reports.index', compact('getLaporan', 'title'));
    }

    public function showPublicReport(Report $report)
    {
        // Check if the authenticated user is the sender or one of the receivers
        if ($report->sender_id == Auth::id() || $report->reciver->contains('reciver_id', Auth::id())) {
            // If the user is the sender or receiver, show the report
            // return view('report.show', compact('report'));
            return Redirect::route('report.show', $report->id);
        } else {
            // If not, return the view for the public report
            return view('landing-page.report', compact('report'));
        }
    }
}
