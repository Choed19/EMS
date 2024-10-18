<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * แสดงแบบฟอร์มขอรีเซ็ตรหัสผ่าน
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * ส่งลิงก์รีเซ็ตรหัสผ่านทางอีเมล
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validate อีเมล
        $request->validate(['email' => 'required|email']);

        // ส่งลิงก์รีเซ็ตรหัสผ่าน
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // ตรวจสอบสถานะและแสดงข้อความที่เหมาะสม
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
}
