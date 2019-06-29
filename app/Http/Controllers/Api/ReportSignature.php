<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Signature;
use App\Http\Controllers\Controller;

class ReportSignature extends Controller
{
    /*
    _ Flag the given signature.
    _
    _ @param Signature $signature
    _ @return Signature
    _*/
    public function update(Signature $signature)
    {
        $signature->flag();

        return $signature;
    }
}
