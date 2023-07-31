<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presto.it | Diventa Revisore</title>
</head>
<body>
    <div style="text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <h1><b>Un utente ha chiesto di diventare revisore!</b></h1>
        <h2 style="font-weight: 600;">Ecco i suoi dati:</h2>
        <p><span style="font-weight: 600;">Nome</span> -> <em>{{$user->name}}</em></p>
        <p><span style="font-weight: 600;">Email</span> -> <em>{{$user->email}}</em></p>
        <p><span style="font-weight: 600;">Perchè vuoi diventare Revisore di Presto.it?</span></p>
        <p><em>{{$user->description}}</em></p>
        <p>Se vuoi renderlo revisore clicca qui:</p>
        <a href="{{route('make.revisor', compact('user'))}}" style="background-color: red; color: white; font-size: 1.5rem; font-weight: bold; text-decoration: none; border-radius: 0.5rem; padding: 0.5rem 1rem;">RENDI REVISORE</a>
    </div>
</body>
</html>

