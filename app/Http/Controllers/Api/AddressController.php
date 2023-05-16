<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Address\AddressNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Address;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{
    public function getAll(Request $request)
    {
        $this->setLocaleFromHeaderRequest($request);

        $addresses = Address::getAll();
        return response([
            "message" => __('response_messages.successful_query_count_address', ['count' => count($addresses)]),
            "data" => $addresses
        ], 200)->header('Content-Type', 'application/json');
    }

    /**
     * @throws AddressNotFoundException
     * @throws ValidationException
     */
    public function getById(Request $request)
    {
        $this->setLocaleFromHeaderRequest($request);

        $validated = validator($request->route()->parameters(), [

            'id' => 'required'

        ])->validate();

        try {

            $address = Address::getById($validated['id']);

            return response([
                "message" => __('response_messages.successful_query_address_update'),
                "data" => $address
            ], 200)->header('Content-Type', 'application/json');
        } catch (AddressNotFoundException $exception) {
            return response([
                "message" => __('failed_messages')
            ], 400);
        } catch (ValidationException $exception) {

        }
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

    private function composeJsonResponse(string $status, string $message)
    {

    }

    private function setLocaleFromHeaderRequest(Request $request): void
    {
        $locale = $request->header()['lang'][0] ?? "en";
        App::setLocale($locale);
    }


}
