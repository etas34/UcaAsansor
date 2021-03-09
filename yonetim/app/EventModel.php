<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\EventModel
 *
 * @property int $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property int $allDay
 * @property string $backgroundColor
 * @property string $borderColor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereAllDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereBorderColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EventModel whereUserId($value)
 */
class EventModel extends Model
{
    //
}
