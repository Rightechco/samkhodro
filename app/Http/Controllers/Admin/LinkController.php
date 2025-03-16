<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(Request $request){
        $links = Link::latest()->paginate(50);
        $allLink = Link::query()->select('id','name')->get();
        return view('admin.link.index',compact('links','allLink'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'parent' => 'nullable|numeric|exists:links,id'
        ]);
        Link::create([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => $request->slug,
            'parent_id' => $request->parent
        ]);
        return redirect()->back()->with([
            'message' => 'لینک با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request){
        return Link::where('id' , $request->link)->with('parent')->first();
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'parent' => 'nullable|numeric|exists:links,id'
        ]);
        Link::where('id' , $request->link)->update([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => $request->slug,
            'parent_id' => $request->parent
        ]);
        return redirect()->back()->with([
            'message' => 'لینک با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Link $link){
        $link->delete();
        return redirect()->back()->with([
            'message' => 'لینک با موفقیت حذف شد'
        ]);
    }
}
