<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed List</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/Users/BorrowedList.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('img/borrow_list.png') }}" alt="Product Image" class="product-image">
            <h3 class="user-name">ประวัติการยืมของ <br>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h3>
        </div>

        <table id="equipmentTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ลำดับการยืม</th>
                    <th>ชื่อผู้ยืม</th>
                    <th>ชื่ออุปกรณ์</th>
                    <th>หมายเลขซีเรียล</th>
                    <th>อาคาร</th>
                    <th>ห้อง</th>
                    <th>สถานะ</th>
                    <th>คืนจริง</th>
                    <th>ข้อความ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($returnBorrowings as $returnBorrowing)
                @if (in_array($returnBorrowing->status, ['ยืนยันการคืน', 'รอ']))
                <tr>
                    <td>{{ $returnBorrowing->borrow_id }}</td>
                    <td>{{ $returnBorrowing->user->fname ?? 'N/A' }}
                        {{ $returnBorrowing->user->lname ?? 'N/A' }}
                    </td>
                    <td>{{ $returnBorrowing->equipment_name }}</td>
                    <td>{{ $returnBorrowing->serial_no }}</td>
                    <td>{{ $returnBorrowing->building_no }}</td>
                    <td>{{ $returnBorrowing->room_no }}</td>
                    <td>{{ $returnBorrowing->status }}</td>
                    <td>{{ $returnBorrowing->returned_date }}</td>
                    <td>{{ $returnBorrowing->note }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
