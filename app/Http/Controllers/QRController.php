<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index(Request $request){
        $hash = str_replace('.','',uniqid('',true));
        $url = $request->url().'/'.$hash;
        $data['qrcode'] = QrCode::generate($url);
        $data['qr'] = $hash;
        return view('giftcards.qr',$data);
    }

}
