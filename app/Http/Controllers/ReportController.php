<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Data;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function typeReport()
    { 
        $type = Type::orderBy('id','Asc')->get();
        return view('admin.report.index')->with([
            'type' => $type,
        ]);
    }
    public function assetReport()
    { 
        $asset = Asset::orderBy('id','Asc')->get();
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
    public function getMonth(Request $request){
        $month = Data::where(DB::raw("YEAR(date)"),$request->year)
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
        // return $request->month;
        $typeId=$request->typeId;
        $assetId=$request->assetId;
        $month=$request->month;
        $data = Data::when(isset($typeId), function ($query) use ($typeId) {
            $query->where('typeId', $typeId);
        })
        ->when(isset($assetId), function ($query) use ($assetId) {
            $query->where('assetId', $assetId);
        })
        ->when(isset($month), function ($query) use ($month) {
            $query->where(DB::raw("MONTHNAME(created_at)"), $month);
        })
        ->get();
        return view('admin.report.ajax')->with([
            'data' => $data,
        ]);
    }
}
