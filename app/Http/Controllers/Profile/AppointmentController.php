<?php

namespace App\Http\Controllers\Profile;

use App\Models\Appointment;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class AppointmentController
{
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'number' => ['nullable','numeric','regex:/(0|\+98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/'],
            'date' => ['required','regex:/^\d+\/(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])$/'],
            'time' => ['required','regex:/^(0?[0-9]|1[0-9]|2[0-4]):([0-5][0-9]|60)$/'],
        ]);

        if ($request->number) {
            $user = auth()->user();
            $user->number = $request->number;
            $user->save();
        }
        $time = explode(":", $request->time);

        $dateFromPicker = explode('/',$request->date);
        $v = Verta::jalaliToGregorian($dateFromPicker[0],$dateFromPicker[1],$dateFromPicker[2]);
        $date =  Carbon::create($v[0],$v[1],$v[2],$time[0],$time[1],0 );

        $appointment = Appointment::query()->create([
            'user_id' => auth()->user()->id,
            'time' => $date,
        ]);

        return redirect()->back()->with([
            'message' => 'نوبت با موفقیت ایجاد شد'
        ]);
    }
}
