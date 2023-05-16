<?php

namespace App\Models;

use App\Exceptions\Address\AddressNotFoundException;
use App\Exceptions\DuplicateRecordException;
use App\Exceptions\Recipient\RecipientNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class Address extends Model
{
    use HasFactory;

    static function getAll(): Collection|null
    {
        return DB::table('address')->get();
    }

    /**
     * @throws AddressNotFoundException
     */
    static function getById($id)
    {
        $address = DB::table('address')->where('id', '=', $id)->first();

        if ($address == null) {
            throw new AddressNotFoundException(__('exceptions.address_not_found', [
                'attribute' => 'id',
                'value' => $id
            ]));
        }
        return DB::table('address')->where('id', '=', $id)->first();
    }

    /**
     * @throws DuplicateRecordException
     */
    static function store($params): int
    {
        if (self::checkRecordForDuplicate($params)) {
            throw new DuplicateRecordException(__('exceptions.duplicate_database_record'));
        }

        return DB::table('address')->insertGetId([
            'region' => $params['region'],
            'populated_area' => $params['populated_area'],
            'street' => $params['street'],
            'house_number' => $params['house_number'],
            'zip_code' => $params['zip_code'],
            'recipient_id' => $params['recipient_id']
        ]);
    }

    /**
     * @throws AddressNotFoundException
     * @throws DuplicateRecordException
     * @throws RecipientNotFoundException
     */
    static function updateById($params, $id): void
    {
        if (!self::checkExistAddressById($id)) {
            throw new AddressNotFoundException(__('exceptions.address_not_found', [
                'attribute' => 'id',
                'value' => $id
            ]));
        }

        if (self::checkRecordForDuplicate($params)) {
            throw new DuplicateRecordException(__('exceptions.duplicate_database_record'));
        }

        if (!Recipient::checkExistRecipientById($params['recipient_id'])) {
            throw new RecipientNotFoundException(__('exceptions.recipient_not_found', [
                'attribute' => 'id',
                'value' => $params['recipient_id']
            ]));
        }

        DB::table('address')->where('id', '=', $id)
            ->update([
                'region' => $params['region'],
                'populated_area' => $params['populated_area'],
                'street' => $params['street'],
                'house_number' => $params['house_number'],
                'zip_code' => $params['zip_code'],
                'recipient_id' => $params['recipient_id']
            ]);

    }

    /**
     * @throws AddressNotFoundException
     */
    static function deleteById($id): Collection
    {
        if (!self::checkExistAddressById($id)) {
            throw new AddressNotFoundException(__('exceptions.address_not_found', [
                'attribute' => 'id',
                'value' => $id
            ]));
        }

        $address = DB::table('address')->where('id', '=', $id)->get();

        DB::table('address')->where('id', '=', $id)->delete();

        return $address;
    }

    static function checkExistAddressById($id): bool
    {
        return DB::table('address')->where('id', '=', $id)->exists();
    }

    private static function checkRecordForDuplicate($params): bool
    {
        return DB::table('address')
            ->where('region', '=', $params['region'])
            ->where('populated_area', '=', $params['populated_area'])
            ->where('street', '=', $params['street'])
            ->where('house_number', '=', $params['house_number'])
            ->where('zip_code', '=', $params['zip_code'])
            ->where('recipient_id', '=', $params['recipient_id'])
            ->exists();
    }
}
