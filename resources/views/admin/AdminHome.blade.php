<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/AdminHome.css') }}">
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-2 sidebar d-flex flex-column p-3">
                <div class="mb-4">
                    <a class="nav-item dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="bi bi-person-circle" style="margin-right: 10px"></i> {{ Auth::user()->name }}
                    </a>
                </div>
                <div class="menu">
                    <li class="menu-item active"><a href="#" onclick="loadPage('/equipment')"><i class="bi bi-house" style="margin-right: 10px"></i>Home</a></li>
                    <li class="menu-item"><a href="#" onclick="loadPage('{{ route('imems.view') }}')"><i class="bi bi-file-earmark-plus" style="margin-right: 10px"></i> Add Master</a></li>
                    <li class="menu-item"><a href="#" onclick="loadPage('{{ route('upload.index') }}')"><i class="bi bi-cloud-download"style="margin-right: 10px"></i> Import</a></li>
                </div>

                
                <div class="nav-item logout"> 
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            
            <div class="col-md-9 content">
                <iframe id="content-frame" src="/equipment"></iframe>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function loadPage(page) {
            document.getElementById('content-frame').src = page;
        }
        $(document).ready(function() {
    $('.menu-item').on('click', function() {
        $('.menu-item').removeClass('active');
        $(this).addClass('active');
    });
});

    </script>
    
</body>
</html>
