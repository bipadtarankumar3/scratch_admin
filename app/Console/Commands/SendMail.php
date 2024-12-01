<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Camping;
use Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaing:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'When campaing will expire send mail to campaing owner';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $presentDate = date('Y-m-d');
        $campign = Camping::where('status','active')->whereDate('end_date','<',$presentDate)->where('mail_send','NO')->get();
        foreach ($campign as $key => $value) {
            $User = User::where('id', $value->created_by)->first();

            if ($User) {
                $email = $User->email;
                $campaign_name = $value->campaign_name;
                Mail::send('mail.campignExpireMail',['data'=>$campaign_name],function($message) use ($email){
                    $message->to($email)->subject('Expired Campign');
                } );
                $campign_update = Camping::where('id',$value->id)->update(['mail_send'=>'YES']);
            }
        }  
}
}
