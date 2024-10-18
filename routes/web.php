<?php

use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\imEquipmentController;
use App\Http\Controllers\Controlleradmin;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\Auth\CustomForgotPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

//Engineer 
use App\Http\Controllers\Engineer\EngineerController;
Route::get('Engineer/Engineerreportcheck/{id}/edit', [EngineerController::class, 'EngineerRepaircheck'])->name('Engineer.edit');
Route::put('Engineer/Engineerreportcheck/{id}', [EngineerController::class, 'Engineerupdate'])->name('Engineer.update');
Route::get('Engineer/Engineerport', [EngineerController::class, 'EngineerconfirmRepair'])->name('report.Engineer');
Route::get('Engineer/EngineerHome', [EngineerController::class, 'home'])->name('home.Engineer');
Route::get('Engineer/EngineerList', [EngineerController::class, 'history'])->name('Engineer.history');
Route::get('/EngineerDashbord', function () {
    return view('Engineer.EngineerDashbord');
});
Route::get('/userdashboard', function () {
    return view('users.Userdashboard');
});

//User//
//user/UserEquipmentController
use App\Http\Controllers\User\UserEquipmentController;
Route::get('users/Userequipment', [UserEquipmentController::class, 'showUser'])->name('showUser');
//
//Users/UserBorrowing
use App\Http\Controllers\User\UserBorrowingController;
Route::get('uers/Userborrow', [ UserBorrowingController::class, 'borrowshow'])->name('users.Userborrow');
Route::post('/confirm-borrow', [UserBorrowingController::class, 'borrow']);
Route::get('users/BorrowedList', [UserBorrowingController::class, 'index'])->name('list.user');
//
use App\Http\Controllers\User\UserReturnController;
Route::get('users/Userreturn',[UserReturnController::class,'Userreturn'])->name('return.user');
Route::post('/confirm-return', [UserReturnController::class, 'return']);
//
//Users/UserReport
use App\Http\Controllers\User\UserReportController;
Route::get('users/Userreport', [UserReportController::class, 'Userreport'])->name('Userreport');
Route::post('/repair', [UserReportController::class, 'Report'])->name('repair.store');
//


// Route สำหรับแสดงแบบฟอร์มขอรีเซ็ตรหัสผ่าน
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Route สำหรับส่งอีเมลรีเซ็ตรหัสผ่าน
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route สำหรับแสดงแบบฟอร์มรีเซ็ตรหัสผ่าน
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Route สำหรับรีเซ็ตรหัสผ่าน
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/scan-qrcode', [HomeController::class, 'showScanQRCode'])->name('scan.qrcode');

Route::post('/equipment/delete-multiple', [EquipmentController::class, 'deleteMultiple'])->name('equipment.deleteMultiple');

//repairController Admin
Route::get('/admin/Adminreportcheck/{id}/edit', [RepairController::class, 'Repaircheck'])->name('report.edit');
Route::put('/admin/Adminreportcheck/{id}', [RepairController::class, 'update'])->name('report.update');
Route::get('admin/function/Adminreport', [RepairController::class, 'confirmRepair'])->name('report.admin');

//HomeController
Route::put('/role/admin/{user_id}', [HomeController::class, 'roleadmin'])->name('role.admin');
Route::put('/role-admin/{user_id}', [HomeController::class, 'roleadmin'])->name('role.admin');

Route::get('admin/function/ManageRole',[HomeController::class,'roleuser'])->name('roleuser.admin');
//HistoryController admin.function.AdminReporHtistory
Route::get('admin/function/AdminReporHtistory',[HistoryController::class,'reporthistory'])->name('ReporHtistory.admin');
Route::get('admin/function/Adminborrowhistory',[HistoryController::class,'adminborrowhistory'])->name('borrowhistory.admin');
Route::get('admin/function/Adminreturnhistory',[HistoryController::class,'adminreturnhistory'])->name('retrunhistory.admin');
//userprofile


// เส้นทางสำหรับแสดงฟอร์มแก้ไขโปรไฟล์
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

// เส้นทางสำหรับแสดงหน้าข้อมูลผู้ใช้
Route::get('/profile', [ProfileController::class, 'userprofile'])->name('profile.show');

