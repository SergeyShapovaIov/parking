<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Recipient\InputForRecipientNotValidException;
use App\Exceptions\Recipient\RecipientNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class RecipientController extends Controller
{
    public function getAll(Request $request)
    {
        $this->setLocaleFromHeaderRequest($request);

        $recipients = $this->convertConsentOnMailingInArray(Recipient::getAll());

        return response([
            "message" => __('response_messages.successful_query_count_recipient', ['count' => count($recipients)]),
            "data" => $recipients
        ], 200)->header('Content-Type', 'application/json');
    }

    public function getById(Request $request, $id)
    {
        $this->setLocaleFromHeaderRequest($request);

        try {

            $recipient = Recipient::getById($id);

            $recipient->consent_mailing = (bool)$recipient->consent_mailing;

            return response([
                "message" => __('response_messages.successful_query_get_recipient_by_id'),
                "data" => $recipient
            ], 200)->header('Content-Type', 'application/json');
        } catch (RecipientNotFoundException $exception) {
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

            $id = Recipient::store($validated);

            $recipient = Recipient::getById($id);

            $recipient->consent_mailing = (bool)$recipient->consent_mailing;

            return response([
                "message" => __('response_messages.successful_recipient_create'),
                "data" => $recipient
            ], 200)->header('Content-Type', 'application/json');

        } catch (InputForRecipientNotValidException $exception) {

            return response([
                "message" => __('response_messages.failed_recipient_create'),
                "errors" => json_decode($exception->getMessage())
            ], 400)->header('Content-Type', 'application/json');

        }
    }

    public function updateById(Request $request, $id)
    {
        try {

            $this->setLocaleFromHeaderRequest($request);

            $validated = $this->validateInputParams($request);

            $validated['consent_mailing'] = (bool)$validated['consent_mailing'];

            Recipient::updateById($validated, $id);

            $recipient = Recipient::getById($id);

            $recipient->consent_mailing = (bool)$recipient->consent_mailing;

            return response([
                "message" => __('response_messages.successful_query_recipient_update'),
                "data" => $recipient
            ], 200)->header('Content-Type', 'application/json');

        } catch (RecipientNotFoundException $exception) {

            return response([
                "message" => __('response_messages.failed_query_recipient_update'),
                "errors" => $exception->getMessage()
            ], 200)->header('Content-Type', 'application/json');

        } catch (InputForRecipientNotValidException $exception) {

            return response([
                "message" => __('response_messages.failed_recipient_update'),
                "errors" => json_decode($exception->getMessage())
            ], 400)->header('Content-Type', 'application/json');

        }
    }

    public function deleteById(Request $request, $id)
    {
        try {

            $this->setLocaleFromHeaderRequest($request);

            $recipient = Recipient::deleteById($id);

            return response([
                "message" => __('response_messages.successful_query_recipient_delete'),
                "data" => $recipient
            ], 200)->header('Content-Type', 'application/json');

        } catch (RecipientNotFoundException $exception) {

            return response([
                "message" => __('response_messages.failed_query_recipient_delete'),
                "errors" => $exception->getMessage()
            ], 400);

        }
    }

    private function convertConvertMailingPropertyInArray($recipients): array
    {
        foreach ($recipients as $recipient) {
            $recipient['consent_mailing'] = 0 ? false : true;
        }
        return $recipients;
    }

    private function setLocaleFromHeaderRequest(Request $request): void
    {
        $locale = $request->header()['lang'][0] ?? "en";
        App::setLocale($locale);
    }

    /**
     * @throws InputForRecipientNotValidException
     */
    private function validateInputParams(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha_dash|max:255',
            'last_name' => 'required|alpha_dash|max:255',
            'consent_mailing' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            throw new InputForRecipientNotValidException($validator->errors());
        }

        return $validator->valid();
    }

    private function  convertConsentOnMailingInArray($recipients)
    {
        foreach ($recipients as $recipient) {
            $recipient->consent_mailing =  (bool)$recipient->consent_mailing;
        }

        return $recipients;
    }

}
