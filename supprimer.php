<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["produit"])) {
    $produit = $_POST["produit"];
    print($produit);

    // Utilisez une requête DELETE pour supprimer la transaction
    $sql = "DELETE FROM transactions WHERE produit= :produit";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":produit", $produit, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // La transaction a été supprimée avec succès
        echo "Transaction supprimée avec succès.";
        //  header("location:liste_transaction.php"); 
    } else {
        // Erreur lors de la suppression
        echo "Erreur lors de la suppression de la transaction.";
    }
}
?>
