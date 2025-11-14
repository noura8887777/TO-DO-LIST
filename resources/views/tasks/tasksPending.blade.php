<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Tâches</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: "Poppins", sans-serif;
    }

    .search-bar {
      max-width: 400px;
      margin: 30px auto;
    }

    .job-card {
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      background: #fff;
      padding: 20px;
      transition: all 0.3s ease;
      border-left: 6px solid #c2188c;
    }

    .job-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
    }

    .job-title {
      font-weight: 700;
      color: #212529;
      font-size: 1.2rem;
    }

    .skills span {
      background-color: #f1f3f5;
      border-radius: 20px;
      padding: 6px 14px;
      font-size: 0.85rem;
      display: inline-block;
      color: #6c757d;
    }

    /* ✅ Boutons harmonisés */
    .btn-update {
      background-color: #ececf4d8;
      color: #c2188c;
      border:solid 2px #c2188c;
      transition: 0.3s ease;
    }

    .btn-update:hover {
      background-color: #4f47d8;
      color: white;
    }

    .btn-delete {
      background-color:#c2188c;
      color: white;
      border:solid 2px white;
      transition: 0.3s ease;
    }

    .btn-delete:hover {
      background-color: #7e4f7d;
      color: white;
    }

    .btn {
      border-radius: 8px;
      font-weight: 600;
      padding: 8px 14px;
    }
  </style>
</head>
<body>
<x-app-layout>

  <!-- 🔍 Barre de recherche -->
  <div class="container my-4">
    <form action="{{ route('tasks.index') }}" method="GET" class="d-flex justify-content-center">
        <input type="text" 
               name="search" 
               class="form-control form-control-lg w-50 shadow-sm rounded-pill px-4" 
               placeholder="🔍 Rechercher une tâche..."
               value="{{ request('search') }}">
    </form>
  </div>

  <!-- 🧾 Liste des tâches -->
  <div class="container">
    <div class="row g-4">
      @forelse ($taskpending as $task)
        <div class="col-md-4">
          <div class="job-card">
          <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="d-inline">
          @csrf
          @method('PATCH')
          <input type="checkbox" onchange="this.form.submit()" {{ $task->status == 'completed' ? 'checked' : '' }}>
          </form>
            <h5 class="job-title">{{ $task->title }}</h5>
            <p class="text-muted mb-1">
              <small>🕓 Créée le : <strong>{{ $task->created_at}}</strong></small><br>
              <small>📅 Échéance : <strong>{{ $task->due_date }}</strong></small>
            </p>

            <p class="mt-3"><strong>Description :</strong><br>{{ $task->description }}</p>

            <div class="skills mb-3">
              <span>{{ $task->status == 'pending' ? '⏳ En attente' : '✅ Terminée' }}</span>
            </div>

            <div class="d-flex justify-content-between mt-3">
              <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-update w-48">✏️ Modifier</a>
              
              <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Supprimer cette tâche ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete w-48">🗑️ Supprimer</button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="alert alert-warning text-center">
          😔 Aucune tâche trouvée.
        </div>
      @endforelse
    </div>
  </div>

</x-app-layout>
</body>
</html>
