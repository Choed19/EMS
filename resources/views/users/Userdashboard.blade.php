<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- ลิงก์แบบแสดงความคิดเห็นจะไม่ทำงาน -->
    <link rel="stylesheet" href="CSS/Users/Userdashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">

</head>

<body>
    <div class="dashboard-container">
        <div class="effect1">
            <a href="{{ route('showUser') }}">
                <div class="Bluebox">
                    <img src="img/checklist.png" alt="Checklist" class="icon">
                    <span class="text">รายการทั้งหมด</span>
                </div>
            </a>
        </div>
        <div class="effect2">
            <a href="{{ route('users.Userborrow') }}">
                <div class="Yellowbox">
                    <img src="img/Product.png" alt="Product" class="icon">
                    <span class="text">จัดยืมรายการ</span>
                </div>
            </a>
        </div>

        <div class="effect3">
            <a href="{{ route('return.user') }}">
                <div class="Greenbox">
                    <img src="img/Return.png" alt="Return" class="icon">
                    <span class="text">จัดคืนรายการ</span>
                </div>
            </a>
        </div>
        <div class="effect5">
            <a href="{{ route('list.user') }}">
                <div class="greybox">
                    <img src="img/borrow_list.png" alt="Borrow List" class="icon">
                    <span class="text">ประวัติการยืม</span>
                </div>
            </a>
        </div>

        <div class="effect4">
            <a href="{{ route('Userreport') }}">
                <div class="redbox">
                    <img src="img/Damaged.png" alt="Damaged" class="icon">
                    <span class="text">แจ้งซ่อม</span>
                </div>
            </a>
        </div>
    </div>
</body>

</html>
