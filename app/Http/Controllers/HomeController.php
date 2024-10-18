<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // เพิ่มการนำเข้า Auth
use App\Http\Model\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.home'); // เปลี่ยนชื่อ view
    }

    public function BR()
    {
        return view('users.br'); // เปลี่ยนชื่อ view
    }

    public function borrow()
    {
        return view('users.borrow'); // เปลี่ยนชื่อ view
    }

    /**
     * Show the admin home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }

    public function showUserHome()
    {
        $user = Auth::user();
        $image = $user->profile_image; // ดึงข้อมูลภาพโปรไฟล์

        return view('users.home', compact('user', 'image')); // เปลี่ยนชื่อ view
    }
    public function roleuser(){
        // เรียกใช้โมเดล User
        $users = \App\Models\User::all();
        
        // ส่งตัวแปร users ไปยัง view
        return view('admin.function.ManageRole', compact('users'));
    }
    public function roleadmin(Request $request, $user_id)
    {
        // ตรวจสอบว่ามี role ของ user_id ที่ส่งมา
        $request->validate([
            'role.' . $user_id => 'required', // role ต้องถูกส่งมา
        ]);
    
        // ค้นหาผู้ใช้ตาม user_id
        $user = \App\Models\User::findOrFail($user_id);
    
        // อัปเดต role ของผู้ใช้
        $user->role = $request->input('role.' . $user_id); // ดึง role จาก request
        $user->save();
    
        // ส่งข้อความสำเร็จกลับไปยังหน้าก่อนหน้า
        return back()->with('success', 'อัปเดตสิทธิ์เรียบร้อยแล้ว');
    }
    public function showScanQRCode()
{
    return view('users.UserScanQR');
}

    

}
