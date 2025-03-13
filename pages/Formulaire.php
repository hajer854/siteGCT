<?php
$user = 'root';
$pass = '';
try {
    $db = new PDO('mysql:host=localhost;dbname=Formulairedecontact', $user, $pass);
    foreach ($db->query('SELECT * FROM articles') as $row) {
        print_r($row);
    }
} catch (PDOException $e) {
    print "Erreur: " . $e->getMessage() . "<br/>";
    die();
}

// Vérification si des données sont soumises depuis le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs des champs du formulaire
    $nom = $_POST['name'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['phone'];
    $message = $_POST['message'];

    // Préparation et exécution de la requête d'insertion
    $requete = $db->prepare("INSERT INTO contact (nom, prenom, email, telephone, message) VALUES (:nom, :prenom, :email, :telephone, :message)");
    $requete->execute([
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => $email,
        "telephone" => $telephone,
        "message" => $message
    ]);

    echo "Inscription réussie!";
    header("Location: index.html");
    exit(); 
}
?>