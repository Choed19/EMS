<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Equipment</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/Users/userreturn.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- เชื่อมต่อ jQuery และ DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- เชื่อมต่อกับ Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- เชื่อมต่อ Bootstrap JS และ dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<meta name="csrf-token" content="{{ csrf_token() }}">

<body>
    <div class="container">
        <div class="topic">
            <img src="{{ asset('img/return.png') }}" alt="" style="width: 70px; height: 70px;">
            <h2>รายการคืนอุปกรณ์</h2>
        </div>
        <div class="mb-3">
            <!-- โชว์ตาราง -->
            <div class="table-responsive">
                <table id="equipmentTable" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ชื่อผู้ยืม</th>
                            <th>ชื่ออุปกรณ์</th>
                            <th>หมายเลขซีเรียล</th>
                            <th>อาคาร</th>
                            <th>ห้อง</th>
                            <th>สถานะ</th>
                            <th>วันที่ยืม</th>
                            <th>กำหนดการคืน</th>
                            <th>วันที่คืนจริง</th>
                            <th>ข้อความ</th>
                            <th>คืน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowings as $borrowing)
                            @if (in_array($borrowing->status, ['อนุมัติ', 'รอ', 'ยืม', 'ดำเนินการคืน']) && $borrowing->r_date == null)
                                <tr>
                                    <td>{{ $borrowing->borrow_id }}</td>
                                    <td>{{ $borrowing->user->fname ?? 'N/A' }}
                                        {{ $borrowing->user->lname ?? 'N/A' }}
                                    </td>
                                    <td>{{ $borrowing->equipment_name }}</td>
                                    <td>{{ $borrowing->serial_no }}</td>
                                    <td>{{ $borrowing->building_no }}</td>
                                    <td>{{ $borrowing->room_no }}</td>
                                    <td>{{ $borrowing->status }}</td>
                                    <td>{{ $borrowing->borrowed_date }}</td>
                                    <td>{{ $borrowing->returned_date }}</td>
                                    @if ($borrowing->r_date == null)
                                        <td></td>
                                    @else
                                        <td>{{ $borrowing->r_date }}</td>
                                    @endif
                                    <td>{{ $borrowing->note }}</td>
                                    <td>
                                        @if ($borrowing->status == 'อนุมัติ')
                                            <button id="selectButton{{ $borrowing->serial_no }}" data-toggle="modal"
                                                onclick="slectRow('{{ $borrowing }}')" data-target="#cartModal"
                                                class="btn btn-custom">เลือก</button>
                                        @elseif ($borrowing->status == 'รอ,ยืม,ดำเนินการคืน')
                                            <button class="btn btn-secondary" disabled>ไม่สามารถเลือกได้</button>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="cartModalLabel">
                                    <img src="{{ asset('img/check.png') }}" alt=""
                                        style="width: 30px; height: 30px; ">
                                    รายการอุปกรณ์ที่คืน
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <!-- Table for selected items -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>หมายเลขซีเรียล</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>อาคาร</th>
                                            <th>ห้อง</th>
                                            <th>สถานะ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">ยกเลิกรายการ</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="confirmSelection()">ยืนยันรายการ</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Success Popup Modal -->
                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">การคืนสำเร็จ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                การคืนครุภัณฑ์ของคุณได้สำเร็จแล้ว!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="successConfirmButton"
                                    data-bs-dismiss="modal">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- jQuery -->
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

                    let selectedEquipment = null;

                    function slectRow(dataJson) {
                        selectedEquipment = null;
                        let data = JSON.parse(dataJson);
                        console.log(data);
                        selectedEquipment = data;
                        updateCartModal();
                        updateItemCount();
                    }

                    function updateItemCount() {
                        var itemCount = document.getElementById('itemCount');
                        itemCount.innerText = selectedEquipment.length;
                    }

                    function updateCartModal() {
                        var tableBody = document.querySelector('#cartModal tbody');
                        tableBody.innerHTML = ''; // ล้างข้อมูลแถวที่มีอยู่

                        var row = document.createElement('tr');

                        row.innerHTML = `
                <td>${selectedEquipment.serial_no}</td>
                <td>${selectedEquipment.equipment_name}</td>
                <td>${selectedEquipment.building_no}</td>
                <td>${selectedEquipment.room_no}</td>
                <td>${selectedEquipment.status}</td>
            `;

                        tableBody.appendChild(row);
                    }

                    async function confirmSelection() {
                        let dataForSend = JSON.stringify(selectedEquipment);
                        try {
                            let res = await fetch('/confirm-return', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                },
                                body: dataForSend
                            });

                            let resData = await res.json(); // Wait for the response to be converted to JSON
                            if (resData.success) {
                                alert('ยืนยันการคืนสำเร็จ!');

                                // Close the modals first
                                $('.modal').modal('hide');

                                // Wait a moment for modals to close before reloading the page
                                setTimeout(() => {
                                    location.reload(); // Refresh the page after the modals are closed
                                }, 500); // Add a 500ms delay to ensure modals are closed
                            } else {
                                alert('ยืนยันการคืนไม่สำเร็จ! กรุณาลองใหม่');
                            }
                        } catch (e) {
                            console.log(e);
                            alert('เกิดข้อผิดพลาด โปรดลองอีกครั้ง');
                        }
                    }
                </script>
            </div>
        </div>
    </div>

</body>

</html>
