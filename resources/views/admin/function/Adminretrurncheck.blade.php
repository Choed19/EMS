<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin/Adminretrurncheck.css') }}">
    <title>AdminCheckReturn</title>
</head>

<body>
    <div class="content">
        <div class="head">
            <h1>ข้อมูลการคืน</h1>
        </div>

        <form action="{{ route('adminreturn.update', $returnBorrowing->return_id ?? '') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_id">ชื่อผู้คืน :</label>
                <p>
                    {{ optional($returnBorrowing->user)->fname ?? 'ไม่พบข้อมูล' }}
                    {{ optional($returnBorrowing->user)->lname ?? 'ไม่พบข้อมูล' }}
                </p>
            </div>
            {{-- <div class="form-group">
                <label for="user_id">User Email :</label>
                <th>{{ $returnBorrowing->user->email ?? 'N/A' }}</th>
            </div> --}}
            <div class="form-group">
                <label for="equipment_name">ปี :</label>
                <p>{{ $returnBorrowing->equipment->year ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="equipment_group">ประเภทอุปกรณ์ :</label>
                <p>{{ $returnBorrowing->equipment->equipment_group ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="equipment_name">ชื่ออุปกรณ์ :</label>
                <p>{{ $returnBorrowing->equipment_name }}</p>
            </div>
            <div class="form-group">
                <label for="equipment_cost">ราคาอุปกรณ์ :</label>
                <p>{{ $returnBorrowing->equipment->cost ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="serial_no">หมายเลขอุปกรณ์ :</label>
                <p>{{ $returnBorrowing->serial_no }}</p>
            </div>
            <div class="form-group">
                <label for="department_name">ชื่อแผนก :</label>
                <p>{{ $returnBorrowing->equipment->department_name ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="building_no">อาคาร :</label>
                <p>{{ $returnBorrowing->building_no }}</p>
            </div>
            <div class="form-group">
                <label for="room_no">ห้อง :</label>
                <p>{{ $returnBorrowing->room_no }}</p>
            </div>
            <div class="form-group">
                <label for="returned_date">วันคืนจริง :</label>
                <p>{{ $returnBorrowing->returned_date }}</p>
            </div>
            <div class="form-group">
                <label for="status">Status :</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="{{ $returnBorrowing->status }}" selected>{{ $returnBorrowing->status }}</option>
                    <option value="ยืนยันการคืน">ยืนยันการคืน</option>
                    <option value="คืนไมสำเร็จ">คืนไมสำเร็จ</option>
                </select>
            </div>
            <button type="submit" class="Confirm">Confirm</button>
        </form>
    </div>
</body>
