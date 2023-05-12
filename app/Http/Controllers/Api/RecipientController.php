<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    public function getAll()
    {
        //
    }

    public function getById(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function updateById(Request $request)
    {
        //
    }

    public function deleteById(Request $request)
    {
        //
    }

    private function convertConvertMailingPropertyInArray($recipients): array
    {
        foreach ($recipients as $recipient) {
            $recipient['consent_mailing'] = 0 ? false : true;
        }
        return $recipients;
    }
}
