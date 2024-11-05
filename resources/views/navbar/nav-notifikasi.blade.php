<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/navbar/nav-form.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
                /* Navbar Custom Styling */
                .navbar-custom {
            padding: 0 60px;
            background-color: #388DD8;
            border-bottom: 2px solid white;
            height: 72px;
        }
                /* Profile Info Styling */
               div .offcanvas-title {
            display: flex;
            align-items: center;
            margin-left: 60px; /* Menambahkan jarak antara tombol kembali dan profil */
        }
    </style>
</head>
<body>
    @if (Auth::user()->role == 'user_edit')
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-custom navbar-light fixed-top">
        <div class="container-fluid">
            <!-- Back button with text -->
            <div class="back-button">
                <button onclick="goBack()">
                    <i class="bi bi-arrow-left"></i> <!-- Bootstrap Icons -->
                </button>
                <h5 class="offcanvas-title">POIN SISWA SMKN 1 KAWALI</h5>
            </div>
        </div>
    </nav>
    {{-- NAVBAR - END --}}

    @elseif (Auth::user()->role == 'admin')
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-custom navbar-light fixed-top">
        <div class="container-fluid">
            <!-- Back button with text -->
            <div class="back-button">
                <button onclick="goBack()">
                    <i class="bi bi-arrow-left"></i> <!-- Bootstrap Icons -->
                </button>
                <h5 class="offcanvas-title">POIN SISWA SMKN 1 KAWALI</h5>
            </div>
        </div>
    </nav>
    {{-- NAVBAR - END --}}
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
