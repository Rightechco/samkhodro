<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Demand;
use App\Models\Form;
use App\Models\Like;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $startDayEn = verta()->startDay()->formatGregorian('Y-m-d H:i:s');
        $endDayEn = verta()->endDay()->formatGregorian('Y-m-d H:i:s');
        $allUser = User::count();
        $todayUser = User::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $allDemand = Demand::count();
        $allComment = Like::count();
        $allProduct = Product::count();
        $allNews = Blog::count();
        $allView = View::count();
        $todayView = View::whereBetween('created_at', [$startDayEn, $endDayEn])->count();


        $year2 =verta()->year;
        $farvardin = Verta::parse($year2 . ' فروردین 1')->formatGregorian('Y-m-d H:i:s');
        $ordibehesht = Verta::parse($year2 . ' اردیبهشت 1')->formatGregorian('Y-m-d H:i:s');
        $khordad = Verta::parse($year2 . ' خرداد 1')->formatGregorian('Y-m-d H:i:s');
        $tir = Verta::parse($year2 . ' تیر 1')->formatGregorian('Y-m-d H:i:s');
        $mordad = Verta::parse($year2 . ' مرداد 1')->formatGregorian('Y-m-d H:i:s');
        $shahrivar = Verta::parse($year2 . ' شهریور 1')->formatGregorian('Y-m-d H:i:s');
        $mehr = Verta::parse($year2 . ' مهر 1')->formatGregorian('Y-m-d H:i:s');
        $aban = Verta::parse($year2 . ' آبان 1')->formatGregorian('Y-m-d H:i:s');
        $azar = Verta::parse($year2 . ' آذر 1')->formatGregorian('Y-m-d H:i:s');
        $dey = Verta::parse($year2 . ' دی 1')->formatGregorian('Y-m-d H:i:s');
        $bahman = Verta::parse($year2 . ' بهمن 1')->formatGregorian('Y-m-d H:i:s');
        $esfand = Verta::parse($year2 . ' اسفند 1')->formatGregorian('Y-m-d H:i:s');

        $deyPay = User::whereBetween('created_at', [$dey, $bahman])->count();
        $bahmanPay = User::whereBetween('created_at', [$bahman, $esfand])->count();
        $esfandPay = User::whereBetween('created_at', [$esfand, $farvardin])->count();
        $farvardinPay = User::whereBetween('created_at', [$farvardin, $ordibehesht])->count();
        $ordibeheshtPay = User::whereBetween('created_at', [$ordibehesht, $khordad])->count();
        $khordadPay = User::whereBetween('created_at', [$khordad, $tir])->count();
        $tirPay = User::whereBetween('created_at', [$tir, $mordad])->count();
        $mordadPay = User::whereBetween('created_at', [$mordad, $shahrivar])->count();
        $shahrivarPay = User::whereBetween('created_at', [$shahrivar, $mehr])->count();
        $mehrPay = User::whereBetween('created_at', [$mehr, $aban])->count();
        $abanPay = User::whereBetween('created_at', [$aban, $azar])->count();
        $azarPay = User::whereBetween('created_at', [$azar, $dey])->count();

        return view('admin.dashboard',compact(
            'allUser',
            'todayUser',
            'allDemand',
            'allComment',
            'allProduct',
            'allNews',
            'allView',
            'todayView',
            'deyPay',
            'bahmanPay',
            'esfandPay',
            'farvardinPay',
            'ordibeheshtPay',
            'khordadPay',
            'tirPay',
            'mordadPay',
            'shahrivarPay',
            'mehrPay',
            'abanPay',
            'azarPay',
        ));
    }
    public function learn(){
        return view('admin.learn');
    }

    public function form()
    {
        $forms = Form::query()->latest()->paginate(50);
        return view('admin.form',compact('forms'));
    }

    public function seeRes(Form $form)
    {
        return view('admin.seeForm',compact('form'));
    }
}
