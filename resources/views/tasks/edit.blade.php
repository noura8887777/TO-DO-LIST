<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Tâche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 600;
            color: #4b0082;
        }
        .btn-custom {
            background: linear-gradient(135deg, #6f42c1, #d63384);
            color: white;
            font-weight: 600;
            border: none;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #d63384, #6f42c1);
        }
        h2 {
            color: #6f42c1;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4">
                <h2>📝 modifier Tâche : {{$taskMod->title}}</h2>
                <form action="{{ route('tasks.update', $taskMod->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="title" class="form-control"
                    value="{{ old('title', $taskMod->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description', $taskMod->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Date limite</label>
                <input type="date" name="due_date" class="form-control"
                    value="{{ old('due_date', $taskMod->due_date) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select form-select-lg" required>
                    <option value="">-- Sélectionner le statut --</option>
                    <option value="pending" {{ old('status', $taskMod->status) == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="completed" {{ old('status', $taskMod->status) == 'completed' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-3">
                Mettre à jour
            </button>
        </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
