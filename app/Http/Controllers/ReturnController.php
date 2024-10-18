<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\equipment;
use App\Models\Returnborrowing;

use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
   
    public function show()
    {
        // Retrieve all return borrowings
        $returnBorrowings = Returnborrowing::all();
        
        // Return the view with the return borrowings
        return view('admin/function/Adminreturn', compact('returnBorrowings'));
    }
    public function edit($return_id)
    {
        // Retrieve the return borrowing by ID
        $returnBorrowing = Returnborrowing::with(['user', 'equipment'])->find($return_id);
    
        // Check if return borrowing exists
        // if (!$returnBorrowing) {
        //     return redirect()->route('adminreturn.index')->with('error', 'ไม่พบข้อมูลการยืม');
        // }
    
        // Return the view with the return borrowing
        return view('admin/function/Adminretrurncheck', compact('returnBorrowing'));
    }
    public function update(Request $request, $return_id)
{
    // ค้นหาการยืมอุปกรณ์ตาม ID
    $returnBorrowing = Returnborrowing::findOrFail($return_id);

    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $request->validate([
        'status' => 'required|string|max:50',
    ]);

    // อัปเดตสถานะของการยืม
    $returnBorrowing->update([
        'status' => $request->status,
    ]);

    // ค้นหาอุปกรณ์ที่เกี่ยวข้องกับการยืม
    $equipment = Equipment::where('serial_no', $returnBorrowing->serial_no)->first();

    // ตรวจสอบว่าพบอุปกรณ์หรือไม่
    if ($equipment) {
        // อัปเดตสถานะการยืมของอุปกรณ์เป็น ''
        $equipment->update(['status_borrow' => '']);
    } else {
        return redirect()->back()->withErrors(['serial_no' => 'อุปกรณ์ไม่พบ']);
    }

    // ค้นหาข้อมูลการยืม
    $borrowings = Borrowing::where('serial_no', $returnBorrowing->serial_no)->first();

    if ($borrowings) {
        // อัปเดตสถานะการยืมเป็น 'คืนสำเร็จ'
        $borrowings->update(['status' => 'คืนสำเร็จ']);
    } else {
        return redirect()->back()->withErrors(['serial_no' => 'อุปกรณ์ไม่พบ']);
    }

    // ส่งข้อความสำเร็จและกลับไปที่หน้าเดิม
    return redirect()->route('admin.return')->with('success', 'สถานะการคืนถูกอัปเดตเรียบร้อยแล้ว');
}

        public function adminreturn(Request $request)
    {
        try {
            // ข้อมูลการยืมทั้งหมดจากฟอร์ม
            $borrowingData = $request->json()->all();
            foreach ($borrowingData as $item) {
                // บันทึกข้อมูลการยืมลงในตาราง Borrowing
                Returnborrowing::create([
                    'user_id' => auth()->id(), // เก็บ User ID ของผู้ที่ยืม
                    'equipment_id' => Equipment::where('serial_no', $item['serial_no'])->first()->equipment_id, // หาค่า equipment_id จาก SerialNo
                    'serial_no' => $item['serial_no'],
                    'equipment_name' => $item['equipment_name'],
                    'building_no' => $item['building_no'],
                    'room_no' => $item['room_no'],
                    'status' => 'ยืนยันการคืน',
                    'borrowed_date' => $item['start_date'], // วันที่เริ่มยืม
                    'returned_date' => $item['end_date'],   // วันที่คืน
                ]);

                // อัปเดตสถานะในตาราง equipment
                Equipment::where('serial_no', $item['serial_no'])
                    ->update(['status_borrow' => '']);
            }
            $borrowings = Borrowing::where('serial_no', $item['serial_no']);
            if ($borrowings) {
                // อัปเดตสถานะการยืมของอุปกรณ์เป็น 'none'
                $borrowings->update(['status' => 'คืนสำเร็จ']);
            } else {
                // จัดการกรณีไม่พบอุปกรณ์
                return redirect()->back()->withErrors(['serial_no' => 'อุปกรณ์ไม่พบ']);
            }

            return response()->json(['success' => true, 'message' => 'Borrowing successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
