<?php
// Vérifier si le formulaire d'ajout de produit a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_produit = $_POST["nom_produit"];
   
    $quantite = $_POST["quantite"];
   

    // Établir une connexion à la base de données
    include("connexion.php");

    // Préparer la requête SQL pour ajouter le produit
    $sql = "INSERT INTO produits (nom_produit, quantite) VALUES (:nom_produit, :quantite)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nom_produit", $nom_produit, PDO::PARAM_STR);
   
    $stmt->bindParam(":quantite", $quantite, PDO::PARAM_INT);
  

    if ($stmt->execute()) {
        echo "Produit ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du produit.";
    }

    // Fermer la connexion à la base de données
    $pdo = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Produit</title>
    <style>
        /* Utilisez le même CSS que login.php */
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.login-container {
    max-width: 300px;
    margin: 100px auto;
    background-color: #fff;
    padding: 20px 30px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 9px;
}

h2 {
    margin-top: 0;
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
}

input[type="text"], input[type="password"], input[type="email"] {
    width: 50%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 10px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

p {
    color: red;
    font-weight: bold;
}

    </style>
</head>
<body>
    <h1>Ajouter un Produit</h1>
    <form action="ajout_produit.php" method="post">
        <label for="nom_produit">Nom du Produit :</label>
        <input type="text" id="nom_produit" name="nom_produit" required><br>
        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" required><br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>