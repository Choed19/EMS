<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment List</title>
    <link rel="stylesheet" href="{{ asset('CSS/Equipment.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- DataTables Bootstrap JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js">
    </script>

</head>

<body>
    <div class="container">
        <h2 style="text-align: left">Equipment List</h2>
        <div class="mb-3">
            <div class="d-grid">
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="ค้นหา...">
                </div>
            </div>
        </div>

        <table id="equipmentTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Group of Equipment</th>
                    <th>Serial No</th>
                    <th>Name Equipment</th>
                    <th>Cost(Baht)</th>
                    <th>Location</th>
                    <th>Starting Date</th>
                    <th>Status</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipments as $equipment)
                    <tr>
                        <td>{{ $equipment->GroupofEquipment }}</td>
                        <td>{{ $equipment->SerialNo }}</td>
                        <td>{{ $equipment->NameEquipment }}</td>
                        <td>{{ $equipment->cost }}</td>
                        <td>{{ $equipment->location }}</td>
                        <td>{{ $equipment->StartingDate }}</td>
                        <td>{{ $equipment->Status }}</td>
                        <td>{{ $equipment->Company }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#equipmentTable').DataTable({
                "pageLength": 6,
                "lengthChange": false,
                "dom": '<"top">rt<"bottom"ip><"clear">',
            });

            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            window.searchTable = function() {
                table.search($('#searchInput').val()).draw();
            }
        });
    </script>
</body>

</html>
