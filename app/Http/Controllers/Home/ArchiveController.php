<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Tag;
use App\Traits\SeoHelper;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    use SeoHelper;
    public function product(){
        $name = 'همه محصولات';
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ??'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?? [] ;
        $body = Setting::where('key' , 'aboutSeo')->pluck('value')->first() ??'' ;
        $this->seoSingleSeo( $name . "$title - " , $name , 'store' , "products" , $logoSite , $keyword );
        $urls = '/change/products';
        return view('home.archive.product',compact('name','urls','body'));
    }
    public function changeProduct(Request $request){
        $currentUrl = url()->current();
        return Product::latest()->paginate(30)->setPath($currentUrl);
    }

    public function categoryProduct(Category $category){
        $name = $category->name;
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ??'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?? [] ;
        $body = $category->body ??'' ;
        $this->seoSingleSeo( $name . "$title - " , $category->bodySeo , 'store' , "products" , $logoSite , $keyword );
        $urls = '/change/product/category/'.$category->slug;
        return view('home.archive.product',compact('name','urls','body'));
    }
    public function changeCategoryProduct(Category $category){
        $currentUrl = url()->current();
        return $category->product()->latest()->paginate(30)->setPath($currentUrl);
    }

    public function blog(){
        $name = 'همه بلاگ ها';
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ??'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?? [] ;
        $body = Setting::where('key' , 'aboutSeo')->pluck('value')->first() ??'' ;
        $this->seoSingleSeo( $name . "$title - " , $name , 'store' , "products" , $logoSite , $keyword );
        $blogs = Blog::latest()->where('status',1)->take(100)->get();
        $suggest = Blog::latest()->where('suggest',1)->where('status',1)->take(5)->get();
        return view('home.archive.blog',compact('name','blogs','suggest','body'));
    }
    public function categoryBlog(Category $category){
        $name = $category->name;
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ??'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?? [] ;
        $body = $category->body ??'' ;
        $this->seoSingleSeo( $name . "$title - " , $category->bodySeo , 'store' , "products" , $logoSite , $keyword );
        $blogs = $category->blog()->where('status',1)->latest()->take(100)->get();
        $suggest = $category->blog()->latest()->where('status',1)->where('suggest',1)->take(5)->get();
        return view('home.archive.blog',compact('name','blogs','suggest','body'));
    }
    public function tagBlog(Tag $tag){
        $name = $tag->name;
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ??'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?? [] ;
        $body = $tag->body ??'' ;
        $this->seoSingleSeo( $name . "$title - " , $tag->bodySeo , 'store' , "products" , $logoSite , $keyword );
        $blogs = $tag->blog()->where('status',1)->latest()->take(100)->get();
        $suggest = $tag->blog()->where('status',1)->latest()->where('suggest',1)->take(5)->get();
        return view('home.archive.blog',compact('name','blogs','suggest','body'));
    }
}
