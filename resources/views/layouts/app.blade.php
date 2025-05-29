<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smart Parking IOT</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('layouts.sidebar')
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('layouts.navbar')
        <div class="container-fluid py-4">
            @yield('content')
            @include('layouts.footer')
        </div>
    </main>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/soft-ui-dashboard.js') }}"></script>
    
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Firebase -->
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
        import { getDatabase } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBW3o5yLi2KL6ukMvBAasmFLU9YHN2IpY8",
            authDomain: "steinlie-realtime.firebaseapp.com",
            databaseURL: "https://steinlie-realtime-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "steinlie-realtime",
            storageBucket: "steinlie-realtime.appspot.com",
            messagingSenderId: "324833723114",
            appId: "1:324833723114:web:e0f40337c88722f20c0d93",
            measurementId: "G-X7HFCJ9287"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const db = getDatabase(app);

        // Make Firebase instances available globally
        window.db = db;
    </script>

    <!-- Template JS -->
    <script src="/assets/js/argon-dashboard.js"></script>

    @stack('scripts')
</body>
</html> 