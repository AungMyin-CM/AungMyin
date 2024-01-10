<?php

namespace App\Http\Controllers;

use File;
use Response;
use Illuminate\Http\Request;

use App\Imports\ImportPatient;
use App\Exports\ExportPatients;
use App\Imports\ImportPharmacy;
use App\Exports\ExportDictionary;
use App\Exports\ExportPharmacy;
use App\Imports\ImportDictionary;
use Maatwebsite\Excel\Facades\Excel;



class DataController extends Controller
{
    // public function exportPatientCSV()
    // {
    //     $filepath = public_path('docs\Patient.xlsx');
    //     return Response::download($filepath);
    // }

    // public function exportMedCSV()
    // {
    //     $fileName = 'Pharmacy.csv';

    //     $headers = array(
    //         "Content-type"        => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //         "Pragma"              => "no-cache",
    //         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires"             => "0"
    //     );

    //     $columns = array('Code', 'Name', 'Expire date ', 'Quantity', 'Actual Price', 'Margin', 'Selling Price', 'Unit', 'Vendor', 'Vendor Phone Number', 'Description', 'Storage Place');
    //     $callback = function () use ($columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);
    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    public function importPatientExcel(Request $request)
    {
        $request->validate([
            "patient_excel"  => "required|mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|file|max:1024",
         ],[
             "patient_excel.mimetypes" => "The file format must be .xlsx"
         ]);

         Excel::import(new ImportPatient, request()->file('patient_excel'));

         return redirect()->back()->with("success","Your excel file is successfully uploaded") ;

    }



    public function importPharmacyExcel(Request $request){

        $request->validate([
            "pharmacy_excel"  => "required|mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|file|max:1024",
            ],[
                "pharmacy_excel.mimetypes" => "The file format must be .xlsx"
            ]);

        Excel::import(new ImportPharmacy, request()->file('pharmacy_excel'));

        return redirect()->back()->with('success','Your excel file is successfully uploaded');

    }

    public function importDictionaryExcel(Request $request){
        if($request->hasFile('dictionary_excel')){
            Excel::import(new ImportDictionary, request()->file('dictionary_excel'));

            return redirect()->back()->with('success','Your excel is successfully uploaded');
        }
    }

    // exports
    public function exportPatient()
    {
        return Excel::download(new ExportPatients,'patients.xlsx');
    }

    public function exportMedCSV(){

        return Excel::download(new ExportPharmacy, 'Pharmacy.xlsx');

    }


    public function exportDictionaryCSV(){

        return Excel::download(new ExportDictionary,'dictionaries.xlsx');

    }



}
