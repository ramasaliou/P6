<!DOCTYPE html>
<html>
<head>
    <title>Vérifier le Stock</title>
</head>
<body>
    <h1>Vérifier le Stock</h1>
    
    <!-- Insérez ici le code PHP pour afficher la quantité actuelle des produits en stock -->
    <?php
// Inclure le fichier de connexion à la base de données
include("connexion.php");

// Sélectionnez les données de stock depuis la base de données
$sql = "SELECT nom_produit, quantite FROM produits";
$result = $pdo->query($sql);

// Affichez le résultat
if ($result->rowCount() > 0) {
    echo "<h2>Quantité des Produits en Stock :</h2>";
    echo "<ul>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>{$row['nom_produit']} : {$row['quantite']} unités</li>";
    }
    echo "</ul>";
} else {
    echo "Aucun produit en stock pour le moment.";
}

// Fermez la connexion à la base de données
$pdo = null;
?>

</body>
</html>