<?php

namespace App\Http\Controllers\Excel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class importstudent extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('excel.import');
    }

    public function parse(Request $request)
    {
        $file = $request->file('file')->getRealPath();
        $excelreader = IOFactory::load($file);
        $worksheet = $excelreader->getActiveSheet();
        $data = $worksheet->toArray(null,true,true,true);
        return $data;
    }

    public function laradaliy(Request $request)
    {
        // return $path;
        // if ($request->has('header')){
        //     $data = Excel::load($path, function($reader){})->get()->toArray();
        // }else{
        //     $data = array_map('str_getcsv',file($path));
        // }
        // if(count($data) > 0 ){
        //     if($request->has('header')){
        //         $csv_header_fields = [];
        //         foreach ($data[0] as $key => $value) {
        //             $csv_header_fields[] = $key;
        //         }
        //     }
        //     $csv_data = array_slice($data, 0 , 2);
        //     $csv_data_file = CsvData::create([
        //         'csv_filename'=> $request->file('csv_file')->getClientOriginalName(),
        //         'csv_header'=> $request->has('header'),
        //         'csv_data'=> json_encode($data)
        //     ]);
        // }else{
        //            return $data;
        // }
        // return view('excel.import', compact('csv_header_fields','csv_data','csv_data_file'));

        // $file = "./here.xlsx";

//        $spreadsheet = new Spreadsheet();
//        $sheet = $spreadsheet->getActiveSheet();
//        $sheet->setCellValue('A1','here');
//         $writer = new Xlsx($spreadsheet);
//         $writer->save('hello world.xlsx');
//         echo "<meta http-equiv='refresh' content='0;url=hello world.xlsx'/>";


    }
    public function process()
    {
        return 'process';
    }









}

/**
 * $file = "test.xlsx";
 * $excelReader = PHPExcel_IOFactory::createReaderForFile($file);
 * $excelObj = $excelReader->load($file);
 * $worksheet = $excelObj->getSheet(0);
 * $lastRow = $worksheet->getHighestRow();
 * $lstCol = $worksheet->getHighestColumn();
 *  // to get value
 * //for loop
 * $worksheet->getCell('A',index)->getValue();
 *
 * $worksheet->toArray(null, true,true, true);
 *                     0: if cell doesn't exist 1:to specify whether the formular should be calculated
 * 3:specify whether the cell format should be applied to the returned data e.g 1246.00 instesad of 1246
 * 4: specify whether the array index should be a simple running number or the actual cell number on the sheet array['1']['A']
 *
 *
 *
 *
 * **/
/** using this import Writer\Xlsx
 *  dis one is like creating report
 * $spreadsheet = new Spreadsheet();
 * $sheet = $spreadsheet->getActiveSheet();
 * $sheet->setCellValue('A1','helloworld');
 *  // unrecommended way
 * $writer = new Xlsx($spreadsheet);
 * $writer->save('hello world.xlsx');
 * echo "<meta http-equiv='refresh' content='0;url=hello world.xlsx'/>;
 *
 * recommended way using IOFactory
 *  making the server and the browser know this is a excel file
 * by changing the header
 *  //code
 *  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 * // set file name
 *  header('Content-Disposition: attachment;filename="result.xlsx"');
 *
 * $writer =  IOFactory::createWrite('$spreadsheet, 'Xlxs');
 * $writer->save('php://output');
 *
 *
 *
 * /
