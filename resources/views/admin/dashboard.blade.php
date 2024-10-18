@extends('layouts.Adminapp')

@section('content')
    {{-- Figma icon --}}
    <link href="https://cdn.jsdelivr.net/npm/figma-icons/css/all.min.css" rel="stylesheet">
    {{-- Link --}}
    <link rel="stylesheet" href="{{ asset('../css/admin/dashboard.css') }}">

    <!-- Import Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <div class="container"> --}}
    <div class="container">
        <div class="row">
            <!-- Small cards -->
            <div id='box1' class="small-box">
                <div class="inner">
                    <h3>{{ $equipmentCount }}</h3>
                    <p>อุปกรณ์ครุภัณฑ์</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <a href="{{route('admin.equipment')}}" class="small-box-footer">
                    รายละเอียด <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div id='box2' class="small-box">
                <div class="inner">
                    <h3>{{ $BorrowEquipmentCount }}</h3>
                    <p>ยืมครุภัณฑ์</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding"></i>
                </div>
                <a href="{{ route('borrowings.admin') }}" class="small-box-footer">
                    รายละเอียด <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div id='box3' class="small-box">
                <div class="inner">
                    <h3>{{ $ReturnEquipmentCount }}</h3>
                    <p>คืนอุปกรณ์</p>
                </div>
                <div class="icon">
                    <i class="fas fa-undo"></i>
                </div>
                <a href="{{ route('admin.return') }}" class="small-box-footer">
                    รายละเอียด <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div id='box4' class="small-box">
                <div class="inner">
                    <h3>{{ $ReportEquipmentCount }}</h3>
                    <p>แจ้งซ่อม</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <a href="{{ route('report.admin') }}" class="small-box-footer">
                    รายละเอียด <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div> <!-- End of .row -->
        <br><br><br>
        {{-- <div class="chart-container" style="width:1600px;align-item:left;">
            <!-- Borrowing Chart -->
            <div class="chart">
                <canvas id="borrowingChart"></canvas>
            </div>
        </div> --}}
    </div> <!-- End of .container -->




    <!-- Script for borrowing data by month chart -->
    {{-- <script>
        const ctx = document.getElementById('borrowingChart').getContext('2d');

        // Monthly data from Laravel controller
        const months = @json($months);
        const borrowCounts = @json($borrowCounts);
        const returnCounts = @json($returnCounts);
        const reportCounts = @json($reportCounts);

        const borrowingsChart = new Chart(ctx,  {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                        label: 'Borrowings',
                        data: borrowCounts,
                        
                        backgroundColor: 'rgba(207, 105, 233,1)', // Bar color for borrowings
                        borderColor: 'rgba(94, 52, 210, 1)', // Border color
                        borderWidth: 2
                    },
                    {
                        label: 'Returns',
                        data: returnCounts,
                        backgroundColor: 'rgba(234, 122, 10, 1)', // Bar color for returns
                        borderColor: 'rgba(248, 75, 18, 1)', // Border color
                        borderWidth: 2
                    },
                    {
                        label: 'Reports',
                        data: reportCounts,
                        backgroundColor: 'rgba(227, 245, 64, 1)', // Bar color for reports
                        borderColor: 'rgba(216, 184, 0, 1)', // Border color
                        borderWidth: 2
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true, // Ensure y-axis starts at 0
                        ticks: {
                            stepSize: 5, // Set step size of 5
                            max: 50 // Maximum value of y-axis
                        }
                    }
                },
                responsive: true, // Ensure the chart is responsive
                plugins: {
                    legend: {
                        position: 'top', // Position the legend at the top
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script> --}}
@endsection