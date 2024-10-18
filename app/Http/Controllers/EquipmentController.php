<?php

namespace App\Http\Controllers;
use App\Models\RepairReport;
use App\Models\Returnborrowing;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EquipmentExport;
use App\Models\equipment;
use App\Models\user;
use App\Models\Borrowing;
class EquipmentController extends Controller
{
    

    public function show(Request $request)
    {
        $equipments = DB::table('equipment')->get();

        // return response()->json(['data' => $equipments], 200);
        return view('admin.function.AdminEquipment', ['equipments' => $equipments]);
     

    }
    public function showborrow(Request $request)
    {
        $Borrowing = DB::table('borrowings')->get();

        // return response()->json(['data' => $equipments], 200);
        return view('admin/AdminEquipment', ['borrowings' => $Borrowing]);

    }
    public function showname()
    {
        $equipments = Equipment::all();
        return view('users/Userreport', compact('equipments'));

    }
    public function showUser(Request $request)
    {
        $equipments = DB::table('equipment')->get();

        // return response()->json(['data' => $equipments], 200);
        return view('users/Userequipment', ['equipments' => $equipments]);

    }
    public function borrowshow(Request $request)
    {
        $equipments = DB::table('equipment')->where('status_borrow', '')->get();

        // return response()->json(['data' => $equipments], 200);
        return view('users/Userborrow', ['equipments' => $equipments]);

    }
    public function export()
    {
        return Excel::download(new EquipmentExport, 'equipment.xlsx');
    }
    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        Equipment::whereIn('equipment_id', $ids)->delete();
    
        return response()->json(['success' => 'ข้อมูลที่เลือกถูกลบเรียบร้อยแล้ว']);
    }
    



}