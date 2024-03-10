<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Traits\Funciones;
use App\Http\Traits\DigOceSpaces;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GiftCardApiController extends Controller
{
    use DigOceSpaces;
    use Funciones;

    private $hasUploadFiles = false;
    private $rollbackDocs   = "";

    public function __construct()
    {
         /* Declarar variables para rollback */
         $this->rollbackDocs   = null;
         $this->hasUploadFiles = false;
    }

    public function index()
    {
        $data = DB::table('vgiftcards')->get()->collect()->toArray();
        return(json_encode($data));
    }
}
