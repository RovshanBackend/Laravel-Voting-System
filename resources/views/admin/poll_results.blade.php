<!DOCTYPE html>
<html lang="az">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Səsvermə Nəticələri | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .progress {
            height: 25px;
            border-radius: 12px;
        }

        .progress-bar {
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="content container my-5">

        <h2 class="mb-4 text-primary">🗳️ Səsvermə Nəticələri</h2>

        @php
            $lehinə = $poll->votes->where('choice', 'lehinə')->count();
            $əleyhinə = $poll->votes->where('choice', 'əleyhinə')->count();
            $bitərəf = $poll->votes->where('choice', 'bitərəf')->count();
            $total = $poll->votes->count() ?: 1;

            $lehinəPercent = round(($lehinə / $total) * 100, 1);
            $əleyhinəPercent = round(($əleyhinə / $total) * 100, 1);
            $bitərəfPercent = round(($bitərəf / $total) * 100, 1);
        @endphp

        <div class="card p-4 mb-4">
            <h5 class="fw-semibold">{{ $poll->title }}</h5>
            <p class="text-muted small mb-3">Səsvermə bitmə tarixi: {{ $poll->end_date }}</p>

            <div class="mb-3">
                <label>Lehinə: {{ $lehinə }} səs</label>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: {{ $lehinəPercent }}%">
                        {{ $lehinəPercent }}%
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label>Əleyhinə: {{ $əleyhinə }} səs</label>
                <div class="progress">
                    <div class="progress-bar bg-danger" style="width: {{ $əleyhinəPercent }}%">
                        {{ $əleyhinəPercent }}%
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label>Bitərəf: {{ $bitərəf }} səs</label>
                <div class="progress">
                    <div class="progress-bar bg-secondary" style="width: {{ $bitərəfPercent }}%">
                        {{ $bitərəfPercent }}%
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.polls') }}" class="btn btn-secondary mt-3">⬅ Geri</a>
        </div>

    </div>


</body>

</html>
