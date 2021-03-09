<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\YorumModel
 *
 * @property int $id
 * @property int $gorev_id
 * @property int $user_id
 * @property string $yorum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel whereGorevId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\YorumModel whereYorum($value)
 * @mixin \Eloquent
 * @property-read \App\GorevModel $gorevFunc
 * @property-read \App\User $userFunc
 */
class YorumModel extends Model
{
    public function gorevFunc()
    {
        return $this->hasOne('\App\GorevModel','id','gorev_id');
    }
    public function userFunc()
    {
        return $this->hasOne('\App\User','id','user_id');
    }


}
