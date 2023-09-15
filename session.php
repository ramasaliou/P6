<?php
// Démarrez la session
session_start();

// Vérifiez si l'utilisateur est authentifié
if (!isset($_SESSION["login"])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas authentifié
    header("Location: login.php");
    exit;
}

// Le reste du code de la page à accès limité va ici

// Par exemple, vous pouvez afficher le nom de l'utilisateur authentifié :
echo "Bienvenue, " . $_SESSION["login"] . "!";

// Ou afficher du contenu spécifique aux utilisateurs authentifiés

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page à accès limité</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
</head>
<body>
    <div class="dashboard-container">
    <h1>Bienvenue sur la page à accès limité</h1>
    <p>Ceci est une page réservée aux utilisateurs authentifiés.</p>
    <p>  <ul>
        <li><a href="ajout_produit.php">Ajouter un Produit</a></li>
        <li><a href="transaction.php">transaction</a></li>
        <li><a href="liste_transaction.php">liste _transaction</a></li>
        <li><a href="verifier_stock.php">Vérifier le Stock</a></li>
    </ul.</p>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
    <div>
</body>
</html>
