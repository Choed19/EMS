@extends('layouts.Adminapp')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/AdminEquipment.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- bootstrap5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS ของ Bootstrap 5 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <div class="container" id='Container'>
        <h2 style="text-align: left"><b>รายการอุปกรณ์</b></h2>

        <div class="mb-3">
            <div class="d-grid">
                <div class="search-container">
                    <div class="" id="select-group">
                        <div class="select-search">
                            <div class="options">
                                <label for="categorySelect" class="form-label me-2"
                                    style="font-size: 20px; margin-top:8px;"></label>
                                <select id="categorySelect" class="form-select me-2">
                                    <option value="">ทั้งหมด</option>
                                    <option value="2">ปี</option>
                                    <option value="3">กลุ่มอุปกรณ์</option>
                                    <option value="4">หมายเลขซีเรียล</option>
                                    <option value="5">ชื่ออุปกรณ์</option>
                                    <option value="6">ราคา</option>
                                    <option value="7">วันที่ซื้อ</option>
                                    <option value="8">ชื่อแผนก</option>
                                    <option value="9">อาคาร</option>
                                    <option value="10">ห้อง</option>
                                    <option value="11">สถานะอุปกรณ์</option>
                                </select>

                                <input type="text" id="searchInput" class="form-control me-2" placeholder="ค้นหา...">
                            </div>
                            <!-- ช่อง Input ค้นหา -->
                  
                               
                  
                        </div>

                    </div>


                    <div class="button">
                        <div class="group">
                            <a href="{{ route('Addmaster.admin') }}"><button>เพิ่มข้อมูลอุปกรณ์</button></a>
                            <a href="{{ route('upload.index') }}"><button>อัปโหลดข้อมูลอุปกรณ์</button></a>
                        </div>

                        <div class="group">
                            <a href="{{ route('export.equipment') }}"><button>นำออกข้อมูลอุปกรณ์</button></a>
                            <a href="javascript:void(0);" onclick="deleteSelected();">
                                <button>ลบข้อมูลที่เลือก</button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table id="equipmentTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th class="plus"></th>
                    <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll()"></th>
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
                    <th>เวลานำเข้า</th>
                    <th>นำเข้าโดย</th>
                    <th>วันที่อัปเดต</th>
                    <th>ผู้อัปเดต</th>
                    <th>สถานะการยืม</th>
                    <th>ฟังก์ชั้น</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($equipments as $equipment)
                    <tr>
                        <td class="plus"></td>
                        <td><input type="checkbox" class="select-checkbox" value="{{ $equipment->equipment_id }}"></td>
                        <td>{{ $equipment->year }}</td>
                        <td>{{ $equipment->equipment_group }}</td>
                        <td>{{ $equipment->serial_no }}</td>
                        <td>{{ $equipment->equipment_name }}</td>
                        <td>{{ $equipment->cost }}</td>
                        <td>{{ $equipment->buy_date }}</td>
                        <td>{{ $equipment->department_name }}</td>
                        <td>{{ $equipment->building_no }}</td>
                        <td>{{ $equipment->room_no }}</td>
                        <td>{{ $equipment->status }}</td>
                        <td>{{ $equipment->create_time }}</td>
                        <td>{{ $equipment->create_by }}</td>
                        <td>{{ $equipment->update_time }}</td>
                        <td>{{ $equipment->update_by }}</td>
                        <td>{{ $equipment->status_borrow }}</td>
                        <td>
                            <div class="actions">

                                <div>
                                    <a id="edit-button" class="function"
                                        onclick="editEquipment({{ $equipment->equipment_id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>

                                <div>
                                    <a id="delete-button"class="function"
                                        onclick="deleteEquipment({{ $equipment->equipment_id }})">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                                <div>
                                    <a id="qrcode-button" class="function"
                                        onclick="generateQRCode({{ $equipment->equipment_id }})">
                                        <i class="bi bi-qr-code"></i>
                                    </a>
                                </div>

                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pupup_box">
        <form id="fileForm" action="{{ route('equipment.import') }}" method="POST" enctype="multipart/form-data"
            style="display:none;">
            @csrf
            <input type="file" name="file" id="fileInput" required>
            <button type="submit">Import</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- QRCode.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        // ฟังก์ชันเลือก/ยกเลิกเลือกทั้งหมด
        function toggleSelectAll() {
            var selectAllCheckbox = document.getElementById('selectAll');
            var checkboxes = document.querySelectorAll('.select-checkbox');

            // เลือกหรือยกเลิกการเลือกเช็คบ็อกซ์ทั้งหมด
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
    </script>
    <script>
        var searchColumn = 1; // ตั้งค่าให้เริ่มค้นหาจากคอลัมน์แรกโดยค่าเริ่มต้น

        function setSearchColumn(column, categoryName) {
            searchColumn = column;
            document.getElementById('searchInput').placeholder = "ค้นหา " + categoryName + "...";
            document.getElementById('categoryButton').textContent = categoryName;
        }

        function filterTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.getElementById('equipmentTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td')[searchColumn - 1]; // -1 เพราะคอลัมน์เริ่มต้นที่ 0
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = ""; // แสดงแถว
                    } else {
                        tr[i].style.display = "none"; // ซ่อนแถว
                    }
                }
            }
        }
        $(document).ready(function() {
            var table = $('#equipmentTable').DataTable({
                responsive: true,
                pageLength: 8,
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

        function deleteSelected() {
            var selectedIds = [];
            $('.select-checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: "คุณไม่สามารถย้อนกลับการกระทำนี้ได้!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ลบข้อมูล!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('equipment.deleteMultiple') }}', // เพิ่ม Route สำหรับลบข้อมูลหลายรายการ
                            type: 'POST',
                            data: {
                                ids: selectedIds,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'สำเร็จ!',
                                    'ข้อมูลที่เลือกถูกลบแล้ว.',
                                    'success'
                                );
                                location.reload();
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'เกิดข้อผิดพลาด!',
                                    'เกิดข้อผิดพลาดในการลบข้อมูล.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            } else {
                Swal.fire('แจ้งเตือน', 'กรุณาเลือกข้อมูลที่ต้องการลบอย่างน้อยหนึ่งรายการ.', 'warning');
            }
        }


        function deleteEquipment(id) {
            if (confirm('คุณต้องการลบข้อมูล')) {
                $.ajax({
                    url: '/equipment/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        function editEquipment(id) {
            window.location.href = '/equipment/' + id + '/edit';
        }

        function generateQRCode(equipmentId) {
            // ใช้ fetch API เพื่อดึง QR Code จากเซิร์ฟเวอร์
            fetch(`/equipment/${equipmentId}/qrcode`)
                .then(response => response.text())
                .then(data => {
                    // แสดงผล QR Code ใน Pop-up โดยใช้ SweetAlert2 พร้อมปุ่มดาวน์โหลด
                    Swal.fire({
                        title: 'QR Code',
                        html: data, // แสดง QR Code ใน pop-up
                        showCloseButton: true,
                        focusConfirm: false,
                        showCancelButton: true,
                        cancelButtonText: 'Close',
                        confirmButtonText: 'Download',
                        preConfirm: () => {
                            // ดาวน์โหลด QR Code เมื่อกดปุ่ม 'Download'
                            return fetch(`/equipment/${equipmentId}/download-qrcode`)
                                .then(response => response.blob())
                                .then(blob => {
                                    // ใช้ FileSaver.js เพื่อดาวน์โหลดไฟล์
                                    const url = window.URL.createObjectURL(blob);
                                    const a = document.createElement('a');
                                    a.style.display = 'none';
                                    a.href = url;
                                    a.download = `qrcode-equipment-${equipmentId}.png`;
                                    document.body.appendChild(a);
                                    a.click();
                                    window.URL.revokeObjectURL(url);
                                })
                                .catch(error => {
                                    console.error('Error downloading QR Code:', error);
                                    Swal.showValidationMessage(`Failed to download QR Code: ${error}`);
                                });
                        }
                    });
                })
                .catch(error => console.log('Error:', error));
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.select-checkbox');
            let selectedIds = [];

            // เมื่อกดปุ่ม "เลือกทั้งหมด"
            selectAllCheckbox.addEventListener('change', function() {
                selectedIds = []; // Clear the previous selections
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                    if (selectAllCheckbox.checked) {
                        selectedIds.push(checkbox.value); // Add the ID to selectedIds
                    }
                });
                console.log(selectedIds); // Log the selected IDs for verification
            });

            // เมื่อกดเช็คหรือยกเลิกเช็ค checkbox แต่ละอัน
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        selectedIds.push(checkbox.value); // Add the ID to selectedIds
                    } else {
                        selectedIds = selectedIds.filter(id => id !== checkbox
                            .value); // Remove the ID from selectedIds
                        selectAllCheckbox.checked =
                            false; // If any checkbox is unchecked, uncheck "select all"
                    }

                    // หากทุก checkbox ถูกเลือก ให้เช็ค "เลือกทั้งหมด"
                    if (Array.from(checkboxes).every(checkbox => checkbox.checked)) {
                        selectAllCheckbox.checked = true;
                    }

                    console.log(selectedIds); // Log the selected IDs for verification
                });
            });
        });
    </script>
@endsection