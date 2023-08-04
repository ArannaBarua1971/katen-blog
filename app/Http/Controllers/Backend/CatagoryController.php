<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SlugBuilder;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

class CatagoryController extends Controller
{
    use SlugBuilder,HasRoles;

    public function allCatagory()
    {
        $allCatagory = Catagory::simplePaginate(5);

        return view('layouts.Backend.catagory', compact('allCatagory'));
    }

    public function addCatagory(Request $req)
    {
        $req->validate([
            'catagory_name' => 'required',
        ]);

        $newCatagory = new Catagory();
        $newCatagory->catagory_name = $req->catagory_name;
        $slug = $this->getSlug($req, Catagory::class, 'catagory_name');
        $newCatagory->slug = $slug;
        $newCatagory->save();

        return back();
    }

    public function editCatagory($slug)
    {
        $editData = catagory::Where('slug', $slug)->first();
        $allCatagory = Catagory::simplePaginate(5);

        return view('layouts.Backend.catagory', compact('allCatagory', 'editData'));
    }

    public function updateCatagory(Request $req, $slug)
    {
        $req->validate([
            'catagory_name' => 'required',
        ]);

        $updateData = catagory::Where('slug', $slug)->first();
        $updateData->catagory_name = $req->catagory_name;
        $slug = $this->getSlug($req, Catagory::class, 'catagory_name');
        $updateData->slug = $slug;
        $updateData->save();

        return redirect()->route('catagory.all');
    }

    public function deleteCatagory($id)
    {
        $deleteData = Catagory::find($id);

        $deleteData->delete();

        return redirect()->route('catagory.all');
    }
}
