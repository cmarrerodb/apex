<?php

namespace App\Http\Controllers\Api;

use App\Models\GiftCredito;
use App\Models\GiftEstados;
use Illuminate\Http\Request;
use App\Models\GiftFormasPago;
use App\Models\GiftEstadosPago;
use App\Http\Controllers\Controller;

class AuxiliaresController extends Controller
{

    public function gift_estados(){
        $data = GiftEstados::get();
        return $data;
    }

    public function gift_estado_pagos(){
        $data=GiftEstadosPago::get();
        return $data;
    }

    public function gift_credito(){
        $data =GiftCredito::get();
        return $data;
    }

    public function gift_formas_pago(){
        $data =GiftFormasPago::get();
        return $data;
    }


}
