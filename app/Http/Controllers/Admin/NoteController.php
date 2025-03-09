<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function parent(){
        if(auth()->user()->level == 2){
            $notes = Note::where(function ($q){
                $q->where('customer_id' , auth()->user()->id)
                    ->orWhere('user_id' , auth()->user()->id);
            })->latest()->paginate(50);
        }else{
            $notes = Note::latest()->paginate(50);
        }
        return view('admin.note.index',compact('notes'));
    }
    public function index(Request $request , User $user){
        $notes = Note::where('customer_id' , $user->id)->latest()->paginate(50);
        return view('admin.customers.show.note',compact('notes','user'));
    }
    public function indexPotential(Request $request , User $user){
        $notes = Note::where('customer_id' , $user->id)->latest()->paginate(50);
        return view('admin.potential.show.note',compact('notes','user'));
    }
    public function indexEmployee(Request $request , User $user){
        $notes = Note::where('customer_id' , $user->id)->latest()->paginate(50);
        return view('admin.employee.show.note',compact('notes','user'));
    }
    public function store(Request $request , User $user){
        $request->validate([
            'body' => 'required',
        ]);
        $note = Note::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
            'customer_id' => $user->id != '' ? $user->id : auth()->user()->id,
        ]);
        return redirect()->back()->with([
            'message' => 'یادداشت با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request){
        if(auth()->user()->level == 2){
            return Note::where(function ($q){
                $q->where('customer_id' , auth()->user()->id)
                    ->orWhere('user_id' , auth()->user()->id);
            })->where('id' , $request->note)->first();
        }else{
            return Note::where('id' , $request->note)->first();
        }
    }
    public function delete(Request $request , Note $note){
        $note->delete();
        return redirect()->back()->with([
            'message' => 'یادداشت با موفقیت اضافه شد'
        ]);
    }
    public function update(Request $request , User $user){
        $request->validate([
            'body' => 'required',
        ]);
        if(auth()->user()->level == 2){
            Note::where(function ($q){
                $q->where('customer_id' , auth()->user()->id)
                    ->orWhere('user_id' , auth()->user()->id);
            })->where('id' , $request->note)->update([
                'body' => $request->body
            ]);
        }else{
            Note::where('id' , $request->note)->update([
                'body' => $request->body
            ]);
        }
        return redirect()->back()->with([
            'message' => 'یادداشت با موفقیت ویرایش شد'
        ]);
    }
}