// เส้นทางสำหรับแสดงฟอร์มแก้ไขโปรไฟล์
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// เส้นทางสำหรับอัปโหลดรูปภาพโปรไฟล์
Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');

// เส้นทางสำหรับอัปเดตข้อมูลผู้ใช้
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// เส้นทางสำหรับหน้า Home
Route::get('/home', function () {
    return view('users.Home'); // เปลี่ยนตามชื่อไฟล์ blade ของคุณ
})->name('home');
// เส้นทางสำหรับการแสดงหน้าโปรไฟล์ผู้ใช้
Route::get('users/Userprofile', [ProfileController::class, 'userprofile'])->name('profile.user');

// เส้นทางสำหรับการอัปโหลดภาพโปรไฟล์ (เพิ่มเส้นทางนี้)
Route::post('users/Userprofile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
Route::get('/profile', [ProfileController::class, 'userprofile'])->name('profile.user');
Route::get('users/home', [HomeController::class, 'showUserHome'])->name('users.home');



//returnBorrow
Route::get('/admin/Adminretrurncheck/{id}/edit', [ReturnController::class, 'edit'])->name('adminreturn.edit');
Route::put('/admin/Adminretrurncheck/{id}', [ReturnController::class, 'update'])->name('adminreturn.update');
Route::get('admin/function/Adminreturn',[ReturnController::class,'show'])->name('admin.return');

//adminreturn
Route::put('/confirm-adminreturn', [ReturnController::class, 'adminreturn']);
//Borrow
Route::get('admin/AdminEquipment02',[EquipmentController::class,'showborrow']);
Route::get('/admin/Adminborrowcheck/{id}/edit', [BorrowingController::class, 'edit'])->name('borrowings.edit');
Route::put('/admin/Adminborrowcheck/{id}', [BorrowingController::class, 'update'])->name('borrowings.update');
Route::get('admin/function/AdminBorrow', [BorrowingController::class, 'indexadmin'])->name('borrowings.admin');
Route::patch('admin/borrowings/{id}/update-status', [BorrowingController::class, 'updateStatus'])->name('admin.borrowings.updateStatus');


//Controlleradmin
Route::post('admin/addems', [Controlleradmin::class, 'store'])->name('add.store');
Route::get('admin/addems', [Controlleradmin::class, 'addview'])->name('add.view');
Route::get('/export', [EquipmentController::class, 'export'])->name('export.equipment');



// Route for home page or dashboard (after login)
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Example route for user home page after login
Route::get('/home', [HomeController::class, 'index'])->name('users.Home');

// Default route for landing page
Route::get('/', function () {
    return view('welcome');
});

//imEquipmentController
// routes/web.php
Route::post('/equipment/delete-multiple', [EquipmentController::class, 'deleteMultiple'])->name('equipment.deleteMultiple');

Route::get('/admin/function/Addmaster', [imEquipmentController::class, 'view'])->name('Addmaster.admin');
Route::get('admin/function/equipment', [EquipmentController::class, 'show'])->name('admin.equipment');
// Route::get('/equipment/function/AdminEquipmentedit/{equipment_id}/{user_id}', [imEquipmentController::class, 'edit'])->name('equipment.edit');

Route::get('equipment/{id}/edit', [imEquipmentController::class, 'edit'])->name('equipment.edit');
Route::put('equipment/{id}', [imEquipmentController::class, 'update'])->name('equipment.update');
Route::delete('equipment/{id}', [imEquipmentController::class, 'destroy'])->name('equipment.destroy');
Route::get('/equipment/create', [imEquipmentController::class, 'view'])->name('equipment.view');
Route::post('/Addmaster', [imEquipmentController::class, 'store'])->name('equipment.store');
Route::post('/upload', [imEquipmentController::class, 'import'])->name('equipment.import');
Route::get('formEquipment/Equipment', [EquipmentController::class, 'show'])->name('equipment.show');
// Route::get('importems', function () {
//     return view('/importems');
// })->name('import.ems');
Route::get('/admin/function/upload', function () {
    return view('admin/function/upload');
})->name('upload.index');
//
Route::get('admin/Equipment', function () {
    return view('admin/Equipment');
});
Route::get('/', function () {
    return view('auth/login');
})->name('auth/login');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::post('/check-duplicates', [imEquipmentController::class, 'checkDuplicates']);


// Route::get('/equipment_view', function(){
//     return view('Equipment');
// });

Route::get('admin/function/equipment', [EquipmentController::class, 'show'])->name('admin.equipment');








Route::get('/formEquiment/importEquiment', function () {
    return view('formEquiment/importEquiment');
});
//exportEquiment
Route::get('/formEquiment/exportEquiment', function () {
    return view('formEquiment/exportEquiment');
});

Route::fallback(function () {
    return '<h1>ไม่พบหน้าเว็บ</h1>';

});




Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('layouts/iframe');
Route::get('users/BR', [App\Http\Controllers\HomeController::class, 'BR'])->name('BR.user');
Route::get('users/borrow', [App\Http\Controllers\HomeController::class, 'borrow'])->name('users/borrow');
Route::get('admin/home', [Homecontroller::class, 'adminHome'])->name('admin.home')->Middleware('is_admin');

// routes/web.php

use App\Http\Controllers\Auth\RegisterController;


// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


//routes for Admin
use App\Http\Controllers\Auth\LoginController ;


Route::get('/login', [LoginController::class, 'index'])->name('index.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.login');


Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//profileController
Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');

Route::get('/profile/image', [ProfileController::class, 'showImage'])->name('profile.image');

Route::get(
    'admin/editProfile',[ProfileController::class,'adminprofile'])->name('edit.Profile');

Route::get('/userdashboard', function () {
    return view('users.Userdashboard');
});

Route::get('/Userequipment.', function () {
    return view('users.Userequipment');
})->name('users.Userequipment');
Route::get('users/Home', function () {
    return view('users/Home');
})->name('users/Home');
Route::get('/login', function () {
    return view('auth/login');
})->name('admin/login');
Route::get('/auth/email', function () {
    return view('auth.passwords.email');
})->name('auth.email');

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/user-must-be-authed', 'AuthenticatedUserController@index');
});
// Route::get('go', function () {
//     return view('users/go');
// })->middleware('auth');
// Route::get('users/go', function () {
//     return view('users/go');
// })->name('users/go');

