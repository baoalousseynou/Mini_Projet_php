<?php
	@$nom=$_POST["nom"];
	@$prenom=$_POST["prenom"];
	@$login=$_POST["login"];
	@$pass=$_POST["password"];
	@$repass=$_POST["repass"];
	@$pseudo=$_POST["pseudo"];
	@$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
		if(empty($nom)) $message="<li>Non invalide!</li>";
		if(empty($prenom)) $message.="<li>Prénom invalide!</li>";
		if(empty($login)) $message.="<li>Login invalide!</li>";
		if(empty($pseudo)) $message.="<li>pseudo invalide!</li>";
		if(empty($pass)) $message.="<li>Mot de passe invalide!</li>";
		if($pass!=$repass) $message.="<li>Mots de passe non identiques!</li>";	
		if(empty($message)){
			 include("db.php");
			$req=$pdo->prepare("select id_user from users where pseudo=? limit 1");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$req->execute(array($pseudo));
			$tab=$req->fetchAll();
			if(count($tab)>0)
				$message="<li>Pseudo existe déjà!</li>";
			else{
				$ins=$pdo->prepare("insert into users(pseudo,nom,prenom,login,password) values(?,?,?,?,?)");
				$ins->execute(array($pseudo,$nom,$prenom,$login,sha1($pass)));
				header("location:pageConnexion.php");
			}
		}
	}
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 450px;">
        <h3 class="text-center mb-4">Inscription</h3>

        <form method="post" enctype="multipart/form-data">
			<?php if(!empty($message)){ ?>
            <div class="alert alert-danger mt-3 text-center">
                <?php echo $message ?>
            </div>
        <?php } ?>
            <div class="mb-3">
                <div class="col">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?php echo $nom ?>">
                </div>
                <div class="col">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="<?php echo $prenom ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">pseudo</label>
                <input type="text" name="pseudo" class="form-control" value="<?php echo $pseudo ?>">
            </div>

			<div class="mb-3">
                <label class="form-label">Login</label>
                <input type="text" name="login" class="form-control" value="<?php echo $login ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmer mot de passe</label>
                <input type="password" name="repass" class="form-control">
            </div>

            <button type="submit" name="valider" class="btn btn-success w-100">
                S'inscrire
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="pageConnexion.php">Déjà inscrit ?</a>
        </div>

        
    </div>
</div>

</body>
</html>
