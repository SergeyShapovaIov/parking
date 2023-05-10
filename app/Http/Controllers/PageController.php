<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PageController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'text' => 'required|max:2023',
            'link' => 'required|max:255'
        ]);


        try {
            Page::store($validated);
        } catch (Exception $exception) {

        }

        return redirect('admin-panel');
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


    public function getPageByLink(Request $request)
    {
        $validated = validator($request->route()->parameters(), [

            'link' => 'required|max:255'

        ])->validate();

        $page = Page::getByLink($validated['link']);

        return view('info-page', [
            'page' => $page,
            'infoPages' => Page::getAll()
        ]);
    }

    public function deleteById(Request $request)
    {
        $validated = validator($request->route()->parameters(), [

            'page' => 'required'

        ])->validate();

        Page::deleteById($validated['page']);

        return redirect('admin-panel');
    }
}
