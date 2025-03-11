<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController
{
    public function index()
    {
        $appointments = Appointment::query()->latest()->paginate(50);
        return view('admin.appointment.index',compact('appointments'));
    }

    public function edit(Appointment $appointment)
    {
        return view('admin.appointment.edit',compact('appointment'));
    }

    public function update(Request $request,Appointment $appointment)
    {
        $request->validate([
            'status' => ['required',Rule::in(Appointment::$statuses)],
            'note' => 'nullable|string|max:5500',
        ]);

        $appointment->status = $request->status;
        $appointment->note = $request->note ?? '-';
        $appointment->save();

        return redirect('/admin/appointment/')->with([
            'message' => 'نوبت با موفقیت ویرایش شد'
        ]);
    }

    public function delete(Appointment $appointment)
    {
        $appointment->delete();
        return redirect('/admin/appointment/')->with([
            'message' => 'نوبت با موفقیت حذف شد'
        ]);
    }
}
