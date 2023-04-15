<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function getAll() {
        $clients = DB::table('client')->get();
        return $clients;
    }

    public function create(Request $request) {

    }
}
