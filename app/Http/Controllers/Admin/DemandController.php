<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demand;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $allDemand = Demand::where('type',0)->count();
        $canDemand = Demand::where('type',0)->where('status' , 1)->count();
        $invoiceDemand = Demand::where('type',0)->where('status' , 2)->count();
        $proposalDemanded = Demand::where('type',0)->where('status' , 3)->count();
        $unInvoiceDemand = Demand::where('type',0)->where('status' , 0)->count();
        $demands = Demand::where('type',0)->paginate(60);
        return view('admin.preInvoice.demand',compact('demands','allDemand','canDemand','invoiceDemand','proposalDemanded','unInvoiceDemand','title'));
    }
    public function delete(Demand $demand,Request $request){
        $demand->delete();
        return redirect()->back()->with([
            'message' => 'درخواست با موفقیت حذف شد'
        ]);
    }
    public function invoice(Demand $demand,Request $request){
        $demand->update([
            'status' => 2
        ]);
        Event::create([
            'title' => 'تبدیل درخواست',
            'body' => 'درخواست ' . $demand->name . ' به فاکتور تبدیل شروع شد',
            'type' => 2,
            'user_id' => auth()->user()->id,
            'customer_id' => auth()->user()->id,
        ]);
        return redirect('/admin/invoice/create');
    }
    public function proposal(Demand $demand,Request $request){
        $demand->update([
            'status' => 3
        ]);
        Event::create([
            'title' => 'تبدیل درخواست',
            'body' => 'درخواست ' . $demand->name . ' به پروپوزال تبدیل شروع شد',
            'type' => 2,
            'user_id' => auth()->user()->id,
            'customer_id' => auth()->user()->id,
        ]);
        return redirect('/admin/proposal/create');
    }
    public function customerIndex(User $user,Request $request){
        $title = $request->title;
        $allDemand = $user->demand()->where('type',0)->count();
        $canDemand = $user->demand()->where('type',0)->where('status' , 1)->count();
        $invoiceDemand = $user->demand()->where('type',0)->where('status' , 2)->count();
        $proposalDemanded = $user->demand()->where('type',0)->where('status' , 3)->count();
        $unInvoiceDemand = $user->demand()->where('type',0)->where('status' , 0)->count();
        $demands = $user->demand()->where('type',0)->paginate(60);
        return view('admin.customers.show.demand',compact('demands','user','allDemand','canDemand','invoiceDemand','proposalDemanded','unInvoiceDemand','title'));
    }
    public function potentialIndex(User $user,Request $request){
        $title = $request->title;
        $allDemand = $user->demand()->where('type',0)->count();
        $canDemand = $user->demand()->where('type',0)->where('status' , 1)->count();
        $invoiceDemand = $user->demand()->where('type',0)->where('status' , 2)->count();
        $proposalDemanded = $user->demand()->where('type',0)->where('status' , 3)->count();
        $unInvoiceDemand = $user->demand()->where('type',0)->where('status' , 0)->count();
        $demands = $user->demand()->where('type',0)->paginate(60);
        return view('admin.potential.show.demand',compact('demands','user','allDemand','canDemand','invoiceDemand','proposalDemanded','unInvoiceDemand','title'));
    }
    public function customerInvoice(User $user,Demand $demand,Request $request){
        $demand->update([
            'status' => 2
        ]);
        Event::create([
            'title' => 'تبدیل درخواست',
            'body' => 'درخواست ' . $demand->name . ' به فاکتور تبدیل شروع شد',
            'type' => 2,
            'user_id' => auth()->user()->id,
            'customer_id' => auth()->user()->id,
        ]);
        return redirect('/admin/customer/'.$user->id.'/invoice/create');
    }
    public function customerProposal(User $user,Demand $demand,Request $request){
        $demand->update([
            'status' => 3
        ]);
        Event::create([
            'title' => 'تبدیل درخواست',
            'body' => 'درخواست ' . $demand->name . ' به پروپوزال تبدیل شروع شد',
            'type' => 2,
            'user_id' => auth()->user()->id,
            'customer_id' => auth()->user()->id,
        ]);
        return redirect('/admin/proposal/create');
    }
    public function potentialInvoice(User $user,Demand $demand,Request $request){
        $demand->update([
            'status' => 2
        ]);
        Event::create([
            'title' => 'تبدیل درخواست',
            'body' => 'درخواست ' . $demand->name . ' به فاکتور تبدیل شروع شد',
            'type' => 2,
            'user_id' => auth()->user()->id,
            'customer_id' => auth()->user()->id,
        ]);
        return redirect('/admin/potential/'.$user->id.'/invoice/create');
    }
    public function potentialProposal(User $user,Demand $demand,Request $request){
        $demand->update([
            'status' => 3
        ]);
        Event::create([
            'title' => 'تبدیل درخواست',
            'body' => 'درخواست ' . $demand->name . ' به پروپوزال تبدیل شروع شد',
            'type' => 2,
            'user_id' => auth()->user()->id,
            'customer_id' => auth()->user()->id,
        ]);
        return redirect('/admin/proposal/create');
    }
}
