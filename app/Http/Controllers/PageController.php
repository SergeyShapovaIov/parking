<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PageController extends Controller
{

    public function store()
    {

    }

    public function updateById(Request $request)
    {
        $validated = $request->validate([
           'page_id'=> 'required|min:1',
           'title' => 'required|max:255',
           'text' => 'required|max:2023',
           'link' => 'required|max:255'
        ]);

        try {
            Page::updateById($validated);
        } catch (Exception $exception) {

        }

        return redirect('admin-panel');
    }

    public function getAll()
    {

    }

    public function deleteById()
    {

    }
}
