<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\equipment;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EquipmentImport;
use Illuminate\Support\Facades\Log;

class imEquipmentController extends Controller
{
    // แสดงหน้า view สำหรับการดูข้อมูล
    public function view()
    {
        return view('admin\function\Addmaster'); 
    }
    // public function addview()
    // {
    //     return view('admin/addems'); // ต้องตรงกับชื่อ view ที่คุณต้องการแสดง
    // }

    // บันทึกข้อมูล Equipment ลงในฐานข้อมูล
    public function store(Request $request)
    {
        $user = Auth::user();
        // ตรวจสอบความถูกต้องของข้อมูลที่รับเข้ามา
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'equipment_group' => 'required',
            'serial_no' => 'required',
            'equipment_name' => 'required',
            'cost' => 'required|numeric',
            'buy_date' => 'required',
            'department_name' => 'required',
            'building_no' => 'required',
            'room_no' => 'required',
            'status' => 'required',
        ]);

        // ถ้า Validate ไม่ผ่าน
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // บันทึกข้อมูลลงในฐานข้อมูล
        $equipment = new equipment();
        $equipment->year = $request->year;
        $equipment->equipment_group = $request->equipment_group;
        $equipment->serial_no = $request->serial_no;
        $equipment->equipment_name = $request->equipment_name;
        $equipment->cost = $request->cost;
        $equipment->buy_date = $request->buy_date;
        $equipment->department_name = $request->department_name;
        $equipment->building_no = $request->building_no;
        $equipment->room_no = $request->room_no;
        $equipment->status = $request->status;
        $equipment->create_time = now();
        $equipment->create_by = $user->fname . ' ' . $user->lname;
        $equipment->update_time = now();
        $equipment->update_by = $user->fname . ' ' . $user->lname;
        $equipment->save();

        // ส่งกลับหน้าที่แล้วพร้อมกับข้อความแจ้งเตือน
        return back()->with('success', 'Equipment successfully added.');
        // return redirect()->route('equipment.show')->with('success', 'Equipment updated successfully.');
    }
    public function import(Request $request)
    {
        try {
            Excel::import(new EquipmentImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data Imported Successfully!');
        } catch (\Exception $e) {
            Log::error('Import failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to import data. Please check the file and try again.');
        }
    }
    public function destroy($equipment_id)
    {
        $equipment = Equipment::where('equipment_id', $equipment_id)->firstOrFail();
        $equipment->delete();

        return response()->json(['success' => 'Equipment deleted successfully.']);
    }
    public function edit($equipment_id)
    {
        // หากต้องการดึงข้อมูลผู้ใช้ในที่นี้ คุณอาจดึงจาก Session หรือ Auth
        $user = Auth::user(); // หรือใช้ Session เพื่อดึง user_id
    
        $equipment = Equipment::where('equipment_id', $equipment_id)->firstOrFail();
    
        return view('admin.function.AdminEquipmentedit', compact('equipment', 'user'));
    }
    
    public function update(Request $request, $equipment_id)
    {
        // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมา
        $request->validate([
            'department_name' => 'required',
            'building_no' => 'required',
            'room_no' => 'required',
            'status' => 'required',
        ]);
    
        // ดึงข้อมูลอุปกรณ์ตาม ID
        $equipment = Equipment::where('equipment_id', $equipment_id)->firstOrFail();
    
        // ดึงข้อมูลผู้ใช้ที่ทำการอัปเดต (จาก Authentication)
        $user = Auth::user();
    
        // อัปเดตข้อมูลอุปกรณ์ พร้อมกับชื่อผู้ใช้ที่ทำการอัปเดตและเวลาที่อัปเดต
        $equipment->update(array_merge($request->all(), [
            'update_by' => $user->fname . ' ' . $user->lname, // อัปเดตชื่อผู้ใช้โดยอัตโนมัติ
            'update_time' => now()
        ]));
    
        // ส่งผู้ใช้กลับไปยัง route พร้อมข้อความสำเร็จ
        return redirect()->route('equipment.show')->with('success', 'อุปกรณ์ถูกแก้ไขเรียบร้อยแล้ว');
    }
    

    public function checkDuplicates(Request $request)
    {
        // รับ array ของ serial_no จากคำขอ
        $serialNumbers = $request->input('serialNumbers');
    
        // ตรวจสอบ serial_no ที่มีอยู่ในฐานข้อมูล
        $duplicates = Equipment::whereIn('serial_no', $serialNumbers)->pluck('serial_no')->toArray();
    
        // ส่งรายการ serial_no ที่ซ้ำกลับไปยังฝั่งลูกค้า
        return response()->json(['duplicates' => $duplicates]);
    }
    
}
