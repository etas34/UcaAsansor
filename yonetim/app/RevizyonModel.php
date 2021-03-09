<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RevizyonModel
 *
 * @property int $id
 * @property int $asansor_id
 * @property int|null $yag
 * @property int|null $makina
 * @property int|null $kabin
 * @property int|null $pano
 * @property int|null $kuyu
 * @property string|null $ekstra
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereAsansorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereEkstra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereKabin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereKuyu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereMakina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel wherePano($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereYag($value)
 * @mixin \Eloquent
 * @property int|null $revizyon
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RevizyonModel whereRevizyon($value)
 */
class RevizyonModel extends Model
{
    //
}
