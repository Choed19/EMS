<?php

namespace App\Http\Controllers\User;
use App\Models\RepairReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\equipment;
class UserReportController extends Controller
{
    public function Userreport()
    {
        $equipments = Equipment::all();
        return view('users/Userreport', compact('equipments'));

    }
    public function Report(Request $request)
    {
        try {
            $items = $request->json()->all();
            logger($items); // ตรวจสอบข้อมูลที่ส่งมาทั้งหมด
    
            if (empty($items['equipment_id'])) {
                return response()->json(['success' => false, 'message' => 'ไม่พบข้อมูลอุปกรณ์']);
            }
    
            $userId = auth()->id();
            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'ผู้ใช้งานยังไม่ได้เข้าสู่ระบบ']);
            }
    
            // บันทึกการแจ้งซ่อมใหม่
            RepairReport::create([
                'user_id' => $userId,
                'equipment_id' => $items['equipment_id'],
                'description' => $items['description'] ?? 'ไม่มีรายละเอียด',
                'report_date' => now(),
                'status' => 'รอดำเนินการ',
            ]);
    
            // ตรวจสอบอุปกรณ์ว่ามีหรือไม่
            $equipment = Equipment::where('equipment_id', $items['equipment_id'])->first();
    
            if ($equipment) {
                // อัปเดตสถานะเมื่อพบอุปกรณ์
                if ($equipment->status !== 'รอดำเนินการซ่อม') { // ตรวจสอบสถานะก่อนอัปเดต
                    $equipment->update(['status' => 'รอดำเนินการซ่อม']);
                }
                return response()->json(['success' => true, 'message' => 'แจ้งซ่อมสำเร็จ']);
            } else {
                // กรณีไม่พบข้อมูล
                return response()->json(['success' => false, 'message' => 'ไม่พบอุปกรณ์']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage()]);
        }
    }
    
}