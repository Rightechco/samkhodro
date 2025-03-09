<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function parent(){
        if(auth()->user()->level == 2){
            $events = Event::where(function ($q){
                $q->where('customer_id' , auth()->user()->id)
                ->orWhere('user_id' , auth()->user()->id);
            })->latest()->paginate(50);
            $users = User::latest()->where('level' , '!=' , 3)->select(['name','id'])->get();
        }else{
            $events = Event::latest()->paginate(50);
            $users = User::latest()->select(['name','id'])->get();
        }
        return view('admin.event.index',compact('events','users'));
    }
    public function index(Request $request , User $user){
        $events = Event::where(function ($q) use($user){
            $q->where('user_id' , $user->id)
                ->orWhere('customer_id' , $user->id);
        })->latest()->paginate(50);
        return view('admin.customers.show.event',compact('events','user'));
    }
    public function indexPotential(Request $request , User $user){
        $events = Event::where(function ($q) use($user){
            $q->where('user_id' , $user->id)
                ->orWhere('customer_id' , $user->id);
        })->latest()->paginate(50);
        return view('admin.potential.show.event',compact('events','user'));
    }
    public function indexEmployee(Request $request , User $user){
        $events = Event::where(function ($q) use($user){
            $q->where('user_id' , $user->id)
                ->orWhere('customer_id' , $user->id);
        })->distinct('id')->latest()->paginate(50);
        return view('admin.employee.show.event',compact('events','user'));
    }
    public function store(Request $request , User $user){
        $request->validate([
            'body' => 'required',
            'title' => 'required',
        ]);
        Event::create([
            'title' => $request->title,
            'body' => $request->body,
            'type' => 0,
            'user_id' => auth()->user()->id,
            'customer_id' => $request->user_id ?? $user->id,
        ]);
        return redirect()->back()->with([
            'message' => 'اعلان با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request , User $user){
        if(auth()->user()->level == 2){
            return Event::where(function ($q){
                $q->where('customer_id' , auth()->user()->id)
                    ->orWhere('user_id' , auth()->user()->id);
            })->where('id' , $request->event)->first();
        }else{
            return Event::where('id' , $request->event)->first();
        }
    }
    public function update(Request $request , User $user){
        $request->validate([
            'body' => 'required',
            'title' => 'required',
        ]);
        if(auth()->user()->level == 2){
            Event::where(function ($q){
                $q->where('customer_id' , auth()->user()->id)
                    ->orWhere('user_id' , auth()->user()->id);
            })->where('id' , $request->event)->update([
                'title' => $request->title,
                'body' => $request->body,
                'customer_id' => $request->user_id ?? $user->id,
            ]);
        }else{
            Event::where('id' , $request->event)->update([
                'title' => $request->title,
                'body' => $request->body,
                'customer_id' => $request->user_id ?? $user->id,
            ]);
        }
        return redirect()->back()->with([
            'message' => 'اعلان با موفقیت ویرایش شد'
        ]);
    }
    public function deleteCustomer(Request $request , User $user , Event $event){
        $event->delete();
        return redirect()->back()->with([
            'message' => 'اعلان با موفقیت حذف شد'
        ]);
    }
    public function delete(Request $request , Event $event){
        $event->delete();
        return redirect()->back()->with([
            'message' => 'اعلان با موفقیت حذف شد'
        ]);
    }
}
