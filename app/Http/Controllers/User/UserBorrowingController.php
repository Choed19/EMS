<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\equipment;
use App\Models\Borrowing;
use App\Models\Returnborrowing;
use Illuminate\Support\Facades\DB;
class UserBorrowingController extends Controller
{
    public function borrowshow(Request $request)
    {
        $equipments = DB::table('equipment')->where('status_borrow', '')->get();

        // return response()->json(['data' => $equipments], 200);
        return view('users/Userborrow', ['equipments' => $equipments]);

    }
    public function borrow(Request $request)
    {
        try {
            // ข้อมูลการยืมทั้งหมดจากฟอร์ม
            $borrowingData = $request->json()->all();
            foreach ($borrowingData as $item) {
                // บันทึกข้อมูลการยืมลงในตาราง Borrowing
                Borrowing::create([
                    'user_id' => auth()->id(), // เก็บ User ID ของผู้ที่ยืม
                    'equipment_id' => Equipment::where('serial_no', $item['serial_no'])->first()->equipment_id, // หาค่า equipment_id จาก SerialNo
                    'serial_no' => $item['serial_no'],
                    'equipment_name' => $item['equipment_name'],
                    'building_no' => $item['building_no'],
                    'room_no' => $item['room_no'],
                    'status' => 'รอ',
                    'borrowed_date' => $item['start_date'], // วันที่เริ่มยืม
                    'returned_date' => $item['end_date'],   // วันที่คืน
                ]);

                // อัปเดตสถานะในตาราง equipment
                Equipment::where('serial_no', $item['serial_no'])
                    ->update(['status_borrow' => 'ยืม']);
            }

            return response()->json(['success' => true, 'message' => 'Borrowing successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function index($return_id = null)
    {
        // Get the ID of the currently logged-in user
        $userId = Auth::id();   

        // Check if $return_id is provided
        if ($return_id) {
            // If return_id is provided, fetch specific borrowing information
            $returnBorrowings = Returnborrowing::where('id', $return_id)
                ->where('user_id', $userId) // Ensure the borrowing belongs to the logged-in user
                ->get();
        } else {
            // If no return_id, fetch all borrowings for the user
            $returnBorrowings = Returnborrowing::where('user_id', $userId)->get();
        }

        // Pass the data to the view
        return view('users.BorrowedList', compact('returnBorrowings'));
    }
}
