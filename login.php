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
$login = $mot_de_passe = "";
$erreur_message = "";

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $login = $_POST["login"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Recherchez l'utilisateur dans la base de données par nom d'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Vérifiez si le mot de passe correspond
        if (password_verify($mot_de_passe, $row["mot_de_passe"])) {
            // Informations d'identification correctes, créer une session
            $_SESSION["login"] = $login;
            header("Location: session.php");
            exit;
        } else {
            // Mot de passe incorrect
            $erreur_message = "Mot de passe incorrect.";
        }
    } else {
        // Utilisateur non trouvé
        $erreur_message = "Nom d'utilisateur incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        /* Utilisez le même CSS que login.php */
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.login-container {
    /* max-width: 100px; */
    margin: 50px auto;
    background-color: #fff;
    padding: 20px 20px;
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
    width: 40%;
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
    <h1>Connexion</h1>
    
    <?php if (!empty($erreur_message)) : ?>
    <p><?php echo $erreur_message; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="login.php">
    <div class="dashboard-container">
        <label for="login">Nom d'utilisateur :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <input type="submit" value="Se connecter">

        <div>
        <boutton><a href="inscription.php">s' inscrire</a></button>
    </form>
</body>
</html>
