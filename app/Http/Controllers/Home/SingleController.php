<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Like;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\SeoHelper;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    use SeoHelper;
    public function product(Product $product){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $this->seoSingleSeo( $product->titleSeo . "$title - " , $product->bodySeo , 'store' , 'blog/'."$product->slug" , $product->image , $product->keywordSeo );
        $related =  Product::whereHas('category', function ($q) use ($product){
            return $q->whereIn('id', $product->category()->pluck('id'));
        })->where('id' , '!=' , $product->id)->take(6)->get();
        $post = Product::where('id',$product->id)->with('category')->first();

        if(auth()->user()){
            $like = Like::where(function ($q){
                return $q->where('user_ip', \request()->ip())->orWhere('user_id' , auth()->user()->id);
            })->where('likable_type' , 'App\\Models\\Product')->where('likable_id' , $product->id)->first();
        }else{
            $like = Like::where('user_ip' , \request()->ip())->where('likable_type' , 'App\\Models\\Product')->where('likable_id' , $product->id)->first();
        }
        return view('home.single.product' , compact('related','like','post'));
    }
    public function blog(Blog $blog){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $this->seoSingleSeo( $blog->titleSeo . "$title - " , $blog->bodySeo , 'store' , 'blog/'."$blog->slug" , $blog->image , $blog->keywordSeo );
        $related =  Blog::whereHas('category', function ($q) use ($blog){
            return $q->whereIn('name', $blog->category()->pluck('name'));
        })->where('id' , '!=' , $blog->id)->where('status' , 1)->take(6)->get();
        $suggest = Blog::where('suggest',1)->inRandomOrder()->where('status',1)->latest()->get();
        $post = Blog::where('id',$blog->id)->with('category')->first();
        return view('home.single.blog' , compact('related','suggest','post'));
    }
}
