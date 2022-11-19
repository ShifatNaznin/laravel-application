<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Data;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function typeReport()
    {
        $type = Type::orderBy('id', 'Asc')->get();
        return view('admin.report.index')->with([
            'type' => $type,
        ]);
    }
    public function assetReport()
    {
        $asset = Asset::orderBy('id', 'Asc')->get();
        return view('admin.report.asset')->with([
            'asset' => $asset,
        ]);
    }
    public function monthlyReport()
    {
        $year = Data::select(
            DB::raw("YEAR(date) as year_name")
        )
            ->groupBy('year_name')
            ->get();
        // $year = Asset::orderBy('id','Asc')->get();
        return view('admin.report.monthly')->with([
            'year' => $year,
        ]);
    }
    public function quarterlyReport()
    {
        $year = Data::select(
            DB::raw("YEAR(date) as year_name")
        )
            ->groupBy('year_name')
            ->get();
        // $year = Asset::orderBy('id','Asc')->get();
        return view('admin.report.quarterly')->with([
            'year' => $year,
        ]);
    }
    public function getMonth(Request $request)
    {
        $month = Data::where(DB::raw("YEAR(date)"), $request->year)
            ->select(
                DB::raw("MONTHNAME(date) as month_name")
            )
            ->groupBy('month_name')
            // ->orderBy('created_at','DESC')
            ->get();
        $options = "<option value='' >-- Select Month --</option>";
        foreach ($month as $item) {
            $options .= "<option value='$item->month_name'>$item->month_name</option>";
        }
        return response()->json($options);
    }
    public function getReportList(Request $request)
    {
        $typeId = $request->typeId;
        $assetId = $request->assetId;
        $month = $request->month;
        $year = $request->year;
        $data = Data::when(isset($typeId), function ($query) use ($typeId) {
            $query->where('typeId', $typeId);
        })
            ->when(isset($assetId), function ($query) use ($assetId) {
                $query->where('assetId', $assetId);
            })
            ->when(isset($month, $year), function ($query) use ($year, $month) {
                $query->whereYear('date', $year)->where(DB::raw("MONTHNAME(created_at)"), $month);
            })
            ->get();
        return view('admin.report.ajax')->with([
            'data' => $data,
        ]);
    }
    public function getQuarterList(Request $request)
    {
        // return $request->month;
        $quarterId = $request->quarterId;
        //  return gettype($quarterId);
        $year = $request->year;
        if ($quarterId == 1) {
            $start_month = 1;
            $end_month = 3;
        } else if ($quarterId == 2) {
            $start_month = 4;
            $end_month = 6;
        } else if ($quarterId == 3) {
            $start_month = 7;
            $end_month = 9;
        } else if ($quarterId == 4) {
            $start_month = 10;
            $end_month = 12;
        }
        $data = Data::when(!($quarterId == 0 || $quarterId == "null"), function ($query) use ($year, $start_month, $end_month) {
            $query->whereYear('date', $year)->whereMonth('date', '>=', $start_month)->whereMonth('date', '<=', $end_month);
        })
            ->get();
        return view('admin.report.ajax')->with([
            'data' => $data,
        ]);
    }
    public function printPdf(Request $request)
    {
        $data=array(
         'a'=>1,
         'b'=>2,
        );
        $fileName = 'fisher-man-list-by-birth.pdf';
        $mPdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10,
            'default_font' => 'nikosh',
            'default_font_size' => 14
        ]);
        $html = \View::make('admin.report.pdf2',['fisherList' => $data]);
        $html = $html->render();
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName, 'I');
        // return "ok";
        // return $request->month;
        // $typeId = $request->typeId;
        // $assetId = $request->assetId;
        // $month = $request->month;
        // $data = Data::get();

        // $data = Data::when(isset($typeId), function ($query) use ($typeId) {
        //     $query->where('typeId', $typeId);
        // })
        // ->when(isset($assetId), function ($query) use ($assetId) {
        //     $query->where('assetId', $assetId);
        // })
        // ->when(isset($month), function ($query) use ($month) {
        //     $query->where(DB::raw("MONTHNAME(created_at)"), $month);
        // })
        // ->get();
        // return $data;
        // $fileName = 'pdf123.pdf';
        // $mPdf = new \Mpdf\Mpdf([
        //     'margin_left' => 10,
        //     'margin_right' => 10,
        //     'margin_top' => 15,
        //     'margin_bottom' => 20,
        //     'margin_header' => 10,
        //     'margin_footer' => 10,
        //     'default_font' => 'nikosh',
        //     'default_font_size' => 14,
        //     'format' => 'A4-L',
        //     'orientation' => 'L'
        //     // 'tempDir'=>storage_path('tempdir')
        // ]);
        // // echo "<pre>";
        // // print_r($data); 
        // // echo "</pre>";
        // // die;
        // $data=array(
        //  'a'=>1,
        //  'b'=>2,
        // );
        // $html = \View::make('admin.report.pdf',[ 'data' => $data,]);
        // $html = $html->render();
        // $mPdf->WriteHTML($html);
        // $mPdf->Output($fileName, 'I');
    }
}
