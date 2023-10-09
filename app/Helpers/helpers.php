<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Write code on Method
 *
 * @return response()
 */

if (!function_exists('getProfilDinas')) {
    function getProfilDinas()
    {
        $data = DB::table('profil')->first();
        return $data;
    }
}
