<?php

namespace App\Exports;

use App\AsansorModel;
use App\RevizyonModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class RevizyonGecmisExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $bakimlar=RevizyonModel::where('revizyon_models.durum','=',2)
            ->join('asansor_models', 'revizyon_models.asansor_id', '=', 'asansor_models.id')
            ->join('users', 'revizyon_models.user_id', '=', 'users.id')
            ->select('kimlik','apartman','blok','etiket','name','revizyon_models.updated_at','etiket_tarihi')->get();
        return $bakimlar;
    }

    public function headings(): array
    {
        return [
            'Asansör Kimlik No','Apartman','Blok','Etiket','Revizyon Yapan','Revizyon Tarihi','Sonraki Kontrol Tarihi'
        ];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:G1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(4);

            },
        ];
    }
}
