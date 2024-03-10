<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    public function timeline_reservas() {
        $semanas = DB::table('vres_semanas')->get();
        return json_encode($semanas);
    }
}
