<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\ActiveSms;
use App\Mail\SendMail;
use App\Models\Currency;
use App\Models\Event;
use App\Models\Pattern;
use App\Models\Setting;
use App\Models\User;
use App\Traits\SendSmsTrait;
use App\Traits\SeoHelper;
use Carbon\Carbon;
use Ghasedak\GhasedakApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use SeoHelper;
    use SendSmsTrait;
    public function login(){
        $pre = str_contains(url()->previous(), 'offline') ? url('admin') : url()->previous();
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?: [] ;
        $shortActivity = Setting::where('key' , 'aboutSeo')->pluck('value')->first() ?:'' ;
        $this->seoSingleSeo( 'ثبت نام / ورود' . "$title - " , $shortActivity , 'store' , 'login' , $logoSite , $keyword );
        if (Auth::check())return redirect('/profile');
        return view('home.auth.authIndex',compact('pre'));
    }
    public function checkAuth(Request $request){
        $request->validate([
            'authData' => 'required',
        ]);
        DB::table('active_sms')->where('expire' , '<=', Carbon::now()->timestamp)->delete();
        if (is_numeric($request->authData)) {
            $check2 = User::where('number' , $request->authData)->where('contact' , 0)->first();
            if($check2){
                return 'exist';
            }else{
                $code = ActiveSms::buildCode();
                ActiveSms::create([
                    'code'=> $code,
                    'expire'=> Carbon::now()->addSecond(200)->timestamp,
                    'phone'=>$request->authData
                ]);
                $this->sendSmsData($request->authData,$code);
                return 'code';
            }
        }
        elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $check2 = User::where('email' , $request->authData)->where('contact' , 0)->first();
            if($check2){
                return 'exist';
            }else{
                $code = ActiveSms::buildCode();
                ActiveSms::create([
                    'code'=> $code,
                    'expire'=> Carbon::now()->addSecond(200)->timestamp,
                    'phone'=>$request->authData
                ]);
                $this->sendEmailData($request->authData,$code);
                return 'code';
            }
        }else{
            return [0,0];
        }
    }
    public function checkCode(Request $request){
        $request->validate([
            'code' => ['required','min:6','max:6' , Rule::exists('active_sms')],
        ]);
        $check = ActiveSms::where('code',$request->code)->where('expire' , '>='  ,Carbon::now()->timestamp)->where('phone',$request->authData)->first();
        if ($check){
            return 'ok';
        }else{
            return 'fail';
        }
    }
    public function enterAuth(Request $request){
        $request->validate([
            'authData' => 'required',
            'password' => 'required',
        ]);

        if (is_numeric($request->authData)) {
            $credentials = [
                'number' => $request->authData,
                'password' => $request->password,
            ];
        } elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->authData,
                'password' => $request->password,
            ];
        }else{
            return 'format';
        }

        if (Auth::attempt($credentials)) {
            return 'success';
        } else {
            return 'no';
        }
    }
    public function addUser(Request $request){
        $request->validate([
            'authData' => 'required',
            'password' => 'required|required_with:confirmed|same:confirmed',
            'code' => ['required','min:6','max:6' , Rule::exists('active_sms')],
            'user' => 'unique:users,name',
        ]);
        $check = ActiveSms::where('phone' , $request->authData)->where('code' , $request->code)->where('expire' , '>='  ,Carbon::now()->timestamp)->first();
        if($check){
            if (is_numeric($request->authData)) {
                $user = User::create([
                    'name'=> $request->user,
                    'number'=> $request->authData,
                    'gender'=> 0,
                    'password'=> Hash::make($request->password)
                ]);
                $currency_default = Setting::where('key' , 'currency_default')->pluck('value')->first();
                if ($currency_default){
                    $user->currency()->sync($currency_default);
                }
                Auth::login($user);
                Event::create([
                    'title' => 'ثبت نام',
                    'body' => 'کاربر با نام ' . $request->user . ' ثبت نام کرد',
                    'type' => 3,
                    'user_id' => auth()->user()->id,
                    'customer_id' => auth()->user()->id,
                ]);
                return 'success';
            } elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
                $user = User::create([
                    'name'=> $request->user,
                    'email'=> $request->authData,
                    'gender'=> 0,
                    'password'=> Hash::make($request->password)
                ]);
                Auth::login($user);
                Event::create([
                    'title' => 'ثبت نام',
                    'body' => 'کاربر با نام ' . $request->user . ' ثبت نام کرد',
                    'type' => 3,
                    'user_id' => auth()->user()->id,
                    'customer_id' => auth()->user()->id,
                ]);
                return 'success';
            }else{
                return 'format';
            }
        }else{
            return 'time';
        }
    }
    public function changePassword(Request $request){
        $request->validate([
            'authData' => 'required',
        ]);

        if (is_numeric($request->authData)) {
            $code = ActiveSms::buildCode();
            ActiveSms::create([
                'code'=> $code,
                'expire'=> Carbon::now()->addSecond(200)->timestamp,
                'phone'=>$request->authData
            ]);
            $this->sendSmsData($request->authData,$code);
            return 'code';
        } elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $code = ActiveSms::buildCode();
            ActiveSms::create([
                'code'=> $code,
                'expire'=> Carbon::now()->addSecond(200)->timestamp,
                'phone'=>$request->authData
            ]);
            $this->sendEmailData($request->authData,$code);
            return 'code';
        }else{
            return 'format';
        }
    }
    public function checkPassCode(Request $request){
        $check = ActiveSms::where('code',$request->code)->where('expire' , '>='  ,Carbon::now()->timestamp)->where('phone',$request->authData)->first();
        if ($check){
            return 'ok';
        }else{
            return 'fail';
        }
    }
    public function changeUserPassword(Request $request){
        $request->validate([
            'authData' => 'required',
            'password' => 'required|required_with:confirmed|same:confirmed',
            'code' => ['required','min:6','max:6' , Rule::exists('active_sms')],
        ]);

        $check = ActiveSms::where('code',$request->code)->where('expire' , '>='  ,Carbon::now()->timestamp)->where('phone',$request->authData)->first();
        if (!$check){
            return 'time';
        }
        if (is_numeric($request->authData)) {
            $user = User::where('number',$request->authData)->first();
            $user->update([
                'password'=> Hash::make($request->password)
            ]);
            Auth::login($user);
            return 'success';
        } elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email',$request->authData)->first();
            $user->update([
                'password'=> Hash::make($request->password)
            ]);
            Auth::login($user);
            return 'success';
        }else{
            return 'format';
        }
    }
    public function sendSmsData($numSend,$code){
        $loginSms = Setting::where('key' , 'loginSms')->pluck('value')->first();
        if($loginSms){
            $smsPattern = Pattern::where('id' , $loginSms)->first();
            $patterns = [];
            foreach (explode(',',$smsPattern->body) as $val){
                $data = 0;
                if($val == 'admin'){
                    $data = User::where('level' , 3)->pluck('name')->first();
                }
                elseif($val == 'title'){
                    $data = Setting::where('key' , 'title')->pluck('value')->first();
                }
                elseif($val == 'webUrl'){
                    $data = url();
                }
                elseif($val == 'active'){
                    $data = $code;
                }
                elseif($val == 'adminNumber'){
                    $data = Setting::where('key' , 'number')->pluck('value')->first();
                }
                elseif($val == 'adminEmail'){
                    $data = Setting::where('key' , 'email')->pluck('value')->first();
                }
                array_push($patterns,$data);
            }
            $this->sendSms($numSend , $patterns,$smsPattern->name);
        }
    }
    public function sendEmailData($emailSend,$code){
        $loginEmail = Setting::where('key' , 'loginEmail')->pluck('value')->first();
        if($loginEmail){
            $emailPattern = Pattern::where('id' , $loginEmail)->first();
            $texts = $emailPattern->body;
            $texts = str_replace('{admin}',$texts,User::where('level' , 3)->pluck('name')->first());
            $texts = str_replace('{title}',$texts,Setting::where('key' , 'title')->pluck('value')->first());
            $texts = str_replace('{active}',$texts,$code);
            $texts = str_replace('{webUrl}',$texts,url());
            $texts = str_replace('{adminNumber}',$texts,Setting::where('key' , 'number')->pluck('value')->first());
            $texts = str_replace('{adminEmail}',$texts,Setting::where('key' , 'email')->pluck('value')->first());
            Mail::to($emailSend)->send(new sendMail($emailPattern->name , $texts , env('MAIL_FROM_ADDRESS')));
        }
    }
}
