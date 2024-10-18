@extends('layouts.Adminapp')

@section('content')
<head>
<link rel="stylesheet" href="{{ asset('css/admin/ManageRole.css') }}">
{{-- Font สำหรับหน้าเว็ป --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
</head>
    <div class="content">
        <h1>กำหนดสิทธิ</h1>
        <div class="container">
            <table id="equipmentTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead class="colum">
                    <tr>
                        <th class="plus"></th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>อีเมล</th>
                        <th>สิทธิ</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <form action="{{ route('role.admin', $user->user_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td class="plus"></td>
                                <td>{{ $user->fname }}</td>
                                <td>{{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="form-group">
                                        <label for="role-{{ $user->user_id }}"></label>
                                        <select class="form-control" id="role-{{ $user->user_id }}"
                                            name="role[{{ $user->user_id }}]" required>
                                            <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User
                                            </option>
                                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="Engineer" {{ $user->role == 'Engineer' ? 'selected' : '' }}>Engineer
                                            </option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <script>
            // $(document).ready(function () {
            //     var table = $('#equipmentTable').DataTable({
            //         responsive: {
            //             details: {
            //                 type: 'column', // ทำให้คลิกที่ไอคอนลูกศรเพื่อขยายข้อมูลเพิ่มเติม
            //                 target: 'tr' // แสดงแถวที่มีข้อมูลเพิ่มเติม
            //             }
            //         },
            //         pageLength: 5, // ตั้งค่าจำนวนรายการต่อหน้าเป็น 5
            //         lengthChange: false, // ปิดการแสดงเมนูปรับจำนวนรายการต่อหน้า
            //         autoWidth: false, // ปิดการขยายคอลัมน์อัตโนมัติ
            //         columnDefs: [
            //             { responsivePriority: 1, targets: 1 }, // คอลัมน์ชื่อจะแสดงเสมอ
            //             { responsivePriority: 2, targets: 2 }, // คอลัมน์นามสกุลจะแสดงเสมอ
            //             { responsivePriority: 3, targets: [3, 4, 5] },  // คอลัมน์อื่นๆ จะถูกซ่อนเมื่อหน้าจอเล็ก
            //             { className: 'control', orderable: false, targets: 0 } // เพิ่มปุ่มลูกศรที่คอลัมน์แรกเพื่อขยายข้อมูล
            //         ],
            //         language: {
            //             search: "", // ตั้งค่าให้ไม่มีข้อความค้นหา
            //             paginate: {
            //                 next: "ถัดไป",
            //                 previous: "ย้อนกลับ"
            //             },
            //             info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            //             infoEmpty: "แสดง 0 ถึง 0 จาก 0 รายการ",
            //             zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
            //         },
            //         dom: 'lrtip' // ปิดการแสดงช่องค้นหาใน DataTables เอง
            //     });
            // });
            
        </script>
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
               
            });
        </script>


    </div>
@endsection
