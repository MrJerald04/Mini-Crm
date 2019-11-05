<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SendEmail;
use Carbon\Carbon;
use App\Jobs\SendMailJob;
use App\Mail\EmailTemplate;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //One hour is added to compensate for PHP being one hour faster 
        $now = date("Y-m-d H:i", strtotime(Carbon::now()));
        logger($now);
        $sendEmail = SendEmail::all();
        if($sendEmail !== null){
            foreach($sendEmail as $sndEmail){
                if ($sndEmail->date_string == $now) {
                    if ($sndEmail->delivered == 'NO') {
                        dispatch(new SendMailJob(
                            $sndEmail->to_email, 
                            new EmailTemplate($sndEmail))
                        );
                        $sndEmail->delivered = 'YES';
                        $sndEmail->save();
                    }
                }
                
            }
        }
    }
}
