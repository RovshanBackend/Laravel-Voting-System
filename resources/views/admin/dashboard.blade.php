<!DOCTYPE html>
<html lang="az">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
        }

        .sidebar h4 {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 8px 0;
            margin-bottom: 8px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .content {
            margin-left: 240px;
            padding: 30px;
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }

        .action-btns button {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="active">📊 İcmal</a>
        <a href="{{ route('admin.users') }}">👥 İstifadəçilər</a>
        <a href="{{ route('admin.polls') }}">🗳️ Səsvermələr</a>
        <a href="#">⚙️ Parametrlər</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-light btn-sm w-100">🚪 Çıxış</button>
        </form>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>İdarəetmə Paneli</h2>
        </div>

        <div class="row g-4">

            @php
                use App\Models\User;
                use App\Models\Poll;
                use App\Models\Vote;
                $totalUsers = User::count();
                $totalPolls = Poll::count();
                $totalVotes = Vote::count();
            @endphp

            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h5>İstifadəçilər</h5>
                    <p class="display-6 fw-bold mb-0">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h5>Səsvermə aksiyaları</h5>
                    <p class="display-6 fw-bold mb-0">{{ $totalPolls }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h5>Aktiv səsvermələr</h5>
                    <p class="display-6 fw-bold mb-0 text-success">{{ $totalVotes }}</p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
