<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class CustomForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        // แสดงฟอร์มรีเซ็ตรหัสผ่าน
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
{
    // ตรวจสอบอีเมล
    $request->validate(['email' => 'required|email']);

    // ส่งลิงก์รีเซ็ตรหัสผ่าน
    $status = Password::sendResetLink(
        $request->only('email')
    );

    // ตรวจสอบสถานะและส่งข้อความตอบกลับ
    if ($status === Password::RESET_LINK_SENT) {
        return back()->with(['status' => __($status)]);
    }

    return back()->withErrors(['email' => __($status)]);
}

}
