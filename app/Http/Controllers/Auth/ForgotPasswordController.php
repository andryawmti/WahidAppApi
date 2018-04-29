<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordV2;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $email = $request->input('email');
        $token = str_random(64);
        $link = url('/password/reset').'/'.$token;

        $resetRequset = DB::table('password_resets')->where('email', '=', $email)->first();
        if (isset($resetRequset)) {
            DB::table('password_resets')->where('email', '=', $email)->delete();
        }

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
        ]);

        Mail::to($email)->send(new ResetPasswordV2($link));

        if (!Mail::failures()) {
            $response = Password::RESET_LINK_SENT;
        }else{
            $response = Password::INVALID_USER;
        }

        /*$response = $this->broker()->sendResetLink(
            $request->only('email')
        );*/

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }
}
