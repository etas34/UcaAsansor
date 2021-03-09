<?php

namespace App\Exports;

use App\AsansorModel;
use App\ParcaModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ParcaExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    public function collection()
    {
        $parca=ParcaModel::where('parca_models.durum','=',1)
            ->join('asansor_models', 'parca_models.asansor_id', '=', 'asansor_models.id')
            ->join('users', 'parca_models.user_id', '=', 'users.id')
            ->select('kimlik','apartman','blok','parca','miktar','birim','users.name','parca_models.created_at','sekil','fatura_no')
            ->orderBy('created_at', 'desc')->get();
        return $parca;
    }

    public function headings(): array
    {
        return [
            'Asansör Kimlik No','Apartman','Blok','Değiştirilen Parça','Miktar','Birim','Değiştiren Kişi','Tarih','Değiştirilme Şekli','Fatura No'
        ];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:J1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(4);

            },
        ];
    }
}
