<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function assetList()
    { 
        $asset = Asset::orderBy('id','DESC')->get();
        return view('admin.asset.index')->with([
            'asset' => $asset,
        ]);
    }
    public function createAsset()
    { 
        return view('admin.asset.create');
    }

    public function storeAsset(Request $request)
    {
        $add = new Asset();
        $add->assetName = $request->assetName;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editAsset($id)
    { 
        $data = Asset::findOrFail($id);
        return view('admin.asset.edit')->with([
            'data' => $data,
        ]);
    }
    public function updateAsset(Request $request)
    {   
        $add = Asset::find($request->id);
        $add->assetName = $request->assetName;
        $add->save();
        if ($add) {
            flash('Successfully Updated')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteAsset($id)
    {
        Asset::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
}
