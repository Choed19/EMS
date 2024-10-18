
@extends('layouts.iframe')
@section('title','website')
    

@section('content')
<h2>Document</h2>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos ipsa necessitatibus corporis deleniti animi
    ut omnis veritatis! Molestias dolore quibusdam et consectetur in sequi asperiores quam molestiae quis!
    Voluptatum, quidem.</p>

<hr>
@foreach ($blogs as $item)
    <h3>{{$item['title']}}</h3>
    <p>{{$item['content']}}</p>
    @if ($item['status'] == true)
        <p class="text-success">เผยแผร่</p>
        
    @else
        <p class='text-danger'>ฉบับล่าง</p>
    @endif
    <hr>
    
@endforeach



@endsection



<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขโปรไฟล์</title>
    <!-- เพิ่ม CSS สำหรับ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS สำหรับ DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <!-- CSS ที่กำหนดเอง -->
    <link rel="stylesheet" href="{{ asset('css/Userprofile.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- ฟอนต์สำหรับหน้าเว็บ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">แก้ไขโปรไฟล์</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="profile_image" class="form-label">รูปภาพโปรไฟล์ (ขนาดไม่เกิน 10MB)</label>
                <div class="mb-3">
                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'default.jpg' }}"
                        alt="Profile Image" id="profile_image_preview" class="img-thumbnail">
                </div>
            </div>
            <div class="form-group mb-3">
                <input type="file" class="form-control" id="profile_image" name="profile_image" disabled>
                @error('profile_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <button type="submit" class="btn btn-success">อัปโหลด</button>
            </div>

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
            document.getElementById('password').disabled = false; // เปิดใช้งานฟิลด์รหัสผ่าน
            document.getElementById('password_confirmation').disabled = false; // เปิดใช้งานฟิลด์ยืนยันรหัสผ่าน
            document.getElementById('profile_image').disabled = false; // เปิดใช้งานฟิลด์รูปภาพโปรไฟล์
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









