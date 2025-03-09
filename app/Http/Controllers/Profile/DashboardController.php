<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Gallery;
use App\Models\Like;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function ChangeAllUserInfo(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);
        if($request->password){
            auth()->user()->update([
                'password'=>Hash::make($request->password),
                'name'=>$request->name,
                'gender'=>$request->gender,
                'city'=>$request->city,
            ]);
        }else{
            auth()->user()->update([
                'name'=>$request->name,
                'gender'=>$request->gender,
                'city'=>$request->city,
            ]);
        }
        return redirect()->back()->with([
            'message' => 'کاربر ویرایش شد'
        ]);
    }
    public function profile(){
        $user= \auth()->user();
        $likes = Like::where(function ($query) use($user) {
            $query->where('user_id', '=', $user->id)
                ->orWhere('user_ip', '=', \request()->ip());
        })->where('likable_type' , 'App\Models\Product')->get();
        $likePost = [];
        foreach ($likes as $item) {
            $posts = Product::latest()->where('id' , $item->likable_id)->first();
            array_push($likePost , $posts);
        }
        $tickets = Ticket::where(function ($query) use($user) {
            $query->where('user_id', '=', $user->id)
                ->orWhere('catch_id', '=', $user->id);
        })->get();
        return view('profile.index', compact('likePost','tickets'));
    }
    public function like(){
        $user= \auth()->user();
        $likes = Like::where(function ($query) use($user) {
            $query->where('user_id', '=', $user->id)
                ->orWhere('user_ip', '=', \request()->ip());
        })->where('likable_type' , 'App\Models\Product')->get();
        $likePosts = [];
        foreach ($likes as $item) {
            $posts = Product::latest()->where('id' , $item->likable_id)->first();
            array_push($likePosts , $posts);
        }

        $title = 'علاقه مندی ها';
        $tab = 2;
        return view('profile.like', compact('likePosts','title','tab'));
    }
    public function personalInfo(){
        $user = User::where('id' , auth()->user()->id)->first();
        return view('profile.info', compact('user'));
    }
    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function uploadProfile(Request $request){
        $folder = $_SERVER['DOCUMENT_ROOT']."/upload/user/" . auth()->user()->id . '/';
        if (!file_exists($folder)){
            mkdir($folder , 0755 , true);
        }
        $file = $request->image;
        $name = $file->getClientOriginalName();
        $type = $file->getClientOriginalExtension();
        $sizefile = $file->getsize()/1000;
        if( $sizefile > 1000){
            $size=round($sizefile/1000 ,2) . 'mb';
        }else{
            $size=round($sizefile) . 'kb';
        }
        $url = "/upload/user/" . auth()->user()->id;
        if ($type == "jpg" or $type == "JPG" or $type == "png" or $type == "PNG" or $type == "jpeg" or $type == "svg" or $type == "tif" or $type == "gif" or $type == "jfif"){
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] .$url , $name);
            $img = Gallery::create([
                'name' => $name,
                'size' => $size,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'url' => $url . '/' . $name ,
                'path' => $path->getRealPath(),
            ]);
        }
        elseif ($type == "rar" or $type == "zip"){
            $path = $file->move(storage_path($url) , $name);
            $img = Gallery::create([
                'name' => $name,
                'size' => $size,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'url' => $url . '/' . $name ,
                'path' => $path->getRealPath(),
            ]);
        }
        elseif ($type == "mp3"){
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] .$url , $name);
            $img = Gallery::create([
                'name' => $name,
                'size' => $size,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'url' => $url . '/' . $name ,
                'path' => $path->getRealPath(),
            ]);
        }
        elseif ($type == "mp4" or $type == "mkv"){
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] .$url , $name);
            $img = Gallery::create([
                'name' => $name,
                'size' => $size,
                'user_id' => auth()->user()->id,
                'type' => $type,
                'url' => $url . '/' . $name ,
                'path' => $path->getRealPath(),
            ]);
        }
        auth()->user()->update([
            'profile' => $img['url']
        ]);
        return 'success';
    }
}
