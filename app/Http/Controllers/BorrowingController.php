<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Equipment;
use App\Models\Returnborrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    // public function index()
    // {
    //     // Retrieve all return borrowings
    //     $returnBorrowings = Returnborrowing::all();
        
    //     // Return the view with the return borrowings
    //     return view('users/BorrowedList', compact('returnBorrowings'));
    // }
    // public function index($return_id)
    // {
    //     // ดึงเฉพาะข้อมูลการยืมของผู้ใช้ที่ล็อกอินอยู่เท่านั้น
    //     $userId = Auth::id(); // ได้รับค่า user_id ของผู้ใช้ที่ล็อกอิน
    //     $returnBorrowings = Returnborrowing::all();

    //     // ส่งข้อมูลไปยัง View
    //     return view('users/BorrowedList', compact('returnBorrowing'));
    // }
    
    public function indexadmin()
    {
        // ดึงข้อมูลการยืมทั้งหมดจากฐานข้อมูล
        $borrowings = Borrowing::with('user', 'equipment')->get();

        // ส่งข้อมูลไปยัง View
        return view('admin/function/AdminBorrow', compact('borrowings'));
    }
    public function updateStatus(Request $request, $borrow_id)
    {
        $borrowing = Borrowing::findOrFail($borrow_id);
        $borrowing->status = $request->input('status');
        $borrowing->save();

        return redirect()->route('admin.borrowings.index')->with('success', 'Status updated successfully.');
    }
    
    public function edit($borrow_id)
    {
        // ค้นหา borrowing ตาม ID ที่ต้องการ (ควรใช้ findOrFail เพื่อหาเฉพาะข้อมูลที่ต้องการ)
        $borrowing = Borrowing::with('user', 'equipment')->findOrFail($borrow_id);

        // ส่งตัวแปร $borrowing ไปยัง view
        return view('admin/function/Adminborrowcheck', compact('borrowing'));
    }


    // public function edit($borrow_id)
    // {
    //     // ดึงข้อมูลการยืมทั้งหมดจากฐานข้อมูล
    //     $borrowings = Borrowing::with('user', 'equipment')->get();

    //     // ส่งข้อมูลไปยัง View
    //     return view('admin/Adminborrowcheck', compact('borrowings'));
    // }
    public function update(Request $request, $borrow_id)
    {
        // ค้นหาการยืมตาม ID
        $borrowing = Borrowing::findOrFail($borrow_id);
    
        // ตรวจสอบข้อมูลที่ส่งเข้ามา
        $request->validate([

            'status' => 'required|string|max:255',
            'note' => 'nullable|string|max:255', // เพิ่ม validation สำหรับ 'note'
        ]);
    
        // อัปเดตข้อมูลการยืม
        $borrowing->update([
            'status' => $request->status,
            'note' => $request->note,
        ]);
    
        // ส่งกลับไปยังหน้าที่กำหนด พร้อมกับข้อความสำเร็จ
        return redirect()->route('borrowings.admin', $borrow_id)->with('success', 'สถานะการคืนถูกอัปเดตเรียบร้อยแล้ว');
    }
    
}
