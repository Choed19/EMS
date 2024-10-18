@extends('layouts.Adminapp')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/admin/Adminreturn.css') }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <title>AdminReturnList</title>
    </head>

    <body>
        <div class="container">
            <h1>รายการคืนอุปกรณ์</h1>
            <table id="equipmentTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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
                        <th>ยืนยัน</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returnBorrowings as $returnBorrowing)
                        @if (in_array($returnBorrowing->status, ['รอ']))
                            <tr>
                                <td></td>
                                <td>{{ $returnBorrowing->return_id }}</td>
                                <td>
                                    {{ optional($returnBorrowing->user)->fname ?? 'ไม่พบข้อมูล' }}
                                    {{ optional($returnBorrowing->user)->lname ?? 'ไม่พบข้อมูล' }}
                                </td>
                                <td>{{ $returnBorrowing->serial_no }}</td>
                                <td>{{ $returnBorrowing->equipment_name }}</td>
                                <td>{{ $returnBorrowing->building_no }}</td>
                                <td>{{ $returnBorrowing->room_no }}</td>
                                <td>{{ $returnBorrowing->status }}</td>
                                <td>{{ $returnBorrowing->returned_date }}</td>
                                <td>
                                    <button
                                        onclick="loadPage('{{ route('adminreturn.edit', $returnBorrowing->return_id) }}')"
                                        class="btn btn-warning">Check</button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{-- model เด้อ --}}
            <div id="popupModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Bootstrap JS Bundle -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <!-- DataTables JS -->
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
            <!-- Include DataTables and related scripts -->
            <script>
                // Function to open modal and load content via AJAX
                function loadPage(page) {
                    var modal = document.getElementById("popupModal");
                    var modalContent = document.getElementById("modalContent");

                    // AJAX request to load content
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', page, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            modalContent.innerHTML = xhr.responseText;
                            modal.style.display = "block"; // Show modal
                        } else if (xhr.readyState == 4) {
                            modalContent.innerHTML = '<p>Unable to load the page content.</p>';
                            modal.style.display = "block"; // Show modal
                        }
                    };
                    xhr.send();
                }

                // Function to close the modal
                function closeModal() {
                    document.getElementById("popupModal").style.display = "none";
                }

                // Close the modal if user clicks outside of it
                window.onclick = function(event) {
                    var modal = document.getElementById("popupModal");
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
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

                    // ตัวกรองเพิ่มเติมตามหมวดหมู่
                    $('#categorySelect').on('change', function() {
                        var selectedColumn = $(this).val();
                        var searchValue = $('#searchInput').val();

                        // ทำการค้นหาในคอลัมน์ที่เลือก
                        if (selectedColumn !== "") {
                            table.columns().search(''); // รีเซ็ตการค้นหาทั้งหมดก่อน
                            table.column(selectedColumn).search(searchValue).draw(); // ค้นหาในคอลัมน์ที่เลือก
                        } else {
                            table.search(searchValue).draw(); // ถ้าเลือก "ทั้งหมด" ให้ค้นหาทุกคอลัมน์
                        }
                    });

                    // เมื่อผู้ใช้พิมพ์ในช่องค้นหา
                    $('#searchInput').on('keyup', function() {
                        var searchValue = $(this).val();
                        var selectedColumn = $('#categorySelect').val();

                        if (selectedColumn !== "") {
                            table.column(selectedColumn).search(searchValue).draw();
                        } else {
                            table.search(searchValue).draw();
                        }
                    });
                });
            </script>
        </div>
    </body>
@endsection
