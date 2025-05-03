<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LNU Feedback System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }
        .header {
            background-color: #0275d8;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo-text {
            font-size: 22px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .logo-img {
            height: 30px;
            margin-right: 10px;
        }
        .sidebar {
            background-color: white;
            min-height: calc(100vh - 56px);
            border-right: 1px solid #ddd;
            padding: 20px 0;
        }
        .sidebar-heading {
            font-weight: bold;
            padding: 0 15px 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #666;
            font-size: 14px;
            padding: 8px 15px;
        }
        .nav-tabs .nav-link.active {
            border-bottom: 2px solid #0275d8;
            color: #0275d8;
            background-color: transparent;
            font-weight: 500;
        }
        .instructor-item {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.2s;
        }
        .instructor-item:hover {
            background-color: #f8f9fa;
        }
        .instructor-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 15px;
        }
        .instructor-info {
            font-size: 14px;
            color: #666;
        }
        .instructor-name {
            font-weight: 500;
            color: #333;
            margin-bottom: 3px;
        }
        .welcome-card {
            background-color: #20B2AA;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        .stats-card {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            text-align: center;
            margin-bottom: 20px;
        }
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #0275d8;
        }
        .btn-logout {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
        }
        .content-area {
            padding: 25px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo-text">
            <img src="{{ asset('images/lnu-logo.png') }}" alt="LNU Logo" class="logo-img">
            LNU Feedback
        </div>
        <div>
            <button class="btn btn-logout">Logout</button>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                @yield('sidebar')
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Any custom JavaScript can go here
    </script>
</body>
</html>