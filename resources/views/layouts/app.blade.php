<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }
        html, body {
            height: 100%;
            overflow: hidden;  /* Prevent scrolling */
        }

        .sidebar {
            height: 120vh;
            background-color: #343a40;
            color: #fff;
            padding: 0;
            position: fixed;
            width: 250px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h4 {
            font-size: 18px;
            margin-bottom: 30px;
            padding: 10px 15px;
        }

        .sidebar .nav-item {
            margin-bottom: 15px;
        }

        .sidebar a {
            color: #fff;
            display: block;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 15px;
        }

        .sidebar a:hover {
            color: #17a2b8;
            background-color: #495057;
        }

        .sidebar a.active {
            font-weight: bold;
            color: #17a2b8;
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            background-color: #f8f9fa;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .navbar-brand {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .horizontal-line {
            width: 100%;
            border: 0;
            border-top: 2px solid #6C757D; 
            margin: 0; 
            padding: 0;
        }

        .header {
            background-color: #343a40;
        }

        .header .navbar {
            padding: 10px 15px;
        }

        .header .navbar-nav {
            margin-left: 250px;
        }

        .header .navbar-nav .nav-link {
            color: #fff;
        }

        .header .navbar-nav .nav-link:hover {
            color: #17a2b8;
        }

        .sidebar-header {
            background-color: #333;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            color: #fff;
        }

        .sidebar-header img {
            width: 40px;
            height: 35px;
            margin-right: 10px;
        }

        .sidebar-header h6 {
            margin: 0;
            font-size: 18px;
        }

    </style>

</head>
<body>
    @include('auth.header')

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="/images/dnss.png" alt="DNS Logo">
            <h6>FREE-DNS Manager</h6>
        </div>
        
        <ul class="nav flex-column container mt-4">
            <li class="nav-item">
                <a class="nav-link active" href="dashboard">
                    <i class="fa fa-home"></i>&nbsp;&nbsp; Main
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('zones.index') }}">
                    <i class="fa fa-table"></i>&nbsp;&nbsp; Zones
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="chpass.php">
                    <i class="fa fa-key"></i>&nbsp;&nbsp; Change Password
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="commit.php">
                    <i class="fa fa-code-branch"></i>&nbsp;&nbsp; Commit Changes
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Welcome, <strong>RAJVIRSINGH</strong></span>
                <form action="{{ route('logout') }}" method="POST" class="ml-3">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
