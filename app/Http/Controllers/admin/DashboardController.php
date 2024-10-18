<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Borrowing;
use App\Models\RepairReport;
use App\Models\Returnborrowing;

use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index() {
        // นับจำนวนครุภัณฑ์ทั้งหมด
        $equipmentCount = Equipment::count();
        
        // นับจำนวนครุภัณฑ์ที่ยืม
        $BorrowEquipmentCount = Borrowing::count();
        
        // นับจำนวนครุภัณฑ์ที่คืน
        $ReturnEquipmentCount = Returnborrowing::count();
        
        // นับจำนวนครุภัณฑ์ที่ซ่อม
        $ReportEquipmentCount = RepairReport::count();
        
        // ดึงข้อมูลสำหรับกราฟจำนวนอุปกรณ์ตามกลุ่ม
     
    
        // ดึงข้อมูลสำหรับกราฟการยืมตามเดือน
     
//         $borrowings = Borrowing::selectRaw('MONTH(borrowed_date) as month, COUNT(*) as count')
//         ->groupBy('month')
//         ->orderBy('month')
//         ->get();

//         $returns = Returnborrowing::selectRaw('MONTH(returned_date) as month, COUNT(*) as count')
//         ->groupBy('month')
//         ->orderBy('month')
//         ->get();

//         $reports = RepairReport::selectRaw('MONTH(report_date) as month, COUNT(*) as count')
//         ->groupBy('month')
//         ->orderBy('month')
//         ->get();
    


//         $months = [
//             'January', 'February', 'March', 'April', 'May', 'June',
//             'July', 'August', 'September', 'October', 'November', 'December'
//         ];
//  // สร้าง array สำหรับแสดงข้อมูลในกราฟ
//         $borrowCounts = array_fill(0, 12, 0); 
//         $returnCounts = array_fill(0, 12, 0); 
//         $reportCounts = array_fill(0, 12, 0); 
      
      
//         foreach ($borrowings as $borrowing) {
//             $borrowCounts[$borrowing->month - 1] = $borrowing->count;
//         }
//         foreach ($returns as $return) {
//             $returnCounts[$return->month - 1] = $return->count;
//         }
//         foreach ($reports as $report) {
//             $reportCounts[$report->month - 1] = $report->count;
//         }


        // ส่งข้อมูลทั้งหมดไปยัง View เพียงครั้งเดียว
        return view('admin.dashboard', [
            'equipmentCount' => $equipmentCount,
            'BorrowEquipmentCount' => $BorrowEquipmentCount,
            'ReturnEquipmentCount' => $ReturnEquipmentCount,
            'ReportEquipmentCount' => $ReportEquipmentCount,
            // 'months' => $months,
            // 'borrowCounts' => $borrowCounts,
            // 'returnCounts' => $returnCounts,
            // 'reportCounts' => $reportCounts

        ]);
    }
}
