<?php

namespace App\Http\Controllers;

use App\Models\MetaTag;
use Illuminate\Http\Request;

class MetaTagController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required|max:255',
            'page_id' => 'required'
        ]);

        MetaTag::store($validated);

        return redirect('page-update/' . $validated['page_id']);
    }

    public function deleteById(Request $request, $page_id, $tag)
    {
        MetaTag::deleteById($tag);

        return redirect('page-update/' . $page_id);

    }
}
