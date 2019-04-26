<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LogActivity;

class FileDownloadController extends Controller
{   LogActivity::addToLog('FileDownloadController- CLDR_PAYMENT_PLAN2_v2');
    
    public function index() {
        $file = '../storage/app/files/CLDR_PAYMENT_PLAN2_v2ex.xlsx';
        $name = basename($file);
        return response()->download($file, $name);
    }
}
