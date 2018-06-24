<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\User;

class AuthController extends Controller
{
    /**
     * Validate and create the user along with the verification code
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $credenials = $request->only('name', 'email', 'password');

        $validator = Validator::make($credenials, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->messages()
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $verification_code = str_random(30);
        DB::table('user_verifications')->insert([
            'user_id' => $user->id,
            'token' => $verification_code
        ]);

        $this->sendVerificationEmail($user->email, $user->name, $verification_code);

        return response()->json([
            'success' => true,
            'message' => 'Thanks for signing up! Check out your mail to verify your email address and complete the registration process'
        ]);
    }

    /**
     * Verify user by verification code
     *
     * @param $verification_code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUser($verification_code)
    {
        $verified = DB::table('user_verifications')->where('token', $verification_code)->first();

        if (!is_null($verified)) {
            $user = User::find($verified->user_id);

            if ($user->is_verified == true) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your account has already been verified'
                ]);
            }

            $user->update(['is_verified' => true]);
            DB::table('user_verifications')->where('token', $verification_code)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Your email address was successfully verified'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid verification code'
        ]);
    }

    /**
     * Login and try to create a JWT token
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->messages()
            ]);
        }

        $credentials['is_verified'] = true;

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'error' => 'We can\'t find an account with those credentials'
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Login failed. Please try again'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => ['token' => $token]
        ]);
    }

    /**
     * Logout and invalidate the JWT token
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json([
                'success' => true,
                'message' => 'You have been successfully logged out'
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Logout failed. Please try again'
            ], 500);
        }
    }

    /**
     * Send a reset password email
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function recover(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => ['email' => 'Your email address could not be found']
            ], 401);
        }

        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your password reset link');
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'A reset email has been sent through! Please check your mail :)'
        ]);
    }

    /**
     * Send the verification email
     *
     * @param $email
     * @param $name
     * @param $verification_code
     */
    private function sendVerificationEmail($email, $name, $verification_code)
    {
        $subject = 'Please verify your email address';

        Mail::send('emails.verify', [
            'name' => $name,
            'verification_code' => $verification_code
        ], function ($mail) use ($email, $name, $subject) {
            $mail->from(getenv('MAIL_FROM_ADDRESS'), config('app.name'));
            $mail->to($email, $name);
            $mail->subject($subject);
        });
    }
}
