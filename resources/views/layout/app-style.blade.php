<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Website Peminjaman RPL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('asset-image/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/general-sans" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('style')

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <img src="{{ asset('asset-image/logo.png') }}" alt="">
                <span class="d-none d-sm-block"
                    style="font-family: 'Bebas Neue', sans-serif; font-weight:700;font-style: italic;color:black">SOFTWARE
                    ENGINEERING</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
            {{-- WOW, MY NAME SHOWED ON THIS LIST, AMAZINGGAGAGAGAGAGGAGAGAG --}}
            @if (session()->has('username'))
                <a class="user-welcoming nav-link nav-profile d-flex align-items-center pe-0" href="#"
                    data-bs-toggle="dropdown">
                    <span class="d-none d-md-block ps-2" id="username"></span>
                </a>
            @else
                <a class="user-welcoming nav-link nav-profile d-flex align-items-center pe-0" href="#"
                    data-bs-toggle="dropdown">
                    <span class="d-none d-md-block ps-2">Selamat Datang, Guest</span>
                </a>
            @endif


        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('asset-image/profile-default.png') }}" alt="Profile"
                            class="rounded-circle">
                        {{-- session has username blablabla role shit --}}
                        @if (session()->has('username'))
                            <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('username') }}</span>
                        @else
                            <span class="d-none d-md-block ps-2">Guest</span>
                        @endif

                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            {{-- fungsi gacor kangggangwjiajfeuoipfjhbojdfeuiuiojofuw --}}
                            @if (session()->has('username') && session()->has('role'))
                                <h6>{{ session('username') }} ({{ session('role') }})</h6>
                            @else
                                <h6>Guest</h6>
                            @endif
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->


                <!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading" style="font-family: 'General Sans', sans-serif;font-weight:300">Menu</li>
            <hr>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('datapinjam.index') ? 'active' : '' }}"
                    href="{{ route('datapinjam.index') }}">
                    <i class="bi bi-grid"></i>
                    <span style="font-family: 'General Sans', sans-serif;font-weight:300">Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            @if (session('role') == 'Admin' || session('role') == '1')
                <li class="nav-item">
                    <a class="nav-link collapsed {{ request()->routeIs('databarang.index') ? 'active' : '' }}"
                        href="{{ route('databarang.index') }}">
                        <i class="bi bi-person"></i>
                        <span style="font-family: 'General Sans', sans-serif;font-weight:300">Data Barang</span>
                    </a>
                </li><!-- End Profile Page Nav -->
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed {{ request()->routeIs('datapinjam.formpinjam') ? 'active' : '' }}"
                    href="{{ route('datapinjam.formpinjam') }}">
                    <i class="bi bi-question-circle"></i>
                    <span style="font-family: 'General Sans', sans-serif;font-weight:300">Form Peminjaman</span>
                </a>
            </li><!-- End F.A.Q Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed {{ request()->routeIs('datapinjam.laporan') ? 'active' : '' }}"
                    href="{{ route('datapinjam.laporan') }}">
                    <i class="bi bi-envelope"></i>
                    <span style="font-family: 'General Sans', sans-serif;font-weight:300">Laporan Peminjaman</span>
                </a>
            </li><!-- End Contact Page Nav -->
            <hr>


        </ul>

    </aside><!-- End Sidebar-->

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Rifky & Raden</span>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            <a href="">All Right Reserved</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                strings: ["Selamat Datang, {{ session('username') }}",
                "Di website peminjaman jurusan RPL",
                ],
                typeSpeed: 80,
                backSpeed: 50,
                backDelay: 2000,
                startDelay: 500,
                loop: true,
                showCursor: true,
            };
            var typed = new Typed('#username', options);
        });
    </script>
    <!-- Template Main JS File -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('script')

</body>

</html>
