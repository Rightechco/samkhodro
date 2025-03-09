<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Gallery;
use App\Models\Pattern;
use App\Models\Setting;
use App\Models\TypeTransaction;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function manageIndex(){
        $name = Setting::where('key' , 'name')->pluck('value')->first();
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logo = Setting::where('key' , 'logo')->pluck('value')->first();
        $about = Setting::where('key' , 'about')->pluck('value')->first();
        $address = Setting::where('key' , 'address')->pluck('value')->first();
        $email = Setting::where('key' , 'email')->pluck('value')->first();
        $fanavari = Setting::where('key' , 'fanavari')->pluck('value')->first();
        $etemad = Setting::where('key' , 'etemad')->pluck('value')->first();
        $number = Setting::where('key' , 'number')->pluck('value')->first();
        $number2 = Setting::where('key' , 'number2')->pluck('value')->first();
        $facebook = Setting::where('key' , 'facebook')->pluck('value')->first();
        $instagram = Setting::where('key' , 'instagram')->pluck('value')->first();
        $twitter = Setting::where('key' , 'twitter')->pluck('value')->first();
        $telegram = Setting::where('key' , 'telegram')->pluck('value')->first();
        $imagePopUp = Setting::where('key' , 'imagePopUp')->pluck('value')->first();
        $titlePopUp = Setting::where('key' , 'titlePopUp')->pluck('value')->first();
        $addressPopUp = Setting::where('key' , 'addressPopUp')->pluck('value')->first();
        $popUpStatus = Setting::where('key' , 'popUpStatus')->pluck('value')->first();
        $descriptionPopUp = Setting::where('key' , 'descriptionPopUp')->pluck('value')->first();
        $buttonPopUp = Setting::where('key' , 'buttonPopUp')->pluck('value')->first();
        $headerColor = Setting::where('key' , 'headerColor')->pluck('value')->first();
        $sideColor = Setting::where('key' , 'sideColor')->pluck('value')->first();
        $frontStatus = Setting::where('key' , 'frontStatus')->pluck('value')->first();
        return view('admin.setting.manage' , compact('name','title','headerColor','frontStatus','sideColor','descriptionPopUp','buttonPopUp','imagePopUp','titlePopUp','addressPopUp','popUpStatus','logo','about','address','email','fanavari','etemad','number','facebook','instagram','twitter','telegram','number2'));
    }

    public function manageUpdate(Request $request){
        $name = $request->name;
        $title = $request->title;
        $logo = Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image;
        $about = $request->about;
        $address = $request->address;
        $email = $request->email;
        $fanavari = $request->fanavari;
        $etemad = $request->etemad;
        $number = $request->number;
        $number2 = $request->number2;
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $twitter = $request->twitter;
        $telegram = $request->telegram;
        $imagePopUp = $request->imagePopUp;
        $titlePopUp = $request->titlePopUp;
        $addressPopUp = $request->addressPopUp;
        $popUpStatus = $request->popUpStatus;
        $descriptionPopUp = $request->descriptionPopUp;
        $buttonPopUp = $request->buttonPopUp;
        $headerColor = $request->headerColor;
        $sideColor = $request->sideColor;
        $frontStatus = $request->frontStatus == 'on' ? 1:0;
        $array = [
            'frontStatus' =>$frontStatus,
            'name' =>$name,
            'title' =>$title,
            'logo' =>$logo,
            'about' =>$about,
            'address' =>$address,
            'email' =>$email,
            'fanavari' =>$fanavari,
            'etemad' =>$etemad,
            'number' =>$number,
            'number2' =>$number2,
            'facebook' =>$facebook,
            'instagram' =>$instagram,
            'twitter' =>$twitter,
            'telegram' =>$telegram,
            'imagePopUp' =>$imagePopUp,
            'titlePopUp' =>$titlePopUp,
            'addressPopUp' =>$addressPopUp,
            'popUpStatus' =>$popUpStatus,
            'descriptionPopUp' =>$descriptionPopUp,
            'buttonPopUp' =>$buttonPopUp,
            'headerColor' =>$headerColor,
            'sideColor' =>$sideColor,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function seoIndex(){
        $titleSeo = Setting::where('key' , 'titleSeo')->pluck('value')->first();
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first();
        $aboutSeo = Setting::where('key' , 'aboutSeo')->pluck('value')->first();
        $h1Seo = Setting::where('key' , 'h1Seo')->pluck('value')->first();
        $metaSeo = Setting::where('key' , 'metaSeo')->pluck('value')->first();
        return view('admin.setting.seo' , compact('titleSeo','keyword','h1Seo','metaSeo','aboutSeo'));
    }

    public function seoUpdate(Request $request){
        $titleSeo = $request->titleSeo;
        $keyword = $request->keyword;
        $aboutSeo = $request->aboutSeo;
        $h1Seo = $request->h1Seo;
        $metaSeo = $request->metaSeo;
        $array = [
            'titleSeo' =>$titleSeo,
            'keyword' =>$keyword,
            'aboutSeo' =>$aboutSeo,
            'h1Seo' =>$h1Seo,
            'metaSeo' =>$metaSeo,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function messageIndex(){
        $userSms = Setting::where('key' , 'userSms')->pluck('value')->first();
        $passSms = Setting::where('key' , 'passSms')->pluck('value')->first();
        $kaveKey = Setting::where('key' , 'kaveKey')->pluck('value')->first();
        $typeSms = Setting::where('key' , 'smsType')->pluck('value')->first();
        $userFaraz = Setting::where('key' , 'userFaraz')->pluck('value')->first();
        $passFaraz = Setting::where('key' , 'passFaraz')->pluck('value')->first();
        $numberFaraz = Setting::where('key' , 'numberFaraz')->pluck('value')->first();
        $ghasedak = Setting::where('key' , 'ghasedak')->pluck('value')->first();
        $loginSms = Setting::where('key' , 'loginSms')->pluck('value')->first();
        $loginEmail = Setting::where('key' , 'loginEmail')->pluck('value')->first();
        $patternSms = Pattern::where('type',0)->select(['name','id'])->get();
        $patternEmail = Pattern::where('type',1)->select(['name','id'])->get();
        return view('admin.setting.message' , compact('patternSms','ghasedak','loginSms','loginEmail','patternEmail','userSms','passSms','kaveKey','userFaraz','passFaraz','numberFaraz','typeSms'));
    }

    public function messageUpdate(Request $request){
        $userSms = $request->userSms;
        $passSms = $request->passSms;
        $kaveKey = $request->kaveKey;
        $typeSms = $request->typeSms;
        $userFaraz = $request->userFaraz;
        $passFaraz = $request->passFaraz;
        $numberFaraz = $request->numberFaraz;
        $ghasedak = $request->ghasedak;
        $loginSms = $request->loginSms;
        $loginEmail = $request->loginEmail;
        $array = [
            'userSms' =>$userSms,
            'passSms' =>$passSms,
            'kaveKey' =>$kaveKey,
            'smsType' =>$typeSms,
            'userFaraz' =>$userFaraz,
            'passFaraz' =>$passFaraz,
            'numberFaraz' =>$numberFaraz,
            'ghasedak' =>$ghasedak,
            'loginSms' =>$loginSms,
            'loginEmail' =>$loginEmail,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function scriptIndex(){
        $headScript = Setting::where('key' , 'headScript')->pluck('value')->first();
        $bodyScript = Setting::where('key' , 'bodyScript')->pluck('value')->first();
        return view('admin.setting.script',compact('headScript','bodyScript'));
    }

    public function scriptUpdate(Request $request){
        $headScript = $request->headScript;
        $bodyScript = $request->bodyScript;
        $array = [
            'headScript' =>$headScript,
            'bodyScript' =>$bodyScript,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function popUp(Request $request){
        $imagePopUp = $request->imagePopUp;
        $titlePopUp = $request->titlePopUp;
        $addressPopUp = $request->addressPopUp;
        $descriptionPopUp = $request->descriptionPopUp;
        $buttonPopUp = $request->buttonPopUp;
        if($request->popUpStatus == 'on'){
            $popUpStatus = 1;
        }else{
            $popUpStatus = 0;
        }
        $array = [
            'imagePopUp' =>$imagePopUp,
            'titlePopUp' =>$titlePopUp,
            'addressPopUp' =>$addressPopUp,
            'popUpStatus' =>$popUpStatus,
            'descriptionPopUp' =>$descriptionPopUp,
            'buttonPopUp' =>$buttonPopUp,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }
}
