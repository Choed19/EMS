<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    // ฟังก์ชันสำหรับอัปโหลดภาพโปรไฟล์
    public function upload(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|max:10240', // กำหนดให้เป็นไฟล์ภาพ ขนาดไม่เกิน 10MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            // อัปโหลดไฟล์ไปยังที่จัดเก็บและเก็บเส้นทางไว้ในฐานข้อมูล
            $path = $file->store('profile_images', 'public'); // เก็บไฟล์ในโฟลเดอร์ public/profile_images

            // บันทึกเส้นทางของภาพโปรไฟล์
            $user->profile_image = $path;
        }

        $user->save();

        return back()->with('success_image', 'อัปโหลดภาพโปรไฟล์สำเร็จแล้ว!');
    }








    // ฟังก์ชันสำหรับแสดงภาพโปรไฟล์
    public function showImage()
    {
        // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $user = Auth::user();

        // ตรวจสอบว่าผู้ใช้มีภาพโปรไฟล์หรือไม่
        if ($user->profile_image) {
            // สร้าง URL ของภาพจากเส้นทางที่เก็บในฐานข้อมูล
            $imagePath = storage_path('app/public/' . $user->profile_image);

            // ตรวจสอบว่ามีไฟล์ภาพอยู่จริงหรือไม่
            if (file_exists($imagePath)) {
                // ส่งไฟล์ภาพกลับไป
                return response()->file($imagePath);
            } else {
                // ส่งข้อความถ้าไม่พบไฟล์
                return response()->json(['message' => 'ไม่พบไฟล์ภาพ'], 404);
            }
        } else {
            // ส่งข้อความถ้าไม่มีภาพ
            return response()->json(['message' => 'ไม่พบภาพโปรไฟล์'], 404);
        }
    }




    // ฟังก์ชันสำหรับแสดงหน้าข้อมูลผู้ใช้
    public function userprofile()
    {
        // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $user = Auth::user();
        return view('users.Userprofile', ['user' => $user]); // ส่งข้อมูลไปยัง view
    }
    public function adminprofile()
    {
        // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $user = Auth::user();
        return view('admin.editProfile', ['user' => $user]); // ส่งข้อมูลไปยัง view
    }
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // ฟังก์ชันสำหรับอัปเดตโปรไฟล์
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // อัปเดตข้อมูลผู้ใช้
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');

        // อัปเดตรหัสผ่านหากผู้ใช้กรอกรหัสผ่านใหม่
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // บันทึกข้อมูลใหม่
        $user->save();

        return redirect()->back()->with('success_profile', 'โปรไฟล์ได้รับการอัปเดตเรียบร้อยแล้ว');
    }
}
