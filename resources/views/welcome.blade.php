<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking IOT - Ultimate Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #1a2980;
            --secondary-color: #26d0ce;
            --bg-dark: #0f172a;
            --bg-light-transparent: rgba(255, 255, 255, 0.07);
            --border-color: rgba(255, 255, 255, 0.1);
            --text-primary: #ffffff;
            --text-secondary: #a0aec0;
            --success-color: #10b981; /* Green */
            --warning-color: #f59e0b; /* Orange */
            --danger-color: #ef4444; /* Red */
            --info-color: #3b82f6; /* Blue */
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-secondary);
        }

        /* --- Navbar --- */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            padding: 1rem 0;
            background-color: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            color: var(--text-primary) !important;
            font-weight: 700;
            font-size: 1.75rem;
        }

        .navbar-nav .nav-item {
            margin: 0 1rem;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            cursor: pointer;
        }
        .nav-link:hover,
        .navbar-brand:hover,
        .nav-link.active {
            color: var(--secondary-color) !important;
        }

        .nav-link.dropdown-toggle::after {
            margin-left: 0.6rem;
            vertical-align: middle;
        }

        .dropdown-menu {
            background-color: rgba(30, 41, 59, 0.9);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
        }
        .dropdown-item.active,
        .dropdown-item:active {
            color: var(--secondary-color); /* This makes the text of the active dropdown item your theme's secondary color */
            text-decoration: none;
            background-color: var(--bg-light-transparent); /* This sets the background of the active dropdown item to your theme's light transparent background */
        }
        .dropdown-item {
            color: var(--text-secondary);
            cursor: pointer;
        }
        .dropdown-item:hover {
            background-color: var(--bg-light-transparent);
            color: var(--secondary-color);
        }

        .btn-dashboard-nav {
            background: var(--secondary-color);
            color: var(--bg-dark);
            border: 2px solid var(--secondary-color);
            padding: 8px 24px;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        .btn-dashboard-nav:hover {
            background: transparent;
            color: var(--secondary-color);
            border: 1px solid var(--secondary-color);
        }

        /* --- Main Content Area --- */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding-top: 140px;
        }

        .content-section {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        .content-section.active {
            /*display: block;*/
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Hero Section --- */
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 80px;
            background: linear-gradient(
                    135deg,
                    var(--primary-color) 0%,
                    var(--bg-dark) 100%
            );
        }
        .hero-section .display-3 {
            font-weight: 700;
        }
        .hero-section .lead {
            font-size: 1.25rem;
            color: var(--text-secondary);
        }
        .btn-cta {
            background: var(--secondary-color);
            color: var(--bg-dark);
            border-radius: 50px;
            padding: 16px 40px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }
        .btn-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(38, 208, 206, 0.2);
        }

        /* --- Cards & Components --- */
        .content-card {
            background: var(--bg-light-transparent);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 2.5rem;
            color: var(--text-primary);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
            margin-bottom: 2.5rem;
        }
        .content-card .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 0 0 1.5rem 0;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: var(--text-primary);
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        /* --- Form & Table Enhancements --- */
        .form-label {
            color: var(--text-secondary);
            font-weight: 500;
        }
        .form-control,
        .form-select {
            background-color: rgba(0, 0, 0, 0.25);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }
        .form-control:focus,
        .form-select:focus {
            background-color: rgba(0, 0, 0, 0.3);
            color: var(--text-primary);
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(38, 208, 206, 0.25);
        }
        .modal-content {
            background-color: #1e293b;
            border: 1px solid var(--secondary-color);
            border-radius: 1rem;
        }
        .table {
            color: var(--text-secondary);
        }
        .table thead th {
            color: var(--text-primary);
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table tbody tr {
            border-color: var(--border-color);
        }
        .table > :not(caption) > * > * {
            padding: 1rem;
        }

        /* --- Enhanced Parking Slot Status --- */
        .slot-card {
            background: var(--bg-light-transparent);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .slot-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .slot-card .slot-icon {
            font-size: 2.5rem;
        }
        .slot-card .slot-number {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-top: 1rem;
        }
        .slot-card .slot-status {
            font-weight: 500;
        }
        .slot-card.available .slot-icon,
        .slot-card.available .slot-status {
            color: #34d399;
        }
        .slot-card.occupied .slot-icon,
        .slot-card.occupied .slot-status {
            color: #f87171;
        }

        /* --- Pusat Pemantauan Dashboard Parkir Motor dan Mobil --- */
        .glass-card {
            background: var(--bg-light-transparent);
            backdrop-filter: blur(12px); /* Slightly more blur */
            border: 1px solid var(--border-color);
            border-radius: 18px; /* Slightly more rounded */
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* Smoother transition */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Initial subtle shadow */
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .glass-card:hover {
            transform: translateY(-7px); /* More pronounced lift */
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4); /* Stronger shadow on hover */
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--text-primary);
        }

        .text-white {
            color: var(--text-primary) !important;
        }

        .text-secondary {
            color: var(--text-secondary) !important;
        }

        /* Custom Scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(
                    180deg,
                    var(--secondary-color),
                    var(--primary-color)
            );
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(
                    180deg,
                    var(--secondary-color) 90,
                    var(--primary-color) 90
            );
        }

        /* --- Header --- */
        .header-title {
            background: linear-gradient(
                    135deg,
                    var(--text-primary),
                    var(--secondary-color)
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 3.5rem; /* Slightly larger */
            text-align: center;
            margin-bottom: 0.75rem;
            animation: fadeInDown 1s ease-out; /* Animation */
        }

        .header-subtitle {
            color: var(--text-secondary);
            text-align: center;
            font-size: 1.3rem; /* Slightly larger */
            margin-bottom: 4rem; /* More space */
            animation: fadeInUp 1s ease-out 0.2s forwards; /* Animation with delay */
            opacity: 0; /* Hidden initially */
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Metric Cards --- */
        .metric-card {
            text-align: center;
            padding: 2.2rem; /* Slightly more padding */
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px; /* Thicker accent line */
            background: linear-gradient(
                    90deg,
                    var(--secondary-color),
                    var(--primary-color)
            );
        }

        .metric-number {
            font-size: 2.8rem; /* Larger number */
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .metric-label {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 1rem; /* Slightly larger label */
            opacity: 0.8;
        }

        /* --- Parking Slots ENHANCED --- */
        .slot-grid {
            /* This is the container div.slot-grid in your HTML */
            display: grid; /* Keep the grid for multiple columns */
            grid-template-columns: repeat(
        auto-fit,
        minmax(140px, 1fr)
    ); /* More flexible grid */
            gap: 1.2rem; /* Slightly more gap */
            flex-grow: 1; /* Important for taking remaining space in glass-card */
        }

        .parking-slot {
            position: relative;
            z-index: 1;
            padding: 1.8rem; /* More padding */
            border-radius: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            width: 100%; /* Each slot card will take full width of its grid column */
            box-sizing: border-box; /* Ensure padding doesn't add to width */
            display: flex; /* Make each slot a flex container */
            flex-direction: column; /* Icon and text content will stack vertically */
            align-items: center; /* Center horizontally */
            justify-content: center; /* Center vertically */
            gap: 0.8rem; /* Space between icon and text elements */
            text-align: center; /* Center text within the slot */
        }

        .parking-slot.available {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }

        .parking-slot.occupied {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        /* Style for the car icon */
        .parking-slot .slot-icon {
            font-size: 3.5rem; /* Larger icon size */
            color: rgba(255, 255, 255, 0.25); /* More visible, yet subtle */
            opacity: 0.9;
            margin-bottom: 0.5rem; /* Space between icon and info */
        }

        /* Text information for the slot (e.g., "Slot 1") */
        .parking-slot .slot-info {
            font-size: 1.2rem; /* Larger slot info */
            margin-bottom: 0.4rem; /* Reduced margin for tighter look */
            font-weight: 700;
        }

        /* Status text for the slot (e.g., "Kosong") */
        .parking-slot .slot-status {
            font-size: 0.95rem; /* Slightly larger status */
            opacity: 0.95;
            font-weight: 500;
        }

        /* Additional details for occupied slots */
        .parking-slot .slot-details {
            font-size: 0.75rem; /* Slightly larger details */
            margin-top: 0.7rem; /* Space after status */
            opacity: 0.85;
            line-height: 1.4;
        }

        /* Override hover style for parking-slot */
        .parking-slot:hover {
            transform: translateY(-3px) scale(1.02); /* Slight lift and scale on hover */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-color: var(--secondary-color); /* Highlight on border */
        }

        .system-health {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem; /* More padding */
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            margin-top: 2rem; /* More space */
        }

        .system-health > div:first-child {
            display: flex;
            align-items: center;
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-right: 0.6rem;
            vertical-align: middle;
        }

        .status-online {
            background: var(--secondary-color);
            box-shadow: 0 0 12px rgba(38, 208, 206, 0.7); /* Stronger glow */
            animation: pulse 2s infinite cubic-bezier(0.4, 0, 0.6, 1); /* Smoother pulse */
        }

        .status-offline {
            background: var(--danger-color);
        }

        @keyframes pulse {
            0% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* --- Charts --- */
        .chart-container {
            position: relative;
            flex-grow: 1;
            height: auto;
            max-height: 640px;
            padding: 1.5rem; /* More padding */
        }

        .btn-group .btn {
            border-radius: 10px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.7);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-group .btn.active {
            background: linear-gradient(
                    90deg,
                    var(--secondary-color),
                    var(--primary-color)
            );
            color: var(--text-primary);
            border-color: transparent;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-group .btn:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* --- Quick Stats --- */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(
        auto-fit,
        minmax(130px, 1fr)
    ); /* Adjusted grid */
            gap: 1.2rem; /* More gap */
            position: relative;
            overflow: hidden;
        }

        .quick-stat-item {
            text-align: center;
            padding: 1.5rem; /* More padding */
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px; /* More rounded */
            /* border: 1px solid var(--border-color); Ini adalah border solid standar */
            transition: all 0.3s ease;
            /* Penting: Set position ke relative agar pseudo-element ::before bisa diposisikan absolut di dalamnya */
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .quick-stat-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px; /* Tebal garis */
            background: linear-gradient(
                    90deg,
                    var(--secondary-color),
                    var(--primary-color)
            ); /* Gradien untuk garis */
            border-top-left-radius: 12px; /* Ikuti border-radius induk */
            border-top-right-radius: 12px; /* Ikuti border-radius induk */
        }

        .quick-stat-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .quick-stat-number {
            font-size: 1.8rem; /* Larger number */
            font-weight: 700;
            color: var(--secondary-color);
        }

        .quick-stat-label {
            font-size: 0.9rem; /* Slightly larger label */
            color: var(--text-secondary);
            margin-top: 0.4rem;
            opacity: 0.9;
        }

        /* --- Recent Activity --- */
        .activity-item {
            display: flex;
            align-items: center;
            padding: 1.2rem; /* More padding */
            border-bottom: 1px solid rgba(255, 255, 255, 0.08); /* Lighter border */
            transition: all 0.3s ease;
        }

        .activity-item:last-child {
            border-bottom: none; /* No border on last item */
        }

        .activity-item:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .activity-icon {
            min-width: 45px; /* Larger icon */
            height: 45px; /* Larger icon */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.2rem; /* More space */
            font-size: 1.4rem; /* Larger icon font */
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .activity-icon.entry {
            background: linear-gradient(
                    135deg,
                    var(--secondary-color),
                    var(--success-color)
            );
        }

        .activity-icon.exit {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
        }

        /* --- Alert Panel --- */
        .alert-panel {
            position: fixed;
            top: 25px; /* Slightly lower */
            right: 25px; /* Slightly more to the right */
            max-width: 560px; /* Slightly wider */
            z-index: 1050;
        }

        .custom-alert {
            background: rgba(255, 255, 255, 0.1); /* Slightly more opaque */
            backdrop-filter: blur(15px); /* More blur */
            border: 1px solid rgba(255, 255, 255, 0.15); /* Slightly stronger border */
            color: var(--text-primary);
            border-radius: 14px; /* More rounded */
            margin-bottom: 1.2rem; /* More space between alerts */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.4s ease-out; /* Smoother animation */
        }

        .custom-alert .btn-close {
            filter: invert(1); /* Ensure close button is visible */
            opacity: 0.7;
            font-size: 0.8rem;
            padding: 0.8rem;
        }
        .custom-alert .btn-close:hover {
            opacity: 1;
        }

        /* Specific alert styles for better visual cues */
        .custom-alert.alert-info {
            border-left: 5px solid var(--info-color);
        }
        .custom-alert.alert-warning {
            border-left: 5px solid var(--warning-color);
        }
        .custom-alert.alert-danger {
            border-left: 5px solid var(--danger-color);
        }
        .custom-alert.alert-success {
            border-left: 5px solid var(--success-color);
        }

        .progress-custom {
            height: 10px; /* Thicker progress bar */
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            overflow: hidden;
            margin-top: 0.75rem;
        }

        .progress-bar-custom {
            height: 100%;
            background: linear-gradient(
                    90deg,
                    var(--secondary-color),
                    var(--primary-color)
            );
            border-radius: 5px;
            transition: width 0.5s ease-out; /* Smoother transition */
        }

        /* --- Loading Spinner --- */
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--border-color);
            border-top: 4px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }
        .table-dark-custom {
            background-color: black !important;
            color: white !important;
        }

        .table-dark-custom th,
        .table-dark-custom td {
            background-color: #1e293b !important;
            color: white !important;
            border-color: #333 !important;
        }
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.6em;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
        }

        .badge-md {
            font-size: 0.65rem;
            padding: 1.5em 1.8em;
        }

        /* Gradient for primary (e.g., 'ktm') */
        .bg-gradient-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
        }

        /* Gradient for success */
        .bg-gradient-success {
            background: linear-gradient(45deg, #28a745, #1e7e34);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#" onclick="showSection('pusat-pemantauan-dashboard-parkir-motor')">SmartParking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"
                    style="background-image: url(\" data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30' %3e%3cpath stroke='rgba(255,255,255,0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22' /%3e%3c/svg%3e\");"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link active" onclick="showSection('pusat-pemantauan-dashboard-parkir-motor')">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown">Manajemen Parkir</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="showSection('parkir-motor')">Parkir Motor</a></li>
                            <li><a class="dropdown-item" onclick="showSection('parkir-mobil')">Parkir Mobil</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Data
                            Master</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="showSection('mahasiswa')">Data Mahasiswa</a></li>
                            <li><a class="dropdown-item" onclick="showSection('portal')">Kelola Portal</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-lg-3"><a href="/dashboard" class="btn btn-dashboard-nav">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content">
        {{-- Pusat Pemantauan Dashboard Parkir Motor --}}
        <div id="pusat-pemantauan-dashboard-parkir-motor" class="content-section active">
            <div class="container">
                <div class="d-flex justify-content-end align-items-center pb-4">
                    <div class="btn-group btn-group-sm" role="group" id="dashboardSectionToggleButtons">
                        <button type="button" class="btn btn-outline-light active" onclick="showSection('pusat-pemantauan-dashboard-parkir-motor')">Dashboard Motor</button>
                        <button type="button" class="btn btn-outline-light" onclick="showSection('pusat-pemantauan-dashboard-parkir-mobil')">Dashboard Mobil</button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <h1 class="header-title section-title">SmartParking Dashboard</h1>
                        <p class="header-subtitle">Monitoring Parkir Motor Real-time</p>
                    </div>
                </div>

                <div class="row mb-5 align-items-stretch">
                    <div class="col-lg-7 col-md-12 mb-4 mb-lg-4">
                        <div class="glass-card h-100 d-flex flex-column gap-3">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="fa-solid fa-motorcycle me-2"></i>Status Slot Parkir</h5>
                            </div>
                            <div class="slot-grid px-4" id="slotGridMotor"></div>
                            <div class="pb-4 px-4">
                                <div class="system-health mt-auto d-flex flex-row align-items-center">
                                    <div>
                                        <span id="statusIndicatorMotor" class="status-indicator"></span>
                                        <strong class="text-white">Sistem Operasional</strong>
                                    </div>
                                    <div class="text-end">
                                        <span id="jamOperasionalMotor">Memuat...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 mb-4 mb-lg-4">
                        <div class="row h-100">
                            <div class="col-6 mb-4">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                                        <div class="metric-number" id="occupancyRateMotor">0%</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-chart-pie me-2"></i>Tingkat Okupansi
                                        </div>
                                        <div class="progress-custom mt-3 w-100">
                                            <div class="progress-bar-custom" id="progressBarMotor" style="width: 0%"></div>
                                        </div>
                                        <small class="text-secondary d-block mt-2 w-100" style="font-size: 0.75rem;">Persentase slot terisi dari total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="metric-number" style="color: var(--success-color);" id="todayEntryMotor">0</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-right-to-bracket me-2"></i>Kendaraan Masuk Hari Ini
                                        </div>
                                        <small class="text-secondary d-block mt-2" style="font-size: 0.75rem;">Total mobil masuk per hari ini</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="metric-number" style="color: var(--warning-color);" id="peakHourMotor">--:--</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-clock me-2"></i>Jam Masuk Paling Ramai
                                        </div>
                                        <small class="text-secondary d-block mt-2 text-center" style="font-size: 0.75rem;">Waktu paling banyak kendaraan masuk hari ini</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card metric-card h-100">
                                    <div class="metric-number" style="color: var(--info-color);" id="lastEntryTimeMotor">--:--</div>
                                    <div class="metric-label">
                                        <i class="fa-solid fa-clock me-2"></i>Kendaraan Masuk Terakhir
                                    </div>
                                    <small class="text-secondary d-block mt-2" style="font-size: 0.75rem;">Berdasarkan waktu masuk terakhir hari ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-graph-up me-2"></i>Penggunaan Parkir</h5>
                                <div class="btn-group btn-group-sm" role="group" id="chartToggleButtonsMotor">
                                    <button type="button" class="btn btn-outline-light active" onclick="toggleChartMotor('hourly')">Per Jam</button>
                                    <button type="button" class="btn btn-outline-light" onclick="toggleChartMotor('weekly')">Mingguan</button>
                                </div>
                            </div>
                            <div class="chart-container" style="height: 380px;">
                                <canvas id="usageChartMotor"></canvas>
                                <div id="noDataMotorHourlyMessage" style="display: none; text-align: center; color: #a0aec0; font-size: 1.1em; height: 100%; justify-content: center; align-items: center;">
                                    Tidak Ada Data Per Jam
                                </div>
                                <div id="noDataMotorWeeklyMessage" style="display: none; text-align: center; color: #a0aec0; font-size: 1.1em; height: 100%; justify-content: center; align-items: center;">
                                    Tidak Ada Data Mingguan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-pie-chart me-2"></i>Metode Akses</h5>
                            </div>
                            <div class="chart-container">
                                <canvas id="accessChartMotor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-speedometer2 me-2"></i>Quick Stats</h5>
                            </div>
                            <div class="quick-stats p-4">
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="currentAvailableSlotsMotor">XX</div>
                                    <div class="quick-stat-label">Slot Tersedia</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="topDepartmentMotor">TI</div>
                                    <div class="quick-stat-label">Top Jurusan</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="trafficComparisonMotor">+15%</div>
                                    <div class="quick-stat-label">Lalu Lintas vs Kemarin</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="topAccessMotor">...</div>
                                    <div class="quick-stat-label">Akses Terbanyak</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="fa fa-building me-2"></i>Distribusi Jurusan</h5>
                            </div>
                            <div class="chart-container">
                                <canvas id="departmentChartMotor" style="height: 300px;"></canvas>
                                <div id="noDataDepartmentMotorMessage" style="display: none; text-align: center; color: #a0aec0; font-size: 1.1em; height: 100%; display: flex; justify-content: center; align-items: center;">
                                    Tidak Ada Data Jurusan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-clock-history me-2"></i>Aktivitas Terbaru</h5>
                            </div>
                            <div id="recentActivityMotor" style="max-height: 680px; overflow-y: auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pusat Pemantauan Dashboard Parkir Mobil --}}
        <div id="pusat-pemantauan-dashboard-parkir-mobil" class="content-section">
            <div class="container">
                <div class="d-flex justify-content-end align-items-center pb-4">
                    <div class="btn-group btn-group-sm" role="group" id="dashboardSectionToggleButtons">
                        <button type="button" class="btn btn-outline-light" onclick="showSection('pusat-pemantauan-dashboard-parkir-motor')">Dashboard Motor</button>
                        <button type="button" class="btn btn-outline-light active" onclick="showSection('pusat-pemantauan-dashboard-parkir-mobil')">Dashboard Mobil</button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <h1 class="header-title section-title">SmartParking Dashboard</h1>
                        <p class="header-subtitle">Monitoring Parkir Mobil Real-time</p>
                    </div>
                </div>

                <div class="row mb-5 align-items-stretch">
                    <div class="col-lg-7 col-md-12 mb-4 mb-lg-4">
                        <div class="glass-card h-100 d-flex flex-column gap-3">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-car-front me-2"></i>Status Slot Parkir</h5>
                            </div>
                            <div class="slot-grid px-4" id="slotGridMobil"></div>
                            <div class="pb-4 px-4">
                                <div class="system-health mt-auto d-flex flex-row align-items-center">
                                    <div>
                                        <span id="statusIndicatorMobil" class="status-indicator"></span>
                                        <strong class="text-white">Sistem Operasional</strong>
                                    </div>
                                    <div class="text-end">
                                        <span id="jamOperasionalMobil">Memuat...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 mb-4 mb-lg-4">
                        <div class="row h-100">
                            <div class="col-6 mb-4">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                                        <div class="metric-number" id="occupancyRateMobil">0%</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-chart-pie me-2"></i>Tingkat Okupansi
                                        </div>
                                        <div class="progress-custom mt-3 w-100">
                                            <div class="progress-bar-custom" id="progressBarMobil" style="width: 0%"></div>
                                        </div>
                                        <small class="text-secondary d-block mt-2 w-100" style="font-size: 0.75rem;">Persentase slot terisi dari total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="metric-number" style="color: var(--success-color);" id="todayEntryMobil">0</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-right-to-bracket me-2"></i>Kendaraan Masuk Hari Ini
                                        </div>
                                        <small class="text-secondary d-block mt-2" style="font-size: 0.75rem;">Total mobil masuk per hari ini</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="metric-number" style="color: var(--warning-color);" id="peakHourMobil">--:--</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-clock me-2"></i>Jam Masuk Paling Ramai
                                        </div>
                                        <small class="text-secondary d-block mt-2 text-center" style="font-size: 0.75rem;">Waktu paling banyak kendaraan masuk hari ini</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card metric-card h-100">
                                    <div class="metric-number" style="color: var(--info-color);" id="lastEntryTimeMobil">--:--</div>
                                    <div class="metric-label">
                                        <i class="fa-solid fa-clock me-2"></i>Kendaraan Masuk Terakhir
                                    </div>
                                    <small class="text-secondary d-block mt-2" style="font-size: 0.75rem;">Berdasarkan waktu masuk terakhir hari ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-graph-up me-2"></i>Penggunaan Parkir</h5>
                                <div class="btn-group btn-group-sm" role="group" id="chartToggleButtonsMobil">
                                    <button type="button" class="btn btn-outline-light active" onclick="toggleChartMobil('hourly')">Per Jam</button>
                                    <button type="button" class="btn btn-outline-light" onclick="toggleChartMobil('weekly')">Mingguan</button>
                                </div>
                            </div>
                            <div class="chart-container" style="height: 380px;">
                                <canvas id="usageChartMobil"></canvas>
                                <div id="noDataMobilHourlyMessage" style="display: none; text-align: center; color: #a0aec0; font-size: 1.1em; height: 100%; justify-content: center; align-items: center;">
                                    Tidak Ada Data Per Jam
                                </div>
                                <div id="noDataMobilWeeklyMessage" style="display: none; text-align: center; color: #a0aec0; font-size: 1.1em; height: 100%; justify-content: center; align-items: center;">
                                    Tidak Ada Data Mingguan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-pie-chart me-2"></i>Metode Akses</h5>
                            </div>
                            <div class="chart-container">
                                <canvas id="accessChartMobil"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-speedometer2 me-2"></i>Quick Stats</h5>
                            </div>
                            <div class="quick-stats p-4">
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="currentAvailableSlotsMobil">XX</div>
                                    <div class="quick-stat-label">Slot Tersedia</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="topDepartmentMobil">TI</div>
                                    <div class="quick-stat-label">Top Jurusan</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="trafficComparisonMobil">+15%</div>
                                    <div class="quick-stat-label">Lalu Lintas vs Kemarin</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="topAccessMobil">...</div>
                                    <div class="quick-stat-label">Akses Terbanyak</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="fa fa-building me-2"></i>Distribusi Jurusan</h5>
                            </div>
                            <div class="chart-container">
                                <canvas id="departmentChartMobil" style="height: 300px;"></canvas>
                                <div id="noDataDepartmentMessage" style="display: none; text-align: center; color: #a0aec0; font-size: 1.1em; height: 100%; display: flex; justify-content: center; align-items: center;">
                                    Tidak Ada Data Jurusan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-clock-history me-2"></i>Aktivitas Terbaru</h5>
                            </div>
                            <div id="recentActivityMobil" style="max-height: 680px; overflow-y: auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parkir Motor Section -->
        <div id="parkir-motor" class="content-section">
            <x-motorcycle.page />
        </div>

        <!-- Parkir Mobil Section -->
        <div id="parkir-mobil" class="content-section">
            <x-car.page />
        </div>

        <!-- Mahasiswa Section -->
        <div id="mahasiswa" class="content-section">
            <div class="container">
                <h2 class="section-title">Data Master Mahasiswa</h2>
                <div class="content-card">
                    <div class="mt-4">
                        <h6 class="text-white">Grafik Jumlah Mahasiswa per Jurusan</h6>
                        <canvas id="jurusanChart" height="100"></canvas>
                    </div>
                </div>
                <div class="content-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6><i class="fas fa-users me-2"></i>Daftar Mahasiswa Terdaftar</h6>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="fas fa-plus me-1"></i> Tambah Mahasiswa
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-dark-custom">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="mahasiswaList">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portal Section -->
        <div id="portal" class="content-section">
            <div class="container">
                <h2 class="section-title">Kelola Portal & Jadwal Sistem</h2>
                <div class="content-card">
                    <div class="card-header">
                        <h6><i class="fas fa-cogs me-2"></i>Pengaturan Jadwal Operasional Portal</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gy-5">
                            <div class="col-md-6">
                                <h5 class="mb-4 text-light"><i class="fas fa-motorcycle me-2"></i>Portal Motor</h5>
                                <div class="mb-3"><label class="form-label">Jam Mulai</label><input type="time"
                                        class="form-control" id="motor_jam_mulai"></div>
                                <div class="mb-3"><label class="form-label">Jam Selesai</label><input
                                        type="time" class="form-control" id="motor_jam_selesai"></div>
                                <div class="mb-3"><label class="form-label">Status Operasional</label><select
                                        class="form-select" id="motor_operasional">
                                        <option value="on">On</option>
                                        <option value="off">Off</option>
                                    </select></div>
                                <button class="btn btn-info" onclick="updateJadwal('motor')">Update Jadwal
                                    Motor</button>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-4 text-light"><i class="fas fa-car me-2"></i>Portal Mobil</h5>
                                <div class="mb-3"><label class="form-label">Jam Mulai</label><input type="time"
                                        class="form-control" id="mobil_jam_mulai"></div>
                                <div class="mb-3"><label class="form-label">Jam Selesai</label><input
                                        type="time" class="form-control" id="mobil_jam_selesai"></div>
                                <div class="mb-3"><label class="form-label">Status Operasional</label><select
                                        class="form-select" id="mobil_operasional">
                                        <option value="on">On</option>
                                        <option value="off">Off</option>
                                    </select></div>
                                <button class="btn btn-info" onclick="updateJadwal('mobil')">Update Jadwal
                                    Mobil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-4" style="background-color: var(--bg-dark); border-top: 1px solid var(--border-color);">
        <div class="container text-center text-secondary">
            <p class="mb-0">&copy; <span id="currentYear"></span> Smart Parking IOT. Crafted for a Smarter Future.
            </p>
        </div>
    </footer>

    <!-- Modals -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mahasiswa</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        <div class="mb-3"><label class="form-label">NIM</label><input type="text"
                                class="form-control" id="nim" required></div>
                        <div class="mb-3"><label class="form-label">Nama</label><input type="text"
                                class="form-control" id="nama" required></div>
                        <div class="mb-3"><label class="form-label">Jurusan</label><input type="text"
                                class="form-control" id="jurusan" required></div>
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mahasiswa</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_nim">
                        <div class="mb-3"><label class="form-label">NIM</label><input type="text"
                                class="form-control" id="view_nim" readonly></div>
                        <div class="mb-3"><label class="form-label">Nama</label><input type="text"
                                class="form-control" id="edit_nama" required></div>
                        <div class="mb-3"><label class="form-label">Jurusan</label><input type="text"
                                class="form-control" id="edit_jurusan" required></div>
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
        Chart.register(ChartDataLabels);
    </script>

    <script>
        // Navigation System
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            const targetSection = document.getElementById(sectionId);
            if (targetSection) {
                targetSection.classList.add('active');
            }

            // show dashboard section if it exists
            const dashboardToggleButtons = document.querySelectorAll('#dashboardSectionToggleButtons .btn');
            dashboardToggleButtons.forEach(button => {
                button.classList.remove('active');
                const onclickAttr = button.getAttribute('onclick');
                if (onclickAttr && onclickAttr.includes(`'${sectionId}'`)) {
                    button.classList.add('active');
                }
            });

            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active');
            });

            const dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.classList.remove('active');
            });

            let foundActiveLink = false;

            navLinks.forEach(link => {
                const onclickAttr = link.getAttribute('onclick');
                if (onclickAttr && onclickAttr.includes(`showSection('${sectionId}')`)) {
                    link.classList.add('active');
                    foundActiveLink = true;
                }
            });

            dropdownItems.forEach(item => {
                const onclickAttr = item.getAttribute('onclick');
                if (onclickAttr && onclickAttr.includes(`showSection('${sectionId}')`)) {
                    item.classList.add('active');

                    let parentNavLink = item.closest('.dropdown').querySelector('.nav-link.dropdown-toggle');
                    if (parentNavLink) {
                        parentNavLink.classList.add('active');
                        foundActiveLink = true;
                    }
                }
            });

            if (sectionId === 'pusat-pemantauan-dashboard-parkir-motor' && !foundActiveLink) {
                document.querySelector('.nav-item .nav-link[onclick*="pusat-pemantauan-dashboard-parkir-motor"]').classList.add('active');
            }

            const navbarCollapse = document.getElementById('navbarNav');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        }
    </script>

    <script type="module">
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
        import {
            getDatabase,
            ref,
            get,
            set,
            remove,
            child,
            onValue
        } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

        const firebaseConfig = {
            apiKey: "AIzaSyBW3o5yLi2KL6ukMvBAasmFLU9YHN2IpY8",
            authDomain: "steinlie-realtime.firebaseapp.com",
            databaseURL: "https://steinlie-realtime-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "steinlie-realtime",
            storageBucket: "steinlie-realtime.appspot.com",
            messagingSenderId: "324833723114",
            appId: "1:324833723114:web:e0f40337c88722f20c0d93",
        };

        const app = initializeApp(firebaseConfig);
        const db = getDatabase(app);

        // --- Global Functions & Helpers ---
        window.updateJadwal = updateJadwal;
        window.editMahasiswa = editMahasiswa;
        window.deleteMahasiswa = deleteMahasiswa;

        const loadingSpinner = '<tr><td colspan="4"><div class="spinner"></div></td></tr>';
        const noDataFound = (cols, text) => `<tr><td colspan="${cols}" class="text-center py-5">${text}</td></tr>`;

        const chartColors = {
            primary: '#1A2980',
            secondary: '#26D0CE',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            info: '#3b82f6'
        };

        // Dashboard Mobil
        function setupDashboardMobil() {
            const slotRef = ref(db, 'tempat_parkir/Mobil');
            const jadwalRef = ref(db, 'jadwal_sistem/mobil');
            const parkirRef = ref(db, 'parkir/Mobil');

            const slotGrid = document.getElementById('slotGridMobil');
            const occupancyRateEl = document.getElementById('occupancyRateMobil');
            const progressBar = document.getElementById('progressBarMobil');
            const jamOperasionalEl = document.getElementById('jamOperasionalMobil');
            const indicator = document.getElementById('statusIndicatorMobil');
            const todayEntryEl = document.getElementById('todayEntryMobil');

            const accessChartCanvas = document.getElementById('accessChartMobil');
            const accessChartCtx = accessChartCanvas ? accessChartCanvas.getContext('2d') : null;
            const departmentChartCanvas = document.getElementById('departmentChartMobil');
            const departmentChartCtx = departmentChartCanvas ? departmentChartCanvas.getContext('2d') : null;

            const recentActivityContainer = document.getElementById('recentActivityMobil');

            let accessChart;
            let departmentChart;

            // Quick Stats
            const availableSlotEl = document.getElementById('currentAvailableSlotsMobil');
            const peakHourEl = document.getElementById('peakHourMobil');
            const topDepartmentEl = document.getElementById('topDepartmentMobil');
            const trafficComparisonEl = document.getElementById('trafficComparisonMobil');
            const topAccessEl = document.getElementById('topAccessMobil');
            const lastEntryTimeEl = document.getElementById('lastEntryTimeMobil');

            // Tampilkan spinner loading
            slotGrid.innerHTML = `
                <div class="d-flex justify-content-center align-items-center flex-column text-white">
                    <div class="spinner-border mb-2" role="status"></div>
                    <div>Memuat data slot parkir...</div>
                </div>
            `;

            if (recentActivityContainer) {
                recentActivityContainer.innerHTML = `
                <div class="d-flex justify-content-center align-items-center flex-column text-white py-4">
                    <div class="spinner-border mb-2" role="status"></div>
                    <div>Memuat aktivitas terbaru...</div>
                </div>
            `;
            }

            // --- Listener Slot Parkir ---
            onValue(slotRef, (snapshot) => {
                const data = snapshot.val();
                slotGrid.innerHTML = '';

                if (!data) {
                    slotGrid.innerHTML = `
                    <div class="d-flex justify-content-center align-items-center flex-column text-white">
                        <p class="text-white mb-0">⚠️ Data slot tidak ditemukan.</p>
                    </div>
                `;
                    updateOccupancyStatsMobil(0, 0);
                    return;
                }

                let occupied = 0, total = 0;
                Object.entries(data).forEach(([slotKey, status], index) => {
                    const slotDiv = document.createElement('div');
                    slotDiv.classList.add('parking-slot', status);
                    slotDiv.id = slotKey;

                    const isOccupied = status === 'occupied';
                    if (isOccupied) occupied++;
                    total++;

                    slotDiv.innerHTML = `
                    <i class="fas fa-car slot-icon" aria-hidden="true"></i>
                    <div class="slot-info">Slot ${index + 1}</div>
                    <div class="slot-status">${isOccupied ? 'Terisi' : 'Kosong'}</div>
                `;

                    slotGrid.appendChild(slotDiv);
                });

                updateOccupancyStatsMobil(occupied, total);
                // Quick Stats Slot Tersedia
                if (availableSlotEl) availableSlotEl.textContent = (total - occupied).toString();
            }, () => {
                slotGrid.innerHTML = `<p class="text-white">❌ Gagal memuat data slot parkir.</p>`;
            });

            if (jamOperasionalEl) {
                jamOperasionalEl.innerHTML = `
                <div class="d-flex align-items-center gap-2 text-white">
                    <div class="spinner-border spinner-border-sm" role="status"></div>
                    <div>Memuat jadwal...</div>
                </div>
            `;
            }

            // --- Listener Jadwal Operasional ---
            onValue(jadwalRef, (snapshot) => {
                const data = snapshot.val();
                const jamMulai = data?.jam_mulai ?? '06:00';
                const jamSelesai = data?.jam_selesai ?? '18:00';
                const status = data?.operasional ?? 'off';

                window.jamOperasionalMulai = jamMulai;
                window.jamOperasionalSelesai = jamSelesai;

                if (jamOperasionalEl) {
                    jamOperasionalEl.textContent = `${jamMulai} - ${jamSelesai} WIB`;
                }
                if (indicator) {
                    indicator.classList.remove('status-online', 'status-offline');
                    indicator.classList.add(status === 'on' ? 'status-online' : 'status-offline');
                }
            });

            // --- Listener Kendaraan Masuk Hari Ini ---
            const now = new Date();
            const year = now.getFullYear();
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const day = now.getDate().toString().padStart(2, '0');

            const today = `${year}-${month}-${day}`;

            if (todayEntryEl) todayEntryEl.textContent = '...';

            onValue(parkirRef, (snapshot) => {
                const data = snapshot.val() || {};
                let count = 0;
                let weeklyCount = [0, 0, 0, 0, 0, 0, 0];
                let hourlyMap = {};
                let aksesCount = {
                    ktm: 0,
                    petugas: 0
                };
                let aksesData = {};
                let jurusanCount = {};
                let yesterdayCount = 0;

                const yesterdayDate = new Date(now);
                yesterdayDate.setDate(now.getDate() - 1);

                const yesterdayYear = yesterdayDate.getFullYear();
                const yesterdayMonth = (yesterdayDate.getMonth() + 1).toString().padStart(2, '0');
                const yesterdayDay = yesterdayDate.getDate().toString().padStart(2, '0');

                const yesterday = `${yesterdayYear}-${yesterdayMonth}-${yesterdayDay}`;

                let lastEntryTime = '';

                Object.values(data).forEach(entry => {
                    const isFilled = (value) => value && value.trim() !== '' && value !== '-';
                    const isValid = isFilled(entry.nama) && isFilled(entry.nim) && isFilled(entry.jurusan);
                    const isToday = entry.tanggal === today;

                    if (isToday && isValid) {
                        count++;

                        const jam = entry.waktu?.slice(0, 2);
                        if (jam) {
                            hourlyMap[jam] = (hourlyMap[jam] || 0) + 1;
                        }

                        if (entry.waktu) {
                            if (!lastEntryTime || entry.waktu > lastEntryTime) {
                                lastEntryTime = entry.waktu;
                            }
                        }

                        const akses = entry.akses?.toLowerCase();
                        if (akses === 'ktm') aksesCount.ktm++;
                        else if (akses === 'petugas') aksesCount.petugas++;

                        aksesData[akses] = (aksesData[akses] || 0) + 1;

                        const jurusan = entry.jurusan.trim();
                        jurusanCount[jurusan] = (jurusanCount[jurusan] || 0) + 1;
                    }

                    if (entry.tanggal && isValid) {
                        const dayIdx = new Date(entry.tanggal).getDay();
                        const index = dayIdx === 0 ? 6 : dayIdx - 1;
                        weeklyCount[index]++;
                    }

                    if (entry.tanggal === yesterday && isValid) {
                        yesterdayCount++;
                    }
                });

                // Kendaaran Masuk Hari Ini
                if (todayEntryEl) todayEntryEl.textContent = count;

                // Jam Paling Ramai
                if (peakHourEl) {
                    const sortedHours = Object.entries(hourlyMap).sort((a, b) => b[1] - a[1]);
                    if (sortedHours.length === 0) {
                        peakHourEl.textContent = '--:--'; // Display default if no data
                    } else {
                        const jamRamai = sortedHours[0]?.[0] || '--';
                        peakHourEl.textContent = `${jamRamai}:00`;
                    }
                }

                // Kendaraan Masuk Terakhir
                if (lastEntryTimeEl) {
                    lastEntryTimeEl.textContent = lastEntryTime ? lastEntryTime.slice(0, 5) : '--:--';
                }

                // Update Quick Stats
                // Top Jurusan
                if (topDepartmentEl) {
                    const sorted = Object.entries(jurusanCount).sort((a, b) => b[1] - a[1]);
                    if (sorted.length === 0) {
                        topDepartmentEl.textContent = '-';
                    } else {
                        topDepartmentEl.textContent = sorted[0]?.[0] || '-';
                    }
                }

                // Lalu Lintas vs Kemarin
                if (trafficComparisonEl) {
                    let percentageText = '---';

                    if (yesterdayCount > 0) {
                        const change = count - yesterdayCount;
                        if (change > 0) {
                            const percentage = ((change / yesterdayCount) * 100).toFixed(1);
                            percentageText = `+${percentage}%`;
                        } else {
                            percentageText = '0%';
                        }
                    } else if (count > 0) {
                        percentageText = '+100%';
                    }
                    trafficComparisonEl.textContent = percentageText;
                }

                // Akses Terbanyak
                if (topAccessEl) {
                    if (aksesCount.ktm > 0 || aksesCount.petugas > 0) {
                        const label = aksesCount.ktm >= aksesCount.petugas ?
                            `KTM (${aksesCount.ktm})` :
                            `Petugas (${aksesCount.petugas})`;
                        topAccessEl.textContent = label;
                    } else {
                        topAccessEl.textContent = '-';
                    }
                }

                // Update Department Chart
                const departmentChartMobil = document.getElementById('departmentChartMobil');
                const noDataDepartmentMessageEl = document.getElementById('noDataDepartmentMessage');

                if (departmentChartCtx && departmentChartMobil && noDataDepartmentMessageEl) {
                    const sorted = Object.entries(jurusanCount).sort((a, b) => b[1] - a[1]);
                    const labels = sorted.map(([jur]) => jur);
                    const values = sorted.map(([, val]) => val);

                    const hasActualData = values.some(val => val > 0);

                    if (hasActualData) {
                        departmentChartMobil.style.display = 'block';
                        noDataDepartmentMessageEl.style.display = 'none';

                        const colors = labels.map((_, i) => [
                            chartColors.primary,
                            chartColors.secondary,
                            chartColors.success,
                            chartColors.warning,
                            chartColors.info,
                            chartColors.danger
                        ][i % 6]);

                        if (!departmentChart) {
                            // Initialize the chart for the first time
                            departmentChart = new Chart(departmentChartCtx, {
                                type: 'bar',
                                data: {
                                    labels,
                                    datasets: [{
                                        label: 'Jumlah Kendaraan',
                                        data: values,
                                        backgroundColor: colors,
                                        borderColor: colors,
                                        borderWidth: 1,
                                        borderRadius: 5
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { display: false },
                                        datalabels: {
                                            color: '#FFFFFF',
                                            font: {
                                                weight: 'bold',
                                                size: 12
                                            },
                                            formatter: (value, context) => {
                                                if (value > 0) {
                                                    return value;
                                                }
                                                return '';
                                            }
                                        }

                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            grid: {
                                                color: 'rgba(255,255,255,0.08)',
                                                drawBorder: false
                                            },
                                            ticks: { color: '#a0aec0' },
                                            max: Math.max(...values, 5)
                                        },
                                        x: {
                                            grid: {
                                                color: 'rgba(255,255,255,0.08)',
                                                drawBorder: false
                                            },
                                            ticks: { color: '#a0aec0' }
                                        }
                                    }
                                }
                            });
                        } else {
                            // Update existing chart
                            departmentChart.data.labels = labels;
                            departmentChart.data.datasets[0].data = values;

                            departmentChart.data.datasets[0].backgroundColor = colors;
                            departmentChart.data.datasets[0].borderColor = colors;

                            departmentChart.options.scales.y.max = Math.max(...values, 5);

                            departmentChart.update();
                        }
                    } else {
                        departmentChartCanvas.style.display = 'none';
                        noDataDepartmentMessageEl.style.display = 'flex'; // Use 'flex' to activate centering
                    }
                }

                window.latestHourlyMap = hourlyMap;
                window.latestWeeklyCount = weeklyCount;

                if (window.currentChartMode === 'weekly') {
                    updateWeeklyChartMobil(weeklyCount);
                } else {
                    updateHourlyChartMobil(hourlyMap);
                }

                if (accessChartCtx) {
                    let aksesLabels = Object.keys(aksesData);
                    let aksesValues = Object.values(aksesData);

                    if (aksesLabels.length === 0) {
                        aksesLabels = ['Tidak Ada Data'];
                        aksesValues = [1];
                    }

                    const total = aksesValues.reduce((sum, val) => sum + val, 0);
                    const safeTotal = total === 0 ? 1 : total;

                    const aksesPercentages = aksesValues.map(val => {
                        const percentage = safeTotal ? (val / safeTotal) * 100 : 0;
                        if (percentage % 1 === 0) {
                            return percentage.toFixed(0);
                        } else {
                            return percentage.toFixed(1);
                        }
                    });

                    const backgroundColors = aksesLabels.map((_, i) => [
                        chartColors.info,
                        chartColors.warning,
                        chartColors.primary,
                        chartColors.danger,
                        chartColors.success
                    ][i % 5]);
                    if (!accessChart) {
                        accessChart = new Chart(accessChartCtx, {
                            type: 'doughnut',
                            data: {
                                labels: aksesLabels.map(label => label.toUpperCase()),
                                datasets: [{
                                    data: aksesPercentages,
                                    backgroundColor: aksesLabels.includes('Tidak Ada Data') ? ['#4a5568'] : backgroundColors, // Use a grey color for no data
                                    hoverOffset: 5
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                layout: { padding: 5 },
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            color: '#a0aec0',
                                            font: { size: 12 },
                                            padding: 30
                                        }
                                    },
                                    tooltip: {
                                        padding: 12,
                                        boxPadding: 6,
                                        cornerRadius: 6,
                                        titleFont: { size: 13 },
                                        bodyFont: { size: 13 },
                                        callbacks: {
                                            label: function(context) {
                                                let label = context.label || '';
                                                if (label === 'TIDAK ADA DATA') return label; // Don't show % for no data
                                                if (label) label += ': ';
                                                if (context.parsed !== null) label += context.parsed + '%';
                                                return label;
                                            }
                                        }
                                    },
                                    datalabels: {
                                        color: '#FFFFFF',
                                        font: {
                                            weight: 'bold',
                                            size: 12
                                        },
                                        formatter: (value, context) => {
                                            if (context.chart.data.labels[context.dataIndex] === 'TIDAK ADA DATA') {
                                                return '';
                                            }
                                            return `${value}%`;
                                        }
                                    }
                                },
                            }
                        });
                    } else {
                        accessChart.data.labels = aksesLabels.map(label => label.toUpperCase());
                        accessChart.data.datasets[0].data = aksesPercentages;
                        accessChart.data.datasets[0].backgroundColor = aksesLabels.includes('Tidak Ada Data') ? ['#4a5568'] : backgroundColors;

                        accessChart.update();
                    }
                }
            }, () => {
                if (todayEntryEl) todayEntryEl.textContent = '0';
            });

            // --- Listener Aktivitas Terbaru ---
            if (recentActivityContainer) {
                onValue(parkirRef, (snapshot) => {
                    const data = snapshot.val();
                    if (!data) {
                        recentActivityContainer.innerHTML = `
                        <div class="text-center text-secondary py-4">
                            Tidak Ada Aktivitas Hari Ini
                        </div>
                    `;
                        return;
                    }

                    const isFilled = (value) => value && value.trim() !== '' && value !== '-';
                    const isValid = (entry) => isFilled(entry.nama) && isFilled(entry.nim) && isFilled(entry.jurusan);

                    const now = new Date();
                    const year = now.getFullYear();
                    const month = (now.getMonth() + 1).toString().padStart(2, '0');
                    const day = now.getDate().toString().padStart(2, '0');
                    const today = `${year}-${month}-${day}`;

                    const sorted = Object.values(data)
                        .filter(isValid)
                        .filter(entry => entry.tanggal === today)
                        .sort((a, b) => {
                            const dateTimeA = `${a.tanggal} ${a.waktu}`;
                            const dateTimeB = `${b.tanggal} ${b.waktu}`;

                            const dateA = new Date(dateTimeA);
                            const dateB = new Date(dateTimeB);

                            return dateB.getTime() - dateA.getTime();
                        }).slice(0, 10);

                    if (sorted.length === 0) {
                        recentActivityContainer.innerHTML = `
                        <div class="text-center text-secondary py-4">
                            Tidak Ada Aktivitas Hari Ini
                        </div>
                    `;
                    } else {
                        recentActivityContainer.innerHTML = sorted.map((entry, index) => {
                            const aksesUpper = (entry.akses || '').toUpperCase();
                            const borderClass = (index < sorted.length - 1) ? 'border-bottom border-secondary' : '';

                            return `
                            <div class="activity-item d-flex align-items-center py-2 px-3 ${borderClass}">
                                <div class="activity-icon entry me-3">
                                <i class="bi bi-arrow-up"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-1">${entry.nama}</h6>
                                <small class="text-secondary">${entry.nim} • ${entry.jurusan} • ${entry.waktu} • ${aksesUpper}</small>
                            </div>
                        </div>`;
                        }).join('');
                    }
                });
            }

            function updateOccupancyStatsMobil(occupied, total) {
                const rate = total > 0 ? Math.round((occupied / total) * 100) : 0;
                if (occupancyRateEl) occupancyRateEl.textContent = `${rate}%`;
                if (progressBar) progressBar.style.width = `${rate}%`;
            }

            window.toggleChartMobil = function (mode) {
                if (window.currentChartMode === mode) return;
                window.currentChartMode = mode;

                if (mode === 'hourly') {
                    updateHourlyChartMobil(window.latestHourlyMap || {});
                } else if (mode === 'weekly') {
                    updateWeeklyChartMobil(window.latestWeeklyCount || []);
                }

                const chartToggleButtons = document.querySelectorAll('#chartToggleButtonsMobil .btn');
                chartToggleButtons.forEach(btn => {
                    btn.classList.remove('active');
                    const onclickAttr = btn.getAttribute('onclick');
                    if (onclickAttr && onclickAttr.includes(`'${mode}'`)) {
                        btn.classList.add('active');
                    }
                });
            };
        }

        function updateWeeklyChartMobil(data) {
            const chartCanvas = document.getElementById('usageChartMobil');
            const noDataHourlyMessageEl = document.getElementById('noDataMobilHourlyMessage');
            const noDataWeeklyMessageEl = document.getElementById('noDataMobilWeeklyMessage');

            const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            const values = data.map(count => count || 0);
            const hasActualData = values.some(val => val > 0);

            if (hasActualData) {
                chartCanvas.style.display = 'block';
                noDataWeeklyMessageEl.style.display = 'none';
                noDataHourlyMessageEl.style.display = 'none';

                window.usageChartMobilInstance.data = {
                    labels,
                    datasets: [{
                        label: 'Mobil Parkir Mingguan',
                        data: values,
                        backgroundColor: [
                            chartColors.secondary,
                            chartColors.primary,
                            chartColors.success,
                            chartColors.warning,
                            chartColors.info,
                            `${chartColors.secondary}AA`,
                            `${chartColors.primary}AA`
                        ],
                        borderColor: [
                            chartColors.secondary,
                            chartColors.primary,
                            chartColors.success,
                            chartColors.warning,
                            chartColors.info,
                            chartColors.secondary,
                            chartColors.primary
                        ],
                        borderWidth: 1,
                        barThickness: 20,
                    }]
                };
                window.usageChartMobilInstance.options.scales.y.max = Math.max(...values, 5);
                window.usageChartMobilInstance.type = 'bar';
                window.usageChartMobilInstance.update();
            } else {
                chartCanvas.style.display = 'none';
                noDataWeeklyMessageEl.style.display = 'flex';
                noDataHourlyMessageEl.style.display = 'none';
            }
        }

        function updateHourlyChartMobil(hourlyMap) {
            const chartCanvas = document.getElementById('usageChartMobil');
            const noDataMessageEl = document.getElementById('noDataMobilHourlyMessage');

            if (window.usageChartMobilInstance) {
                const labels = [];
                const values = [];

                const startHour = parseInt(('00:00').split(':')[0]);
                const endHour = parseInt(('24:00').split(':')[0]);

                // const startHour = parseInt((window.jamOperasionalMulai || '06:00').split(':')[0]);
                // const endHour = parseInt((window.jamOperasionalSelesai || '18:00').split(':')[0]);

                for (let hour = startHour; hour <= endHour; hour++) {
                    const label = `${hour.toString().padStart(2, '0')}:00`;
                    labels.push(label);
                    values.push(hourlyMap[hour.toString().padStart(2, '0')] || 0);
                }

                const hasActualData = values.some(val => val > 0);

                if (hasActualData) {
                    chartCanvas.style.display = 'block';
                    noDataMessageEl.style.display = 'none';

                    window.usageChartMobilInstance.data = {
                        labels,
                        datasets: [{
                            label: 'Mobil Parkir',
                            data: values,
                            borderColor: chartColors.secondary,
                            backgroundColor: (context) => {
                                const chart = context.chart;
                                const { ctx, chartArea } = chart;
                                if (!chartArea) return null;
                                const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                                gradient.addColorStop(0, `${chartColors.secondary}00`);
                                gradient.addColorStop(1, `${chartColors.secondary}40`);
                                return gradient;
                            },
                            fill: true,
                            tension: 0.4,
                            borderWidth: 3,
                            pointBackgroundColor: chartColors.secondary,
                            pointBorderColor: '#fff',
                            pointBorderWidth: 1,
                            pointRadius: 8,
                            pointHoverRadius: 10,
                        }]
                    };
                    window.usageChartMobilInstance.options.scales.y.max = Math.max(...values, 5);
                    window.usageChartMobilInstance.type = 'line';
                    window.usageChartMobilInstance.update();

                } else {
                    chartCanvas.style.display = 'none';
                    noDataMessageEl.style.display = 'flex';
                }
            }
        }

        // Dashboard Motor
        function setupDashboardMotor() {
            const slotRef = ref(db, 'tempat_parkir/Motor');
            const jadwalRef = ref(db, 'jadwal_sistem/motor');
            const parkirRef = ref(db, 'parkir/Motor');

            const slotGrid = document.getElementById('slotGridMotor');
            const occupancyRateEl = document.getElementById('occupancyRateMotor');
            const progressBar = document.getElementById('progressBarMotor');
            const jamOperasionalEl = document.getElementById('jamOperasionalMotor');
            const indicator = document.getElementById('statusIndicatorMotor');
            const todayEntryEl = document.getElementById('todayEntryMotor');

            const accessChartCanvas = document.getElementById('accessChartMotor');
            const accessChartCtx = accessChartCanvas ? accessChartCanvas.getContext('2d') : null;
            const departmentChartCanvas = document.getElementById('departmentChartMotor');
            const departmentChartCtx = departmentChartCanvas ? departmentChartCanvas.getContext('2d') : null;

            const recentActivityContainer = document.getElementById('recentActivityMotor');

            let accessChartMotor;
            let departmentChart;

            // Quick Stats untuk Motor
            const availableSlotEl = document.getElementById('currentAvailableSlotsMotor');
            const peakHourEl = document.getElementById('peakHourMotor');
            const topDepartmentEl = document.getElementById('topDepartmentMotor');
            const trafficComparisonEl = document.getElementById('trafficComparisonMotor');
            const topAccessEl = document.getElementById('topAccessMotor');
            const lastEntryTimeEl = document.getElementById('lastEntryTimeMotor');

            // Tampilkan spinner loading
            if (slotGrid) {
                slotGrid.innerHTML = `
                <div class="d-flex justify-content-center align-items-center flex-column text-white">
                    <div class="spinner-border mb-2" role="status"></div>
                    <div>Memuat data slot parkir motor...</div>
                </div>
            `;
            }

            if (recentActivityContainer) {
                recentActivityContainer.innerHTML = `
                <div class="d-flex justify-content-center align-items-center flex-column text-white py-4">
                    <div class="spinner-border mb-2" role="status"></div>
                    <div>Memuat aktivitas terbaru motor...</div>
                </div>
            `;
            }

            // --- Listener Slot Parkir Motor ---
            onValue(slotRef, (snapshot) => {
                const data = snapshot.val();
                if (slotGrid) slotGrid.innerHTML = '';

                if (!data) {
                    if (slotGrid) {
                        slotGrid.innerHTML = `
                        <div class="d-flex justify-content-center align-items-center flex-column text-white">
                            <p class="text-white mb-0">⚠️ Data slot motor tidak ditemukan.</p>
                        </div>
                    `;
                    }
                    updateOccupancyStatsMotor(0, 0); // Panggil fungsi update untuk Motor
                    return;
                }

                let occupied = 0, total = 0;
                Object.entries(data).forEach(([slotKey, status], index) => {
                    const slotDiv = document.createElement('div');
                    slotDiv.classList.add('parking-slot', status);
                    slotDiv.id = slotKey;

                    const isOccupied = status === 'occupied';
                    if (isOccupied) occupied++;
                    total++;

                    slotDiv.innerHTML = `
                    <i class="fas fa-motorcycle slot-icon" aria-hidden="true"></i> <div class="slot-info">Slot ${index + 1}</div>
                    <div class="slot-status">${isOccupied ? 'Terisi' : 'Kosong'}</div>
                `;

                    if (slotGrid) slotGrid.appendChild(slotDiv);
                });

                updateOccupancyStatsMotor(occupied, total); // Panggil fungsi update untuk Motor
                // Quick Stats Slot Tersedia
                if (availableSlotEl) availableSlotEl.textContent = (total - occupied).toString();
            }, () => {
                if (slotGrid) slotGrid.innerHTML = `<p class="text-white">❌ Gagal memuat data slot parkir motor.</p>`;
            });

            if (jamOperasionalEl) {
                jamOperasionalEl.innerHTML = `
                <div class="d-flex align-items-center gap-2 text-white">
                    <div class="spinner-border spinner-border-sm" role="status"></div>
                    <div>Memuat jadwal...</div>
                </div>
            `;
            }

            // --- Listener Jadwal Operasional Motor ---
            onValue(jadwalRef, (snapshot) => {
                const data = snapshot.val();
                const jamMulai = data?.jam_mulai ?? '06:00';
                const jamSelesai = data?.jam_selesai ?? '18:00';
                const status = data?.operasional ?? 'off';

                window.jamOperasionalMulaiMotor = jamMulai;
                window.jamOperasionalSelesaiMotor = jamSelesai;

                if (jamOperasionalEl) {
                    jamOperasionalEl.textContent = `${jamMulai} - ${jamSelesai} WIB`;
                }
                if (indicator) {
                    indicator.classList.remove('status-online', 'status-offline');
                    indicator.classList.add(status === 'on' ? 'status-online' : 'status-offline');
                }
            });

            // --- Listener Kendaraan Masuk Hari Ini Motor ---
            const now = new Date();
            const year = now.getFullYear();
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const day = now.getDate().toString().padStart(2, '0');

            const today = `${year}-${month}-${day}`;

            if (todayEntryEl) todayEntryEl.textContent = '...';

            onValue(parkirRef, (snapshot) => {
                const data = snapshot.val() || {};
                let count = 0;
                let weeklyCount = [0, 0, 0, 0, 0, 0, 0];
                let hourlyMap = {};
                let aksesCount = {
                    ktm: 0,
                    petugas: 0
                };
                let aksesData = {};
                let jurusanCount = {};
                let yesterdayCount = 0;

                const yesterdayDate = new Date(now);
                yesterdayDate.setDate(now.getDate() - 1);

                const yesterdayYear = yesterdayDate.getFullYear();
                const yesterdayMonth = (yesterdayDate.getMonth() + 1).toString().padStart(2, '0');
                const yesterdayDay = yesterdayDate.getDate().toString().padStart(2, '0');

                const yesterday = `${yesterdayYear}-${yesterdayMonth}-${yesterdayDay}`;

                let lastEntryTime = '';

                Object.values(data).forEach(entry => {
                    const isFilled = (value) => value && value.trim() !== '' && value !== '-';
                    const isValid = isFilled(entry.nama) && isFilled(entry.nim) && isFilled(entry.jurusan);
                    const isToday = entry.tanggal === today;

                    if (isToday && isValid) {
                        count++;

                        const jam = entry.waktu?.slice(0, 2);
                        if (jam) {
                            hourlyMap[jam] = (hourlyMap[jam] || 0) + 1;
                        }

                        if (entry.waktu) {
                            if (!lastEntryTime || entry.waktu > lastEntryTime) {
                                lastEntryTime = entry.waktu;
                            }
                        }

                        const akses = entry.akses?.toLowerCase();
                        if (akses === 'ktm') aksesCount.ktm++;
                        else if (akses === 'petugas') aksesCount.petugas++;

                        aksesData[akses] = (aksesData[akses] || 0) + 1;

                        const jurusan = entry.jurusan.trim();
                        jurusanCount[jurusan] = (jurusanCount[jurusan] || 0) + 1;
                    }

                    if (entry.tanggal && isValid) {
                        const dayIdx = new Date(entry.tanggal).getDay();
                        const index = dayIdx === 0 ? 6 : dayIdx - 1; // Senin (1) -> 0, Minggu (0) -> 6
                        weeklyCount[index]++;
                    }

                    if (entry.tanggal === yesterday && isValid) {
                        yesterdayCount++;
                    }
                });

                // Kendaaran Masuk Hari Ini
                if (todayEntryEl) todayEntryEl.textContent = count;

                // Jam Paling Ramai
                if (peakHourEl) {
                    const sortedHours = Object.entries(hourlyMap).sort((a, b) => b[1] - a[1]);
                    if (sortedHours.length === 0) {
                        peakHourEl.textContent = '--:--';
                    } else {
                        const jamRamai = sortedHours[0]?.[0] || '--';
                        peakHourEl.textContent = `${jamRamai}:00`;
                    }
                }

                // Kendaraan Masuk Terakhir
                if (lastEntryTimeEl) {
                    lastEntryTimeEl.textContent = lastEntryTime ? lastEntryTime.slice(0, 5) : '--:--';
                }

                // Update Quick Stats Motor
                // Top Jurusan
                if (topDepartmentEl) {
                    const sorted = Object.entries(jurusanCount).sort((a, b) => b[1] - a[1]);
                    if (sorted.length === 0) {
                        topDepartmentEl.textContent = '-';
                    } else {
                        topDepartmentEl.textContent = sorted[0]?.[0] || '-';
                    }
                }

                // Lalu Lintas vs Kemarin
                if (trafficComparisonEl) {
                    let percentageText = '---';

                    if (yesterdayCount > 0) {
                        const change = count - yesterdayCount;
                        if (change > 0) {
                            const percentage = ((change / yesterdayCount) * 100).toFixed(1);
                            percentageText = `+${percentage}%`;
                        } else {
                            percentageText = '0%';
                        }
                    } else if (count > 0) {
                        percentageText = '+100%';
                    }
                    trafficComparisonEl.textContent = percentageText;
                }

                // Akses Terbanyak
                if (topAccessEl) {
                    if (aksesCount.ktm > 0 || aksesCount.petugas > 0) {
                        const label = aksesCount.ktm >= aksesCount.petugas ?
                            `KTM (${aksesCount.ktm})` :
                            `Petugas (${aksesCount.petugas})`;
                        topAccessEl.textContent = label;
                    } else {
                        topAccessEl.textContent = '-';
                    }
                }

                // Update Department Chart Motor
                const departmentChartMotor = document.getElementById('departmentChartMotor');
                const noDataDepartmentMotorMessageEl = document.getElementById('noDataDepartmentMotorMessage');

                if (departmentChartCtx && departmentChartMotor && noDataDepartmentMotorMessageEl) {
                    const sorted = Object.entries(jurusanCount).sort((a, b) => b[1] - a[1]);
                    const labels = sorted.map(([jur]) => jur);
                    const values = sorted.map(([, val]) => val);

                    const hasActualData = values.some(val => val > 0);

                    if (hasActualData) {
                        departmentChartMotor.style.display = 'block';
                        noDataDepartmentMotorMessageEl.style.display = 'none';

                        const colors = labels.map((_, i) => [
                            chartColors.primary,
                            chartColors.secondary,
                            chartColors.success,
                            chartColors.warning,
                            chartColors.info,
                            chartColors.danger
                        ][i % 6]);

                        if (!departmentChart) {
                            departmentChart = new Chart(departmentChartCtx, {
                                type: 'bar',
                                data: {
                                    labels,
                                    datasets: [{
                                        label: 'Jumlah Kendaraan',
                                        data: values,
                                        backgroundColor: colors,
                                        borderColor: colors,
                                        borderWidth: 1,
                                        borderRadius: 5
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { display: false },
                                        datalabels: {
                                            color: '#FFFFFF',
                                            font: {
                                                weight: 'bold',
                                                size: 12
                                            },
                                            formatter: (value, context) => {
                                                if (value > 0) {
                                                    return value;
                                                }
                                                return '';
                                            }
                                        }

                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            grid: {
                                                color: 'rgba(255,255,255,0.08)',
                                                drawBorder: false
                                            },
                                            ticks: { color: '#a0aec0' },
                                            max: Math.max(...values, 5)
                                        },
                                        x: {
                                            grid: {
                                                color: 'rgba(255,255,255,0.08)',
                                                drawBorder: false
                                            },
                                            ticks: { color: '#a0aec0' }
                                        }
                                    }
                                }
                            });
                        } else {
                            // Update existing chart
                            departmentChartMotor.data.labels = labels;
                            departmentChartMotor.data.datasets[0].data = values;

                            departmentChartMotor.data.datasets[0].backgroundColor = colors;
                            departmentChartMotor.data.datasets[0].borderColor = colors;

                            departmentChartMotor.options.scales.y.max = Math.max(...values, 5);

                            departmentChartMotor.update();
                        }
                    } else {
                        departmentChartCanvas.style.display = 'none';
                        noDataDepartmentMotorMessageEl.style.display = 'flex'; // Use 'flex' to activate centering
                    }
                }

                window.latestHourlyMapMotor = hourlyMap;
                window.latestWeeklyCountMotor = weeklyCount;

                if (window.currentChartModeMotor === 'weekly') {
                    updateWeeklyChartMotor(weeklyCount);
                } else {
                    updateHourlyChartMotor(hourlyMap);
                }

                if (accessChartCtx) {
                    let aksesLabels = Object.keys(aksesData);
                    let aksesValues = Object.values(aksesData);

                    if (aksesLabels.length === 0) {
                        aksesLabels = ['Tidak Ada Data'];
                        aksesValues = [1];
                    }

                    const total = aksesValues.reduce((sum, val) => sum + val, 0);
                    const safeTotal = total === 0 ? 1 : total;

                    const aksesPercentages = aksesValues.map(val => {
                        const percentage = safeTotal ? (val / safeTotal) * 100 : 0;
                        if (percentage % 1 === 0) {
                            return percentage.toFixed(0);
                        } else {
                            return percentage.toFixed(1);
                        }
                    });

                    const backgroundColors = aksesLabels.map((_, i) => [
                        chartColors.info,
                        chartColors.warning,
                        chartColors.primary,
                        chartColors.danger,
                        chartColors.success
                    ][i % 5]);
                    if (!accessChartMotor) {
                        accessChartMotor = new Chart(accessChartCtx, {
                            type: 'doughnut',
                            data: {
                                labels: aksesLabels.map(label => label.toUpperCase()),
                                datasets: [{
                                    data: aksesPercentages,
                                    backgroundColor: aksesLabels.includes('Tidak Ada Data') ? ['#4a5568'] : backgroundColors, // Use a grey color for no data
                                    hoverOffset: 5
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                layout: { padding: 5 },
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            color: '#a0aec0',
                                            font: { size: 12 },
                                            padding: 30
                                        }
                                    },
                                    tooltip: {
                                        padding: 12,
                                        boxPadding: 6,
                                        cornerRadius: 6,
                                        titleFont: { size: 13 },
                                        bodyFont: { size: 13 },
                                        callbacks: {
                                            label: function(context) {
                                                let label = context.label || '';
                                                if (label === 'TIDAK ADA DATA') return label; // Don't show % for no data
                                                if (label) label += ': ';
                                                if (context.parsed !== null) label += context.parsed + '%';
                                                return label;
                                            }
                                        }
                                    },
                                    datalabels: {
                                        color: '#FFFFFF',
                                        font: {
                                            weight: 'bold',
                                            size: 12
                                        },
                                        formatter: (value, context) => {
                                            if (context.chart.data.labels[context.dataIndex] === 'TIDAK ADA DATA') {
                                                return '';
                                            }
                                            return `${value}%`;
                                        }
                                    }
                                },
                            }
                        });
                    } else {
                        accessChartMotor.data.labels = aksesLabels.map(label => label.toUpperCase());
                        accessChartMotor.data.datasets[0].data = aksesPercentages;
                        accessChartMotor.data.datasets[0].backgroundColor = aksesLabels.includes('Tidak Ada Data') ? ['#4a5568'] : backgroundColors;

                        accessChartMotor.update();
                    }
                }
            }, () => {
                if (todayEntryEl) todayEntryEl.textContent = '0';
            });

            // --- Listener Aktivitas Terbaru Motor ---
            if (recentActivityContainer) {
                onValue(parkirRef, (snapshot) => {
                    const data = snapshot.val();
                    if (!data) {
                        recentActivityContainer.innerHTML = `
                        <div class="text-center text-secondary py-4">
                            Tidak Ada Aktivitas Hari Ini
                        </div>
                    `;
                        return;
                    }

                    const isFilled = (value) => value && value.trim() !== '' && value !== '-';
                    const isValid = (entry) => isFilled(entry.nama) && isFilled(entry.nim) && isFilled(entry.jurusan);

                    const now = new Date();
                    const year = now.getFullYear();
                    const month = (now.getMonth() + 1).toString().padStart(2, '0');
                    const day = now.getDate().toString().padStart(2, '0');
                    const today = `${year}-${month}-${day}`;

                    const sorted = Object.values(data)
                        .filter(isValid)
                        .filter(entry => entry.tanggal === today)
                        .sort((a, b) => {
                            const dateTimeA = `${a.tanggal} ${a.waktu}`;
                            const dateTimeB = `${b.tanggal} ${b.waktu}`;

                            const dateA = new Date(dateTimeA);
                            const dateB = new Date(dateTimeB);

                            return dateB.getTime() - dateA.getTime();
                        }).slice(0, 10);

                    if (sorted.length === 0) {
                        recentActivityContainer.innerHTML = `
                        <div class="text-center text-secondary py-4">
                            Tidak Ada Aktivitas Hari Ini
                        </div>
                    `;
                    } else {
                        recentActivityContainer.innerHTML = sorted.map((entry, index) => {
                            const aksesUpper = (entry.akses || '').toUpperCase();
                            const borderClass = (index < sorted.length - 1) ? 'border-bottom border-secondary' : '';

                            return `
                            <div class="activity-item d-flex align-items-center py-2 px-3 ${borderClass}">
                                <div class="activity-icon entry me-3">
                                <i class="bi bi-arrow-up"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-1">${entry.nama}</h6>
                                <small class="text-secondary">${entry.nim} • ${entry.jurusan} • ${entry.waktu} • ${aksesUpper}</small>
                            </div>
                        </div>`;
                        }).join('');
                    }
                });
            }

            function updateOccupancyStatsMotor(occupied, total) {
                const rate = total > 0 ? Math.round((occupied / total) * 100) : 0;
                if (occupancyRateEl) occupancyRateEl.textContent = `${rate}%`;
                if (progressBar) progressBar.style.width = `${rate}%`;
            }

            window.toggleChartMotor = function (mode) {
                if (window.currentChartModeMotor === mode) return;
                window.currentChartModeMotor = mode;

                if (mode === 'hourly') {
                    updateHourlyChartMotor(window.latestHourlyMapMotor || {});
                } else if (mode === 'weekly') {
                    updateWeeklyChartMotor(window.latestWeeklyCountMotor || []);
                }

                const chartToggleButtons = document.querySelectorAll('#chartToggleButtonsMotor .btn');
                chartToggleButtons.forEach(btn => {
                    btn.classList.remove('active');
                    const onclickAttr = btn.getAttribute('onclick');
                    if (onclickAttr && onclickAttr.includes(`'${mode}'`)) {
                        btn.classList.add('active');
                    }
                });
            };
        }

        function updateWeeklyChartMotor(data) {
            const chartCanvas = document.getElementById('usageChartMotor');
            const noDataHourlyMessageEl = document.getElementById('noDataMotorHourlyMessage');
            const noDataWeeklyMessageEl = document.getElementById('noDataMotorWeeklyMessage');

            const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            const values = data.map(count => count || 0);
            const hasActualData = values.some(val => val > 0);

            if (hasActualData) {
                chartCanvas.style.display = 'block';
                noDataWeeklyMessageEl.style.display = 'none';
                noDataHourlyMessageEl.style.display = 'none';

                window.usageChartMotorInstance.data = {
                    labels,
                    datasets: [{
                        label: 'Motor Parkir Mingguan',
                        data: values,
                        backgroundColor: [
                            chartColors.secondary,
                            chartColors.primary,
                            chartColors.success,
                            chartColors.warning,
                            chartColors.info,
                            `${chartColors.secondary}AA`,
                            `${chartColors.primary}AA`
                        ],
                        borderColor: [
                            chartColors.secondary,
                            chartColors.primary,
                            chartColors.success,
                            chartColors.warning,
                            chartColors.info,
                            chartColors.secondary,
                            chartColors.primary
                        ],
                        borderWidth: 1,
                        barThickness: 20,
                    }]
                };
                window.usageChartMotorInstance.options.scales.y.max = Math.max(...values, 5);
                window.usageChartMotorInstance.type = 'bar';
                window.usageChartMotorInstance.update();
            } else {
                chartCanvas.style.display = 'none';
                noDataWeeklyMessageEl.style.display = 'flex';
                noDataHourlyMessageEl.style.display = 'none';
            }
        }

        function updateHourlyChartMotor(hourlyMap) {
            const chartCanvas = document.getElementById('usageChartMotor');
            const noDataMessageEl = document.getElementById('noDataMotorHourlyMessage');

            if (window.usageChartMotorInstance) {
                const labels = [];
                const values = [];

                const startHour = parseInt(('00:00').split(':')[0]);
                const endHour = parseInt(('24:00').split(':')[0]);

                // Gunakan jam operasional spesifik untuk motor
                // const startHour = parseInt((window.jamOperasionalMulaiMotor || '06:00').split(':')[0]);
                // const endHour = parseInt((window.jamOperasionalSelesaiMotor || '18:00').split(':')[0]);

                for (let hour = startHour; hour <= endHour; hour++) {
                    const label = `${hour.toString().padStart(2, '0')}:00`;
                    labels.push(label);
                    values.push(hourlyMap[hour.toString().padStart(2, '0')] || 0);
                }

                const hasActualData = values.some(val => val > 0);

                if (hasActualData) {
                    chartCanvas.style.display = 'block';
                    noDataMessageEl.style.display = 'none';

                    window.usageChartMotorInstance.data = {
                        labels,
                        datasets: [{
                            label: 'Motor Parkir',
                            data: values,
                            borderColor: chartColors.secondary,
                            backgroundColor: (context) => {
                                const chart = context.chart;
                                const { ctx, chartArea } = chart;
                                if (!chartArea) return null;
                                const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                                gradient.addColorStop(0, `${chartColors.secondary}00`);
                                gradient.addColorStop(1, `${chartColors.secondary}40`);
                                return gradient;
                            },
                            fill: true,
                            tension: 0.4,
                            borderWidth: 3,
                            pointBackgroundColor: chartColors.secondary,
                            pointBorderColor: '#fff',
                            pointBorderWidth: 1,
                            pointRadius: 8,
                            pointHoverRadius: 10,
                        }]
                    };
                    window.usageChartMotorInstance.options.scales.y.max = Math.max(...values, 5);
                    window.usageChartMotorInstance.type = 'line';
                    window.usageChartMotorInstance.update();

                } else {
                    chartCanvas.style.display = 'none';
                    noDataMessageEl.style.display = 'flex';
                }
            }
        }

        // --- Mahasiswa Management ---
        const mahasiswaRef = ref(db, 'Mahasiswa');
        const mhsListEl = document.getElementById('mahasiswaList');

        async function loadMahasiswaData() {
            mhsListEl.innerHTML = loadingSpinner;
            try {
                const snapshot = await get(mahasiswaRef);
                const data = snapshot.val();
                let html = '';
                if (data) {
                    Object.entries(data).forEach(([nim, mhs]) => {
                        html += `<tr>
                        <td><p class="mb-0">${nim}</p></td><td><p class="mb-0">${mhs.Nama || mhs.nama}</p></td>
                        <td><p class="mb-0">${mhs.Jurusan || mhs.jurusan}</p></td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="editMahasiswa('${nim}', '${mhs.Nama || mhs.nama}', '${mhs.Jurusan || mhs.jurusan}')"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="deleteMahasiswa('${nim}')"><i class="fas fa-trash"></i></button>
                        </td></tr>`;
                    });
                } else {
                    html = noDataFound(4, "Tidak ada data mahasiswa.");
                }
                mhsListEl.innerHTML = html;
                tampilkanGrafikJurusan();

            } catch (error) {
                console.error(error);
                mhsListEl.innerHTML = noDataFound(4, "Gagal memuat data.");
            }
        }
        async function tampilkanGrafikJurusan() {
            try {
                const snapshot = await get(mahasiswaRef);
                const data = snapshot.val();
                const jurusanCount = {};

                if (data) {
                    Object.values(data).forEach(mhs => {
                        jurusanCount[mhs.Jurusan] = (jurusanCount[mhs.Jurusan] || 0) + 1;
                    });


                    if (window.jurusanChart instanceof Chart) {
                        window.jurusanChart.destroy();
                    }

                    const ctx = document.getElementById('jurusanChart').getContext('2d');
                    window.jurusanChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(jurusanCount),
                            datasets: [{
                                label: 'Jumlah Mahasiswa',
                                data: Object.values(jurusanCount),
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                }
            } catch (error) {
                console.error("Gagal memuat grafik jurusan:", error);
            }
        }
        document.getElementById('addForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const nim = document.getElementById('nim').value.trim();
            const nama = document.getElementById('nama').value.trim();
            const jurusan = document.getElementById('jurusan').value.trim();
            if (!nim || !nama || !jurusan) return;

            const nimRef = child(mahasiswaRef, nim);
            const snapshot = await get(nimRef);
            if (snapshot.exists()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'NIM sudah terdaftar!'
                });
                return;
            }
            await set(nimRef, {
                nama,
                jurusan
            });
            document.getElementById('addForm').reset();
            bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
            loadMahasiswaData();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data mahasiswa ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        });

        function editMahasiswa(nim, nama, jurusan) {
            document.getElementById('edit_nim').value = nim;
            document.getElementById('view_nim').value = nim;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_jurusan').value = jurusan;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }

        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const nim = document.getElementById('edit_nim').value;
            const nama = document.getElementById('edit_nama').value.trim();
            const jurusan = document.getElementById('edit_jurusan').value.trim();
            if (!nama || !jurusan) return;
            await set(child(mahasiswaRef, nim), {
                nama,
                jurusan
            });
            bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
            loadMahasiswaData();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data mahasiswa diupdate.',
                timer: 1500,
                showConfirmButton: false
            });
        });

        function deleteMahasiswa(nim) {
            Swal.fire({
                    title: 'Anda Yakin?',
                    text: "Data ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                })
                .then(async (result) => {
                    if (result.isConfirmed) {
                        await remove(child(mahasiswaRef, nim));
                        loadMahasiswaData();
                        Swal.fire('Dihapus!', 'Data mahasiswa berhasil dihapus.', 'success');
                    }
                });
        }

        // --- Parking Management ---
        function setupParkingListeners(type) {
            const typeDb = type === 'Motor' ? 'Motor' : 'Mobil';
            const parkirRef = ref(db, `parkir/${typeDb}`);
            const tempatParkirRef = ref(db, `tempat_parkir/${typeDb}`);
            const listEl = document.getElementById(`${type.toLowerCase()}List`);
            const slotListEl = document.getElementById(`slot${type}List`);
            const iconClass = type === 'Motor' ? 'fa-motorcycle' : 'fa-car';

            Chart.register(ChartDataLabels);

            let aksesChart = null;
            let hourlyChart = null;

            // Get today's date in YYYY-MM-DD format
            const today = new Date();
            const todayString = today.getFullYear() + '-' +
                String(today.getMonth() + 1).padStart(2, '0') + '-' +
                String(today.getDate()).padStart(2, '0');

            document.getElementById(`last_updated_${type.toLowerCase()}`).textContent = new Date().toLocaleString('id-ID');

            // Helper function to filter today's data only
            function filterTodayData(data) {
                const todayData = {};
                Object.entries(data).forEach(([key, value]) => {
                    if (typeof value === 'object' && (value.nim || value.NIM)) {
                        // Check if the entry's date matches today
                        if (value.tanggal === todayString) {
                            todayData[key] = value;
                        }
                    }
                });
                return todayData;
            }

            function updateAksesChart(data) {
                // Filter data for today only
                const todayData = filterTodayData(data);

                const stats = {
                    ktm: 0,
                    petugas: 0
                };

                Object.values(todayData).forEach(entry => {
                    if (entry.akses === 'ktm') stats.ktm++;
                    else if (entry.akses === 'petugas') stats.petugas++;
                });

                const ctx = document.getElementById(`aksesChart${type}`).getContext('2d');

                if (aksesChart) aksesChart.destroy();

                aksesChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Akses via KTM', 'Akses via Petugas'],
                        datasets: [{
                            data: [stats.ktm, stats.petugas],
                            backgroundColor: ['#5e72e4', '#2dce89'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            datalabels: {
                                color: 'white',
                                font: {
                                    size: 25,
                                    weight: 'bold'
                                },
                                formatter: (value, ctx) => {
                                    const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total ? Math.round((value / total) * 100) : 0;
                                    return percentage > 5 ? percentage + '%' : '';
                                }
                            }
                        }
                    }
                });
            }

            function updateSummaryStats(type, data) {
                // Filter data for today only
                const todayData = filterTodayData(data);

                let ktmCount = 0;
                let petugasCount = 0;
                let totalCount = 0;

                Object.keys(todayData).forEach(key => {
                    const entry = todayData[key];
                    if (entry && (entry.nim || entry.NIM)) {
                        totalCount++;
                        if (entry.akses === 'ktm') {
                            ktmCount++;
                        } else if (entry.akses === 'petugas') {
                            petugasCount++;
                        }
                    }
                });

                const stats = {
                    ktm: ktmCount,
                    petugas: petugasCount,
                    total: totalCount
                };

                const typePrefix = type.toLowerCase();

                document.getElementById(`total-ktm-${typePrefix}`).textContent = stats.ktm;
                document.getElementById(`total-petugas-${typePrefix}`).textContent = stats.petugas;
                document.getElementById(`total-akses-${typePrefix}`).textContent = stats.total;

                return stats;
            }

            function updateHourlyChart(data) {
                // Filter data for today only
                const todayData = filterTodayData(data);

                const hourlyStats = {};
                for (let i = 0; i < 24; i++) hourlyStats[i] = 0;

                Object.values(todayData).forEach(entry => {
                    const hour = parseInt(entry.waktu.split(':')[0]);
                    hourlyStats[hour]++;
                });

                const ctx = document.getElementById(`hourlyChart${type}`).getContext('2d');

                // Find peak hour and counts
                const maxCount = Math.max(...Object.values(hourlyStats));
                const peakHourIndex = Object.values(hourlyStats).indexOf(maxCount);
                const peakHour = Object.keys(hourlyStats)[peakHourIndex];

                // Calculate average per hour
                const nonZeroHours = Object.values(hourlyStats).filter(v => v > 0).length;
                const totalAccess = Object.values(hourlyStats).reduce((a, b) => a + b, 0);
                const avgPerHour = nonZeroHours > 0 ? Math.round(totalAccess / nonZeroHours) : 0;

                const typePrefix = type.toLowerCase();
                document.getElementById(`peak-hour-${typePrefix}`).textContent = `${peakHour}:00`;
                document.getElementById(`peak-count-${typePrefix}`).textContent = maxCount;
                document.getElementById(`avg-per-hour-${typePrefix}`).textContent = avgPerHour;

                if (hourlyChart) hourlyChart.destroy();
                hourlyChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Object.keys(hourlyStats).map(h => h + ':00'),
                        datasets: [{
                            label: 'Jumlah Akses',
                            data: Object.values(hourlyStats),
                            borderColor: '#5e72e4',
                            backgroundColor: 'rgba(94, 114, 228, 0.1)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Jam / Hari',
                                    color: '#cfd8dc',
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    }
                                },
                                ticks: {
                                    color: '#cfd8dc'
                                },
                                grid: {
                                    color: '#2e3c53'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Akses Parkir',
                                    color: '#cfd8dc',
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    }
                                },
                                ticks: {
                                    color: '#cfd8dc',
                                    beginAtZero: true,
                                    stepSize: 1
                                },
                                grid: {
                                    color: '#2e3c53'
                                }
                            }
                        }
                    }
                });
            }

            listEl.innerHTML = loadingSpinner;
            slotListEl.innerHTML = '<div class="col-12"><div class="spinner"></div></div>';

            onValue(parkirRef, (snapshot) => {
                const data = snapshot.val() || {};
                let html = '',
                    entries = [];

                Object.entries(data).forEach(([dateTime, value]) => {
                    if (typeof value === 'object' && (value.nim || value.NIM)) {
                        // Only include entries from today
                        if (value.tanggal === todayString) {
                            entries.push({
                                tanggal: value.tanggal || '',
                                waktu: value.waktu || '',
                                nim: value.nim || value.NIM || '',
                                nama: value.nama || value.Nama || '',
                                jurusan: value.jurusan || value.Jurusan || '',
                                akses: value.akses || '',
                            });
                        }
                    }
                });

                entries.sort((a, b) => (b.tanggal + ' ' + b.waktu).localeCompare(a.tanggal + ' ' + a.waktu));

                if (entries.length) {
                    entries.forEach(e => {
                        html +=
                            `<tr>
                        <td>${e.tanggal}</td>
                        <td>${e.waktu}</td>
                        <td>${e.nim}</td>
                        <td>${e.nama}</td>
                        <td>${e.jurusan}</td>
                        <td>
                            <span class="badge badge-md bg-gradient-${e.akses === 'ktm' ? 'primary' : 'success'}">${e.akses === 'ktm' ? "KTM" : "Petugas"}</span>
                        </td>
                    </tr>`;
                    });
                } else {
                    html = noDataFound(6, "Tidak ada riwayat parkir hari ini.");
                }
                listEl.innerHTML = html;

                updateSummaryStats(type, data);
                updateAksesChart(data);
                updateHourlyChart(data);
            });

            onValue(tempatParkirRef, (snapshot) => {
                const data = snapshot.val() || {};
                let html = '';
                for (let i = 1; i <= 4; i++) {
                    const status = (data['slot' + i] || 'available');
                    const isAvailable = status === 'available';
                    html += `<div class="col-6 col-md-3">
            <div class="slot-card ${isAvailable ? 'available' : 'occupied'}">
                <i class="fas ${iconClass} slot-icon"></i>
                <div class="slot-number">Slot ${i}</div>
                <p class="slot-status mb-0">${isAvailable ? 'Kosong' : 'Terisi'}</p>
            </div></div>`;
                }
                slotListEl.innerHTML = html;
            });
        }

        // --- Portal Management ---
        const jadwalRef = ref(db, 'jadwal_sistem');
        async function loadJadwalData() {
            const snapshot = await get(jadwalRef);
            const data = snapshot.val() || {};
            ['motor', 'mobil'].forEach(jenis => {
                if (data[jenis]) {
                    document.getElementById(`${jenis}_jam_mulai`).value = data[jenis].jam_mulai || '';
                    document.getElementById(`${jenis}_jam_selesai`).value = data[jenis].jam_selesai || '';
                    document.getElementById(`${jenis}_operasional`).value = data[jenis].operasional || 'off';
                }
            });
        }
        async function updateJadwal(jenis) {
            const jamMulai = document.getElementById(`${jenis}_jam_mulai`).value;
            const jamSelesai = document.getElementById(`${jenis}_jam_selesai`).value;
            const operasional = document.getElementById(`${jenis}_operasional`).value;
            if (!jamMulai || !jamSelesai) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Input Tidak Lengkap!',
                    text: 'Jam mulai dan selesai harus diisi!'
                });
                return;
            }
            await set(child(jadwalRef, jenis), {
                jam_mulai: jamMulai,
                jam_selesai: jamSelesai,
                operasional
            });
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: `Jadwal ${jenis} berhasil diupdate.`,
                timer: 1500,
                showConfirmButton: false
            });
        }

        // --- Initial Load ---
        document.addEventListener('DOMContentLoaded', () => {
            // --- Chart for Mobil ---
            const ctxMobil = document.getElementById('usageChartMobil')?.getContext('2d');
            if (ctxMobil) {
                window.usageChartMobilInstance = new Chart(ctxMobil, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: []
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            datalabels: {
                                color: '#FFFFFF',
                                font: {
                                    size: 12
                                },
                                formatter: (value, context) => {
                                    if (value > 0) {
                                        return value;
                                    }
                                    return '';
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 5,
                                ticks: { color: '#a0aec0' },
                                grid: { color: 'rgba(255,255,255,0.08)', drawBorder: false }
                            },
                            x: {
                                ticks: { color: '#a0aec0' },
                                grid: { color: 'rgba(255,255,255,0.08)', drawBorder: false }
                            }
                        }
                    }
                });
            }
            window.currentChartMode = 'hourly';
            setupDashboardMobil();

            // --- Chart for Motor ---
            const ctxMotor = document.getElementById('usageChartMotor')?.getContext('2d'); // Get context for Motor chart
            if (ctxMotor) {
                window.usageChartMotorInstance = new Chart(ctxMotor, { // Create instance for Motor
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: []
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            datalabels: {
                                color: '#FFFFFF',
                                font: {
                                    size: 12
                                },
                                formatter: (value, context) => {
                                    if (value > 0) {
                                        return value;
                                    }
                                    return '';
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 5,
                                ticks: { color: '#a0aec0' },
                                grid: { color: 'rgba(255,255,255,0.08)', drawBorder: false }
                            },
                            x: {
                                ticks: { color: '#a0aec0' },
                                grid: { color: 'rgba(255,255,255,0.08)', drawBorder: false }
                            }
                        }
                    }
                });
            }
            window.currentChartModeMotor = 'hourly';
            setupDashboardMotor();

            loadMahasiswaData();
            setupParkingListeners('Motor');
            setupParkingListeners('Mobil');
            loadJadwalData();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('mainNavbar');
            const scrollToTopBtn = document.getElementById("scrollToTopBtn");
            const scrollAnimateElements = document.querySelectorAll('.scroll-animate');

            // Navbar Scroll Effect
            const handleNavScroll = () => {
                if (window.scrollY > 50) navbar.classList.add('scrolled');
                else navbar.classList.remove('scrolled');
            };

            // Scroll to Top Button
            const handleScrollBtn = () => {
                if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                    scrollToTopBtn.style.display = "block";
                } else {
                    scrollToTopBtn.style.display = "none";
                }
            };
            scrollToTopBtn.addEventListener('click', () => window.scrollTo({
                top: 0,
                behavior: 'smooth'
            }));

            // Animate on Scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            scrollAnimateElements.forEach(el => observer.observe(el));

            // Event Listeners
            window.addEventListener('scroll', () => {
                handleNavScroll();
                handleScrollBtn();
            });

            // Initial calls
            document.getElementById('currentYear').textContent = new Date().getFullYear();
        });
    </script>
</body>

</html>
