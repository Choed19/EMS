@extends('layouts.Adminapp')

@section('content')
<!DOCTYPE html>
<html lang="th">

<head>
   
    <title>แก้ไขโปรไฟล์</title>
    <link rel="stylesheet" href="{{ asset('css/admin/adminprofile.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">แก้ไขโปรไฟล์</h1>

        <!-- แสดงข้อความสำเร็จสำหรับการอัปโหลดรูปภาพ -->
        @if (session('success_image'))
            <div class="alert alert-success">
                {{ session('success_image') }}
            </div>
        @endif

        <!-- แสดงข้อความสำเร็จสำหรับการอัปเดตข้อมูลผู้ใช้ -->
        @if (session('success_profile'))
            <div class="alert alert-success">
                {{ session('success_profile') }}
            </div>
        @endif

        <!-- ฟอร์มสำหรับอัปโหลดรูปภาพโปรไฟล์ -->
        <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf
            @method('POST')
            <div class="form-group mb-3">
                <label for="profile_image" class="form-label">รูปภาพโปรไฟล์ (ขนาดไม่เกิน 10MB)</label>
                <div class="mb-3 text-center">
                    @if($user->profile_image)
                        <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" id="profile_image_preview" class="img-thumbnail" style="max-width: 200px;">
                    @else
                        <img src="default-profile.png" alt="Default Profile Image" id="profile_image_preview" class="img-thumbnail" style="max-width: 200px;">
                    @endif
                </div>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
                @error('profile_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">อัปโหลด</button>
        </form>

        <!-- ฟอร์มสำหรับแก้ไขข้อมูลผู้ใช้ -->
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="fname" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="fname" name="fname"
                    value="{{ old('fname', $user->fname) }}" disabled>
                @error('fname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="lname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" id="lname" name="lname"
                    value="{{ old('lname', $user->lname) }}" disabled>
                @error('lname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="กรอกรหัสผ่านใหม่" disabled>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่าน</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="ยืนยันรหัสผ่านใหม่" disabled>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <button type="button" id="editBtn" class="btn btn-warning" onclick="enableEdit()">แก้ไข</button>
                <button type="submit" id="saveBtn" class="btn btn-success" style="display: none;">บันทึก</button>
            </div>
        </form>
    </div>

    <!-- JavaScript สำหรับ Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ฟังก์ชันสำหรับเปิดใช้งานฟิลด์ต่างๆ
        function enableEdit() {
            document.getElementById('fname').disabled = false; // เปิดใช้งานฟิลด์ชื่อ
            document.getElementById('lname').disabled = false; // เปิดใช้งานฟิลด์นามสกุล
            // document.getElementById('email').disabled = false; // ถ้ามีฟิลด์อีเมล
            document.getElementById('password').disabled = false; // เปิดใช้งานฟิลด์รหัสผ่าน
            document.getElementById('password_confirmation').disabled = false; // เปิดใช้งานฟิลด์ยืนยันรหัสผ่าน
            document.getElementById('saveBtn').style.display = 'inline-block'; // แสดงปุ่มบันทึก
            document.getElementById('editBtn').style.display = 'none'; // ซ่อนปุ่มแก้ไข
        }

        // แสดงตัวอย่างรูปภาพเมื่อเลือกไฟล์
        document.getElementById('profile_image').addEventListener('change', function(event) {
            const [file] = this.files; // รับไฟล์ที่เลือก
            if (file) {
                document.getElementById('profile_image_preview').src = URL.createObjectURL(file); // แสดงตัวอย่าง
            }
        });
    </script>
</body>

</html>

@endsection

