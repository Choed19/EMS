<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Engineer/Engineerreportcheck.css') }}">
    <title>EngineerCheck</title>
</head>

<body>
    <div class="content">
        <div class="head">
            <h1>ข้อมูลรายการแจ้งซ่อมสำหลับช่าง</h1>
        </div>

        <form action="{{ route('Engineer.update', $reports->report_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">ชื่อผู้คืน :</label>
                <p>
                    {{ optional($reports->user)->fname ?? 'ไม่พบข้อมูล' }}
                    {{ optional($reports->user)->lname ?? 'ไม่พบข้อมูล' }}
                </p>
            </div>
            <div class="form-group">
                <label for="equipment_name">ปี :</label>
                <p>{{ $reports->equipment->year ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="equipment_group">ประเภทอุปกรณ์ :</label>
                <p>{{ $reports->equipment->equipment_group ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="equipment_name">ชื่ออุปกรณ์ :</label>
                <p>{{ $reports->equipment->equipment_name }}</p>
            </div>
            <div class="form-group">
                <label for="equipment_cost">ราคาอุปกรณ์ :</label>
                <p>{{ $reports->equipment->cost ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="serial_no">หมายเลขอุปกรณ์ :</label>
                <p>{{ $reports->equipment->serial_no }}</p>
            </div>
            <div class="form-group">
                <label for="department_name">ชื่อแผนก :</label>
                <p>{{ $reports->equipment->department_name ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="building_no">อาคาร :</label>
                <p>{{ $reports->equipment->building_no }}</p>
            </div>
            <div class="form-group">
                <label for="room_no">ห้อง :</label>
                <p>{{ $reports->equipment->room_no }}</p>
            </div>
            <div class="form-group">
                <label for="status">สถานะการยืม :</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="{{ $reports->status }}" selected>{{ $reports->status }}</option>
                    <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
                    <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                </select>
            </div>
            <button type="submit" class="Confirm">Confirm</button>
        </form>
        
    </div>
</body>
