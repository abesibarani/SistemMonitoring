<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem Monitoring Ruangan</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sensor Monitoring<sup>IoT</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Ruangan
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Ruangan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ruangan</h6>
                        <a class="collapse-item" href="{{ route('ruangtengah') }}">Ruang Tengah</a>
                        <a class="collapse-item" href="{{ route('outdoor') }}">Ruang Outdoor</a>
                        <a class="collapse-item" href="{{ route('pantry') }}">Pantry</a>
                        <a class="collapse-item" href="{{ route('restroom') }}">Kamar Tidur</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Monitoring Pantry</h1>

                    <!-- Sensor Data Cards -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Suhu</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="temperature">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-thermometer-half fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Kelembapan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="humidity">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-water fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                CO2</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="co2">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-wind fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Row -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Sensor Suhu</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="temperatureChart" style="max-height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Grafik Sensor Kelembapan</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="humidityChart" style="max-height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-info">Grafik Sensor CO2</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="co2Chart" style="max-height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; Sistem Monitoring Ruangan 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="btn btn-primary"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            // Function to update card data
            function updateCardData(temperature, humidity, co2) {
                $('#temperature').text(parseFloat(temperature).toFixed(1) + ' °C');
                $('#humidity').text(parseFloat(humidity).toFixed(1) + ' %');
                $('#co2').text(parseFloat(co2).toFixed(0) + ' ppm');
            }

            // Function to create and update chart for a sensor
            function createChart(sensorData, chartId, chartLabel, backgroundColor, borderColor) {
                var ctx = document.getElementById(chartId).getContext("2d");
                var sensorChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: sensorData.terminal_time,
                        datasets: [{
                            label: chartLabel,
                            data: sensorData.data.map(value => parseFloat(value).toFixed(1)),
                            backgroundColor: backgroundColor,
                            borderColor: borderColor,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        animation: {
                            duration: 0 // Disable animation
                        },
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    parser: 'YYYY-MM-DD HH:mm:ss',
                                    tooltipFormat: 'HH:mm',
                                    unit: 'minute',
                                    displayFormats: {
                                        minute: 'HH:mm'
                                    },
                                    min: moment().subtract(5, 'minutes').format(
                                    'YYYY-MM-DD HH:mm:ss'), // Show data for the last 5 minutes
                                    max: moment().format('YYYY-MM-DD HH:mm:ss')
                                },
                                title: {
                                    display: true,
                                    text: 'Waktu'
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Function to fetch and update sensor data
            function fetchAndUpdateSensorData() {
                $.ajax({
                    url: '{{ route('getPantryData') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Debug response JSON

                        if (!response.suhu || !response.kelembapan || !response.co2) {
                            console.error("Invalid response format");
                            return;
                        }

                        // Update the cards with the latest data
                        if (response.suhu.terminal_time.length > 0) {
                            var latestIndex = response.suhu.terminal_time.length - 1;
                            updateCardData(response.suhu.data[latestIndex], response.kelembapan.data[
                                latestIndex], response.co2.data[latestIndex]);
                        }

                        // Create and update charts for each sensor
                        createChart(response.suhu, 'temperatureChart', 'Suhu (°C)',
                            'rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)');
                        createChart(response.kelembapan, 'humidityChart', 'Kelembapan (%)',
                            'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 1)');
                        createChart(response.co2, 'co2Chart', 'CO2 (ppm)', 'rgba(255, 206, 86, 0.2)',
                            'rgba(255, 206, 86, 1)');
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                    }
                });
            }

            // Initial fetch and update
            fetchAndUpdateSensorData();

            // Update data every 30 seconds
            setInterval(fetchAndUpdateSensorData, 30000); // 30 seconds
        });
    </script>
</body>

</html>
