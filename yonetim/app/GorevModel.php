<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GorevModel
 *
 * @property int $id
 * @property string $baslik
 * @property string $icerik
 * @property int $sahip_id
 * @property int $atanan_id
 * @property int $onem_id
 * @property string|null $bitis_zaman
 * @property int $durum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereAtananId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereBaslik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereBitisZaman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereIcerik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereOnemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereSahipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $bas_zaman
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GorevModel whereBasZaman($value)
 * @property-read \App\User $atananFunc
 * @property-read \App\DurumModel $durumFunc
 * @property-read \App\OnemModel $onemFunc
 * @property-read \App\User $sahipFunc
 */
class GorevModel extends Model
{
    protected $fillable = ['durum'];

    public function durumFunc()
    {
        return $this->hasOne('\App\DurumModel','id','durum');
    }
    public function onemFunc()
    {
        return $this->hasOne('\App\OnemModel','id','onem_id');
    }

    public function sahipFunc()
    {
        return $this->hasOne('\App\User','id','sahip_id');
    }

    public function atananFunc()
    {
        return $this->hasOne('\App\User','id','atanan_id');
    }

}
