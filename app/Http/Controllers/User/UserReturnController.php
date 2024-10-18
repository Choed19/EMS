<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\equipment;
use App\Models\Returnborrowing;

use Illuminate\Support\Facades\Auth;
class UserReturnController extends Controller
{
    public function Userreturn()
    {
        $userId = Auth::id();

            $borrowings = Borrowing::with('equipment')
            ->leftJoin('returnborrowings', 'borrowings.borrow_id', '=', 'returnborrowings.borrow_id')
            ->where('borrowings.user_id', $userId)
            ->select('borrowings.*', 'returnborrowings.returned_date as r_date')
            ->get();
        // ส่งข้อมูลไปยัง View


        return view('users/Userreturn', compact('borrowings'));
    }
    public function return(Request $request)
    {
        try {
            // ข้อมูลการยืมทั้งหมดจากฟอร์ม
            $item = $request->json()->all();
                Returnborrowing::create([
                    'user_id' => auth()->id(), // เก็บ User ID ของผู้ที่ยืม
                    'borrow_id' => $item['borrow_id'],
                    'equipment_id' =>$item['equipment_id'] ,
                    'serial_no' => $item['serial_no'],
                    'equipment_name' => $item['equipment_name'],
                    'building_no' => $item['building_no'],
                    'room_no' => $item['room_no'],
                    'status' => 'รอ',
                    'returned_date' => now(),
                ]);
                $borrowings = Borrowing::where('serial_no', $item['serial_no']);
                if ($borrowings) {
                    // อัปเดตสถานะการยืมของอุปกรณ์เป็น 'none'
                    $borrowings->update(['status' => 'ดำเนินการคืน']);
                } else {
                    // จัดการกรณีไม่พบอุปกรณ์
                    return redirect()->back()->withErrors(['serial_no' => 'อุปกรณ์ไม่พบ']);
                }
            return response()->json(['success' => true, 'message' => 'Return successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
