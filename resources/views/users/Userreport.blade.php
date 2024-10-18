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
    <link rel="stylesheet" href="{{ asset('css/Users/userreport.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Font สำหรับหน้าเว็ป --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    {{-- <h3>**อาจจะต้องสร้าง Table ใหม่ไว้เก็บข้อมูลการแจ้งซ่อม โดยจะดึงข้อมูลจาก Table Equipment มาใช้ในการแจ้งซ่อม**</h3> --}}
    <div class="container">
        <div class="topic">
            <img src="{{ asset('img/Damaged.png') }}" alt="" style="width: 70px; height: 70px;">
            <h2>แจ้งซ่อมอุปกรณ์</h2>
        </div>
        <div class="mb-3">
            <div class="d-flex flex-wrap align-items-center mb-3">
                <label for="categorySelect" class="form-label me-2"
                    style="font-size: 20px; margin-top:8px">เลือกหมวดหมู่:</label>
                <select id="categorySelect" class="form-select me-2">
                    <option value="">ทั้งหมด</option>
                    <option value="0">ปี</option>
                    <option value="1">กลุ่มอุปกรณ์</option>
                    <option value="2">หมายเลขซีเรียล</option>
                    <option value="3">ชื่ออุปกรณ์</option>
                    <option value="4">ราคา</option>
                    <option value="5">วันที่ซื้อ</option>
                    <option value="6">ชื่อแผนก</option>
                    <option value="7">อาคาร</option>
                    <option value="8">ห้อง</option>
                    <option value="9">สถานะอุปกรณ์</option>
                </select>
                <!-- ช่อง Input ค้นหา -->
                <input type="text" id="searchInput" class="form-control me-2" placeholder="ค้นหา...">
            </div>
            <!-- โชว์ตาราง -->
            <div class="table-responsive">
                <table id="equipmentTable" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>ปี</th>
                            <th>กลุ่มอุปกรณ์</th>
                            <th>หมายเลขซีเรียล</th>
                            <th>ชื่ออุปกรณ์</th>
                            <th>ราคา</th>
                            <th>วันที่ซื้อ</th>
                            <th>ชื่อแผนก</th>
                            <th>อาคาร</th>
                            <th>ห้อง</th>
                            <th>สถานะอุปกรณ์</th>
                            <th>การแจ้งซ่อม</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipments as $equipment)
                            @if (in_array($equipment->status, ['พบ']))
                                <tr>
                                    <td>{{ $equipment->year }}</td>
                                    <td>{{ $equipment->equipment_group }}</td>
                                    <td>{{ $equipment->serial_no }}</td>
                                    <td>{{ $equipment->equipment_name }}</td>
                                    <td>{{ number_format($equipment->cost, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($equipment->buy_date)->format('d/m/Y') }}</td>
                                    <td>{{ $equipment->department_name }}</td>
                                    <td>{{ $equipment->building_no }}</td>
                                    <td>{{ $equipment->room_no }}</td>
                                    <td>{{ $equipment->status }}</td>
                                    <td><button class="repair-btn"
                                            onclick="requestRepair('{{ $equipment->equipment_id }}')">แจ้งซ่อม</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="repairModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>ฟอร์มแจ้งซ่อม</h2>
            <label for="issue">รายละเอียดปัญหา:</label>
            <textarea id="issue" rows="4" placeholder="กรุณากรอกรายละเอียดปัญหา..."></textarea>
            <button onclick="submitRepair()">ส่งคำขอซ่อม</button>
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
            // เริ่มการทำงานของ DataTable พร้อมการตั้งค่าภาษา
            var table = $('#equipmentTable').DataTable({
                responsive: true,
                pageLength: 5,
                lengthChange: false,
                language: {
                    search: "",
                    paginate: {
                        next: "ถัดไป",
                        previous: "ย้อนกลับ"
                    },
                    info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    infoEmpty: "แสดง 0 ถึง 0 จาก 0 รายการ",
                    zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                },
                dom: 'lrtip' // ปิดการแสดงผลช่องค้นหาที่มาพร้อมกับ DataTables
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

        var selectedEquipmentId = null; // เก็บค่า equipment_id ที่จะใช้ในแจ้งซ่อม

        function requestRepair(equipment_id) {
            selectedEquipmentId = equipment_id; // เก็บค่า equipment_id
            var modal = document.getElementById("repairModal");
            modal.style.display = "block"; // แสดง Modal
        }

        function submitRepair() {
            var issue = document.getElementById("issue").value;
            if (issue.trim() === "") {
                alert("กรุณากรอกรายละเอียดปัญหา");
                return;
            }

            if (!selectedEquipmentId) {
                alert("ไม่สามารถหาอุปกรณ์ที่ต้องการแจ้งซ่อมได้");
                return;
            }

            console.log({
                _token: "{{ csrf_token() }}",
                equipment_id: selectedEquipmentId,
                user_id: "{{ auth()->user()->user_id }}",
                description: issue,
                report_date: new Date().toISOString().split('T')[0],
                status: 'รอดำเนินการ'
            });

            $.ajax({
                url: "{{ route('repair.store') }}",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    equipment_id: selectedEquipmentId,
                    user_id: "{{ auth()->user()->user_id }}",
                    description: issue,
                    report_date: new Date().toISOString().split('T')[0],
                    status: 'รอดำเนินการ'
                }),
                success: function(response) {
                    alert(response.message);
                    closeModal();
                    location.reload(); // รีเฟรชหน้าเว็บหลังจากแจ้งซ่อมสำเร็จ
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("มีข้อผิดพลาดในการส่งคำขอ");
                }
            });
        }


        function closeModal() {
            var modal = document.getElementById("repairModal");
            modal.style.display = "none"; // ปิด Modal
        }

        // Close modal when clicking on 'x'
        var closeBtn = document.getElementsByClassName("close")[0];
        closeBtn.onclick = function() {
            closeModal();
        }

        // Close modal when clicking outside of modal
        window.onclick = function(event) {
            var modal = document.getElementById("repairModal");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>
