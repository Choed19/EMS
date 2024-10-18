<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS</title>
    <link rel="icon" href="img/Product.png">
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Users/Home.css') }}">

    <!-- Font สำหรับหน้าเว็ป -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <a class="navbar-brand" href="{{ route('users/Home') }}">Equipment Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link effect1" href="#"
                        onclick="loadPage('{{ route('showUser') }}')">รายการทั้งหมด</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link effect2" href="#"
                        onclick="loadPage('{{ route('users.Userborrow') }}')">จัดยืมรายการ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link effect3" href="#"
                        onclick="loadPage('{{ route('return.user') }}')">จัดคืนรายการ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link effect5" href="#"
                        onclick="loadPage('{{ route('list.user') }}')">ประวัติการยืม</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link effect4" href="#"
                        onclick="loadPage('{{ route('Userreport') }}')">แจ้งซ่อม</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-item text-center">
                            <div class="profile-image mb-2">
                                <img src="data:image/jpeg;base64,{{ Auth::user()->profile_image }}" alt="Profile Image"
                                    class="img-thumbnail rounded-circle" style="width: 70px; height: 70px;">
                            </div>
                            <strong>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</strong>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                            onclick="loadPage('{{ route('profile.user') }}')">โปรไฟล์</a>
                        <a class="dropdown-item" href="#" onclick="loadPage('{{ route('scan.qrcode') }}')">แสกน
                            QR code</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> ออกจากระบบ
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="iframe-container mt-5 pt-4">
        <iframe id="content-iframe" src="/userdashboard" class="w-100 h-100"></iframe>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function loadPage(page) {
            document.getElementById('content-iframe').src = page;
        }

        $(document).ready(function() {
            // Close the navbar when a link is clicked, except for the dropdown menu
            $('.navbar-nav .nav-link').on('click', function(e) {
                // If the clicked link is not inside the user dropdown, close the navbar
                if (!$(this).closest('.dropdown').length) {
                    $('.navbar-collapse').collapse('hide');
                }
            });
        });
    </script>
</body>

</html>
