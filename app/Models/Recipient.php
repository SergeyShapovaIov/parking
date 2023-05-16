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
    static function getById($id)
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
    static function updateById($params, $id): void
    {
        if (!self::checkExistRecipientById($id)) {
            throw new RecipientNotFoundException(__('exceptions.recipient_not_found', [
                'attribute' => 'id',
                'value' => $id
            ]));
        }

        DB::table('recipient')->where('id', '=', $id)
            ->update([
                'first_name' => $params['first_name'],
                'last_name' => $params['last_name'],
                'consent_mailing' => $params['consent_mailing']
            ]);
    }

    /**
     * @throws RecipientNotFoundException
     */
    static function deleteById($id): Collection
    {
        if (!self::checkExistRecipientById($id)) {
            throw new RecipientNotFoundException(__('exceptions.recipient_not_found', [
                'attribute' => 'id',
                'value' => $id
            ]));
        }

        $recipient = DB::table('recipient')->where('id', '=', $id)->get();

        DB::table('recipient')->where('id', '=', $id)->delete();

        return $recipient;
    }

    static function checkExistRecipientById($id): bool
    {
        return DB::table('recipient')->where('id', '=', $id)->exists();
    }

}
