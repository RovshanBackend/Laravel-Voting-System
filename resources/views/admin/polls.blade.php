<!DOCTYPE html>
<html lang="az">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İstifadəçilər | Admin Panel</title>
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
        <a href="{{ route('admin.dashboard') }}">📊 İcmal</a>
        <a href="{{ route('admin.users') }}">👥 İstifadəçilər</a>
        <a href="{{ route('admin.polls') }}" class="active">🗳️ Səsvermələr</a>
        <a href="#">⚙️ Parametrlər</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-light btn-sm w-100">🚪 Çıxış</button>
        </form>
    </div>

    <body>
        <div class="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>🗳️ Səsvermə Aksiyaları</h2>
                <a href="{{ route('admin.polls.create') }}" class="btn btn-primary">+ Yeni səsvermə</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Polls Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Başlıq</th>
                                <th>Təsvir</th>
                                <th>Başlama tarixi</th>
                                <th>Bitmə tarixi</th>
                                {{-- <th>Ümumi səslər</th> --}}
                                {{-- <th>Status</th> --}}
                                <th>Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($polls as $poll)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $poll->title }}</td>
                                    <td>{{ $poll->description }}</td>
                                    <td>{{ $poll->start_date }}</td>
                                    <td>{{ $poll->end_date }}</td>
                                    {{-- <td>42</td> --}}
                                    {{-- <td><span class="badge bg-success">Aktiv</span></td> --}}
                                    <td class="action-btns">
                                        <a href="{{ route('admin.poll.results', $poll->id) }}"
                                            class="btn btn-sm btn-info">Nəticələr</a>
                                        <a href="{{ route('admin.polls.edit', $poll->id) }}"
                                            class="btn btn-warning btn-sm">Redaktə</a>
                                        <form action="{{ route('admin.polls.delete', $poll->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

</html>
