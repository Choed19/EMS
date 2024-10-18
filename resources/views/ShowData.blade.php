<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('showqrcode.css') }}">
    <title>{{ $equipment->name }}ข้อมูลอุปกรณ์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center
        }

        .container {
            margin-top:30px; 
            max-width: 500px;
            
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        
        }

        .header {
            color: white;
            background: #39f8af;
            text-align: center;
            border-radius: 10px 10px 0 0;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .data {
            /* text-align: center; */
            padding: 20px;
            font-size: 18px;
            line-height: 1.6;
            color: #333;
        }

        /* .data p {
            margin: 10px 0;
        } */

        .data span {
            font-weight: bold;
            color: #080808;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #39f8af;
            border-radius: 0 0 10px 10px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ $equipment->equipment_name }}</h1>
        </div>
        <div class="data">
            <p><span>ปี:</span> {{ $equipment->year }}</p>
            <p><span>ประเภท:</span> {{ $equipment->equipment_group }}</p>
            <p><span>หมายเลข:</span> {{ $equipment->serial_no }}</p>
            <p><span>ราคา:</span> {{ $equipment->cost }}</p>
            <p><span>วันที่ซื้อ:</span> {{ $equipment->buy_date }}</p>
            <p><span>แผนก:</span> {{ $equipment->department_name }}</p>
            <p><span>อาคาร:</span> {{ $equipment->building_no }}</p>
            <p><span>ห้อง:</span> {{ $equipment->room_no }}</p>
            <p><span>สถานะ:</span> {{ $equipment->status }}</p>
        </div>
        <div class="footer">
            © 2024 Equipment Management System
        </div>
    </div>
</body>

</html>
