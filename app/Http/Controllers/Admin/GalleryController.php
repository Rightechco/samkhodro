<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Gallery;
use App\Models\Signature;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index(Request $request){
        $currentUrl = url()->current().'?container='.$request->container;
        if ($request->container == 0){
            $galleries = Gallery::latest()->latest()->paginate(40)->setPath($currentUrl);
        }
        if ($request->container == 1){
            $galleries = Gallery::latest()->whereIn('type', ['gif','jpeg','webp','jpg','png','svg','tif','jfif'])->paginate(40)->setPath($currentUrl);
        }
        if ($request->container == 2){
            $galleries = Gallery::latest()->whereIn('type', ['rar','zip'])->paginate(40)->setPath($currentUrl);
        }
        if ($request->container == 3){
            $galleries = Gallery::latest()->whereIn('type', ['mp4','mkv'])->paginate(40)->setPath($currentUrl);
        }
        if ($request->container == 4){
            $galleries = Gallery::latest()->where('status' , 2)->paginate(40)->setPath($currentUrl);
        }
        $count1 = Gallery::latest()->count();
        $count2 = Gallery::latest()->whereIn('type', ['gif','jpeg','jpg','png','webp','svg','tif','jfif'])->count();
        $count3 = Gallery::latest()->whereIn('type', ['rar','zip'])->count();
        $count4 = Gallery::latest()->whereIn('type', ['mp4','mkv'])->count();
        if($count1){
            $percent1 = round(($count1 * '100') / $count1);
            $percent2 = round(($count2 * '100') / $count1);
            $percent3 = round(($count3 * '100') / $count1);
            $percent4 = round(($count4 * '100') / $count1);
        }else{
            $percent1 = 0;
            $percent2 = 0;
            $percent3 = 0;
            $percent4 = 0;
        }
        return view('admin.gallery.index' , compact(
            'count1',
            'count2',
            'count3',
            'count4',
            'percent1',
            'percent2',
            'percent3',
            'percent4',
            'galleries'
        ));
    }
    public function userIndex(Request $request , User $user){
        $currentUrl = url()->current().'?container='.$request->container;
        if ($request->container == 1){
            $galleries = $user->image()->latest()->whereIn('type', ['gif','jpeg','webp','jpg','png','svg','tif','jfif'])->paginate(40)->setPath($currentUrl);
        }
        elseif ($request->container == 2){
            $galleries = $user->image()->latest()->whereIn('type', ['rar','zip'])->paginate(40)->setPath($currentUrl);
        }
        elseif ($request->container == 3){
            $galleries = $user->image()->latest()->whereIn('type', ['mp4','mkv'])->paginate(40)->setPath($currentUrl);
        }else{
            $galleries = $user->image()->latest()->latest()->paginate(40)->setPath($currentUrl);
        }
        $count1 = $user->image()->latest()->count();
        $count2 = $user->image()->latest()->whereIn('type', ['gif','jpeg','jpg','png','webp','svg','tif','jfif'])->count();
        $count3 = $user->image()->latest()->whereIn('type', ['rar','zip'])->count();
        $count4 = $user->image()->latest()->whereIn('type', ['mp4','mkv'])->count();
        if($count1){
            $percent1 = round(($count1 * '100') / $count1);
            $percent2 = round(($count2 * '100') / $count1);
            $percent3 = round(($count3 * '100') / $count1);
            $percent4 = round(($count4 * '100') / $count1);
        }else{
            $percent1 = 0;
            $percent2 = 0;
            $percent3 = 0;
            $percent4 = 0;
        }
        return view('admin.gallery.index' , compact(
            'count1',
            'count2',
            'count3',
            'count4',
            'percent1',
            'percent2',
            'percent3',
            'percent4',
            'galleries'
        ));
    }
    public function upload(Request $request){
        $year = Carbon::now()->year;
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/upload/image/' . $year . '/'.auth()->user()->id;
        if (!file_exists($folder)){
            mkdir($folder , 0755 , true);
        }
        $file = $request->image;
        $type = $file->getClientOriginalExtension();
        $name = time().'.'.$type;
        $size = $file->getsize();
        if ($type == "rar" or $type == "zip"){
            $url = "/upload/file/" . $year . '/'.auth()->user()->id;
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
        elseif ($type == "mp3"){
            $url = "/upload/music/" . $year . '/'.auth()->user()->id;
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
            $url = "/upload/movie/" . $year . '/'.auth()->user()->id;
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
        else{
            $url = "/upload/image/" . $year . '/'.auth()->user()->id;
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
        return $img;
    }
    public function getImage(){
        return Gallery::latest()->take(50)->select(['url','id'])->get();
    }
    public function deleteImage(Gallery $gallery){
        $gallery->delete();
        return redirect()->back()->with([
            'message' => 'تصویر با موفقیت حذف شد'
        ]);
    }
}
