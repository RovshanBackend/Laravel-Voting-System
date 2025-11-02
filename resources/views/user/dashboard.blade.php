<!DOCTYPE html>
<html lang="az">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İstifadəçi Paneli – Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #0d6efd;
        }

        .navbar-brand,
        .navbar-text {
            color: #fff !important;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .vote-btns button {
            width: 30%;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('user.dashboard') }}">Səsvermə Sistemi</a>
            <div class="d-flex">
                <span class="navbar-text me-3">Salam, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer;">Çıxış</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- User dashboard -->
    <div class="container my-5">

        {{-- 🔹 Aktiv səsvermələr --}}
        <h4 class="mb-4">Aktiv səsvermələr</h4>
        <div class="row g-4">
            @if (!empty($polls) && $polls->count() > 0)
                @foreach ($polls as $poll)
                    <div class="col-md-6">
                        <div class="card p-4">
                            <h5>{{ $poll->title }}</h5>
                            <p class="text-muted small mb-4">Səsvermə bitmə tarixi: {{ $poll->end_date }}</p>

                            <form action="{{ route('user.polls.vote') }}" method="POST">
                                @csrf
                                <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                                <div class="vote-btns d-flex justify-content-between">
                                    <button type="submit" name="choice" value="lehinə"
                                        class="btn btn-success btn-sm">Lehinə</button>
                                    <button type="submit" name="choice" value="əleyhinə"
                                        class="btn btn-danger btn-sm">Əleyhinə</button>
                                    <button type="submit" name="choice" value="bitərəf"
                                        class="btn btn-secondary btn-sm">Bitərəf</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted">Hazırda aktiv səsvermə yoxdur.</p>
            @endif
        </div>

        {{-- 🔹 İştirak etdiyim səsvermələr --}}
        <h4 class="mt-5 mb-4">İştirak etdiyim səsvermələr</h4>
        <div class="row g-4">
            @if (!empty($votedPolls) && $votedPolls->count() > 0)
                @foreach ($votedPolls as $poll)
                    <div class="col-md-6">
                        <div class="card p-4 bg-light">
                            <h5>{{ $poll->title }}</h5>
                            <p class="text-muted small">Səsvermə bitmə tarixi: {{ $poll->end_date }}</p>

                            @php
                                $vote = $poll->votes->where('user_id', auth()->id())->first();
                            @endphp

                            @if ($vote)
                                <span
                                    class="badge
                                @if ($vote->choice === 'lehinə') bg-success
                                @elseif($vote->choice === 'əleyhinə') bg-danger
                                @else bg-secondary @endif">
                                    Sizin seçiminiz: {{ ucfirst($vote->choice) }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted">Hələ heç bir səsvermədə iştirak etməmisiniz.</p>
            @endif
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
