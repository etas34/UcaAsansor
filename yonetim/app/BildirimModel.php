<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BildirimModel
 *
 * @property int $id
 * @property int $user_id
 * @property int $gorev_id
 * @property int $bildirim_turu
 * @property int $okundu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel whereBildirimTuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel whereGorevId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel whereOkundu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BildirimModel whereUserId($value)
 * @mixin \Eloquent
 */
class BildirimModel extends Model
{
    //
}
