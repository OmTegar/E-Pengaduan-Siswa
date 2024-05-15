<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $countReport = Report::where('roomType', 'public')->count();
        $countUser = User::where('role_id', 3)->count();
        $countReportDone = Report::where('status', 'selesai')->count();

        $dataReportPublic = Report::where('roomType', 'public')->orderBy('created_at', 'desc')->limit(12)->get();

    
        return view('landing-page.main', compact('countReport', 'countUser', 'countReportDone', 'dataReportPublic'));
    }
    
}
