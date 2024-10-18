@extends('layouts.Adminapp')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/admin/Addmaster.css') }}">
        <title>Item Entry Form</title>

    </head>

    <body>
        <div class="row">
            <div class="col-lg-4" id="container">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">เพิ่มข้อมูลอุปกรณ์ ขั้นสูง</h1>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <form action="{{ route('equipment.store') }}" method="post">
                            @csrf
                            <div class="box">
                                <div class="input-box">

                                    <label for="year">ปี</label>
                                    <input type="text" name="year" required>

                                    <label for="equipment_group">ประเภทอุปกรณ์</label>
                                    <input list="equipment_group" name="equipment_group" required>
                                    <datalist id="equipment_group">
                                        <option value="FA08">
                                        <option value="FA17">
                                        <option value="FA18">
                                        <option value="FA19">
                                        <option value="FD05">
                                        <option value="FN07">
                                        <option value="FN14">
                                        <option value="FN18">
                                        <option value="FN19">
                                    </datalist>

                                    <label for="serial_no">หมายเลขอุปกรณ์</label>
                                    <input type="text" name="serial_no">

                                    <label for="equipment_name">ชื่ออุปกรณ์</label>
                                    <input type="text" name="equipment_name" required>

                                    <label for="cost">ราคา</label>
                                    <input type="number" name="cost" required>

                                    <label for="buy_date">วันที่ซื้อ</label>
                                    <input type="date" name="buy_date" required>
                                </div>

                                <div class="input-box">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input list="department_name" name="department_name" required>
                                    <datalist id="department_name">
                                        <option value="EE">
                                    </datalist>

                                    <label for="building_no">อาคาร</label>
                                    <input list="building_no" name="building_no" required>
                                    <datalist id="building_no">
                                        <option value="7">
                                    </datalist>

                                    <label for="room_no">ห้อง</label>
                                    <input list="room_no" name="room_no" required>
                                    <datalist id="room_no">
                                        <option value="222">
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


                                    <label for="status">สถานะอุปกรณ์</label>
                                    <input list="status_list" name="status" required>
                                    <datalist id="status_list">
                                        <option value="พบ">
                                    </datalist>
                                    
                                </div>
                            </div>

                            <div class="bt">
                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
