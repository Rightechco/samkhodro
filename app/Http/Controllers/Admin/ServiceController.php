<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request){
        $abilities = Service::latest()->paginate(50);
        return view('admin.taxonamy.service',compact('abilities'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'body' => 'required',
            'image' => 'required',
        ]);
        $post = Service::create([
            'name' => $request->name,
            'body' => $request->body,
            'image' => Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image,
        ]);
        return redirect()->back()->with([
            'message' => 'خدمات با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request){
        return Service::where('id' , $request->service)->first();
    }
    public function update(Request $request , Service $service){
        $request->validate([
            'name' => 'required|max:220',
            'body' => 'required',
            'image' => 'required',
        ]);
        $service->update([
            'name' => $request->name,
            'body' => $request->body,
            'image' => Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image,
        ]);
        return redirect()->back()->with([
            'message' => 'خدمات ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Service $service){
        $service->delete();
        return redirect()->back()->with([
            'message' => 'خدمات با موفقیت حذف شد'
        ]);
    }
}
