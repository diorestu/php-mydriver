<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" sizes="128x128" href="/images/icons/128x128.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/icons/512x512.png') }}" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Driver BPD Bali - Admin Panel</title>
    @laravelPWA
    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script type="text/javascript">
        function zoom() {
                    document.body.style.zoom = "100%"
                }
    </script>
    @stack('addon-style')


</head>

<body id="page-top" onload="zoom()">
    @include('sweetalert::alert')
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin-dashboard') }}">
                <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}" alt="SID BPD BALI" width="165px">
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin-dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider {{ (Auth::user()->roles > 1) ? 'd-none' : ''}}">
            <!-- Heading -->
            <div class="sidebar-heading {{ (Auth::user()->roles > 1) ? 'd-none' : ''}}">
                Master
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ (Auth::user()->roles > 1) ? 'd-none' : ''}}">
                <a class="nav-link collapsed py-2" data-toggle="collapse" data-target="#one" aria-expanded="true"
                    aria-controls="one">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Karyawan</span>
                </a>
                <div id="one" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('user.create') }}">Tambah Karyawan</a>
                        <a class="collapse-item" href="{{ route('user.index') }}">Lihat Data Karyawan</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ (Auth::user()->roles > 1) ? 'd-none' : ''}}">
                <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#two" aria-expanded="true"
                    aria-controls="two">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Cabang</span>
                </a>
                <div id="two" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('cabang.index') }}">Tambah Cabang</a>
                        <a class="collapse-item" href="{{ route('cabang.create') }}">Lihat Data Cabang</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ (Auth::user()->roles > 1) ? 'd-none' : ''}}">
                <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#three" aria-expanded="true"
                    aria-controls="three">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Unit Kerja</span>
                </a>
                <div id="three" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('unitkerja.index') }}">Tambah Unit Kerja</a>
                        <a class="collapse-item" href="{{ route('unitkerja.create') }}">Lihat Data Unit Kerja</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed py-2 {{ (Auth::user()->roles > 1) ? 'd-none' : ''}}" href="" data-toggle="collapse" data-target="#four" aria-expanded="true"
                    aria-controls="four">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Mobil</span>
                </a>
                <div id="four" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('mobil.create') }}">Tambah Mobil</a>
                        <a class="collapse-item" href="{{ route('mobil.index') }}">Lihat Data Mobil</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider {{ (Auth::user()->roles > 1) ? 'd-none' : ''}}">
            <!-- Heading -->
            <div class="sidebar-heading">
                Manajemen
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed py-2" data-toggle="collapse" data-target="#pageFour" aria-expanded="true"
                    aria-controls="pageFour">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Aktivitas</span>
                </a>
                <div id="pageFour" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('task.index') }}">Lihat Riwayat Aktivitas</a>
                        <a class="collapse-item" href="{{ route('task.create') }}">Buat Aktivitas</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#pageOne"
                    aria-expanded="true" aria-controls="pageOne">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Absensi</span>
                </a>
                <div id="pageOne" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('absensi.index') }}">Lihat Absensi</a>
                        <a class="collapse-item" href="{{ route('absensi.create') }}">Input Absensi</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#pageTwo"
                    aria-expanded="true" aria-controls="pageTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Lembur</span>
                </a>
                <div id="pageTwo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('lembur.index') }}">Lihat Lembur</a>
                        <a class="collapse-item" href="{{ route('lembur.export') }}">Laporan Lembur</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed py-2" href="{{ route('leave.index') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Cuti</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed py-2" data-toggle="collapse" data-target="#pageFive"
                    aria-expanded="true" aria-controls="pageFive">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>BBM</span>
                </a>
                <div id="pageFive" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('bbm.index') }}">Riwayat Pembelian BBM</a>
                        <a class="collapse-item" href="{{ route('bbm.create') }}">Catat Pembelian BBM</a>
                    </div>
                </div>
            </li>
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
                        <!-- Nav Item - Alerts -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li> --}}
                        {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-dark">{{ strtoupper(Auth::user()->name) }}</span>
                                    <img class="img-profile rounded-circle" alt=""
                                        src="{{ (auth()->user()->photos == null) ? asset('frontend/assets/img/user.jpg') : asset('storage/'.auth()->user()->photos)}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('beranda') }}" target="_blank">
                                    <i class="fas fa-app fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Aplikasi
                                </a>
                                {{-- <div class="dropdown-divider"></div> --}}
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
                    @yield('content')
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PT. Asta Pijar Kreasi Teknologi. 2021</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Akhiri sistem?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Logout akan mengakhiri sesi Anda di sistem, lanjutkan?</div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>
    @stack('addon-script')
</body>
</html>
