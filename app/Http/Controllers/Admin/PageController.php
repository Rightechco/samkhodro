<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $pages = Page::where(function ($query) use($title) {
                $query->where('title', $title)
                    ->orWhere('id', $title);
            })->select(['id' , 'title' , 'slug' , 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $pages = Page::select(['id' , 'title' , 'slug' , 'created_at'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.page.index',compact('pages','title'));
    }
    public function create(){
        return view('admin.page.create');
    }
    public function edit(Page $page){
        $posts = Page::where('id' , $page->id)->first();
        return view('admin.page.edit',compact('posts'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'body' => 'required',
            'bodySeo' => 'required',
            'titleSeo' => 'required',
            'keywordSeo' => 'required',
        ]);
        $post = Page::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'titleSeo' => $request->titleSeo,
            'bodySeo' => $request->bodySeo,
            'keyword' => $request->keywordSeo,
            'body' => $request->body,
        ]);
    }
    public function update(Page $page,Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'body' => 'required',
            'bodySeo' => 'required',
            'titleSeo' => 'required',
            'keywordSeo' => 'required',
        ]);
        $post = $page->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'titleSeo' => $request->titleSeo,
            'bodySeo' => $request->bodySeo,
            'keyword' => $request->keywordSeo,
            'body' => $request->body,
        ]);
        return 'success';
    }
    public function delete(Page $page){
        $page->delete();
        return redirect()->back()->with([
            'message' => 'برگه با موفقیت حذف شد'
        ]);
    }
}
