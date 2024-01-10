<?php

namespace App\Exports;

use App\Models\Pharmacy;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportPharmacy implements FromCollection,WithHeadings,WithMapping,WithEvents,ShouldAutoSize
{
    public function collection()
    {

        $clinic_id = session()->get('cc_id');

        return Pharmacy::where('clinic_id',$clinic_id)->get();
    }

    public function map($row): array
    {
        return [
            $row->code, $row->name, $row->expire_date, $row->quantity, $row->act_price, $row->margin, $row->sell_price, $row->unit, $row->vendor, $row->vendor_phoneNumber, $row->description, $row->storage_place
        ];
    }

    public function headings(): array
    {
        return [
            'Code', 'Name', 'Expire date ', 'Quantity', 'Actual Price', 'Margin', 'Selling Price', 'Unit', 'Vendor', 'Vendor Phone Number', 'Description', 'Storage Place'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:L1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13,
                    ],
                ]);
            },
        ];
    }
}
