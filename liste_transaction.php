



<?php
include("connexion.php");
// Requête SQL pour récupérer les transactions de produits
$sql = "SELECT * FROM transactions";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    echo "<h1>Liste des transactions de produits :</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Produit</th><th>Type de transaction</th><th>Quantité</th><th>Date de transaction</th>><th>actions</th></tr>";


// Boucle pour afficher les transactions
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    $produit = $row['produit'];
    $type_transaction = $row['type_transaction'];
    $quantite_transaction = $row['quantite_transaction'];
    $date_transaction = $row['date_transaction'];
   
    echo "<tr>";
    
    echo "<td>$produit </td>";
    echo "<td>$type_transaction</td>";
    echo "<td>$quantite_transaction</td>";
    echo "<td>$date_transaction</td>";
    // echo "<td><button> supprimer</button></td>";
    echo "<td>
    <form action='supprimer.php' method='POST'>
        <input type='hidden' name='produit' value='$produit'>
        <input type='submit' value='Supprimer'>
    </form>
</td>";
      

    echo "</tr>";
   
 
}}
else{
    echo"tableau vide";
}







   
  
// Fermer la connexion à la base de données
$pdo = null;
?>


