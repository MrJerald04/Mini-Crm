<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Employee;
use App\Notification;
use App\SendEmail;
use Carbon\Carbon;
use App\Jobs\SendMailJob;
use App\Mail\EmailTemplate;

use Auth;

class SendEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::guard('user')->user()->id;
        $user = User::find($user_id);
        return view('/admin/send_mail')->with(['user' => $user]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sendEmail = new SendEmail();
        $sendEmail->from_name = $request->from_name;
        $sendEmail->from_email = $request->from_email;
        $sendEmail->to_name = $request->to_name;
        $sendEmail->to_email = $request->to_email;
        $sendEmail->message = $request->message;
        $sendEmail->save();

        if ($request->send_status == 'now') {
            $sendEmail->delivered = 'YES';
            $sendEmail->send_date = Carbon::now();
            $sendEmail->save();   


            dispatch(new SendMailJob($request->to_email, new EmailTemplate($sendEmail)));
            return redirect('/admin/send_mail')->with('success', 'Email Sent');
        }else{
            $sendEmail->date_string = date("Y-m-d H:i", strtotime($request->date_to_send));
            $sendEmail->save();   
            return redirect('/admin/send_mail')->with('success', 'Email will be sent later');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
