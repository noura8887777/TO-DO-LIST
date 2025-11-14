<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer une tâche</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: "Poppins", sans-serif;
    }

    .form-container {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      border-radius: 15px;
      padding: 35px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      border-left: 6px solid #c2188c;
    }

    h2 {
      color: #c2188c;
      font-weight: 700;
      text-align: center;
      margin-bottom: 25px;
    }

    label {
      font-weight: 600;
      color: #333;
    }

    .form-control,
    .form-select {
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid #ddd;
      transition: 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #c2188c;
      box-shadow: 0 0 5px rgba(194, 24, 140, 0.3);
    }

    .btn-save {
      background-color: #c2188c;
      color: #fff;
      border: none;
      font-weight: 600;
      padding: 10px 20px;
      border-radius: 10px;
      transition: 0.3s;
    }

    .btn-save:hover {
      background-color: #a01572;
    }

    .alert {
      border-radius: 10px;
    }

    .back-btn {
      text-decoration: none;
      color: #6c63ff;
      font-weight: 600;
    }

    .back-btn:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<x-app-layout>
  <div class="form-container">
    <h2>➕ Ajouter une nouvelle tâche</h2>

    @if (session('succee'))
      <div class="alert alert-success text-center">
        {{ session('succee') }}
      </div>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}">
      @csrf

      <div class="mb-3">
        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" placeholder="Ex: Corriger le bug d’authentification">
        @error('title')
          <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="description" id="description" rows="4" class="form-control" placeholder="Décris la tâche...">{{ old('description') }}</textarea>
        @error('description')
          <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="due_date" class="form-label">Date limite</label>
        <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="form-control">
        @error('due_date')
          <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
        <select name="status" id="status" class="form-select">
          <option value="">-- Sélectionner --</option>
          <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>En attente</option>
          <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Terminée</option>
        </select>
        @error('status')
          <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
      </div>
      <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('tasks.index') }}" class="back-btn">← Retour à la liste</a>
        <button type="submit" class="btn btn-save">💾 Enregistrer la tâche</button>
      </div>

    </form>
  </div>
</x-app-layout>

</body>
</html>
