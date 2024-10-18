<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineer Dashboard</title>

    <!-- ใส่ลิงก์ไปยัง CSS ของ Bootstrap และ Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css\Engineer\EngineerDashbord.css') }}">
    <style>
        
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- ไอคอนที่ 1: ยืนยันการซ่อม -->
            <div class="col-md-4 mb-4">
                <div class="card icon-card shadow p-3" onclick="location.href='{{route('report.Engineer')}}'">
                    <div class="card-body text-center">
                        <i class="bi bi-tools icon"></i>
                        <p class="icon-text mt-3">ยืนยันการซ่อม</p>
                    </div>
                </div>
            </div>
            <!-- ไอคอนที่ 2: รายการที่เคยซ่อม -->
            <div class="col-md-4 mb-4">
                <div class="card icon-card shadow p-3" onclick="location.href='{{route('Engineer.history')}}'">
                    <div class="card-body text-center">
                        <i class="bi bi-list-check icon"></i>
                        <p class="icon-text mt-3">รายการที่เคยซ่อม</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ลิงก์ไปยัง Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
