<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin/Adminborrowcheck.css') }}">
    <title>AdminCheckBorrowing</title>
</head>
<body>
    <div class="content">
        <div class="head">
            <h1>ข้อมูลการยืม</h1>
            
        </div>
        <form action="{{ route('borrowings.update', $borrowing->borrow_id) }}" method="POST">
            @csrf
            @method('PUT') <!-- หรือสามารถใช้ PATCH ได้ขึ้นอยู่กับการใช้งาน -->

            <div id="form-group" class="form-group">
                <label for="user_id">ชื่อผู้ยืม :</label>
                <p>
                    {{ optional($borrowing->user)->fname ?? 'ไม่พบข้อมูล'}}
                    {{ optional($borrowing->user)->lname ?? 'ไม่พบข้อมูล'}}
                </p>
            </div>
            <div class="form-group">
                <label for="equipment_name">ชื่ออุปกรณ์ :</label>
                <p>{{ $borrowing->equipment_name }}</p>
            </div>
            <div class="form-group">
                <label for="equipment_name">ราคาอุปกรณ์ :</label>
                <p>{{ $borrowing->equipment->cost ?? 'N/A' }}  บาท</p>
            </div>
            <div class="form-group">
                <label for="serial_no">หมายเลขอุปกรณ์ :</label>
                <p>{{ $borrowing->serial_no }}</p>
            </div>
            <div class="form-group">
                <label for="equipment_name">ชื่อแผนก :</label>
                <p>{{ $borrowing->equipment->department_name ?? 'N/A' }}</p>
            </div>
            <div class="form-group">
                <label for="building_no">อาคาร :</label>
                <p>{{ $borrowing->building_no }}</p>
            </div>

            <div class="form-group">
                <label for="room_no">ห้อง :</label>
                <p>{{ $borrowing->room_no }}</p>
            </div>
            <div class="form-group">
                <label for="borrowed_date">วันที่ยืม :</label>
                <p>{{ $borrowing->borrowed_date }}</p>
            </div>

            <div class="form-group">
                <label for="returned_date">วันที่คืน :</label>
                <p>{{ $borrowing->returned_date }}</p>
            </div>
            <div class="form-group">
                <label for="status">สถาณะการยืม :</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="{{ $borrowing->status }}" selected>{{ $borrowing->status }}</option>
                    {{-- <option value="รอ">รอ</option> --}}
                    <option value="อนุมัติ">อนุมัติ</option>
                    <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
                </select>
            </div>
            <div class="Form-group">
                <label for="note">หมายเหตุ</label>
                <textarea name="note" id="note" class="inputnote" placeholder="หมายเหตุ" rows="4"></textarea>
            </div>
            <button type="submit" class="Confirm" >Confirm</button>
        </form>

    </div>
</body>
