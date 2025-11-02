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
        <h2>İstifadəçini redaktə et</h2>
    </div>

    <div class="row g-4">

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" class="form-control my-2" name="name" value="{{ $user->name }}" required>
            <input type="email" class="form-control my-2" name="email" value="{{ $user->email }}" required>
            <select name="role" class="form-control my-2" required>
                <option value="user" @if ($user->role == 'user') selected @endif>İstifadəçi</option>
                <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
            </select>

            <a href="{{ route('admin.users') }}" class="btn btn-secondary">⬅ Geri</a>
            <button type="submit" class="btn btn-md btn-primary">Güncəllə</button>

        </form>
    </div>
</div>
