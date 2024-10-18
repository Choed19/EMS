<?php

namespace App\Http\Controllers;

use App\Models\RepairReport; // เรียกใช้โมเดล
use Illuminate\Http\Request;
use App\Models\equipment;
class RepairController extends Controller
{
    
    public function confirmRepair(){
        $reports = RepairReport::with('user', 'equipment')->get();
        return view('admin.function.Adminreport', compact('reports')); // เปลี่ยนเป็น 'reports'
    }
    
    public function Repaircheck($report_id){
        $reports =  RepairReport::with('user','equipment')->findOrFail($report_id);
        return view('admin.function.Adminreportcheck',compact('reports'));
    }
    public function update(Request $request, $report_id) {
        $reports = RepairReport::findOrFail($report_id);
    
        $request->validate([
            'status' => 'required|string',
        ]);
    
        $reports->update([
            'status' => $request->status,
        ]);
    
        return redirect()->route('report.admin')->with('success', 'อัปเดตสถานะสำเร็จ');
    }
}

