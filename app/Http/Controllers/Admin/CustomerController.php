<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Customers;
use App\Models\Field;
use App\Models\FieldData;
use App\Models\Group;
use App\Models\Language;
use App\Models\Note;
use App\Models\Ticket;
use App\Models\TypeCustomer;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create(){
        return view('admin.customers.create');
    }
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $users = User::where('level' , 0)->where('contact', 0)->where(function ($query) use($title) {
                $query->where('name' , "LIKE" , "%{$title}%")
                    ->orWhere('id', $title);
            })->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $users = User::where('level' , 0)->where('contact', 0)->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.customers.index',compact('users','title'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'password' => 'required|max:220',
            'number' => 'required|max:20|min:8',
            'email' => 'required|unique:users|email',
            'website' => 'max:255',
            'postal' => 'max:15',
            'address' => 'max:255',
            'state' => 'max:100',
            'city' => 'max:100',
        ]);
        $customer = User::create([
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'registration_number' => $request->registration_number,
            'gender' => $request->gender,
            'website' => $request->website,
            'postal' => $request->postal,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
        ]);
        return redirect('/admin/customer')->with([
            'message' => 'مشتری با موفقیت اضافه شد'
        ]);
    }
    public function edit(User $user){
        $users = User::where('id',$user->id)->first();
        return view('admin.customers.show.edit',compact('users'));
    }
    public function show(){
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
        $startDay = verta()->startDay()->formatGregorian('Y-m-d H:i:s');
        $endDay = verta()->endDay()->formatGregorian('Y-m-d H:i:s');
        $startDay1 = verta()->subDay(1)->startDay()->formatGregorian('Y-m-d H:i:s');
        $endDay1 = verta()->subDay(1)->endDay()->formatGregorian('Y-m-d H:i:s');
        $startWeek = verta()->startWeek()->formatGregorian('Y-m-d H:i:s');
        $endWeek = verta()->endWeek()->formatGregorian('Y-m-d H:i:s');
        $startMonth = verta()->startMonth()->formatGregorian('Y-m-d H:i:s');
        $endMonth = verta()->endMonth()->formatGregorian('Y-m-d H:i:s');
        $startYear = verta()->startYear()->formatGregorian('Y-m-d H:i:s');
        $endYear = verta()->endYear()->formatGregorian('Y-m-d H:i:s');

        $allUsers = User::where('level' , 0)->where('contact', 0)->count();

        $todayUsers = User::where('level' , 0)->where('contact', 0)->where('created_at' , '>=' , $startDay)->where('created_at' , '<' , $endDay)->count();

        $yesUsers = User::where('level' , 0)->where('contact', 0)->where('created_at' , '>=' , $startDay1)->where('created_at' , '<' , $endDay1)->count();
        $weekUsers = User::where('level' , 0)->where('contact', 0)->where('created_at' , '>=' , $startWeek)->where('created_at' , '<' , $endWeek)->count();
        $monthUsers = User::where('level' , 0)->where('contact', 0)->where('created_at' , '>=' , $startMonth)->where('created_at' , '<' , $endMonth)->count();
        $yearUsers = User::where('level' , 0)->where('contact', 0)->where('created_at' , '>=' , $startYear)->where('created_at' , '<' , $endYear)->count();

        $todayTransaction = User::where('level' , 0)->where('contact', 0)->whereHas('transaction', function ($q) use($startDay,$endDay){
            return $q->where('status' , 100)->whereDate('created_at', [$startDay, $endDay]);
        })->latest()->count();
        $yesTransaction = User::where('level' , 0)->where('contact', 0)->whereHas('transaction', function ($q) use($startDay1,$endDay1){
            return $q->where('status' , 100)->whereDate('created_at', [$startDay1, $endDay1]);
        })->latest()->count();

        $deyUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$dey, $bahman])->count();
        $bahmanUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$bahman, $esfand])->count();
        $esfandUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$esfand, $farvardin])->count();
        $farvardinUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$farvardin, $ordibehesht])->count();
        $ordibeheshtUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$ordibehesht, $khordad])->count();
        $khordadUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$khordad, $tir])->count();
        $tirUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$tir, $mordad])->count();
        $mordadUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$mordad, $shahrivar])->count();
        $shahrivarUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$shahrivar, $mehr])->count();
        $mehrUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$mehr, $aban])->count();
        $abanUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$aban, $azar])->count();
        $azarUser = User::where('level' , 0)->where('contact', 0)->whereBetween('created_at', [$azar, $dey])->count();
        $userReports = [$farvardinUser,$ordibeheshtUser,$khordadUser,$tirUser,$mordadUser,$shahrivarUser,$mehrUser,$abanUser,$azarUser,$deyUser,$bahmanUser,$esfandUser];

        return view('admin.customers.show.show',compact('allUsers','userReports','todayTransaction','yesTransaction','todayUsers','yesUsers','weekUsers','monthUsers','yearUsers'));
    }
    public function update(Request $request , User $user){
        $request->validate([
            'name' => 'required|max:220',
            'number' => 'max:20|min:8',
            'password' => 'max:220',
            'email' => ['email',Rule::unique('users')->ignore($user->id)],
            'website' => 'max:255',
            'postal' => 'max:15',
            'address' => 'max:255',
            'state' => 'max:100',
            'city' => 'max:100',
        ]);
        $user->update([
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) :$user->password,
            'registration_number' => $request->registration_number,
            'gender' => $request->gender,
            'website' => $request->website,
            'postal' => $request->postal,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
        ]);
        return redirect('/admin/customer')->with([
            'message' => $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Request $request , User $user){
        Ticket::where(function ($query) use($user) {
            $query->where('user_id', '=', $user->id)
                ->orWhere('catch_id', '=', $user->id);
        })->delete();
        $user->demand()->delete();
        $user->image()->delete();
        $user->delete();
        return redirect()->back()->with([
            'message' => $user->name . ' با موفقیت حذف شد'
        ]);
    }
}
