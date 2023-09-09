
<?php
// Inclure le fichier de connexion
include("connexion.php");

// Démarrez la session
session_start();

// Vérifiez si l'utilisateur est déjà connecté, redirigez-le vers la page session.php si c'est le cas
if (isset($_SESSION["login"])) {
    header("Location: session.php");
    exit;
}

// Définissez des variables pour stocker les données du formulaire
$nom = $prenom = $login = $mot_de_passe = $confirmation_mot_de_passe = "";
$erreur_message = "";

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $login = $_POST["login"];
    $mot_de_passe = $_POST["mot_de_passe"];
    $confirmation_mot_de_passe = $_POST["confirmation_mot_de_passe"];

    // Vérifiez si les mots de passe correspondent
    if ($mot_de_passe !== $confirmation_mot_de_passe) {
        $erreur_message = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifiez si le nom d'utilisateur existe déjà dans la base de données
        $sql = "SELECT * FROM utilisateurs WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $erreur_message = "Ce nom d'utilisateur est déjà pris.";
        } else {
            // Hasher le mot de passe
            $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);

            // Insérer l'utilisateur dans la base de données
            $sql = "INSERT INTO utilisateurs (nom, prenom, login, mot_de_passe) VALUES (:nom, :prenom, :login, :mot_de_passe)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
            $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
            $stmt->bindValue(":login", $login, PDO::PARAM_STR);
            $stmt->bindValue(":mot_de_passe", $mot_de_passe_hash, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Redirigez l'utilisateur vers la page de connexion
                header("Location: login.php");
                exit;
            } else {
                $erreur_message = "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        /* Utilisez le même CSS que login.php */
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.login-container {
    max-width: 400px;
    margin: 100px auto;
    background-color: #fff;
    padding: 20px 30px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
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
    width: 100%;
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
    padding: 10px 20px;
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
    <h1>Inscription</h1>
    
    <?php if (!empty($erreur_message)) : ?>
    <p><?php echo $erreur_message; ?></p>
    <?php endif; ?>
 
    <form method="POST" action="inscription.php">
    
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="login">Nom d'utilisateur :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <label for="confirmation_mot_de_passe">Confirmation du mot de passe :</label>
        <input type="password" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" required><br><br>

        <input type="submit" value="S'inscrire">
        
    </form>
    
</body>
</html>









