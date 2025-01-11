<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #388DD8;
            --hover-color: #1676ca;
        }

        /* NAVBAR-START */
        div#offcanvasDarkNavbar.offcanvas.offcanvas-start {
            width: 270px;
        }

        .offcanvas.offcanvas-start {
            background-color: var(--primary-color);
            overflow-y: auto; /* Scroll untuk layar kecil */
        }

        .navbar {
            background-color: var(--primary-color);
            position: fixed;
            height: 67px;
            width: 100%;
        }

        .offcanvas-title {
            color: white;
            font-size: 17px; /* Ukuran teks 17px */
        }

        li.nav-item {
            padding-left: 10px; /* Kurangi padding */
        }

        ul hr {
            color: white;
            margin: 0;
        }

        a.nav-link {
            padding: 15px 0;
        }

        .offcanvas ul li:hover {
            box-shadow: 0 0.5px 5px rgba(0, 0, 0, 0.192);
            background: var(--hover-color);
            border-style: solid;
            border-color: #ffffff;
            border-width: 5px;
            border-right: black;
            border-top: black;
            border-bottom: black;
        }

        .offcanvas ul li .nav-link:hover {
            color: white;
        }

        div.satu {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: center;
            width: 100%;
        }

        h5.offcanvas-title {
            margin-left: 20px;
            font-size: 17px; /* Pastikan ukuran sama */
        }

        div.offcanvas-body {
            padding-top: 0;
            text-align: left !important;
        }

        div.offcanvas-header {
            padding-bottom: 10px;
        }

        .navbar-custom {
            padding: 5px 0 10px 3px; /* Responsif */
            background-color: var(--primary-color);
            border-bottom: 2px solid white;
            height: 67px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .back-button {
            display: flex;
            align-items: center;
        }

        .back-button button {
            color: white;
            background: transparent;
            border: none;
            border-radius: 50%;
            padding: 10px 72px 0 80px; /* Tambahkan padding untuk membuat lebih besar */
            font-size: 20px; /* Tambahkan ukuran teks */
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .back-button .bi-arrow-left {
            font-size: 25px; /* Perbesar ukuran ikon */
        }

        .back-button button:hover {
            background: var(--primary-color);
            transform: scale(1.1);
        }

        .navbar-custom h5 {
            color: white;
            margin-left: 10px;
            margin-bottom: -10px;
            font-size: 17px; /* Ukuran teks 17px */
        }

        .content {
            margin-top: 80px;
            padding: 15px;
        }

        .dropdown-menu {
            background-color: var(--primary-color);
            border: none;
            box-shadow: none;
        }

        .dropdown-item {
            color: white;
            transition: background-color 0.3s ease;
            padding: 10px;
            font-size: 14px;
        }

        .dropdown-item:hover {
            background-color: var(--hover-color);
        }

        @media (max-width: 576px) {
            div#offcanvasDarkNavbar.offcanvas.offcanvas-start {
                width: 100%; /* Responsif */
            }

            .navbar-custom {
                padding: 5px 0 10px 3px; /* Responsif */

            }
            
            .navbar-custom h5 {
                font-size: 14px;
                font-size: 17px; /* Sesuaikan ukuran font */
            }

            .back-button button {
                padding: 10px 32px 0 33px; /* Tambahkan padding untuk membuat lebih besar */
            }

            .content {
                margin-top: 72px;
            }
        }
 
/* Default styling for navbar logo */
.navbar img {
        width: 48px; /* Default width */
        height: auto;
        margin-left: auto; /* Push logo to the right */
        margin-right: 55px;

    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .navbar img {
            width: 36px; /* Adjust size for smaller screens */
            margin-right: 15px; /* Adjust margin for alignment */
        }
        .offcanvas-title {
            font-size: 16px; /* Reduce font size for mobile */
        }
        
        .satu h5 {
            margin-left: 10px; /* Adjust margin for better alignment */
        }
        
        .navbar-toggler {
            margin-left: 10px; /* Adjust toggle button margin for better placement */
        }
    }

    @media (max-width: 576px) {
        .navbar img {
            width: 32px; /* Smaller logo for extra small screens */
            margin-right: 10px;
        }
    }

        /* NAVBAR-END */
    </style>
</head>
<body>
    @if (Auth::user()->role == 'user_edit')
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-custom navbar-light fixed-top">
        <div class="container-fluid d-flex align-items-center">
            <!-- Back button -->
            <div class="back-button d-flex align-items-center">
                <button onclick="goBack()">
                    <i class="bi bi-arrow-left"></i> <!-- Bootstrap Icons -->
                </button>
                <h5 class="offcanvas-title ms-2">POIN SISWA SMKN 1 KAWALI</h5>
            </div>
            <!-- Logo -->
            <img src="{{ asset('storage/smkn1kawali.png') }}" alt="Logo" class="ms-auto">
        </div>
    </nav>
    {{-- NAVBAR - END --}}
    
    @elseif (Auth::user()->role == 'admin')
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-custom navbar-light fixed-top">
        <div class="container-fluid d-flex align-items-center">
            <!-- Back button -->
            <div class="back-button d-flex align-items-center">
                <button onclick="goBack()">
                    <i class="bi bi-arrow-left"></i> <!-- Bootstrap Icons -->
                </button>
                <h5 class="offcanvas-title ms-2">POIN SISWA SMKN 1 KAWALI</h5>
            </div>
            <!-- Logo -->
            <img src="{{ asset('storage/smkn1kawali.png') }}" alt="Logo" class="ms-auto">
        </div>
    </nav>
    @else
    {{-- Logout user if the role is not valid --}}
    @php
        Auth::logout();
    @endphp
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endif

    <!-- Main content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Tambahkan JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        // Function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
