<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Data;
use App\Models\Type;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function dataList()
    { 
        $data = Data::orderBy('id','DESC')->get();
        return view('admin.data.index')->with([
            'data' => $data,
        ]);
    }
    public function createData()
    { 
        $type = Type::orderBy('id','Asc')->get();
        $asset = Asset::orderBy('id','DESC')->get();
        return view('admin.data.create')->with([
            'type' => $type,
            'asset' => $asset,
        ]);
    }

    public function storeData(Request $request)
    {
        $add = new Data();
        $add->date = $request->date;
        $add->description = $request->description;
        $add->typeId = $request->typeId;
        $add->assetId = $request->assetId;
        $add->amount = $request->amount;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editData($id)
    { 
        $data = Data::findOrFail($id);
        $type = Type::orderBy('id','Asc')->get();
        $asset = Asset::orderBy('id','DESC')->get();
        return view('admin.data.edit')->with([
            'data' => $data,
            'type' => $type,
            'asset' => $asset,
        ]);
    }
    public function updateData(Request $request)
    {   
        $add = Data::find($request->id);
        $add->date = $request->date;
        $add->description = $request->description;
        $add->typeId = $request->typeId;
        $add->assetId = $request->assetId;
        $add->amount = $request->amount;
        $add->save();
        if ($add) {
            flash('Successfully Updated')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteData($id)
    {
        Data::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
}
