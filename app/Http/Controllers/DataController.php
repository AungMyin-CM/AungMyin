<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use Response;

class DataController extends Controller
{
    public function exportPatientCSV()
    {
        $filepath = public_path('docs\Patient.xlsx');
        return Response::download($filepath); 
    }

    public function exportMedCSV()
    {
        $fileName = 'Pharmacy.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Code', 'Name', 'Expire date ', 'Quantity', 'Actual Price', 'Margin', 'Selling Price', 'Unit', 'Vendor', 'Vendor Phone Number', 'Description', 'Storage Place');
        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}