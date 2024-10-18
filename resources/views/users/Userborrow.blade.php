<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Equipment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/Users/Userborrow.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="topic">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/product.png') }}" alt="" style="width: 70px; height: 70px;">
                <h2 class="ms-3">จัดยืมรายการ</h2>
            </div>
            <div class="cart-button" id="Check">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <i class="fa fa-cart-plus"></i> รายการ (<span id="itemCount">0</span>)
                </button>
            </div>
        </div>

        <!-- Select and Search -->
        <div class="mb-3">
            <div class="d-flex flex-wrap align-items-center mb-3">
                <label for="categorySelect" class="form-label me-2" style="font-size: 20px;">เลือกหมวดหมู่:</label>
                <select id="categorySelect" class="form-select me-2">
                    <option value="">ทั้งหมด</option>
                    <option value="0">กลุ่มอุปกรณ์</option>
                    <option value="1">หมายเลขซีเรียล</option>
                    <option value="2">ชื่ออุปกรณ์</option>
                    <option value="3">ชื่อแผนก</option>
                    <option value="4">อาคาร</option>
                    <option value="5">ห้อง</option>
                    <option value="6">สถานะอุปกรณ์</option>
                    <option value="7">ยืม</option>

                </select>
                <input type="text" id="searchInput" class="form-control me-2" placeholder="ค้นหา...">
            </div>

            <!-- Equipment Table -->
            <div class="table-responsive">
                <table id="equipmentTable" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>กลุ่มอุปกรณ์</th>
                            <th>หมายเลขซีเรียล</th>
                            <th>ชื่ออุปกรณ์</th>
                            <th>ชื่อแผนก</th>
                            <th>อาคาร</th>
                            <th>ห้อง</th>
                            <th>สถานะอุปกรณ์</th>
                            <th>ยืม</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipments as $equipment)
                            @if (in_array($equipment->status, ['พบ']))
                                <tr>
                                    <td>{{ $equipment->equipment_group }}</td>
                                    <td>{{ $equipment->serial_no }}</td>
                                    <td>{{ $equipment->equipment_name }}</td>
                                    <td>{{ $equipment->department_name }}</td>
                                    <td>{{ $equipment->building_no }}</td>
                                    <td>{{ $equipment->room_no }}</td>
                                    <td>{{ $equipment->status }}</td>
                                    <td>
                                        @if ($equipment->status_borrow === '')
                                            <button id="selectButton{{ $equipment->serial_no }}"
                                                onclick="toggleSelection('{{ $equipment->serial_no }}', '{{ $equipment->equipment_name }}', '{{ $equipment->building_no }}', '{{ $equipment->room_no }}', '{{ $equipment->status }}')"
                                                class="btn btn-custom">เลือก</button>
                                        @else
                                            <button class="btn btn-secondary" disabled>ไม่สามารถเลือกได้</button>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">
                            <img src="{{ asset('img/check.png') }}" alt="" style="width: 30px; height: 30px;">
                            รายการอุปกรณ์ที่เลือก
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                            <tbody></tbody>
                        </table>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><img src="{{ asset('img/date.png') }}" alt=""
                                        style="width: 30px; height:30px"> กำหนดวันที่เริ่มยืม</label>
                                <input type="date" id="startDate" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><img src="{{ asset('img/date.png') }}" alt=""
                                        style="width: 30px; height:30px"> กำหนดวันที่คืน</label>
                                <input type="date" id="endDate" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">ยกเลิกรายการ</button>
                            <button type="button" class="btn btn-primary"
                                onclick="confirmSelection()">ยืนยันรายการ</button>
                        </div>
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
                        <h5 class="modal-title" id="successModalLabel">การยืมสำเร็จ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        การยืมครุภัณฑ์ของคุณได้สำเร็จแล้ว!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="successConfirmButton"
                            data-bs-dismiss="modal">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script>
        var selectedEquipment = [];

        function toggleSelection(serial_no, equipment_name, building_no, room_no, status) {
            var equipmentIndex = selectedEquipment.findIndex(function(equipment) {
                return equipment.serial_no === serial_no;
            });
            var button = document.getElementById('selectButton' + serial_no);

            if (equipmentIndex === -1) {
                selectedEquipment.push({
                    serial_no,
                    equipment_name,
                    building_no,
                    room_no,
                    status
                });
                button.classList.remove('btn-custom');
                button.classList.add('btn-custom-selected');
            } else {
                selectedEquipment.splice(equipmentIndex, 1);
                button.classList.remove('btn-custom-selected');
                button.classList.add('btn-custom');
            }
            updateItemCount();
            updateCartModal();
        }

        function updateItemCount() {
            document.getElementById('itemCount').innerText = selectedEquipment.length;
        }

        function updateCartModal() {
            var tableBody = document.querySelector('#cartModal tbody');
            tableBody.innerHTML = '';

            selectedEquipment.forEach(function(equipment) {
                var row = `
                    <tr>
                        <td>${equipment.serial_no}</td>
                        <td>${equipment.equipment_name}</td>
                        <td>${equipment.building_no}</td>
                        <td>${equipment.room_no}</td>
                        <td>${equipment.status}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        }


        document.querySelector('.btn-primary').addEventListener('click', function() {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;

            if (!startDate || !endDate || selectedEquipment.length === 0) {
                alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }
        });

        function confirmSelection() {
            let startDate = document.getElementById('startDate').value;
            let endDate = document.getElementById('endDate').value;

            if (selectedEquipment.length === 0) {
                alert('กรุณาเลือกครุภัณฑ์อย่างน้อยหนึ่งรายการ');
                return;
            }

            if (!startDate) {
                alert('กรุณากรอกวันที่เริ่มยืม');
                return;
            }

            if (!endDate) {
                alert('กรุณากรอกวันที่คืน');
                return;
            }

            if (new Date(startDate) > new Date(endDate)) {
                alert('วันที่คืนต้องไม่เร็วกว่าวันที่เริ่มยืม');
                return;
            }

            selectedEquipment.forEach(s => {
                s.start_date = startDate;
                s.end_date = endDate;
            });

            var jsonData = JSON.stringify(selectedEquipment);

            fetch('/confirm-borrow', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: jsonData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // ปิด popup "cartModal" อัตโนมัติ
                        var cartModal = bootstrap.Modal.getInstance(document.getElementById('cartModal'));
                        cartModal.hide();

                        // แสดง popup "การยืมสำเร็จ"
                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();

                        // ล้างข้อมูลที่เลือกทั้งหมด
                        selectedEquipment = [];
                        updateCartModal();
                        updateItemCount();

                        // รอให้ modal ปิดลงแล้วรีเฟรชหน้า
                        setTimeout(() => {
                            location.reload(); // รีเฟรชหน้าหลังจากที่ modal ปิด
                        }, 1000); // รอ 1 วินาทีเพื่อให้ modal ปิดก่อน
                    } else {
                        alert('เกิดข้อผิดพลาดในการยืนยัน: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    alert('เกิดข้อผิดพลาดขณะส่งข้อมูล');
                });
        }

        document.getElementById('endDate').addEventListener('change', function() {
            var startDate = document.getElementById('startDate').value;
            var endDate = this.value;

            if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
                alert('วันที่คืนต้องไม่เร็วกว่าวันที่เริ่มยืม');
                this.value = ''; // ล้างค่า endDate ถ้าผิดเงื่อนไข
            }
        });

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
</body>

</html>
