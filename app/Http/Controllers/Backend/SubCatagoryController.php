<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SlugBuilder;
use App\Models\Catagory;
use App\Models\SubCatagory;
use Illuminate\Http\Request;

class SubCatagoryController extends Controller
{
    use SlugBuilder;

    public function allSubCatagory()
    {
        $allSubcatagory = SubCatagory::with('catagory:catagory_name,id')->get();
        $allcatagory = Catagory::get();

        return view('layouts.Backend.subcatagory', compact('allSubcatagory', 'allcatagory'));
    }

    public function addSubCatagory(Request $req)
    {
        $req->validate([
            'subcatagory_name' => 'required',
            'catagory_id' => 'required',
        ]);

        $newSubCatagory = new SubCatagory();
        $newSubCatagory->catagory_id = $req->catagory_id;
        $newSubCatagory->subcatagory_name = $req->subcatagory_name;
        $newSubCatagory->slug = $this->getSlug($req, SubCatagory::class, 'subcatagory_name');
        $newSubCatagory->save();

        return back();
    }

    public function editSubCatagory($slug)
    {
        $editData = SubCatagory::where('slug', $slug)->first();
        $allSubcatagory = SubCatagory::with('catagory:catagory_name,id')->get();
        $allcatagory = Catagory::get();

        return view('layouts.Backend.subcatagory', compact('allSubcatagory', 'allcatagory', 'editData'));
    }

    public function updateSubCatagory(Request $req, $slug)
    {
        $req->validate([
            'subcatagory_name' => 'required',
            'catagory_id' => 'required',
        ]);
        $updateData = SubCatagory::where('slug', $slug)->first();
        $updateData->subcatagory_name = $req->subcatagory_name;
        $updateData->catagory_id = $req->catagory_id;
        $updateData->slug = $this->getSlug($req, SubCatagory::class, 'subcatagory_name');
        $updateData->save();

        return back();
    }

    public function deleteSubCatagory($id)
    {
        $deleteItem = SubCatagory::find($id);
        $deleteItem->delete();

        return back();
    }
}
