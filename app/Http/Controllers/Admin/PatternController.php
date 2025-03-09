<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pattern;
use App\Models\Reminder;
use Illuminate\Http\Request;

class PatternController extends Controller
{
    public function indexSms(){
        $sms = Pattern::where('type' , 0)->latest()->paginate(50);
        return view('admin.sms.index',compact('sms'));
    }
    public function storeSms(Request $request){
        $request->validate([
            'name' => 'required',
            'body' => 'required',
        ]);
        $note = Pattern::create([
            'name' => $request->name,
            'body' => $request->body,
            'type' => 0,
        ]);
        return redirect()->back()->with([
            'message' => 'قالب با موفقیت اضافه شد'
        ]);
    }
    public function editSms(Request $request){
        return Pattern::where('id' , $request->sms)->where('type',0)->first();
    }
    public function updateSms(Request $request){
        $request->validate([
            'name' => 'required',
            'body' => 'required',
        ]);
        Pattern::where('id' , $request->sms)->update([
            'name' => $request->name,
            'body' => $request->body,
        ]);
        return redirect()->back()->with([
            'message' => 'قالب با موفقیت ویرایش شد'
        ]);
    }

    public function indexEmail(){
        $email = Pattern::where('type' , 1)->latest()->paginate(50);
        return view('admin.email.index',compact('email'));
    }
    public function storeEmail(Request $request){
        $request->validate([
            'name' => 'required',
            'body' => 'required',
        ]);
        $note = Pattern::create([
            'name' => $request->name,
            'body' => $request->body,
            'type' => 1,
        ]);
        return redirect()->back()->with([
            'message' => 'قالب با موفقیت اضافه شد'
        ]);
    }
    public function editEmail(Request $request){
        return Pattern::where('id' , $request->sms)->where('type',1)->first();
    }
    public function updateEmail(Request $request){
        $request->validate([
            'name' => 'required',
            'body' => 'required',
        ]);
        Pattern::where('id' , $request->sms)->update([
            'name' => $request->name,
            'body' => $request->body,
        ]);
        return redirect()->back()->with([
            'message' => 'قالب با موفقیت ویرایش شد'
        ]);
    }
    public function deleteSms(Pattern $pattern){
        Pattern::where('id' , $pattern->id)->where('type' , 0)->delete();
        return redirect()->back()->with([
            'message' => 'قالب با موفقیت حذف شد'
        ]);
    }
    public function deleteEmail(Pattern $pattern){
        Pattern::where('id' , $pattern->id)->where('type' , 1)->delete();
        return redirect()->back()->with([
            'message' => 'قالب با موفقیت حذف شد'
        ]);
    }
}
