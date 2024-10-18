@extends('layouts.Adminapp')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/admin/Adminreturnhistory.css') }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <title>AdminReturnhistory</title>
    </head>

    <body>
        <div class="container">
            <table id="equipmentTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <h1>ประวัติการคืนอุปกรณ์</h1>
                <div class="d-flex flex-wrap align-items-center mb-3">
                    <input type="text" id="searchInput" class="searchborrw" placeholder="ค้นหา...">
                </div>
                <thead class="colum">
                    <tr>
                        <th></th>
                        <th>ลำดับการคืน</th>
                        <th>ชื่อผู้คืน</th>
                        <th>หมายเลขซีเรียล</th>
                        <th>ชื่อครุภัณฑ์</th>
                        <th>อาคาร</th>
                        <th>ห้อง</th>
                        <th>สถานะ</th>
                        <th>วันคืน</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returnBorrowings as $returnBorrowing)
                        <tr>
                            <td></td>
                            <td>{{ $returnBorrowing->return_id }}</td>
                            <td>
                                {{ optional($returnBorrowing->user)->fname ?? 'ไม่พบข้อมูล'}}
                                {{ optional($returnBorrowing->user)->lname ?? 'ไม่พบข้อมูล'}}
                            </td>
                            <td>{{ $returnBorrowing->serial_no }}</td>
                            <td>{{ $returnBorrowing->equipment_name }}</td>
                            <td>{{ $returnBorrowing->building_no }}</td>
                            <td>{{ $returnBorrowing->room_no }}</td>
                            <td>{{ $returnBorrowing->status }}</td>
                            <td>{{ $returnBorrowing->returned_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#equipmentTable').DataTable({
                    responsive: true,
                    pageLength: 5,
                    lengthChange: false,
                    language: {
                        search: "", // ตั้งค่านี้ให้เป็นค่าว่างเพื่อลบข้อความ "ค้นหา:"
                        paginate: {
                            next: "ถัดไป",
                            previous: "ย้อนกลับ"
                        },
                        info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                        infoEmpty: "แสดง 0 ถึง 0 จาก 0 รายการ",
                        zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                    },
                    dom: 'lrtip' // ยังคงปิดการแสดงผลช่องค้นหาที่มาพร้อมกับ DataTables
                });

                // เมื่อผู้ใช้พิมพ์ในช่องค้นหา
                $('#searchInput').on('keyup', function() {
                    var searchValue = $(this).val();
                    table.search(searchValue).draw(); // ค้นหาในทุกคอลัมน์
                });
            });
        </script>
    </body>
@endsection
