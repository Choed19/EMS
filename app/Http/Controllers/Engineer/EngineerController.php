<?php

namespace App\Http\Controllers\Engineer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RepairReport;
use App\Models\equipment;
class EngineerController extends Controller
{
    public function EngineerconfirmRepair(){
        $reports = RepairReport::with('user', 'equipment')->get();
        return view('Engineer.Engineerport', compact('reports')); 
    }
    
    public function EngineerRepaircheck($report_id){
        $reports =  RepairReport::with('user','equipment')->findOrFail($report_id);
        return view('Engineer.Engineerreportcheck',compact('reports'));
    }
    public function home(){
        return view('Engineer.EngineerHome');
    }
    public function EngineerDashbord(){
        return view('Engineer.EngineerDashbord');
    }
    
        public function history() {
            $reports = RepairReport::with('user', 'equipment')->get();
            return view('Engineer.EngineerList', compact('reports')); 
        }
    
    public function Engineerupdate(Request $request, $report_id)
    {
        // ค้นหารายงานการซ่อมที่ต้องการอัปเดต
        $report = RepairReport::findOrFail($report_id);
        
        // ตรวจสอบข้อมูลที่ส่งเข้ามา
        $request->validate([
            'status' => 'required|string',
        ]);
        
        // อัปเดตสถานะของรายงานการซ่อม
        $report->update([
            'status' => $request->status,
        ]);
        // อัปเดตสถานะของอุปกรณ์ที่เชื่อมโยง
        Equipment::where('status', $report->equipment->status) // ใช้ equipment_id จากรายงานการซ่อม
            ->update(['status' => 'พบ']); // เปลี่ยนสถานะของอุปกรณ์เป็น 'พบ'
    
        return redirect()->route('report.admin')->with('success', 'อัปเดตสถานะสำเร็จ');
    }
    
}
