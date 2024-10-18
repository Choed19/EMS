@extends('layouts.Adminapp')

@section('content')
    <!DOCTYPE html>
    <html lang="th">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Equipment</title>
        <link rel="stylesheet" href="{{ asset('css/admin/function/EquipmentEdit.css') }}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    </head>

    <body>
        <div class="container" id="container">
            <div id="card" class='card'>
                <h1 class="text">แก้ไขข้อมูลอุปกรณ์</h1>
                <form action="{{ route('equipment.update', $equipment->equipment_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="box-1">
                        <div class="group">
                            <div class="form-group">
                                <label for="year">ปี {{ $equipment->year }}</label>
                              
                            </div>
                            <div class="form-group">
                                <label for="equipment_group">ประเภทอุปกรณ์  {{ $equipment->equipment_group }}</label>
                            </div>
                            <div class="form-group">
                                <label for="serial_no">หมายเลขอุปกรณ์ {{ $equipment->serial_no }}</label>
                            </div>
                            <div class="form-group">
                                <label for="equipment_name">ชื่ออุปกรณ์ {{ $equipment->equipment_name }}</label>
                              
                            </div>
                            <div class="form-group">
                                <label for="cost">ราคา {{ $equipment->cost }} บาท </label>
                               
                            </div>
                            <div class="form-group">
                                <label for="buy_date">วันที่ซื้อ {{$equipment->buy_date}}</label>
                            </div>
                        </div>


                        <div class="group">
                            <div class="form-group">
                                <label for="department_name">ชื่อแผนก</label>
                                <input type="text" class="form-control" id="department_name" name="department_name"
                                    value="{{ $equipment->department_name }}" required>
                            </div>


                            <div class="form-group">
                                <label for="building_no">อาคาร</label>
                                <input type="text" class="form-control" id="building_no" name="building_no"
                                    value="{{ $equipment->building_no }}" required>
                            </div>
                            <div class="form-group">
                                <label for="room_no">ห้อง</label>
                                <input list="room_no_list" class="form-control" id="room_no" name="room_no" value="{{ $equipment->room_no }}" required>
                                <datalist id="room_no_list">
                                    <option value="223">
                                    <option value="224">
                                    <option value="225">
                                    <option value="226">
                                    <option value="227">
                                    <option value="228">
                                    <option value="229">
                                    <option value="221">
                                    <option value="222/5">
                                </datalist>
                            </div>
                            
                            <div class="form-group">
                                <label for="status">สถานะอุปกรณ์</label>
                                <input list="status_list" class="form-control" id="status" name="status" value="{{ $equipment->status }}" required>
                                <datalist id="status_list">
                                    <option value="พบ">
                                </datalist>
                            </div>                      
                        </div>
                    </div>
                    <div class="box-2">
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    </div>
                  
                </form>
            </div>
        </div>
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection
