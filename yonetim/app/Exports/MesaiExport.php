<?php

namespace App\Exports;

use App\ArizaModel;
use App\ParcaModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class MesaiExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    public function collection()
    {

        $start = new Carbon('first day of last month');
        $start->startOfMonth();
        $end = new Carbon('last day of last month');
        $end->endOfMonth();

        $arizalar=ArizaModel::where('ariza_models.durum','=',2)
            ->join('asansor_models', 'ariza_models.asansor_id', '=', 'asansor_models.id')
            ->join('users', 'ariza_models.user_id', '=', 'users.id')
            ->whereDate('ariza_models.created_at', '>', $start)
            ->whereDate('ariza_models.created_at', '<', $end)
            ->where(function($query) {
                $query->WHERETIME('ariza_models.created_at','>','18:30:00' )
                    ->orwhereRaw('WEEKDAY(ariza_models.created_at) = 5')
                    ->orwhereRaw('WEEKDAY(ariza_models.created_at) = 6');
            })
            ->select('kimlik','apartman','blok','ariza_models.created_at','ariza_models.updated_at','users.name')

            ->get();
        return $arizalar;
    }

    public function headings(): array
    {
        return [
            'Asansör Kimlik No','Apartman','Blok','Arıza Tarihi','Arıza Giderilme Tarihi','Arıza Gideren'
        ];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(4);

            },
        ];
    }
}
