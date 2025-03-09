<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $blogs = Blog::where(function ($query) use($title) {
                $query->where('title' , "LIKE" , "%{$title}%")
                    ->orWhere('id', $title);
            })->select(['id' , 'title' , 'image' , 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $blogs = Blog::select(['id' , 'title' , 'image' , 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.blog.index',compact('blogs','title'));
    }
    public function create(){
        $cats = Category::select(['id' , 'name'])->where('type' , 5)->latest()->get();
        $tags = Tag::select(['id' , 'name'])->latest()->get();
        return view('admin.blog.create',compact('cats','tags'));
    }
    public function edit(Blog $blog){
        $cats = Category::select(['id' , 'name'])->where('type' , 5)->latest()->get();
        $posts = Blog::where('id' , $blog->id)->with('category')->first();
        $tags = Tag::select(['id' , 'name'])->latest()->get();
        return view('admin.blog.edit',compact('cats','posts','tags'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'status' => 'required',
            'time' => 'required',
        ]);
        if ($request->suggest == 'true'){
            $suggest = 1;
        }else{
            $suggest = 0;
        }

        $post = Blog::create([
            'title' => $request->title,
            'suggest' => $suggest,
            'status' => $request->status,
            'slug' => $request->slug,
            'time' => $request->time,
            'image' => $request->image,
            'titleSeo' => $request->titleSeo,
            'bodySeo' => $request->bodySeo,
            'keyword' => $request->keywordSeo,
            'imageAlt' => $request->imageAlt,
            'user_id' => 1,
            'body' => $request->body,
        ]);
        $post->category()->sync(json_decode($request->cats));
        $post->tag()->sync(json_decode($request->tags));
    }
    public function update(Blog $blog,Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'status' => 'required',
        ]);
        if ($request->suggest == 'true'){
            $suggest = 1;
        }else{
            $suggest = 0;
        }
        $post = $blog->update([
            'title' => $request->title,
            'suggest' => $suggest,
            'status' => $request->status,
            'slug' => $request->slug,
            'time' => $request->time,
            'image' => $request->image,
            'titleSeo' => $request->titleSeo,
            'bodySeo' => $request->bodySeo,
            'keyword' => $request->keywordSeo,
            'imageAlt' => $request->imageAlt,
            'user_id' => auth()->user()->id,
            'body' => $request->body,
        ]);
        $blog->category()->detach();
        $blog->tag()->detach();
        $blog->category()->sync(json_decode($request->cats));
        $blog->tag()->sync(json_decode($request->tags));
        return 'success';
    }
    public function show(Blog $blog){
        $posts = Blog::where('id' , $blog->id)->with('category')->first();
        return view('admin.blog.show',compact('posts'));
    }
    public function delete(Blog $blog){
        $blog->category()->detach();
        $blog->delete();
        return redirect()->back()->with([
            'message' => 'بلاگ با موفقیت حذف شد'
        ]);
    }
}
