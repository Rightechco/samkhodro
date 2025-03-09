<?php

namespace App\Console\Commands;

use App\Mail\SendMail;
use App\Models\Event;
use App\Models\Pattern;
use App\Models\Reminder;
use App\Models\Setting;
use App\Models\User;
use App\Traits\SendSmsTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    use SendSmsTrait;
    public function handle()
    {
        $reminders = Reminder::where('stamp','<=',Carbon::now()->timestamp)->where('used' , '<=' , 1)->get();
        foreach ($reminders as $item){
            if ($item->repeat){
                if ($item->used == 0){
                    $times = Carbon::now()->addDays($item->repeat)->timestamp;
                    $item->update([
                        'stamp' => $times,
                        'status' => 1,
                        'used' => 1
                    ]);
                }else{
                    $item->update([
                        'status' => 2,
                        'used' => 1
                    ]);
                }
            }else{
                $item->update([
                    'status' => 2,
                    'used' => 1
                ]);
            }
            Event::create([
                'title' => 'اطلاع رسانی',
                'body' => $item->body,
                'customer_id' => $item->customer_id,
                'user_id' => $item->user_id,
                'type' => 1,
            ]);
            $user = User::where('id' , $item->customer_id)->first();
            if($item->pattern >= 1){
                $smsPattern = Pattern::where('id' , $item->id)->first();
                $patterns = [];
                foreach (explode(',',$smsPattern->body) as $val){
                    $data = 0;
                    if($val == 'user'){
                        $data = $user->name;
                    }
                    elseif($val == 'admin'){
                        $data = User::where('level' , 3)->pluck('name')->first();
                    }
                    elseif($val == 'title'){
                        $data = Setting::where('key' , 'title')->pluck('value')->first();
                    }
                    elseif($val == 'webUrl'){
                        $data = url();
                    }
                    elseif($val == 'adminNumber'){
                        $data = Setting::where('key' , 'number')->pluck('value')->first();
                    }
                    elseif($val == 'userNumber'){
                        $data = $user->number;
                    }
                    elseif($val == 'adminEmail'){
                        $data = Setting::where('key' , 'email')->pluck('value')->first();
                    }
                    elseif($val == 'userEmail'){
                        $data = $user->email;
                    }
                    array_push($patterns,$data);
                }
                $this->sendSms($user->number , $patterns,$item->name);
            }
            if($item->email >= 1){
                $emailPattern = Pattern::where('id' , $item->id)->first();
                $texts = $emailPattern->body;
                $texts = str_replace('{user}',$texts,$user->name);
                $texts = str_replace('{admin}',$texts,User::where('level' , 3)->pluck('name')->first());
                $texts = str_replace('{title}',$texts,Setting::where('key' , 'title')->pluck('value')->first());
                $texts = str_replace('{webUrl}',$texts,url());
                $texts = str_replace('{adminNumber}',$texts,Setting::where('key' , 'number')->pluck('value')->first());
                $texts = str_replace('{userNumber}',$texts,$user->number);
                $texts = str_replace('{adminEmail}',$texts,Setting::where('key' , 'email')->pluck('value')->first());
                $texts = str_replace('{userEmail}',$texts,$user->email);
                Mail::to($user->email)->send(new sendMail($emailPattern->name , $texts , env('MAIL_FROM_ADDRESS')));
            }
        }
    }
}