// rout for qr-code
// routes/web.php
// Route::get('/equipment/{id}/qr-code', [EquipmentController::class, 'generateQRCode']);

// Route::get('/test-qr-code', function () {
//     try {
//         $qrCode = QrCode::encoding('UTF-8')->size(200)->generate('Test QR Code');
//         return response()->json(['qr_code' => $qrCode]);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Failed to generate QR code. ' . $e->getMessage()], 500);
//     }
// });
// Route::get('/qr-test', function () {
//     return view('qr-test'); // สร้าง view 'qr-test.blade.php' เพื่อทดสอบ
// });


// rout qr-code
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Equipment;

Route::get('/equipment/{id}', function ($id) {
    $equipment = Equipment::findOrFail($id);
    return view('ShowData', compact('equipment'));
})->name('ShowData');

// Route สำหรับการสร้าง QR Code
Route::get('/equipment/{id}/qrcode', function ($id) {
    $equipment = Equipment::findOrFail($id);
    
    // สร้าง QR Code ที่เมื่อสแกนแล้วจะนำผู้ใช้ไปยังหน้ารายละเอียดอุปกรณ์
    $url = route('ShowData', ['id' => $id]);
    $qrcode = QrCode::size(200)->generate($url);
    
    return view('qrcode', compact('qrcode', 'equipment'));
});

Route::get('/equipment/{id}/download-qrcode', function ($id) {
    $equipment = Equipment::findOrFail($id);
    
    // สร้าง QR Code ในรูปแบบ PNG
    $qrcode = QrCode::format('png')->size(200)->generate(route('ShowData', ['id' => $id]));
    
    // ส่ง QR Code ให้ดาวน์โหลด
    return response($qrcode, 200)
    ->header('Content-Type', 'image/png')
    ->header('Content-Disposition', 'attachment; filename="qrcode-equipment-' . $id . '.png"');
})->name('equipment.download-qrcode');

// rout qr-code


// showQuantity



