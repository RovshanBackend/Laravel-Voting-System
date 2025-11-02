<!DOCTYPE html>
<html lang="az">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Səsvermə | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            max-width: 700px;
            margin: 40px auto;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
        }

        .btn {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-4 text-primary">🗳️ Yeni Səsvermə Yarat</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.polls.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Səsvermə başlığı</label>
                        <input type="text" id="title" name="title" class="form-control"
                            placeholder="Məsələn: Yeni ofis qaydalarının təsdiqi" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Təsvir</label>
                        <textarea id="description" name="description" class="form-control" rows="3"
                            placeholder="Səsvermənin məqsədini qısaca qeyd edin..." required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Başlama tarixi</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Bitmə tarixi</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="form-select">
                            <option value="active" selected>Aktiv</option>
                            <option value="inactive">Bağlanıb</option>
                        </select>
                    </div> --}}

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.polls') }}" class="btn btn-secondary">⬅ Geri</a>
                        <button type="submit" class="btn btn-primary">Səsverməni Yarat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
