<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::latest()->paginate(50);
        return view('admin.taxonamy.category',compact('categories'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        Category::create([
            'name' => $request->name,
            'nameSeo' => $request->nameSeo,
            'body' => $request->body,
            'bodySeo' => $request->bodySeo,
            'image' => Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image,
            'slug' => $request->slug,
            'type' => $request->type,
            'keyword' => $request->keyword,
        ]);
        return redirect()->back()->with([
            'message' => 'دسته بندی با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request){
        return Category::where('id' , $request->note)->first();
    }
    public function update(Request $request , Category $category){
        $request->validate([
            'name' => 'required',
        ]);
        $category->update([
            'name' => $request->name,
            'nameSeo' => $request->nameSeo,
            'body' => $request->body,
            'bodySeo' => $request->bodySeo,
            'image' => Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image,
            'slug' => $request->slug,
            'type' => $request->type,
            'keyword' => $request->keyword,
        ]);
        return redirect()->back()->with([
            'message' => 'دسته بندی با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Category $category){
        $category->blog()->detach();
        $category->product()->detach();
        $category->delete();
        return redirect()->back()->with([
            'message' => 'دسته بندی با موفقیت حذف شد'
        ]);
    }
}
