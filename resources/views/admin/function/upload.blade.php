@extends('layouts.Adminapp')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/uploadfile.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">

        <form action="{{ route('equipment.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="importfile">
                <h1>อัปโหลดข้อมูลอุปกรณ์</h1>

                <input type="file" id="fileInput" name="file" accept=".xlsx, .xls" required>
                <br><br>

                <button type="button" id="previewBtn">แสดงข้อมูล</button>


            </div>

            <br><br>
            <!-- พื้นที่แสดงข้อมูลจากไฟล์ -->

            <div class="showdata" id="showdata">
                <h3 style="text-align:left;display:none;">แสดงข้อมูล:</h3>
                <div class="preview">
                    <table id="filePreview"  text-align: left;">
                        <thead class="colum">
                         
                        </thead>
                    </table>


                    <button type="submit" id="submitBtn" style="display: none;">อัปโหลด</button>
                </div>
            </div>
    </div>
    <br>
    </form>
    </div>

    <script>
        document.getElementById('previewBtn').addEventListener('click', function(event) {
            // ดึง input file ที่มี id='fileInput'
            const fileInput = document.getElementById('fileInput');
            // ถ้าผู้ใช้เลือกหลายไฟล์ จะรับไฟล์แรกที่ผู้ใช้เลือก
            const file = fileInput.files[0];

            //สร่้างเงื่อนไข ตรวจสอบว่ามีการเลือกไฟล์หรือไม่
            if (file) {
                // สร้างตัวอ่านไฟล์
                const reader = new FileReader();

                // ตั้งค่าอีเวนต์ที่จะทำงานเมื่อไฟล์อ่านเสร็จ
                reader.onload = function(e) {
                    // เข้าถึงข้อมูลไฟล์ที่อ่านเสร็จ
                    const data = new Uint8Array(e.target.result);
                    // วิเคราะห์ข้อมูลเป็น workbook โดยใช้ไลบรารี XLSX
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    // ดึงชื่อชีตแรกใน workbook
                    const sheetName = workbook.SheetNames[0];
                    const sheet = workbook.Sheets[sheetName];
                    // เข้าถึงวัตถุชีตที่ตรงกัน
                    // แปลงชีตเป็น HTML แล้วแสดง

                    const htmlString = XLSX.utils.sheet_to_html(sheet);

                    document.getElementById('filePreview').innerHTML = htmlString;

                    // แสดงปุ่ม "อัปโหลด" เมื่อข้อมูลถูกแสดงแล้ว
                    document.getElementById('submitBtn').style.display = 'inline-block';

                    // document.getElementById('submitBtn').addEventListener('click', function(event) {
                    //     event.preventDefault(); // ป้องกันการส่งฟอร์มอัตโนมัติ
                    //     // แสดง popup แบบง่าย
                    //     alert('อัปโหลดไฟล์สำเร็จ!');
                    //     window.location.reload();
                    // });

                };
                // อ่านไฟล์ Excel เป็น ArrayBuffer
                reader.readAsArrayBuffer(file);

                $('#filePreview').DataTable({
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
                dom: 'lrtip' // ปิดการแสดงผลช่องค้นหา
            });
            }
        });


        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์มชั่วคราว

            // แสดง popup แจ้งเตือน
            alert('อัปโหลดไฟล์สำเร็จ!');

            // ส่งฟอร์มหลังจากแสดง popup โดย delay เล็กน้อย
            setTimeout(function() {
                event.target.form.submit(); // ส่งฟอร์มหลังจาก delay เล็กน้อย
            }, 500); // เพิ่ม delay เพื่อให้ popup แสดงก่อน
        });


        document.getElementById('previewBtn').style.display = 'inline-block';
        // แสดงส่วนแสดงข้อมูล
        document.getElementById('showdata').style.display = 'block';
        document.getElementById('preview').style.display = 'block';
    </script>
@endsection