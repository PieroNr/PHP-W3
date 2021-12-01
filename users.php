<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Utilisateurs</title>
        <link rel="stylesheet" href="src/assets/css/app.css">
    </head>
    <body>
        <nav class="w-100 nav bg-primary">
            <ul class="d-flex a-i-center">
                <li class="px-3">
                    <a class="d-flex a-i-center" style="opacity: 1;" href="index.php">
                        <img style="width: 40px;" src="src/assets/img/logo.png" alt="logo">
                    <h1>WRIT.OR</h1>
                    </a>
                </li>
                <li class="px-3"><a href="index.php">Home</a></li>
                <li class="px-3"><a href="">Account</a></li>
                <li class="px-3"><a href="users.php">Users</a></li>
                <li class="px-3 ms-auto">
                    <button class="btn">Log in</button>
                </li>
                <li class="px-3">
                    <button class="btn btn-secondary">Sign in</button>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="alert alert-danger">Si vous supprimer un utilisateur, ces posts seront automatiquement supprimer.</div>
            <table class="w-100 table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Seclet</td>
                        <td>Tristan</td>
                        <td><a href="mailto:tristanseclet@icloud.com">tristanseclet@icloud.com</a></td>
                        <td>
                            <label>
                                <input type="checkbox">
                            </label>Administrateur ?
                        </td>
                        <td>
                            <button class="btn btn-danger">Supprimer l'utilisateur</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Bouteiller</td>
                        <td>Adrien</td>
                        <td><a href="mailto:tristanseclet@icloud.com">adrienbouteiller@gmail.com</a></td>
                        <td>
                            <label>
                                <input type="checkbox">
                            </label>Administrateur ?
                        </td>
                        <td>
                            <button class="btn btn-danger">Supprimer l'utilisateur</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Neri</td>
                        <td>Piero</td>
                        <td><a href="mailto:tristanseclet@icloud.com">pieroneri@gmail.com</a></td>
                        <td>
                            <label>
                                <input type="checkbox">
                            </label>Administrateur ?
                        </td>
                        <td>
                            <button class="btn btn-danger">Supprimer l'utilisateur</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php
