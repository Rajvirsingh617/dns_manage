<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

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

        html,
        body {
            height: 100%;
            overflow: auto;
            /* Prevent scrolling */
        }

        .sidebar {
            height: 100vh;
            /* Set sidebar to full height */
            background-color: #343a40;
            color: #fff;
            padding: 0;
            position: fixed;
            width: 250px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            top: 0;
            /* Align with the header */
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
            margin-left: 250px;
            /* Offset for sidebar */
            z-index: 1030;
            /* Ensure it appears above the sidebar */
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
            padding: 13px 15px;
            /* Adjust padding for better alignment */
            display: flex;
            align-items: center;
            justify-content: flex-start;
            /* Align items to the left */
            position: sticky;
            /* Keep it fixed when scrolling */
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

        .bg-gradient-success {
            background: linear-gradient(to right, #36AD51, #36AD51);
        }

        .bg-gradient-warning {
            background: linear-gradient(to right, #FFC414, #FFC414);
        }

        .bg-gradient-info {
            background: linear-gradient(to right, #2CABBF, #2CABBF);
        }

        .info-box-icon {
            font-size: 2rem;
            margin-right: 15px;
        }

        .info-box-content {
            flex: 1;
        }

        .sidebar.collapsed {
            width: 60px;
            htr
            /* Adjust to your preferred width */
            transition: width 0.3s ease, left 0.3s ease;
            overflow: hidden;
            /* Hide content when collapsed */
        }

        .sidebar.collapsed .nav-link span {
            display: none;
            /* Hide text labels */
        }

        .sidebar.collapsed .nav-link i {
            font-size: 20px;
            /* Adjust icon size if needed */
            margin: 0 auto;
            /* Center the icons if needed */
        }

        .content {
            transition: margin-left 0.3s ease;
            width: calc(100% - 250px);
        }

        .sidebar.collapsed+.content {
            margin-left: 70px;
            /* Adjust to match collapsed width */
            width: calc(100% - 70px);
        }

        .sidebar.right {
            left: auto;
            right: 0;
            transition: right 0.3s ease, left 0.3s ease;
            /* Smooth transition */
        }

    </style>
    <style>
        .custom-box {
            border-top: 5px solid blue;
            /* Blue top border */
            background: #fff;
            /* Optional: Set a background color */
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            /* Optional: Add a subtle shadow */
            border-radius: 8px;
            /* Optional: Round the corners */
            color: #000;
            /* Optional: Adjust text color */
            padding: 15px;
            /* Optional: Adjust padding */
            margin-bottom: 30px;
            /* Optional: Add spacing between sections */
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .info-box {
            flex: 1 1 100%;
            /* Make each box take up 33% of the row */
            max-width: 100%;
            /* Ensure it doesn't exceed this width */
        }

    </style>
    <style>
        .footer {
            border-top: 2px solid #fff;
            /* White border for design */
            background-color: #343a40;
            /* Dark background */
            color: #fff;
            /* White text */
            text-align: center;
            /* Center text */
            padding: 10px 0;
            /* Vertical spacing */
            position: relative;
            /* Default positioning */
            width: 100%;
            /* Full width */
        }

        .footer {
            flex-shrink: 0;
            /* Footer stays at the bottom */
        }

    </style>
    <style>
        table {
            table-layout: auto;
            /* Allows column width to adjust based on content */
            width: 100%;
            /* Ensures the table spans the container */
        }



        .custom-box {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .text-right {
            text-align: right;
            margin-bottom: 20px;
        }

        .btn-flat {
            margin: 0 5px;
        }

        .table {
            margin-top: 20px;
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .btn-flat {
            border: none;
            border-radius: 4px;
            font-size: 14px;
            padding: 10px 20px;
            margin: 0 5px;
            text-transform: uppercase;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-flat:hover {
            background-color: #0056b3;
            color: #fff;
            text-decoration: none;
        }

        .gray-background li {
            background-color: #6E777F;
            /* Light gray */
            padding: 1px;
            /* Add padding for spacing */
            margin-bottom: 5px;
            /* Add spacing between list items */
            border-radius: 5px;
            /* Optional: Rounded corners */
            list-style-type: none;
            /* Optional: Remove bullet points */
            color: #fff;
            /* Text color */
            width: 210px;
            font-weight: bold;

        }

    </style>
</head>

<body>
    @include('layouts.header')

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="/images/dnss.png" alt="DNS Logo">
            <h6>FREE-DNS Manager</h6>

        </div>

        <ul class="nav flex-column container mt-4">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
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
                <a class="nav-link" href="{{ route('password.change') }}">
                    <i class="fa fa-key"></i>
                    <span>Change Password</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('commit.changes') }}">
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
        {{-- @include('layouts.footer') --}}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <
            blade
            if |(session( % 26 % 2339 % 3 Bpopup % 26 % 2339 % 3 B)) % 0 D >
                $('#popupModal').modal('show'); <
            /blade endif|%0D>
        });

    </script>
    
    <script>
        function confirmDelete(zoneId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirmed
                    document.getElementById('deleteForm-' + zoneId).submit();
                }
            });
        }

    </script>
      <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#dataTable tbody tr');
            
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const entriesCount = document.getElementById("entriesCount");
            const dataTable = document.getElementById("dataTable");
            const rows = dataTable.querySelectorAll("tbody tr");
    
            function updateTable() {
                const count = parseInt(entriesCount.value, 10);
                rows.forEach((row, index) => {
                    row.style.display = index < count ? "" : "none";
                });
            }
    
            // Initial update to apply default count
            updateTable();
    
            // Update table on "Show entries" change
            entriesCount.addEventListener("change", updateTable);
        });
    </script>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
