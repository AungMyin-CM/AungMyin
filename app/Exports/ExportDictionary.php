<?php

namespace App\Exports;

use App\Models\Dictionary;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportDictionary implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{

    public function collection()
    {

        $dictionary = Dictionary::where('user_id',Auth::user()->id)->get();

        $dictionary = $dictionary->map(function ($data) {
            $data->isMed = ($data->isMed == 1) ? 'Yes' : 'No';
            return $data;
        });

        return $dictionary;
    }

    public function headings(): array
    {
        return [
            'Code','Meaning','Price','Is Common','Is Medicine', 'Is Procedure'
        ];
    }

    public function map($row): array
    {
        return [
            $row->code,
            $row->meaning,
            $row->price,
            $row->isCommon,
            $row->isMed,
            $row->isProcedure,
        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event){
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13
                    ]
                ]);
            }
        ];
    }
}
