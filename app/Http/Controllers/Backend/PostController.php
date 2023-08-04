<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaStore;
use App\Http\Helpers\SlugBuilder;
use App\Models\Catagory;
use App\Models\post;
use App\Models\SubCatagory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use MediaStore,SlugBuilder;

    public function addpost()
    {
        $allCatagory = Catagory::get();

        return view('layouts.Backend.addpost', compact('allCatagory'));
    }

    public function getDataforForm(Request $req)
    {
        $specificSubCatagory = SubCatagory::where('catagory_id', $req->catagory_id)->get();

        return $specificSubCatagory;
    }

    public function storePost(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'catagory_id' => 'required',
            'subcatagory_id' => 'required',
        ]);

        $newPost = new post();
        $newPost->catagory_id = $req->catagory_id;
        $newPost->sub_catagory_id = $req->subcatagory_id;
        $newPost->user_id = auth()->user()->id;
        $newPost->title = $req->title;
        if (isset($req->featured_img)) {
            $fileArray = ($this->ForSingleMedia($req->featured_img, 'posts', 'public'));
            $newPost->featured_img = $fileArray['filename'];
            $newPost->featured_img_url = $fileArray['fileUrl'];
        }
        $newPost->details = $req->details;
        $newPost->type = $req->type;
        if (isset($req->isbanner)) {
            $newPost->isbanner = $req->isbanner;
        }
        $newPost->slug = $this->getSlug($req, post::class, 'title');

        $newPost->save();

        return back();
    }
}
