<?php

namespace App\Exports;

use App\AsansorModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class AsansorExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function collection()
    {
        if ($this->id==1)
        {

            $asansor=AsansorModel::where('durum','=', 1)
                ->select('kimlik','apartman','blok','yonetici','yonetici_tel','adres','etiket','aylik_bakim','etiket_tarihi')
                ->get();
        }
        elseif ($this->id==2)
        {

            $asansor=AsansorModel::where('durum','=', 1)
                ->where('etiket','=','Sarı')
                ->select('kimlik','apartman','blok','yonetici','yonetici_tel','adres','etiket','aylik_bakim','etiket_tarihi')
                ->get();

        }
        elseif ($this->id==3)
        {
            $asansor=AsansorModel::where('durum','=', 1)
                ->where('etiket','=','Kırmızı')
                ->select('kimlik','apartman','blok','yonetici','yonetici_tel','adres','etiket','aylik_bakim','etiket_tarihi')
                ->get();

        }

        return $asansor;
    }

    public function headings(): array
    {
        return [
            'Asansör Kimlik No','Apartman','Blok','Yönetici','Yönetici Tel','Adres','Etiket','Son Aylik Bakım Tarihi','Sonraki Revizyon Tarihi'
        ];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:I1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(4);

            },
        ];
    }
}
