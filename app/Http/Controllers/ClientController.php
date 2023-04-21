<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Car;

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
            $id = Client::store($validated['name'], $validated['gender'], $validated['phone_number'], $validated['address']);
        } catch (\Exception $exception) {

            return redirect('add-client')->with('message', $exception->getMessage());
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

    public function update(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|min:0',
            'name' => 'required|max:255',
            'gender' => 'required',
            'phone_number' => 'required|size:11',
            'address' => 'required|max:255'
        ]);

        try {
            Client::updateById(
                $validated['name'],
                $validated['gender'],
                $validated['phone_number'],
                $validated['address'],
                $validated['client_id'],
            );
        } catch (\Exception) {

        }

        return redirect('/client-update/' . $validated['client_id']);
    }

    public function delete(Request $request)
    {

        $validated = validator($request->route()->parameters(), [

            'client' => 'required'

        ])->validate();


        Client::deleteById($validated['client']);

        return redirect('client-list');
    }
}
