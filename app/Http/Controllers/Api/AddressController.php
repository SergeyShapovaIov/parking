<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Address\AddressNotFoundException;
use App\Exceptions\Address\InputForAddressNotValidException;
use App\Exceptions\DuplicateRecordException;
use App\Exceptions\Recipient\RecipientNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Recipient;
use Dotenv\Repository\AdapterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
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
     * @throws ValidationException
     */
    public function getById(Request $request)
    {
        $this->setLocaleFromHeaderRequest($request);

        try {

            $validated = validator($request->route()->parameters(), [

                'id' => 'required'

            ])->validate();

            $address = Address::getById($validated['id']);

            return response([
                "message" => __('response_messages.successful_query_ger_address_by_id'),
                "data" => $address
            ], 200)->header('Content-Type', 'application/json');
        } catch (AddressNotFoundException $exception) {
            return response([
                "message" => __('response_messages.failed_query'),
                "errors" => $exception->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {

            $this->setLocaleFromHeaderRequest($request);

            $validated = $this->validateInputParams($request);

            $this->checkExistRecipientById($validated['recipient_id']);

            $id = Address::store($validated);

            return response([
                "message" => __('response_messages.successful_address_create'),
                "data" => Address::getById($id)
            ], 200)->header('Content-Type', 'application/json');

        } catch (DuplicateRecordException $exception) {

            return response([
                "message" => __('response_messages.failed_address_create'),
                "errors" => __('response_messages.failed_duplicate_record')
            ], 400)->header('Content-Type', 'application/json');

        } catch (RecipientNotFoundException $exception) {

            return response([
                "message" => __('response_messages.failed_address_create'),
                "errors" => __('response_messages.recipient_by_id_not_found', ['id' => $validated['recipient_id']])
            ], 400)->header('Content-Type', 'application/json');

        } catch (InputForAddressNotValidException $exception) {

            return response([
                "message" => __('response_messages.failed_address_create'),
                "errors" => json_decode($exception->getMessage())
            ], 400)->header('Content-Type', 'application/json');

        }
    }

    /**
     * @throws InputForAddressNotValidException
     */
    public function updateById(Request $request, $id)
    {
        try {

            $this->setLocaleFromHeaderRequest($request);

            $validated = $this->validateInputParams($request);

            Address::updateById($validated, $id);

            return response([
                "message" => __('response_messages.successful_query_address_update'),
                "data" => Address::getById($id)
            ], 200)->header('Content-Type', 'application/json');

        } catch (AddressNotFoundException $exception) {

            return response([
                "message" => __('response_messages.failed_query_address_update'),
                "errors" => $exception->getMessage()
            ], 200)->header('Content-Type', 'application/json');

        } catch (DuplicateRecordException $exception) {

            return response([
                "message" => __('response_messages.failed_query_address_update'),
                "errors" => $exception->getMessage()
            ], 200)->header('Content-Type', 'application/json');

        } catch (RecipientNotFoundException $exception) {

            return response([
                "message" => __('response_messages.failed_query_address_update'),
                "errors" => $exception->getMessage()
            ], 200)->header('Content-Type', 'application/json');
        }

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

    /**
     * @throws InputForAddressNotValidException
     */
    private function validateInputParams(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'region' => 'required|max:255',
            'populated_area' => 'required|max:255',
            'street' => 'required|max:255',
            'house_number' => 'required|max:10',
            'zip_code' => 'required|numeric',
            'recipient_id' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            throw new InputForAddressNotValidException($validator->errors());
        }


        return $validator->valid();
    }

    /**
     * @throws RecipientNotFoundException
     */
    private function checkExistRecipientById($id): void
    {
        $status = Recipient::checkExistRecipientById($id);

        if (!$status) {
            throw new RecipientNotFoundException();
        }
    }


}
