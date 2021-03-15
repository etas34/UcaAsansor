<?php

namespace App\Exports;

use App\AsansorModel;
use App\BakimModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;


class BakimExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bakimlar=AsansorModel::where('durum','=',1)
            ->whereDate('aylik_bakim', '<', Carbon::now()->firstOfMonth())
            ->select('kimlik','apartman','blok','adres','aylik_bakim')->get();
        return $bakimlar;
    }

    public function headings(): array
    {
        return [
            'Asansör Kimlik No','Apartman','Blok','Adres','Son Aylik Bakım Tarihi'
        ];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(4);

            },
        ];
    }
}
