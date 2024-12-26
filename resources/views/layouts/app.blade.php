
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
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            padding: 0px;
            position: fixed;
            width: 250px;
        }
        html, body {
            height: 100%;
            overflow: hidden;  /* Prevent scrolling */
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            height: 100%;
            overflow-y: auto; /* Allow vertical scrolling within the container if needed */
        }

        .sidebar h4 {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .sidebar .nav-item {
            margin-bottom: 15px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover {
            color: #17a2b8;
        }
        .sidebar a.active {
            font-weight: bold;
            color: #17a2b8;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .horizontal-line {
            width:100%;
            border: 0;
            border-top: 55px solid #6C757D; /* The color and thickness of the line */
            margin: 0; /* Removes all margins */
            padding: 0; /* Removes all padding */
            margin-left: auto; /* Pushes the line to the right */
}

    </style>

</head>
<body>
    @include('auth.header')
   
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header" style="background-color: gray; padding: 10px; display: flex; align-items: center;">
            <img src="/images/dnss.png" alt="DNS Logo" style="width: 40px; height: 35px; margin-right: 10px;">
            <h6 style="margin: 0; font-size: 18px; color: rgb(10, 9, 9);">FREE-DNS Manager</h6>
        </div>
        
    <ul class="nav flex-column container mt-4">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">
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