<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Mail;

class UserController extends Controller
{
    public function editUser($id)
    {
        $data = User::findOrFail($id);
        return view('admin.user.edit')->with([
            'data' => $data,
        ]);
    }
    public function updateUser(Request $request)
    {
        if (!empty($request->oldPassword && $request->newPassword)) {
            $hashedPassword = Auth::user()->password;

            if (\Hash::check($request->oldPassword, $hashedPassword)) {

                if (!\Hash::check($request->newPassword, $hashedPassword)) {
                    $add = User::find($request->id);
                    $add->name = $request->name;
                    $add->email = $request->email;
                    if ($request->newPassword == null) {
                        $add->password =  $add->password;
                    } else {
                        $add->password =  Hash::make($request->newPassword);
                    }
                    if ($add->save()) {
                        flash('Successfully Updated')->success();
                        return back();
                    } else {
                        flash('Error')->error();
                        return back();
                    }
                } else {
                    flash('new password can not be the old password!')->error();
                    return redirect()->back();
                }
            } else {
                flash('old password doesnt matched ')->error();
                return redirect()->back();
            }
        } else {
            $add = User::find($request->id);
            $add->name = $request->name;
            $add->email = $request->email;
            if ($request->newPassword == null) {
                $add->password =  $add->password;
            } else {
                $add->password =  Hash::make($request->newPassword);
            }
            if ($add) {
                flash('Successfully Updated')->success();
                return back();
            } else {
                flash('Error')->error();
                return back();
            }
        }
    }
    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.password.verify',['token' => $token], function($message) use ($request) {
                  $message->from($request->email);
                  $message->to('codingdriver15@gmail.com');
                  $message->subject('Reset Password Notification');
               });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
}
