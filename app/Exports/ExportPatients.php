<?php

namespace App\Exports;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportPatients implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize,WithEvents
{
    public function collection()
    {
        return Patient::where('user_id',Auth::user()->id)->get();
    }

    public function map($row): array
    {
        return [
            $row->name, $row->father_name, $row->age, $row->phoneNumber, $row->address, $row->gender, $row->summary
        ];
    }

    public function headings(): array
    {
        return [
            'Name', 'Father Name', 'Age' , 'Phone Number' , 'Address' , 'Gender' , 'Summary'
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
