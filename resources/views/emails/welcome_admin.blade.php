<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue dans votre association</title>
</head>
<body>
    <h2>Félicitations {{ $admin->name }} !</h2>

    <p>Votre association "{{ $association->name }}" a été créée avec succès.</p>

    <p>Voici vos identifiants pour vous connecter :</p>

    <ul>
        <li>Email : {{ $admin->email }}</li>
        <li>Mot de passe : {{ $password }}</li>
    </ul>

    <p>Nous vous recommandons de changer votre mot de passe après votre première connexion.</p>
</body>
</html>
