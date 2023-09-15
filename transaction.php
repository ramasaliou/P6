<?php
// Assurez-vous d'avoir une connexion à la base de données ici (inclusion de connexion.php)
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produit = $_POST["produit"];
    $type_transaction = $_POST["type_transaction"];
    $quantite_transaction = $_POST["quantite_transaction"];
    $date_transaction = $_POST["date_transaction"];
    $details = $_POST["details"];

    // Insérer les données de la transaction dans la base de données
    try {
        $sql = "INSERT INTO transactions (produit, type_transaction, quantite_transaction, date_transaction, details) VALUES (:produit, :type_transaction, :quantite_transaction, :date_transaction, :details)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":produit", $produit);
        $stmt->bindParam(":type_transaction", $type_transaction);
        $stmt->bindParam(":quantite_transaction", $quantite_transaction);
        $stmt->bindParam(":date_transaction", $date_transaction);
        $stmt->bindParam(":details", $details);

        if ($stmt->execute()) {
            // La transaction a été enregistrée avec succès
            // Vous pouvez rediriger l'utilisateur ou afficher un message de succès
            // header("Location: transaction.php?success=1");
            echo "transaction reussi";
            header("Location: liste_transaction.php");
            exit;
        } else {
            // Gestion des erreurs d'exécution de la requête
            echo "Erreur d'exécution de la requête SQL.";
        }
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    }

    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Transaction</title>
</head>
<body>
    <h1>Formulaire de Transaction</h1>

    <form action="transaction.php" method="POST">
        <label for="produit">Produit :</label>
        <select id="produit" name="produit">
            <option value="1">Produit 1</option>
            <option value="2">Produit 2</option>
            <option value="3">Produit 3</option>
            <!-- Ajoutez ici d'autres options pour les produits existants -->
        </select>

        <br>

        <label for="type_transaction">Type de Transaction :</label>
        <input type="radio" id="entree" name="type_transaction" value="entree">
        <label for="entree">Entrée</label>
        <input type="radio" id="sortie" name="type_transaction" value="sortie">
        <label for="sortie">Sortie</label>

        <br>

        <label for="quantite_transaction">Quantité :</label>
        <input type="number" id="quantite_transaction" name="quantite_transaction" required>

        <br>

        <label for="date_transaction">Date :</label>
        <input type="date" id="date_transaction" name="date_transaction" required>

        <br>

        <label for="details">Détails :</label>
        <textarea id="details" name="details" rows="4" cols="50"></textarea>

        <br>

        <input type="submit" value="Enregistrer la Transaction">
    </form>
</body>
</html>
