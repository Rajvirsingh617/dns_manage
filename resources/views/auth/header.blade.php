<head>
    <hr class="horizontal-line">
    </div>
</head>
<body>
    <div class="header">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Welcome, <strong>RAJVIRSINGH</strong></span>
        </div>
    </div>

    <!-- Add a new div for the logout button -->
    <div class="logout-btn-container" style="display: flex; justify-content: flex-start; padding: 10px;">
        <form action="{{ route('logout') }}" method="POST" class="ml-3">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>

 