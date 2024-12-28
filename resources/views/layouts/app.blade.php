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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
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
            overflow: auto;  /* Prevent scrolling */
        }

        .sidebar {
    height: 100vh; /* Set sidebar to full height */
    background-color: #343a40;
    color: #fff;
    padding: 0;
    position: fixed;
    width: 250px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    top: 0; /* Align with the header */
    left: 0;
    transition: left 0.3s ease;
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
            transition: margin-left 0.3s ease;
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
            margin-left: 250px; /* Offset for sidebar */
            z-index: 1030; /* Ensure it appears above the sidebar */
        }
        .header .navbar-nav {
            margin-left: 0;
        }

        .header .navbar-nav .nav-link {
            color: #fff;
        }

        .header .navbar-nav .nav-link:hover {
            color: #17a2b8;
        }

        .sidebar-header {
                background-color: #333;
                padding: 13px 15px; /* Adjust padding for better alignment */
                display: flex;
                align-items: center;
                justify-content: flex-start; /* Align items to the left */
                position: sticky; /* Keep it fixed when scrolling */
                top: 0;
                z-index: 1020;
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
    <style>
        .info-box {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            color: #fff;
            margin-bottom: 20px;
        }
        .bg-gradient-success { background: linear-gradient(to right, #28a745, #218838); }
        .bg-gradient-warning { background: linear-gradient(to right, #ffc107, #e0a800); }
        .bg-gradient-info { background: linear-gradient(to right, #17a2b8, #117a8b); }
        .info-box-icon {
            font-size: 2rem;
            margin-right: 15px;
        }
        .info-box-content {
            flex: 1;
        }
        .sidebar.collapsed {
    width: 60px; /* Adjust to your preferred width */
    transition: width 0.3s ease, left 0.3s ease;
    overflow: hidden; /* Hide content when collapsed */
}

.sidebar.collapsed .nav-link span {
    display: none; /* Hide text labels */
}

.sidebar.collapsed .nav-link i {
    font-size: 20px; /* Adjust icon size if needed */
    margin: 0 auto; /* Center the icons if needed */
}

.content {
    transition: margin-left 0.3s ease;
    width: calc(100% - 250px); 
}

.sidebar.collapsed + .content {
    margin-left: 70px; /* Adjust to match collapsed width */
    width: calc(100% - 70px);
}
.sidebar.right {
    left: auto;
    right: 0;
    transition: right 0.3s ease, left 0.3s ease; /* Smooth transition */
}

    </style>
    <style>
        .custom-box {
            border-top: 5px solid blue; /* Blue top border */
            background: #fff; /* Optional: Set a background color */
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow */
            border-radius: 8px; /* Optional: Round the corners */
            color: #000; /* Optional: Adjust text color */
            padding: 15px; /* Optional: Adjust padding */
            margin-bottom: 30px; /* Optional: Add spacing between sections */
        }
        .row {
    display: flex;
    flex-wrap: wrap;
}

.info-box {
    flex: 1 1 100%; /* Make each box take up 33% of the row */
    max-width: 100%; /* Ensure it doesn't exceed this width */
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
                <a class="nav-link" href="dashboard">
                    <i class="fa fa-home"></i>
                    <span>Main</span> <!-- This is the text that will be hidden -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('zones.index') }}">
                    <i class="fa fa-table"></i>
                    <span>Zones</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="chpass.php">
                    <i class="fa fa-key"></i>
                    <span>Change Password</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="commit.php">
                    <i class="fa fa-code-branch"></i>
                    <span>Commit Changes</span>
                </a>
            </li>
            
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.sidebar');
            const toggleButton = document.getElementById('sidebarToggle');
    
            toggleButton.addEventListener('click', function () {
                // Toggle 'collapsed' class for sidebar collapse behavior
                sidebar.classList.toggle('collapsed');
                
                // Toggle 'right' class to move sidebar to the right side
                sidebar.classList.toggle('left');
            });
        });
    </script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('popup'))
            $('#popupModal').modal('show');
        @endif
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>
