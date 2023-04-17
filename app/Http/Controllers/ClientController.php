<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;

class ClientController extends Controller
{
    public function getAll() 
    {
        //
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'gender' => 'required',
            'phone_number' => 'required|size:11',
            'address' => 'required|max:255'
        ]);

        try {
            Client::store($validated['name'], $validated['gender'], $validated['phone_number'], $validated['address']);
        } catch (Exception) {

        }
        
        return redirect('/add-client');
    }

    public function show() 
    {
        //
    }

    public function edit() 
    {
        //
    }

    public function update() 
    {
        //
    }

    public function delete(Request $request, $id) 
    {
        
        $validated = validator($request->route()->parameters(), [

            'client' => 'required'
        
        ])->validate();

        Client::deleteById($validated['client']);

        return redirect('client-list');
    }
}
