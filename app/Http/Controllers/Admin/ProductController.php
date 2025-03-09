<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Field;
use App\Models\FieldData;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $products = Product::latest()->where(function ($query) use($title) {
                $query->where('title' , "LIKE" , "%{$title}%")
                    ->orWhere('sku', $title);
            })->paginate(50)->setPath($currentUrl);
        }else{
            $products = Product::latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.product.index',compact('products','title'));
    }
    public function create(){
        $cats = Category::where('type',4)->latest()->select(['name','id'])->get();
        return view('admin.product.create',compact('cats'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:250',
            'price' => ['required','regex:/^[0-9]+(\.[0-9][0-9]?)?$/','digits_between: 1,20'],
            'count' => 'required|max:20',
            'sku' => 'required|max:30',
        ]);
        $priceF = $request->price;
        $product = Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'priceF' => $priceF,
            'count' => $request->count,
            'image' => Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image,
            'sku' => $request->sku,
            'slug' => $request->slug,
            'titleSeo' => $request->titleSeo,
            'keywordSeo' => $request->keywordSeo,
            'imageAlt' => $request->imageAlt,
            'bodySeo' => $request->bodySeo,
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        $product->category()->sync($request->cat);
        return redirect('/admin/product/')->with([
            'message' => 'محصول با موفقیت اضافه شد'
        ]);
    }
    public function edit(Product $product){
        $cats = Category::where('type',4)->latest()->select(['name','id'])->get();
        $products = Product::where('id',$product->id)->with('category')->first();
        return view('admin.product.edit',compact('products','cats'));
    }
    public function update(Request $request , Product $product){
        $request->validate([
            'title' => 'required|max:250',
            'price' => ['required','regex:/^[0-9]+(\.[0-9][0-9]?)?$/','digits_between: 1,20'],
            'count' => 'required|max:20',
            'sku' => 'required|max:30',
        ]);
        $priceF = $request->price;
        $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'priceF' => $priceF,
            'count' => $request->count,
            'sku' => $request->sku,
            'slug' => $request->slug,
            'titleSeo' => $request->titleSeo,
            'image' => Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image,
            'keywordSeo' => $request->keywordSeo,
            'imageAlt' => $request->imageAlt,
            'bodySeo' => $request->bodySeo,
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        $product->category()->detach();
        $product->category()->sync($request->cat);
        return redirect('/admin/product/')->with([
            'message' => $request->title . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Product $product){
        $product->category()->detach();
        $product->delete();
        return redirect()->back()->with([
            'message' => $product->title . ' با موفقیت حذف شد'
        ]);
    }
}
