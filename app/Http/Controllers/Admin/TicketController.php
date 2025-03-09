<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        $tickets = Ticket::with(["tickets" => function ($q) {
            $q->latest();
        }])->where('parent_id' , 0)->with('user')->get();
        $users = User::where('id' , '!=' , auth()->user()->id)->get();
        return view('admin.ticket.index',compact('user','tickets','users'));
    }
    public function userIndex(Request $request,User $user){
        $tickets = Ticket::where(function ($query) use($user) {
            $query->where('user_id', '=', $user->id)
                ->orWhere('catch_id', '=', $user->id);
        })->with(["tickets" => function ($q) {
            $q->latest();
        }])->where('parent_id' , 0)->with('user')->get();
        $users = User::where('id' , '!=' , auth()->user()->id)->get();
        return view('admin.customers.show.ticket.index',compact('user','tickets','users'));
    }
    public function userIndexEmployee(Request $request,User $user){
        $tickets = Ticket::where(function ($query) use($user) {
            $query->where('user_id', '=', $user->id)
                ->orWhere('catch_id', '=', $user->id);
        })->with(["tickets" => function ($q) {
            $q->latest();
        }])->where('parent_id' , 0)->with('user')->get();
        $users = User::where('id' , '!=' , auth()->user()->id)->get();
        return view('admin.employee.show.ticket.index',compact('user','tickets','users'));
    }
    public function userIndexPotential(Request $request,User $user){
        $tickets = Ticket::where(function ($query) use($user) {
            $query->where('user_id', '=', $user->id)
                ->orWhere('catch_id', '=', $user->id);
        })->with(["tickets" => function ($q) {
            $q->latest();
        }])->where('parent_id' , 0)->with('user')->get();
        $users = User::where('id' , '!=' , auth()->user()->id)->get();
        return view('admin.potential.show.ticket.index',compact('user','tickets','users'));
    }
    public function getTicket(Request $request){
        $user = [$request->user,auth()->user()->id];
        return Ticket::where(function ($query) use($user){
            $query->whereIn('user_id', $user)
            ->orWhere('catch_id', $user);
        })->where('parent_id' , 0)->where('id' , $request->ticket)->with(["tickets" => function ($q) {
            $q->with('user','catch','image');
        }])->with('user','catch','image')->first();
    }
    public function close(Request $request){
        $user = [$request->user,auth()->user()->id];
        return Ticket::where(function ($query) use($user){
            $query->whereIn('user_id', $user)
            ->orWhere('catch_id', $user);
        })->where('parent_id' , 0)->where('id' , $request->ticket)->first()->update([
            'status' => 0
        ]);
    }
    public function create(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'catch_id' => 'required',
            'body' => 'required',
        ]);
        $files = '';
        if($request->file_id){
            $files = $request->file_id;
        }
        elseif($request->image){
            $files = $request->image;
        }
        if($request->parent){
            $status = Ticket::where('status' , 0)->where('id' , $request->parent)->pluck('status')->first();
            if($status){
                return 'fail';
            }
        }
        Ticket::create([
            'title' => $request->title,
            'body' => $request->body,
            'status' => 1,
            'parent_id' => $request->parent ?? 0,
            'file_id' => $files,
            'catch_id' => $request->catch_id,
            'user_id' => auth()->user()->id,
        ]);
        if($request->parent){
            $user = [$request->catch_id,auth()->user()->id];
            return Ticket::where(function ($query) use($user){
                $query->whereIn('user_id', $user)
                    ->orWhere('catch_id', $user);
            })->where('id' , $request->parent)->with(["tickets" => function ($q) {
                $q->with('user','catch','image');
            }])->with('user','catch','image')->first();
        }
        return redirect()->back()->with([
            'message' => 'تیکت با موفقیت ایجاد شد'
        ]);
    }
}
