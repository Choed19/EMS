<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/home.js') }}"></script> --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    {{-- bootstrap-5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <script src="{{ mix('js/home.js') }}"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js">
    </script>
    <!-- เชื่อมต่อกับ Font Awesome Free จาก CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('../css/admin/layout/Adminapp.css') }}">
</head>

<body>

    <div class="header">
        <div id="main">
            <button id="toggleButton" class="togglebtn" onclick="toggleNav()">&#9776;</button>
        </div>

        <div id="main">
            <a href="\admin\dashboard">
                <i class="fa fa-home fa-2x" aria-hidden="true"></i>

            </a>
        </div>
    </div>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="brand">
            <P style="font-size: 35px;margin-left:10px;">EMS</P>
            <div id="main">
                <button id="toggleButton2" class="togglebtn" onclick="toggleNav()">&#9776;</button>
            </div>

        </div>
        <!-- Sidebar ->
        <div class="sidebar">
            <!-Sidebar user panel (optional) -->
        
            <div class="user-panel mt-3 pb-3 mb-3 ">
                <div class="item">
                    <div class="user-item">
                        <img src="data:image/jpeg;base64,{{ Auth::user()->profile_image }}" alt="Profile Image"
                            class="img-thumbnail rounded-circle" style="width: 70px; height: 70px;">
                    </div>
                    <div class="user-item">
                        <a id="name" class="nav-item dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (Auth::check() && optional(auth::user())->fname)
                                <div>{{ auth::user()->fname }} {{ auth::user()->lname }}</div>
                            @endif
                        </a>

                    </div>
                    <div class="user-item">
                        <a id="edit"class="dropdown-item" href="{{ route('edit.Profile') }}"><i
                                class="fa-solid fa-gear" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>


            <div class="nav-item">
                <a class=" nav-link"href="{{ route('Addmaster.admin') }}">เพิ่มข้อมูลอุปกรณ์</a>
            </div>

            <div class="nav-item">
                <a class=" nav-link"href="{{ route('upload.index') }}">อัปโหลดข้อมูลอุปกรณ์</a>
            </div>
            <div class="nav-item">
                <a class=" nav-link"href="{{ route('borrowhistory.admin') }}">ประวัติการยืม</a>
            </div>
            <div class="nav-item">
                <a class=" nav-link"href="{{ route('retrunhistory.admin') }}">ประวัติการคืน</a>
            </div>
            <div class="nav-item">
                <a class=" nav-link"href="{{ route('ReporHtistory.admin') }}">ประวัติการแจ้งซ่อม</a>
            </div>
            <div class="Nav-item">
                <a class="nav-link" href="{{ route('roleuser.admin') }}">กำหนดสิทธิ์</a>
            </div>



            <div class="nav-item">

                <a class="nav-link " href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ __('ออกจากระบบ') }}
                    <i class="bi bi-box-arrow-right"></i>
                </a>



                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

    </aside>


    <div class="main-container">
        @yield('content')
    </div>
    <script>
        function toggleNav() {
            var sidebar = document.querySelector(".main-sidebar");
            var mainContent = document.querySelector(".main-container");
            var header = document.querySelector(".header");

            // สำหรับหน้าจอที่กว้างกว่า 600px
            if (window.innerWidth > 600) {
                if (sidebar.classList.contains("open")) {
                    sidebar.style.width = "0"; // ปิด sidebar
                    mainContent.style.marginLeft = "0"; // เนื้อหาหลักกลับมาเต็มหน้าจอ
                    header.style.marginLeft = "0"; // header กลับมาเต็มหน้าจอ
                } else {
                    sidebar.style.width = "270px"; // เปิด sidebar กว้าง 250px
                    // เลื่อนเนื้อหาหลักไปทางขวา 250px
                    header.style.marginLeft = "270px"; // เลื่อน header ไปทางขวา 250px
                }

                // Toggle classes for open sidebar and expanded content
                sidebar.classList.toggle("open");
                mainContent.classList.toggle("expanded");
            }
            // สำหรับหน้าจอที่เล็กกว่าหรือเท่ากับ 600px
            else {
                if (sidebar.style.top === "0px") {
                    sidebar.style.top = "-100%"; // ซ่อน sidebar กลับไปด้านบน
                } else {
                    sidebar.style.top = "0"; // เลื่อน sidebar ลงมา
                }

                // Toggle the class to control visibility of sidebar
                sidebar.classList.toggle("open");
            }
        }
    </script>

</body>
