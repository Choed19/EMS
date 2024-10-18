@extends('layouts.Adminapp')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Item Entry Form</title>
        <style>
            body,
            html {
                margin: 0;
                padding: 0;
                overflow: auto;
                height: 100%;
            }

            body {
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                /* background: url('img/NatureGIF.gif') no-repeat center center; */
                background-size: cover;
            }

            .card {
                margin-top: 50px;
            }

            form {
                max-width: 600px;
                margin: auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input,
            select,
            textarea {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            button {
                width: 100%;
                padding: 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            button:hover {
                background-color: #45a049;
            }
        </style>
    </head>

    <body>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4">
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
                        <form method="post" action="{{ route('equipment.store') }}">
                            @csrf

                            <label for="GroupofEquipment">Group of Equipment:</label>
                            <input list="GroupofEquipmentList" name="GroupofEquipment" required>

                            <datalist id="GroupofEquipmentList">
                                <option value="FA04">
                                <option value="FA05">
                                <option value="FA06">
                                <option value="FA07">
                                <option value="FA08">
                                <option value="FA09">
                                <option value="FA12">
                                <option value="FA13">
                                <option value="FA14">
                                <option value="FA17">
                                <option value="FA18">
                                <option value="FA19">
                                <option value="FA20">
                                <option value="FA21">
                                <option value="FA32">
                                <option value="FD05">
                                <option value="FD07">
                                <option value="FD08">
                                <option value="FD18">
                                <option value="FN05">
                                <option value="FN07">
                                <option value="FN08">
                                <option value="FN09">
                                <option value="FN12">
                                <option value="FN14">
                                <option value="FN17">
                                <option value="FN18">
                                <option value="FN19">
                                <option value="FN20">
                                <option value="FP07">
                                <option value="FP18">
                            </datalist>

                            <label for="SerialNo">Serial No:</label>
                            <input type="text" name="SerialNo" required>

                            <label for="NameEquipment">Name Equipment:</label>
                            <input type="text" name="NameEquipment" required>

                            <label for="cost">Cost:</label>
                            <input type="number" name="cost" required>

                            <label for="location">location:</label>
                            <input list="location" name="location" required>

                            <datalist id="location">
                                <option value="22-302">22-302</option>
                                <option value="22-304">22-304</option>
                                <option value="22-305/1">22-305/1</option>
                                <option value="22-305/2">22-305/2</option>
                                <option value="22-305/3">22-305/3</option>
                                <option value="22-306,22-305/1,22-305/2">22-306,22-305/1,22-305/2</option>
                                <option value="22-306/1">22-306/1</option>
                                <option value="22-306/2">22-306/2</option>
                                <option value="กรรณิการ์">กรรณิการ์</option>
                                <option value="ก้องรัฐ">ก้องรัฐ</option>
                                <option value="กิติโชค">กิติโชค</option>
                                <option value="กิติพง">กิติพง</option>
                                <option value="เกศรินทร์">เกศรินทร์</option>
                                <option value="คณะ วว">คณะ วว</option>
                                <option value="คณะ วว.ภาควิชาไฟฟ้า">คณะ วว.ภาควิชาไฟฟ้า</option>
                                <option value="คณะ วว.ภาควิทยาการคอมพิวเตอร์และสารสนเทศ">
                                    คณะวว.ภาควิทยาการคอมพิวเตอร์และสารสนเทศ</option>
                                <option value="คณะ วว.สาขาโยธา">คณะ วว.สาขาโยธา</option>
                                <option value="คณะวิทยาศาสตร์และวิศวกรรมศาสตร์">คณะวิทยาศาสตร์และวิศวกรรมศาสตร์</option>
                                <option value="คณะสาธารณสุข">คณะสาธารณสุข</option>
                                <option value="คณะสาธารณสุขศาสตร์">คณะสาธารณสุขศาสตร์</option>
                                <option value="ครรชิต">ครรชิต</option>
                                <option value="จักรินทร์">จักรินทร์</option>
                                <option value="จามร">จามร</option>
                                <option value="จามุณี">จามุณี</option>
                                <option value="จิตรสราญ">จิตรสราญ</option>
                                <option value="จุริรัตน์">จุริรัตน์</option>
                                <option value="ชัชวาล">ชัชวาล</option>
                                <option value="ชิวารัตน์">ชิวารัตน์</option>
                                <option value="ฐาปนี">ฐาปนี</option>
                                <option value="ฐิตาภรณ์">ฐิตาภรณ์</option>
                                <option value="ถธกร">ถธกร</option>
                                <option value="ณัฐธืกา">ณัฐธืกา</option>
                                <option value="ต่อศักดิ์">ต่อศักดิ์</option>
                                <option value="ทวัตชัย">ทวัตชัย</option>
                                <option value="ทวี">ทวี</option>
                                <option value="ทัศวรรณ">ทัศวรรณ</option>
                                <option value="ธนวัตน์">ธนวัตน์</option>
                                <option value="ธวัชชัย">ธวัชชัย</option>
                                <option value="นนัทกาญจน์">นนัทกาญจน์</option>
                                <option value="นภาพร">นภาพร</option>
                                <option value="นารีรัตน์">นารีรัตน์</option>
                                <option value="ปฎิภาณ">ปฎิภาณ</option>
                                <option value="ประครอง">ประครอง</option>
                                <option value="ประภากรณ์">ประภากรณ์</option>
                                <option value="ประยุทธ">ประยุทธ</option>
                                <option value="ฝ่ายรับเข้าศึกษา">ฝ่ายรับเข้าศึกษา</option>
                                <option value="ฝ่ายสื่อสารองค์กรและเทคโนโลยีดิจิทัล">ฝ่ายสื่อสารองค์กรและเทคโนโลยีดิจิทัล
                                </option>
                                <option value="ฝ่ายสื่อสารองค์กรและเทคโนโลยีดิจิทัล(นายธนกฤต)">
                                    ฝ่ายสื่อสารองค์กรและเทคโนโลยีดิจิทัล(นายธนกฤต)</option>
                                <option value="พิลาสินี">พิลาสินี</option>
                                <option value="พิระ">พิระ</option>
                                <option value="เพ็ญศิริ">เพ็ญศิริ</option>
                                <option value="ภัทราวดี">ภัทราวดี</option>
                                <option value="ภาควิชาวิทยา">ภาควิชาวิทยา</option>
                                <option value="ภาควิชาวิทยาศาสตร์">ภาควิชาวิทยาศาสตร์</option>
                                <option value="ภาควิชาวิทยาศาสตร์ทั่วไป">ภาควิชาวิทยาศาสตร์ทั่วไป</option>
                                <option value="ภาควิชาวิทยาศาสตร์ทั่วไปคณะวิทยาศาสตร์และวิศวกรรมศาสตร์">
                                    ภาควิชาวิทยาศาสตร์ทั่วไปคณะวิทยาศาสตร์และวิศวกรรมศาสตร์</option>
                                <option value="ภาควิชาวิทยาศาสตร์ทั่วไปสาขาฟิสิกส์อาคาร6 ห้อง101">
                                    ภาควิชาวิทยาศาสตร์ทั่วไปสาขาฟิสิกส์อาคาร6 ห้อง101</option>
                                <option value="ถาควิชาวิศวกรรมเครื่องกลและการผลิต">ถาควิชาวิศวกรรมเครื่องกลและการผลิต
                                </option>
                                <option value="ภาควิชาวิศวกรรมไฟฟ้าและคอมพิวเตอร์">ภาควิชาวิศวกรรมไฟฟ้าและคอมพิวเตอร์
                                </option>
                                <option value="ภาควิชาวิศกรรมโยธาและสิงแวดล้อม">ภาควิชาวิศกรรมโยธาและสิงแวดล้อม</option>
                                <option value="รัฐษากรณ์">รัฐษากรณ์</option>
                                <option value="รุ่งทวี">รุ่งทวี</option>
                                <option value="รุ่งนภา">รุ่งนภา</option>
                                <option value="โรงปูน">โรงปูน</option>
                                <option value="แลบโยธา อาคาร7 ชั้น1">แลบโยธา อาคาร7 ชั้น1</option>
                                <option value="วนันยา">วนันยา</option>
                                <option value="วรรณภา">วรรณภา</option>
                                <option value="วว.ภาคไอที">วว.ภาคไอที</option>
                                <option value="วัจน์วงค์">วัจน์วงค์</option>
                                <option value="วิรัช">วิรัช</option>
                                <option value="ศมณพร">ศมณพร</option>
                                <option value="ศราวุทธ">ศราวุทธ</option>
                                <option value="ศราวุธ">ศราวุธ</option>
                                <option value="ศิริพร">ศิริพร</option>
                                <option value="ศุภนิดา">ศุภนิดา</option>
                                <option value="ศุภลักษณ์">ศุภลักษณ์</option>
                                <option value="ศุษมา">ศุษมา</option>
                                <option value="เศษฐกร">เศษฐกร</option>
                                <option value="สมควร">สมควร</option>
                                <option value="ส่วนกลางคณะ วว.">ส่วนกลางคณะ วว.</option>
                                <option value="ส่วนกลางคณะวิทยาศาสตร์และวิศวกรรมศาสตร์">
                                    ส่วนกลางคณะวิทยาศาสตร์และวิศวกรรมศาสตร์</option>
                                <option value="สังคม">สังคม</option>
                                <option value="สันติ">สันติ</option>
                                <option value="สายฝน">สายฝน</option>
                                <option value="สาวิณี">สาวิณี</option>
                                <option value="สำนักงานธุรการ">สำนักงานธุรการ</option>
                                <option value="สิทธิชัย">สิทธิชัย</option>
                                <option value="สิริปรางค์">สิริปรางค์</option>
                                <option value="สุดารัตน์">สุดารัตน์</option>
                                <option value="สุนทร">สุนทร</option>
                                <option value="สุภาพ">สุภาพ</option>
                                <option value="สุรเชษฐ์">สุรเชษฐ์</option>
                                <option value="หน้าห้องพักอาจารย์">หน้าห้องพักอาจารย์</option>
                                <option value="ห้อง Common">ห้อง Common</option>
                                <option value="ห้อง LAB 1 อาคารปฎิบัติการและวิจัยด้านวิทยาศาสตร์">ห้อง LAB 1
                                    อาคารปฎิบัติการและวิจัยด้านวิทยาศาสตร์</option>
                                <option value="ห้องเก็บของ อาคาร 7 ชั้น 1">ห้องเก็บของ อาคาร 7 ชั้น 1</option>
                                <option value="ห้องเก็บของชั้น 1 อาคาร 10">ห้องเก็บของชั้น 1 อาคาร 10</option>
                                <option value="ห้องเก็บของชั้น 1 อาคาร 11">ห้องเก็บของชั้น 1 อาคาร 11</option>
                                <option value="ห้องเก็บของชั้น 1 อาคาร 12">ห้องเก็บของชั้น 1 อาคาร 12</option>
                                <option value="ห้องเก็บของชั้น 1 อาคาร 7">ห้องเก็บของชั้น 1 อาคาร 7</option>
                                <option value="ห้องเก็บของชั้น 1 อาคาร 8">ห้องเก็บของชั้น 1 อาคาร 8</option>
                                <option value="ห้องเก็บของชั้น 1 อาคาร 9">ห้องเก็บของชั้น 1 อาคาร 9</option>
                                <option value="ห้องเก็บของชั้นดาดฟ้า">ห้องเก็บของชั้นดาดฟ้า</option>
                                <option value="ห้องคณบดี">ห้องคณบดี</option>
                                <option value="ห้องธุรการ">ห้องธุรการ</option>
                                <option value="ห้องธุรการ คณะ วว">ห้องธุรการ คณะ วว</option>
                                <option value="อ.นิติกรณ์ สศ.">อ.นิติกรณ์ สศ.</option>
                                <option value="อมลิน">อมลิน</option>
                                <option value="อรพรรณ">อรพรรณ</option>
                                <option value="อรัญ">อรัญ</option>
                                <option value="อัญชสา">อัญชสา</option>
                                <option value="อาคาร 6 ห้อง 101">อาคาร 6 ห้อง 101</option>
                                <option value="อาคาร 6 ห้อง 101/1">อาคาร 6 ห้อง 101/1</option>
                                <option value="อาคาร 6 ห้อง 201">อาคาร 6 ห้อง 201</option>
                                <option value="อาคาร 6 ห้อง 202">อาคาร 6 ห้อง 202</option>
                                <option value="อาคาร 22">อาคาร 22</option>
                                <option value="อาคาร 22 ชั้น 3">อาคาร 22 ชั้น 3</option>
                                <option value="อาคาร 22 ชั้น 302">อาคาร 22 ชั้น 302</option>
                                <option value="อาคาร 22 ห้อง 102">อาคาร 22 ห้อง 102</option>
                                <option value="อาคาร 22 ห้อง 102/1">อาคาร 22 ห้อง 102/1</option>
                                <option value="อาคาร 22 ห้อง 104">อาคาร 22 ห้อง 104</option>
                                <option value="อาคาร 22 ห้อง 108">อาคาร 22 ห้อง 108</option>
                                <option value="อาคาร 22 ห้อง 109">อาคาร 22 ห้อง 109</option>
                                <option value="อาคาร 22 ห้อง 201">อาคาร 22 ห้อง 201</option>
                                <option value="อาคาร 22 ห้อง 202">อาคาร 22 ห้อง 202</option>
                                <option value="อาคาร 22 ห้อง 205">อาคาร 22 ห้อง 205</option>
                                <option value="อาคาร 22 ห้อง 206">อาคาร 22 ห้อง 206</option>
                                <option value="อาคาร 22 ห้อง 301">อาคาร 22 ห้อง 301</option>
                                <option value="อาคาร 22 ห้อง LAB 1">อาคาร 22 ห้อง LAB 1</option>
                                <option-206 value="อาคาร 22-206/2">อาคาร 22-206/2</option-206>
                                <option value="อาคาร 5 ห้อง 112/016">อาคาร 5 ห้อง 112/016</option>
                                <option value="อาคาร 5 ห้อง 112/017">อาคาร 5 ห้อง 112/017</option>
                                <option value="อาคาร 5 ห้อง 112/020">อาคาร 5 ห้อง 112/020</option>
                                <option value="อาคาร 5 ห้อง 112/021">อาคาร 5 ห้อง 112/021</option>
                                <option value="อาคาร 5 ห้อง 112/022">อาคาร 5 ห้อง 112/022</option>
                                <option value="อาคาร 5 ห้อง 112/023">อาคาร 5 ห้อง 112/023</option>
                                <option value="อาคาร 5 ห้อง 112/024">อาคาร 5 ห้อง 112/024</option>
                                <option value="อาคาร 5 ห้อง 112/4">อาคาร 5 ห้อง 112/4</option>
                                <option value="อาคาร 6">อาคาร 6</option>
                                <option value="อาคาร 6 (ชั้น2)">"อาคาร 6 (ชั้น2)</option>
                                <option value="อาคาร 6 (ใต้บันได)">อาคาร 6 (ใต้บันได)</option>
                                <option value="อาคาร 6 ชั้น 1">อาคาร 6 ชั้น 1</option>
                                <option value="อาคาร 6 ชั้น 2">อาคาร 6 ชั้น 2</option>
                                <option value="อาคาร 6 ชั้น 201">อาคาร 6 ชั้น 201 </option>
                                <option value="อาคาร 6 ชั้น 202">อาคาร 6 ชั้น 202</option>
                                <option value="อาคาร 6 ห้อง 6-203">อาคาร 6 ห้อง 6-203</option>
                                <option value="อาคาร 6 ห้อง 101">อาคาร 6 ห้อง 101</option>
                                <option value="อาคาร 6 ห้อง 101/1">อาคาร 6 ห้อง 101/1</option>
                                <option value="อาคาร 6 ห้อง 102/1">อาคาร 6 ห้อง 102/1</option>
                                <option value="อาคาร 6 ห้อง 105">อาคาร 6 ห้อง 105</option>
                                <option value="อาคาร 6 ห้อง 201">อาคาร 6 ห้อง 201</option>
                                <option value="อาคาร 6 ห้อง 201/1">อาคาร 6 ห้อง 201/1</option>
                                <option value="อาคาร 6 ห้อง 202">อาคาร 6 ห้อง 202</option>
                                <option value="อาคาร 6 ห้อง 202/1">อาคาร 6 ห้อง 202/1</option>
                                <option value="อาคาร 6 ห้อง 203">อาคาร 6 ห้อง 203</option>
                                <option value="อาคาร 6 ห้อง 203/1">อาคาร 6 ห้อง 203/1</option>
                                <option value="อาคาร 6 ห้อง 204">อาคาร 6 ห้อง 204</option>
                                <option value="อาคาร 6 ห้อง 222/4">อาคาร 6 ห้อง 222/4</option>
                                <option value="อาคาร 7 ห้อง 114/1">อาคาร 7 ห้อง 114/1</option>
                                <option value="อาคาร 7 ชั้น 1">อาคาร 7 ชั้น 1</option>
                                <option value="อาคาร 7 ชั้น 1 แลบโยธา">อาคาร 7 ชั้น 1 แลบโยธา</option>
                                <option value="อาคาร 7 ห้อง 114/4">อาคาร 7 ห้อง 114/4</option>
                                <option value="อาคาร 7 ห้อง 112">อาคาร 7 ห้อง 112</option>
                                <option value="อาคาร 7 ห้อง 112/1">อาคาร 7 ห้อง 112/1</option>
                                <option value="อาคาร 7 ห้อง 112/10">อาคาร 7 ห้อง 112/10</option>
                                <option value="อาคาร 7 ห้อง 112/4">อาคาร 7 ห้อง 112/4</option>
                                <option value="อาคาร 7 ห้อง 112/5">อาคาร 7 ห้อง 112/5</option>
                                <option value="อาคาร 7 ห้อง 112/7">อาคาร 7 ห้อง 112/7</option>
                                <option value="อาคาร 7 ห้อง 112/9">อาคาร 7 ห้อง 112/9</option>
                                <option value="อาคาร 7 ห้อง 114">อาคาร 7 ห้อง 114</option>
                                <option value="อาคาร 7 ห้อง 114/1">อาคาร 7 ห้อง 114/1</option>
                                <option value="อาคาร 7 ห้อง 114/2">อาคาร 7 ห้อง 114/2</option>
                                <option value="อาคาร 7 ห้อง 114/24">อาคาร 7 ห้อง 114/24</option>
                                <option value="อาคาร 7 ห้อง 114/3">อาคาร 7 ห้อง 114/3</option>
                                <option value="อาคาร 7 ห้อง 114/4">อาคาร 7 ห้อง 114/4</option>
                                <option value="อาคาร 7 ห้อง 218 ห้องคณบดี">อาคาร 7 ห้อง 218 ห้องคณบดี</option>
                                <option value="อาคาร 7 ห้อง 219 สุทธิเดช">อาคาร 7 ห้อง 219 สุทธิเดช</option>
                                <option value="อาคาร 7 ห้อง 220">อาคาร 7 ห้อง 220</option>
                                <option value="อาคาร 7 ห้อง 221">อาคาร 7 ห้อง 221</option>
                                <option value="อาคาร 7 ห้อง 222">อาคาร 7 ห้อง 222</option>
                                <option value="อาคาร 7 ห้อง 222/5">อาคาร 7 ห้อง 222/5</option>
                                <option value="อาคาร 7 ห้อง 223">อาคาร 7 ห้อง 223</option>
                                <option value="อาคาร 7 ห้อง 224">อาคาร 7 ห้อง 224</option>
                                <option value="อาคาร 7 ห้อง 225">อาคาร 7 ห้อง 225</option>
                                <option value="อาคาร 7 ห้อง 226">อาคาร 7 ห้อง 226</option>
                                <option value="อาคาร 7 ห้อง 227">อาคาร 7 ห้อง 227</option>
                                <option value="อาคาร 7 ห้อง 228">อาคาร 7 ห้อง 228</option>
                                <option value="อาคาร 7 ห้อง 229">อาคาร 7 ห้อง 229</option>
                                <option value="อาคาร 7 ห้อง 772/4">อาคาร 7 ห้อง 772/4</option>
                                <option value="อาคาร 7 ห้อง 801/6">อาคาร 7 ห้อง 801/6</option>
                                <option value="อาคาร 7 ห้อง 802/4">อาคาร 7 ห้อง 802/4</option>
                                <option value="อาคาร 7 ห้องเก็บของชั้น 1">อาคาร 7 ห้องเก็บของชั้น 1</option>
                                <option value="อาคาร 8 ห้อง 112">อาคาร 8 ห้อง 112</option>
                                <option value="อาคาร 8 ห้อง 112/001">อาคาร 8 ห้อง 112/001</option>
                                <option value="อาคาร 8 ห้อง 112/002">อาคาร 8 ห้อง 112/002</option>
                                <option value="อาคาร 8 ห้อง 112/003">อาคาร 8 ห้อง 112/003</option>
                                <option value="อาคาร 8 ห้อง 112/004">อาคาร 8 ห้อง 112/004</option>
                                <option value="อาคาร 8 ห้อง 112/005">อาคาร 8 ห้อง 112/005</option>
                                <option value="อาคาร 8 ห้อง 112/006">อาคาร 8 ห้อง 112/006</option>
                                <option value="อาคาร 8 ห้อง 112/007">อาคาร 8 ห้อง 112/007</option>
                                <option value="อาคาร 8 ห้อง 112/008">อาคาร 8 ห้อง 112/008</option>
                                <option value="อาคาร 8 ห้อง 112/009">อาคาร 8 ห้อง 112/009</option>
                                <option value="อาคาร 8 ห้อง 112/010">อาคาร 8 ห้อง 112/010</option>
                                <option value="อาคาร 8 ห้อง 112/011">อาคาร 8 ห้อง 112/011</option>
                                <option value="อาคาร 8 ห้อง 112/012">อาคาร 8 ห้อง 112/012</option>
                                <option value="อาคาร 8 ห้อง 112/013">อาคาร 8 ห้อง 112/013</option>
                                <option value="อาคาร 8 ห้อง 112/014">อาคาร 8 ห้อง 112/014</option>
                                <option value="อาคาร 8 ห้อง 112/4">อาคาร 8 ห้อง 112/4</option>
                                <option value="อาคาร 8 ห้อง 112/5">อาคาร 8 ห้อง 112/5</option>
                                <option value="อาคาร 8 ห้อง 222/5">อาคาร 8 ห้อง 222/5</option>
                                <option value="อาคาร 8/1">อาคาร 8/1</option>
                                <option value="อาคาร 8/1 ห้อง 10">อาคาร 8/1 ห้อง 10</option>
                                <option value="อาคาร 8/1 ห้อง 107">อาคาร 8/1 ห้อง 107</option>
                                <option value="อาคาร 8/1 ห้อง 108">อาคาร 8/1 ห้อง 108</option>
                                <option value="อาคาร 8/1-103">อาคาร 8/1-103</option>
                                <option value="อาคาร 8/1-104">อาคาร 8/1-104</option>
                                <option value="อาคาร 8/1-107">อาคาร 8/1-107</option>
                                <option value="อาคาร 8/1-108">อาคาร 8/1-108</option>
                                <option value="อาคาร 9 ห้อง 112">อาคาร 9 ห้อง 112</option>
                                <option value="อาคาร 9 ห้อง 112/001">อาคาร 9 ห้อง 112/001</option>
                                <option value="อาคาร 9 ห้อง 112/002">อาคาร 9 ห้อง 112/002</option>
                                <option value="อาคาร 9 ห้อง 112/003">อาคาร 9 ห้อง 112/003</option>
                                <option value="อาคาร 9 ห้อง 112/004">อาคาร 9 ห้อง 112/004</option>
                                <option value="อาคาร 9 ห้อง 112/005">อาคาร 9 ห้อง 112/005</option>
                                <option value="อาคาร 9 ห้อง 112/006">อาคาร 9 ห้อง 112/006</option>
                                <option value="อาคาร 9 ห้อง 112/5">อาคาร 9 ห้อง 112/5</option>
                                <option value="อาคาร 9 ห้อง 145/6">อาคาร 9 ห้อง 145/6</option>
                                <option value="อาคาร 9 ห้อง 208">อาคาร 9 ห้อง 208</option>
                                <option value="อาคาร 9 ห้อง 222/002">อาคาร 9 ห้อง 222/002</option>
                                <option value="อาคาร 9 ห้อง 222/003">อาคาร 9 ห้อง 222/003</option>
                                <option value="อาคาร 9 ห้อง 222/004">อาคาร 9 ห้อง 222/004</option>
                                <option value="อาคาร 9 ห้อง 222/005">อาคาร 9 ห้อง 222/005</option>
                                <option value="อาคาร 9 ห้อง 222/006">อาคาร 9 ห้อง 222/006</option>
                                <option value="อาคาร 9 ห้อง 222/007">อาคาร 9 ห้อง 222/007</option>
                                <option value="อาคาร 9 ห้อง 301/6">อาคาร 9 ห้อง 301/6</option>
                                <option value="อาคาร 9 ห้อง 302/6">อาคาร 9 ห้อง 302/6</option>
                                <option value="อาคาร 9 ห้อง 332/001">อาคาร 9 ห้อง 332/001</option>
                                <option value="อาคาร 9 ห้อง 332/002">อาคาร 9 ห้อง 332/002</option>
                                <option value="อาคาร 9 ห้อง 332/4">อาคาร 9 ห้อง 332/4</option>
                                <option value="อาคาร 9 ห้อง 442/4">อาคาร 9 ห้อง 442/4</option>
                                <option value="อาคาร 9 ห้อง 445/6">อาคาร 9 ห้อง 445/6</option>
                                <option value="อาคาร 6 ห้อง 201">อาคาร 6 ห้อง 201</option>
                                <option value="อาคาร 6 ห้อง 202">อาคาร 6 ห้อง 202</option>
                                <option value="อาคาร 6 ห้อง 202/1">อาคาร 6 ห้อง 202/1</option>
                                <option value="อาคาร 7 ห้อง 415">อาคาร 7 ห้อง 415</option>
                            </datalist>

                            <label for="StartingDate">Starting Date:</label>
                            <input type="date" name="StartingDate" required>

                            <label for="Status">Status:</label>
                            <input list="Status" name="Status" required>
                            <datalist id="Status">

                                <option value="ใช้งานปัจจุบัน">ใช้งานปัจจุบัน</option>
                                <option value="ชำรุจ">ชำรุจ</option>
                                <option value="ตัดจำหน่าย">ตัดจำหน่าย</option>
                                <option value="ยกเลิก">ยกเลิก</option>
                                <option value="ขาย">ขาย</option>
                            </datalist>
                            <label for="Company">Company:</label>
                            <input list="Company" name="Company" required>
                            <datalist id="Company">
                                <option value="เจเอ เมดิคอล">เจเอ เมดิคอล</option>
                                <option
                                    value="เจ้าหนี้บุคคลภายนอก(เบิกชดเชย) คณะศิลปศาสตร์และวิทยาการจัดการ วิทยาเขตเฉลิมพระเกียรติ จังหวัดสกลนคร">
                                    เจ้าหนี้บุคคลภายนอก(เบิกชดเชย) คณะศิลปศาสตร์และวิทยาการจัดการ
                                    วิทยาเขตเฉลิมพระเกียรติ
                                    จังหวัดสกลนคร</option>
                                <option value="โนอาห์ เน็ตเวิร์ค">โนอาห์ เน็ตเวิร์ค</option>
                                <option value="บริษัท  รีซเวฟ คอมมูนิเคชั่น จำกัด">บริษัท รีซเวฟ คอมมูนิเคชั่น จำกัด
                                </option>
                                <option value="บริษัท คิงส์เฟอร์นิเจอร์ซิตี้ จำกัด">บริษัท คิงส์เฟอร์นิเจอร์ซิตี้ จำกัด
                                </option>
                                <option value="บริษัท แกมมาโก้(ประเทศไทย) จำกัด">บริษัท แกมมาโก้(ประเทศไทย) จำกัด
                                </option>
                                <option value="บริษัท เค.เอ็น.บี.เทคนโลยี จำกัด">บริษัท เค.เอ็น.บี.เทคนโลยี จำกัด
                                </option>
                                <option value="บริษัท เคเอ็นบี เอ็นจิเนีย จำกัด">บริษัท เคเอ็นบี เอ็นจิเนีย จำกัด
                                </option>
                                <option value="บริษัท ไคเนติดส์ คอร์ปอเรชั่น จำกัด">ริษัท ไคเนติดส์ คอร์ปอเรชั่น จำกัด
                                </option>
                                <option value="บริษัท เจอแรงการ์ เซอร์วิส(ไทยแลนด์) จำกัด">บริษัท เจอแรงการ์
                                    เซอร์วิส(ไทยแลนด์) จำกัด
                                </option>
                                <option value="บริษัท ชัชรีย์ โฮลดิ้ง จำกัด">บริษัท ชัชรีย์ โฮลดิ้ง จำกัด
                                </option>
                                <option value="บริษัท ซอยล์เทสติ้งสยาม จำกัด">บริษัท ซอยล์เทสติ้งสยาม จำกัด
                                </option>
                                <option value="บริษัท ซีวิล เซอร์วิส เวิร์ค เอ็นจิเนียริ่ง จำกัด">บริษัท ซีวิล เซอร์วิส
                                    เวิร์ค เอ็นจิเนียริ่ง จำกัด"</option>
                                <option value="บริษัท เซฟดีไซน์ คอนสตรัคชั่น แอนด์ เอ็นจิเนียริ่ง จำกัด">บริษัท
                                    เซฟดีไซน์
                                    คอนสตรัคชั่น แอนด์ เอ็นจิเนียริ่ง จำกัด
                                </option>
                                <option value="บริษัท ไซแอนติฟิค โปรโมชั่น จำกัด">บริษัท ไซแอนติฟิค โปรโมชั่น จำกัด
                                </option>
                                <option value="บริษัท ดิโอ อินโนเวชั่น จำกัด">บริษัท ดิโอ อินโนเวชั่น จำกัด
                                </option>
                                <option value="บริษัท เดโช เทค จำกัด">บริษัท เดโช เทค จำกัด
                                </option>
                                <option value="บริษัท เดอะไซเอนซ์ แอนด์ เอ็ดดูเคชั่นแนล จำกัด">บริษัท เดอะไซเอนซ์ แอนด์
                                    เอ็ดดูเคชั่นแนล จำกัด
                                </option>
                                <option value="บริษัท เดอะลีคเตอร์ ไฮเทค จำกัด">บริษัท เดอะลีคเตอร์ ไฮเทค จำกัด
                                </option>
                                <option value="บริษัท ทารา เทค อินเตอร์เนชั่นแนล จำกัด">บริษัท ทารา เทค
                                    อินเตอร์เนชั่นแนล
                                    จำกัด
                                </option>
                                <option value="บริษัท ที.พี.ที.เครื่องมือสำรวจ จำกัด">บริษัท ที.พี.ที.เครื่องมือสำรวจ
                                    จำกัด
                                </option>
                                <option value="บริษัท ทูพีเอ็น เอ็นจิเนียริ่ง จำกัด">บริษัท ทูพีเอ็น เอ็นจิเนียริ่ง
                                    จำกัด
                                </option>
                                <option value="บริษัท เทคโนโลยีอินฟราสครัคเจอร์ จำกัด">บริษัท เทคโนโลยีอินฟราสครัคเจอร์
                                    จำกัด
                                </option>
                                <option value="บริษัท โททอล เอ็จิเนียริ่ง(ไทยแลนด์) จำกัด">บริษัท โททอล
                                    เอ็จิเนียริ่ง(ไทยแลนด์) จำกัด
                                </option>
                                <option value="บริษัท โทโมนิค จำกัด">บริษัท โทโมนิค จำกัด
                                </option>
                                <option value="บริษัท ไทยวิกตอรี่ จำกัด">บริษัท ไทยวิกตอรี่ จำกัด
                                </option>
                                <option value="บริษัท นีโอ ไดแด็กติค จำกัด">บริษัท นีโอ ไดแด็กติค จำกัด
                                </option>
                                <option value="บริษัท นีโอ เอ็นเทค จำกัด">บริษัท นีโอ เอ็นเทค จำกัด
                                </option>
                                <option value="บริษัท บี.ดี.คอมพิสเตอรื จำกัด">บริษัท บี.ดี.คอมพิสเตอรื จำกัด
                                </option>
                                <option value="บริษัท เบคไทย กรุงเทพ อุปกรณ์เคมีภัรฑ์ จำกัด">บริษัท เบคไทย กรุงเทพ
                                    อุปกรณ์เคมีภัรฑ์ จำกัด
                                </option>
                                <option value="บริษัท เบสต์อินบิต จำกัด">บริษัท เบสต์อินบิต จำกัด
                                </option>
                                <option value="บริษัท พาราไซแอนติฟิค จำกัด">บริษัท พาราไซแอนติฟิค จำกัด
                                </option>
                                <option value="บริษัท เพอร์กินเอลเมอร์ จำกัด">บริษัท เพอร์กินเอลเมอร์ จำกัด
                                </option>
                                <option value="บริษัท ฟิลด์เทค ออโตเมชั่น จำกัด">บริษัท ฟิลด์เทค ออโตเมชั่น จำกัด
                                </option>
                                <option value="บริษัท ยูเนี่ยนซายน์เทรดติ้ง จำกัด">บริษัท ยูเนี่ยนซายน์เทรดติ้ง จำกั
                                </option>
                                <option value="บริษัท รัซมอร์ พรีซิชั่น จำกัด">บริษัท รัซมอร์ พรีซิชั่น จำกัด
                                </option>
                                <option value="บริษัท ลานนาคอม จำกัด">บริษัท ลานนาคอม จำกัด
                                </option>
                                <option value="บริษัท แล็บ ลีดเดอร์ จำกัด">บริษัท แล็บ ลีดเดอร์ จำกัด
                                </option>
                                <option value="บริษัท เวิลด์สยามกรุ๊ป จำกัด">บริษัท เวิลด์สยามกรุ๊ป จำกัด
                                </option>
                                <option value="บริษัท หริกุล ซายเอนซ์ จำกัด">บริษัท หริกุล ซายเอนซ์ จำกัด
                                </option>
                                <option value="บริษัท ออฟฟิเชียล อีควิปเม้นท์ แมนูแฟคเจอริ่ง จำกัด">บริษัท ออฟฟิเชียล
                                    อีควิปเม้นท์ แมนูแฟคเจอริ่ง จำกัด"
                                </option>
                                <option value="บริษัท เอ็น-สแควร์ เอ็นจิเนีย จำกัด">บริษัท เอ็น-สแควร์ เอ็นจิเนีย จำกัด
                                </option>
                                <option value="บริษัท เอ็น.ที.เค ไซเอนติฟิค จำกัด">บริษัท เอ็น.ที.เค ไซเอนติฟิค จำกัด
                                </option>
                                <option value="บริษัท เอ็นทค แอสโซซิเอท จำกัด">บริษัท เอ็นทค แอสโซซิเอท จำกัด
                                </option>
                                <option value="บริษัท เอ็นวายซายน์ จำกัด">บริษัท เอ็นวายซายน์ จำกัด
                                </option>
                                <option value="บริษัท เอพเพนดอร์ฟ(ประเทศไทย) จำกัด">บริษัท เอพเพนดอร์ฟ(ประเทศไทย) จำกัด
                                </option>
                                <option value="บริษัท เอ็ม ดี โปรซัพพลายส์ จำกัด">บริษัท เอ็ม ดี โปรซัพพลายส์ จำกัด
                                </option>
                                <option value="บริษัท เอ็มเอส เอเซีย เทคโนโลยี จำกัด">บริษัท เอ็มเอส เอเซีย เทคโนโลยี
                                    จำกัด
                                </option>
                                <option value="บริษัท เอสซีเค ซีสเต็มส์ จำกัด">บริษัท เอสซีเค ซีสเต็มส์ จำกัด
                                </option>
                                <option value="บริษัท แอ็กโซ เคมิคอลส์ แอนด์ เซอร์วิสเซส จำกัด">บริษัท แอ็กโซ เคมิคอลส์
                                    แอนด์ เซอร์วิสเซส จำกัด
                                </option>
                                <option value="บริษัท โอไอซีอี ออโตเมชั่น จำกัด">บริษัท โอไอซีอี ออโตเมชั่น จำกัด
                                </option>
                                <option value="บริษัท ไอที สมาร์ท จำกัด">บริษัท ไอที สมาร์ท จำกัด
                                </option>
                                <option value="บริษัท ฮอลลีวู้ด อินเตอร์เนชั่นแนล จำกัด">บริษัท ฮอลลีวู้ด
                                    อินเตอร์เนชั่นแนล
                                    จำกัด
                                </option>
                                <option value="บริษัท โฮมพลัส เฟอร์นิเจอร์มอล สกล จำกัด">บริษัท โฮมพลัส เฟอร์นิเจอร์มอล
                                    สกล
                                    จำกัด
                                </option>
                                <option value="ร้านขอนแก่นการไฟฟ้า">ร้านขอนแก่นการไฟฟ้า
                                </option>
                                <option value="ร้านทวีโลหะ">ร้านทวีโลหะ
                                </option>
                                <option value="ร้านพงเจริญการช่าง">ร้านพงเจริญการช่าง
                                </option>
                                <option value="ร้านมงคลคอมพิวเตอร์">ร้านมงคลคอมพิวเตอร์
                                </option>
                                <option value="ร้านสมบูรณ์อีเซอร์วิส">ร้านสมบูรณ์อีเซอร์วิส
                                </option>
                                <option value="สกลแอร์แอนด์เซอร์วิส">สกลแอร์แอนด์เซอร์วิส
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด ซี.บี.เอ็น.เอ็นจิเนียริ่ง">ห้างหุ้นส่วนจำกัด
                                    ซี.บี.เอ็น.เอ็นจิเนียริ่ง
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด ซูปเปร์เจ็ดไอที แอนด์ เน็ทเวิร์ค">ห้างหุ้นส่วนจำกัด
                                    ซูปเปร์เจ็ดไอที แอนด์ เน็ทเวิร์ค
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด ทรีดีอินโน เวชั่นแอนด์เทคโนโลยี">ห้างหุ้นส่วนจำกัด
                                    ทรีดีอินโน เวชั่นแอนด์เทคโนโลยี
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด ที.พี.ที.เครื่องมือสำรวจ">ห้างหุ้นส่วนจำกัด
                                    ที.พี.ที.เครื่องมือสำรวจ
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด บี จี แอ็ด เวอร์ไทซิ่ง">ห้างหุ้นส่วนจำกัด บี จี แอ็ด
                                    เวอร์ไทซิ่ง
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด พิทักษ์ โท เทิ่ล โซลูชั่น">ห้างหุ้นส่วนจำกัด พิทักษ์
                                    โท
                                    เทิ่ล โซลูชั่น
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด ภูพาน เทรดดิ้ง กรุ๊ป">ห้างหุ้นส่วนจำกัด ภูพาน เทรดดิ้ง
                                    กรุ๊ป
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด สกลรัตน์เทรดดิ้ง">ห้างหุ้นส่วนจำกัด สกลรัตน์เทรดดิ้ง
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด เอส.เอ็ม.ที.แมชชีนทูลเทคโนโลยี">ห้างหุ้นส่วนจำกัด
                                    เอส.เอ็ม.ที.แมชชีนทูลเทคโนโลยี
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด เอสไอเอ็ม โกบอล เอ็นจิเนียรี่ง">ห้างหุ้นส่วนจำกัด
                                    เอสไอเอ็ม โกบอล เอ็นจิเนียรี่ง
                                </option>
                                <option value="ห้างหุ้นส่วนจำกัด ไอ เค้น ไซ เอนทิฟิค">ห้างหุ้นส่วนจำกัด ไอ เค้น ไซ
                                    เอนทิฟิค
                                </option>
                            </datalist>

                            <div class="mb-3">
                                <div class="d-grid"><a href="/equipment">
                                        <button class="btn btn-primary">Submit</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
