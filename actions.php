<?php
include 'db.php';
include 'Admin_Taches.php';




// 1. AJOUTER
if (isset($_POST['action']) && $_POST['action'] === 'ajouter') {

    $sql = "INSERT INTO taches (titre, description,statut,id_user)
            VALUES (:titre, :description,:statut,:id_user)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':titre' => $_POST['titre'],
        ':description' => $_POST['description'],
        ':statut' => $_POST['statut'],
        ':id_user' => $id
    ]);
    if($login=="admin"){
    header("Location: Admin_Taches.php");
    }else{
        header("Location: Users_Taches.php");
    }
    exit;
}

// 2. SUPPRIMER
if (isset($_GET['supprimer'])) {
    $stmt = $pdo->prepare("DELETE FROM taches WHERE id = ?");
    $stmt->execute([$_GET['supprimer']]);
    if($login=="admin"){
    header("Location: Admin_Taches.php");
    }else{
        header("Location: Users_Taches.php");
    }
    exit;
}

// 3. RÉCUPÉRER POUR MODIFIER
$tache_a_modifier = null;

if (isset($_GET['modifier'])) {

    $stmt = $pdo->prepare("SELECT * FROM taches WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $tache = $stmt->fetch();
    if($login=="admin"){
    header("Location: Admin_Taches.php");
    }else{
        header("Location: Users_Taches.php");
    }
}


// 4. MODIFIER
if (isset($_POST['action']) && $_POST['action'] === 'modifier') {
    
    $sql = "UPDATE taches
            SET titre = :titre, description = :description
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':titre' => $_POST['titre'],
        ':description' => $_POST['description'],
        ':id' => $_POST['id']
    ]);
   

   if($login=="admin"){
    header("Location: Admin_Taches.php");
    }else{
        header("Location: Users_Taches.php");
    }
    exit;
}

// 5. RÉCUPÉRER LISTE DES TACHES
$taches = $pdo->query("SELECT * FROM taches ORDER BY date_creation DESC")->fetchAll();
