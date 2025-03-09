<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request){
        $tags = Tag::latest()->paginate(50);
        return view('admin.taxonamy.tag',compact('tags'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'nameSeo' => 'required|max:220',
            'keyword' => 'required|max:220',
            'bodySeo' => 'required',
        ]);
        $post = Tag::create([
            'name' => $request->name,
            'nameSeo' => $request->nameSeo,
            'body' => $request->body,
            'bodySeo' => $request->bodySeo,
            'image' => $request->image,
            'slug' => $request->slug,
            'keyword' => $request->keyword,
        ]);
        return redirect()->back()->with([
            'message' => 'برچسب با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request){
        return Tag::where('id' , $request->tag)->first();
    }
    public function update(Request $request , Tag $tag){
        $request->validate([
            'name' => 'required|max:220',
            'nameSeo' => 'required|max:220',
            'keyword' => 'required|max:220',
            'bodySeo' => 'required',
        ]);
        $tag->update([
            'name' => $request->name,
            'nameSeo' => $request->nameSeo,
            'body' => $request->body,
            'bodySeo' => $request->bodySeo,
            'image' => $request->image,
            'slug' => $request->slug,
            'keyword' => $request->keyword,
        ]);
        return redirect()->back()->with([
            'message' => 'برچسب ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Tag $tag){
        $tag->blog()->detach();
        $tag->delete();
        return redirect()->back()->with([
            'message' => 'برچسب با موفقیت حذف شد'
        ]);
    }
}
