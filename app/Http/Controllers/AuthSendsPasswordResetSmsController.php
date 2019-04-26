<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Auth;
use Hash;
use Carbon\Carbon;
use App\User;
use DB;
use Session;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\TokenResetPassword;
use App\Helpers\LogActivity;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Notifications\meuResetDeSenha;




class AuthSendsPasswordResetSmsController extends Controller
{
    //use SendsPasswordResetEmails;
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkSms(Request $request)
    {LogActivity::addToLog('Auth - Reset Link SMS');
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        /*$response = $this->broker()->sendResetLink(
            $request->only('email')
        );*/ //serve para enviar email


        //create a new token to be sent to the user. 
            TokenResetPassword::updateOrCreate(

            ['email'=>$request->email],
            [
                'email' => $request->email,
                'token' => str_random(6), //change 60 to any length you want
                'created_at' => Carbon::now(),
            ]);

            $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

            $phoneData = DB::table('users')
            ->where('email', $request->email)->first();

           $token = $tokenData->token;
           $email = $request->email;
           $phone = $phoneData->phone; // or $email = $tokenData->email;
           //send email token
           $user = User::where('email',$email)->first();
           $user->notify(new meuResetDeSenha($token));


           if($phone){

            return $success=$this->enviarsms($token,$email,$phone);

           }else{
            Session::flash('error', 'Não tens Telefone configurado, porfavor contact o MIS');
            return view('auth.passwords.email');
           }

    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:users']);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    { LogActivity::addToLog('Auth-Reset link SMS failed');
        return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);

    }
        public function enviarsms($token,$email,$phone){

        $token=$token;
        $pnumber=$phone;
        $email=$email;

        // Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1Mjk5NTk0OCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY5MDY3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.NuZQGGd8CoCRyTNgsth8yAgbASnxUgFmFnyrChHSFfg');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        // Sending a SMS Message

        $sendMessageRequest2 = new SendMessageRequest([
            'phoneNumber' => $pnumber,
            'message' => 'Receba o codigo de confirmacao '.$token.' atraves de:'.$email,
            'deviceId' => 110202
        ]);
        $sendMessages = $messageClient->sendMessages([
                $sendMessageRequest2
        ]);

        //$respons=print_r($sendMessages);
        Session::flash('success', 'Introduza o codigo de confirmação enviado para: *****'.substr ($pnumber, -4).' ou acesse seu email');
        return redirect('resertform');

    }

     /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetpasswordform(Request $request)
    {   LogActivity::addToLog('Auth - Reset form');

        $validatedData = $request->validate([
            'token' => 'required|min:6|max:6|exists:password_resets',
            'email'=>'required|email|exists:password_resets',
        ]);

        return view('auth.passwords.reset')->with(
            ['token' => $validatedData['token'], 'email' => $validatedData['email']]
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {  LogActivity::addToLog('Auth- Reset');
        
        
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
        $this->credentials($request);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $dadostoken="";
        $tokenData = DB::table('password_resets')
         ->where('token', $request->token)->first();
        $dadostoken=$tokenData;
        
        if ($dadostoken!="") {
                        $user = User::where('email', $tokenData->email)->first();
                        return $response =$this->resetPassword($user, $request->password);

        }else{
            return view('auth.passwords.reset')->with(
                ['token' => $request->token, 'email' => $request->email]
        );
        }
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {     LogActivity::addToLog('Auth - Reset password');
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
        // If the user shouldn't reuse the token later, delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        return redirect('home');
    }

   
    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }


}
