<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\loginMail;
use App\Models\Comment;
use App\Models\post;
use App\Models\postVeiwCount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class FrontendController extends Controller
{
    public function homepage()
    {
        // Mail::to("test@gmail.com")->send(new loginMail("hassan"));
        $allPost = post::withcount('views as views')->with(['catagory:id,catagory_name,slug', 'user:id,name,profile_img', 'views'])->orderBy('views', 'desc')->latest()->simplePaginate(12);
        $popularPosts = $allPost->take(3);
        $isbanner = $allPost->where('isbanner', true)->take(4);

        return view('layouts.Frontend.homepage', compact('allPost', 'isbanner', 'popularPosts'));
    }

    public function catagoryPost($id)
    {
        $allPost = post::withcount('views as views')->with(['catagory:id,catagory_name,slug', 'user:id,name,profile_img', 'views'])->orderBy('views', 'desc')->latest()->get();
        $popularPosts = $allPost->take(3);
        $sepecificPost = $allPost->where('catagory_id', $id);

        return view('layouts.Frontend.allcatagoryPost', compact('sepecificPost', 'popularPosts'));
    }

    public function subcatagoryPost($id)
    {
        $allPost = post::withcount('views as views')->with(['subcatagory:id,subcatagory_name,slug', 'catagory:id,catagory_name,slug', 'user:id,name,profile_img', 'views'])->orderBy('views', 'desc')->latest()->get();

        $popularPosts = $allPost->take(3);
        $sepecificPost = $allPost->where('sub_catagory_id', $id);

        return view('layouts.Frontend.allsubcatagoryPost', compact('sepecificPost', 'popularPosts'));
    }

    public function userPost($id)
    {
        return 'user';
    }

    public function postDetails($slug)
    {
        $posts = post::withCount('views as views')->with(['catagory:id,catagory_name,slug', 'user:id,name,profile_img', 'views', 'parentComments', 'replyComments']);

        $popularPosts = $posts->orderBy('views', 'desc')->take(3)->get();
        $postData = $posts->where('slug', $slug)->first();
        $userIp = request()->ip();

        // dd($postData);
        postVeiwCount::updateOrcreate([
            'post_id' => $postData->id,
            'ip' => $userIp,
        ], [
            'post_id' => $postData->id,
            'ip' => $userIp,
        ]);

        return view('layouts.Frontend.postDetails', compact('popularPosts', 'postData'));
    }

    public function searchPost(Request $req)
    {
        $relativePost = post::where('title', 'Like', '%'.$req->foundPost.'%')->select('id', 'title', 'slug')->get();

        return $relativePost;
    }

    public function CommentStore(Request $req)
    {
        $req->validate([
            'InputComment' => 'required|max:225',
        ]);
        $newComment = new Comment();

        $newComment->post_id = $req->post_id;
        $newComment->user_id = auth()->user()->id;
        $newComment->parent_id = $req->parent_id ?? null;
        $newComment->content = $req->InputComment;

        $newComment->save();

        return back();
    }

    public function toGetParentName(Request $req)
    {
        $parent_comment = comment::where('id', $req->parent_id)->with('user:id,name')->get();

        return $parent_comment;
    }

    public function commentDelete(Request $req)
    {
        $parent_comment = comment::where('id', $req->id);
        $reply_comment = Comment::where('parent_id', $req->id);
        $parent_comment->delete();
        $reply_comment->delete();

        return back();
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->user();

        $newUser = User::updateOrcreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::Make(uniqid()),
        ]);

        Auth::login($newUser);

        return redirect()->route('home');
    }

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $newUser = User::updateOrcreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::Make(uniqid()),
        ]);

        Auth::login($newUser);

        return redirect()->route('home');
    }
}
