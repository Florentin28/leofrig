<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        h1 {
            font-size: 3rem;
        }

        .logout-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Admin Panel</h1>

    @if(session('role'))
    <p>Message flash de rôle : {{ session('role') }}</p>
    <p>Rôle de l'utilisateur : {{ $user->role }}</p>
@else
    <p>Message flash de rôle non défini.</p>
@endif



    <!-- Bouton de déconnexion -->
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="logout-btn">Déconnexion</button>
    </form>
</body>
</html>
