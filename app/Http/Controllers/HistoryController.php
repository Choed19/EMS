<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Returnborrowing;
use App\Models\Borrowing;
use App\Models\User;
use App\Models\RepairReport;

use Illuminate\Support\Facades\Auth;
class HistoryController extends Controller
{
    public function adminreturnhistory()
    {
        // Retrieve all return borrowings
        $returnBorrowings = Returnborrowing::with(['user', 'equipment'])->get();
    
        // Return the view with all return borrowings
        return view('admin/function/Adminreturnhistory', compact('returnBorrowings'));
    }
    public function adminborrowhistory()
    {
        // ดึงข้อมูลการยืมทั้งหมดจากฐานข้อมูล
        $borrowings = Borrowing::with('user', 'equipment')->get();

        // ส่งข้อมูลไปยัง View
        return view('admin/function/Adminborrowhistory', compact('borrowings'));
    }
    public function reporthistory(){
        $reports = RepairReport::with('user', 'equipment')->get();
        return view('admin.function.AdminReporHitstory', compact('reports')); // เปลี่ยนเป็น 'reports'
    }
}
