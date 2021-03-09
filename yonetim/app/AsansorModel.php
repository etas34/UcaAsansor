<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AsansorModel
 *
 * @property int $id
 * @property string $kimlik
 * @property string $apartman
 * @property string|null $blok
 * @property string|null $yonetici
 * @property string|null $yonetici_tel
 * @property string|null $aylik_bakim
 * @property string|null $yillik_bakim
 * @property int|null $durum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereApartman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereAylikBakim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereBlok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereKimlik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereYillikBakim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereYonetici($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereYoneticiTel($value)
 * @mixin \Eloquent
 * @property string|null $adres
 * @property string|null $etiket_tarihi
 * @property string|null $etiket
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereEtiket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereEtiketTarihi($value)
 * @property string|null $sozlesme
 * @property string|null $pdf
 * @property int|null $bakimci_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereBakimciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel wherePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AsansorModel whereSozlesme($value)
 */
class AsansorModel extends Model
{

    protected $guarded = ['id'];


}
