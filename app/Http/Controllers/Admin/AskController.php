<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ask;
use App\Models\Demand;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class AskController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $asks = Ask::where(function ($query) use($title) {
                $query->where('title', $title)
                    ->orWhere('id', $title);
            })->select(['id' , 'title' , 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $asks = Ask::select(['id' , 'title' , 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.ask.index',compact('asks','title'));
    }
    public function demandIndex(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $asks = Demand::where('type',1)->where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->select(['id' , 'name','email','body' , 'status' , 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $asks = Demand::where('type',1)->select(['id' , 'name','email','body' , 'status' , 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.ask.demand',compact('asks','title'));
    }
    public function deleteDemand(Demand $demand){
        $demand->delete();
        return redirect()->back()->with([
            'message' => 'درخواست با موفقیت حذف شد'
        ]);
    }
    public function subscribeDelete(Subscribe $subscribe){
        $subscribe->delete();
        return redirect()->back()->with([
            'message' => 'درخواست با موفقیت حذف شد'
        ]);
    }
    public function subscribeIndex(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $subscribes = Subscribe::where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->select(['id','email', 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $subscribes = Subscribe::select(['id','email', 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.ask.subscribe',compact('subscribes','title'));
    }
    public function create(){
        return view('admin.ask.create');
    }
    public function edit(Ask $ask){
        $posts = Ask::where('id' , $ask->id)->first();
        return view('admin.ask.edit',compact('posts'));
    }
    public function changeStatus(Demand $demand){
        $demand->update([
            'status' => $demand->status == 1 ?0:1
        ]);
        return redirect()->back()->with([
            'message' => 'تغییر وضعیت انجام شد'
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'body' => 'required',
        ]);
        $post = Ask::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }
    public function update(Ask $ask,Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'body' => 'required',
        ]);
        $post = $ask->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return 'success';
    }
    public function delete(Ask $ask){
        $ask->delete();
        return redirect()->back()->with([
            'message' => 'سوال با موفقیت حذف شد'
        ]);
    }
}
