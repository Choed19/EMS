<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\equipment;
use Illuminate\Support\Facades\DB;
class UserEquipmentController extends Controller
{
    public function showUser(Request $request)
    {
        $equipments = DB::table('equipment')->get();

        // return response()->json(['data' => $equipments], 200);
        return view('users/Userequipment', ['equipments' => $equipments]);

    }
    

}