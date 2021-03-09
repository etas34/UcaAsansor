<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ArizaModel
 *
 * @property int $id
 * @property int $asansor_id
 * @property int|null $icindebiri
 * @property int|null $fotosel
 * @property int|null $sesgeliyor
 * @property int|null $baskaariza
 * @property string|null $disinda
 * @property string|null $ariza_not
 * @property int|null $user_id
 * @property int|null $durum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereArizaNot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereAsansorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereBaskaariza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereDisinda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereFotosel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereIcindebiri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereSesgeliyor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArizaModel whereUserId($value)
 * @mixin \Eloquent
 */
class ArizaModel extends Model
{
    protected $fillable = ['durum'];
}
