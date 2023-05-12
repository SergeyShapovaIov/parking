<?php

namespace App\Models;


use App\Exceptions\Recipient\RecipientNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class Recipient extends Model
{
    use HasFactory;

    static function getAll(): Collection|null
    {
        return DB::table('recipient')->get();
    }

    /**
     * @throws RecipientNotFoundException
     */
    static function getById($id): Model|Builder
    {

        if (!self::checkExistRecipientById($id)) {
            throw new RecipientNotFoundException(__('exceptions.recipient_not_found', [
                'attribute' => 'id',
                'value' => $id
            ]));
        }
        return DB::table('recipient')->where('id', '=', $id)->first();
    }

    static function store($params): int
    {
        return DB::table('recipient')->insertGetId([
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'],
            'consent_mailing' => $params['consent_mailing']
        ]);
    }

    /**
     * @throws RecipientNotFoundException
     */
    static function updateById($params)
    {
        if (!self::checkExistRecipientById($params['id'])) {
            throw new RecipientNotFoundException(__('exceptions.recipient_not_found', [
                'attribute' => 'id',
                'value' => $params['id']
            ]));
        }

        DB::table('recipient')->where('id', '=', $params['id'])
            ->update([
                'first_name' => $params['first_name'],
                'last_name' => $params['last_name'],
                'consent_mailing' => $params['consent_mailing']
            ]);
    }

    static function deleteById()
    {
        //
    }

    static function checkExistRecipientById($id): bool
    {
        return DB::table('recipient')->where('id', '=', $id)->exists();
    }

}
