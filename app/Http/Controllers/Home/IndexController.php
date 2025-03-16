<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Ask;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Demand;
use App\Models\Form;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Subscribe;
use App\Models\Widget;
use App\Traits\SeoHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use SeoHelper;
    public function index(Request $request){
        $frontStatus = Setting::where('key' , 'frontStatus')->pluck('value')->first();
        if(!$frontStatus){
            return redirect('/login');
        }
        $this->setIndexSeo();
        $widgets = Widget::where('status' , 1)->orderBy('number')->get();
        $widget = [];
        foreach ($widgets as $item){
            $widgetCategory = [
                'name'=> $item['name'],
                'title'=> $item['title'],
                'more'=> $item['more'],
                'description'=> $item['description'],
                'background'=> $item['background'],
                'slug'=> $item['slug'],
                'count'=> $item['count'],
                'status'=> $item['status'],
                'ads1'=> json_decode($item['ads1']),
                'ads2'=> json_decode($item['ads2']),
                'ads3'=> json_decode($item['ads3']),
                'post'=> [],
            ];
            if($item['name'] == 'product'){
                $widgetCategory['post'] = Category::has('product')->with('product')->get();
            }
            if($item['name'] == 'blog'){
                $widgetCategory['post'] = Blog::latest()->take($item['count'])->get();
            }
            array_push($widget , $widgetCategory);
        }
        $popUpStatus = Setting::where('key' , 'popUpStatus')->pluck('value')->first();
        $popUp = 0;
        $imagePopUp = '';
        $titlePopUp = '';
        $addressPopUp = '';
        $descriptionPopUp = '';
        $buttonPopUp = '';
        if(empty($_COOKIE['popUp']) && $popUpStatus == 1){
            $popUp = 1;
            $imagePopUp = Setting::where('key' , 'imagePopUp')->pluck('value')->first();
            $titlePopUp = Setting::where('key' , 'titlePopUp')->pluck('value')->first();
            $addressPopUp = Setting::where('key' , 'addressPopUp')->pluck('value')->first();
            $descriptionPopUp = Setting::where('key' , 'descriptionPopUp')->pluck('value')->first();
            $buttonPopUp = Setting::where('key' , 'buttonPopUp')->pluck('value')->first();
        }
        return view('home.index.index',compact('widget','popUp','imagePopUp','titlePopUp','popUpStatus','addressPopUp','descriptionPopUp','buttonPopUp'));
    }

    public function form1()
    {
        return view('home.form.form1');
    }

    public function form1post(Request $request)
    {
        $request->validate([
            'form' => 'required',
            'full_name' => 'required',
            'phone' => 'required',
        ]);
        Form::query()->create([
            'name' => $request->full_name,
            'mobile' => $request->phone,
            'formID' => $request->form,
            'json' => json_encode($request->all(),JSON_UNESCAPED_UNICODE)
        ]);
        return redirect()->back()->with([
            'message' => 'پرسش نامه شما ارسال شد'
        ]);
    }

    public function form2()
    {
        return view('home.form.form2');
    }

    public function form2post(Request $request)
    {
        $request->validate([
            'form' => 'required',
            'full_name' => 'required',
            'phone' => 'required',
        ]);
        Form::query()->create([
            'name' => $request->full_name,
            'mobile' => $request->phone,
            'formID' => $request->form,
            'json' => json_encode($request->all(),JSON_UNESCAPED_UNICODE)
        ]);
        return redirect()->back()->with([
            'message' => 'پرسش نامه شما ارسال شد'
        ]);
    }

    public function faq(){
        $asks = Ask::get();
        return view('home.faq.index',compact('asks'));
    }

    public function sendTicket(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'number' => 'required',
        ]);
        Demand::create([
            'name'=>$request->title,
            'email'=>$request->number,
            'body'=>$request->body,
            'type'=>1,
            'user_id'=>auth()->user() ? auth()->user()->id : 0,
        ]);
        if($request->redirect){
            return redirect($request->redirect)->with([
                'success' => 'درخواست ارسال شد و در اسرع وقت با شما تماس گرفته خواهد شد.'
            ]);
        }
        return 'success';
    }

    public function sendSub(Request $request){
        $sub = Subscribe::where('email' , $request->email)->first();
        if(!$sub){
            Subscribe::create([
                'email' => $request->email
            ]);
            return 'ok';
        }else{
            return 'exist';
        }
    }

    public function page(Page $page){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logo = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        $this->seoSingleSeo(   $page->titleSeo . " - $title " , $page->bodySeo , 'store' , 'page/'."$page->slug" , $logo , $page->keyword);
        return view('home.page.index' , compact('page'));
    }

    public function search(Request $request){
        $search = $request->search;
        $pp = Product::where("title", "LIKE", "%".$search."%")->take(10)->get();
        $bb = Blog::where("title", "LIKE", "%".$search."%")->take(10)->get();
        $pg = Page::where("title", "LIKE", "%".$search."%")->take(10)->get();
        return [$pp,$bb,$pg];
    }
}
