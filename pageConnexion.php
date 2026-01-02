<?php
	
	$login=$_POST["login"];
	$password=sha1($_POST["password"]);
	$pseudo=$_POST["pseudo"];
	$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
		include("db.php");
		$res=$pdo->prepare("select * from users where  login=? and password=? ");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($login,$pass));
		$tab=$res->fetchAll();
		$login=$tab["0"]["login"];
		$id=$tab["0"]["id_user"];
		if(count($tab)==0)
			$message="<li>Mauvais pseudo ou mot de passe!</li>";
		else{
			if ($login=="admin") {
				require_once("Admin_Taches.php");
				return;
				
			}elseif ($login=="users") {
				require_once("Users_Taches.php");
				return;
			}else {
				$message="<li>Access Refusé</li>";
			}
			
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Authentification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 300px;">
        <h3 class="text-center mb-4">Authentification</h3>

        <form name="fo" method="post" action="">
            <div class="mb-3">
                <label class="form-label">Login</label>
                <input type="text" name="login" class="form-control" value="<?php echo $login ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" >
            </div>

            <button type="submit" name="valider" class="btn btn-primary w-100">
                Se connecter
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="inscription.php">Créer un compte</a>
        </div>

        <?php if(!empty($message)){ ?>
            <div class="alert alert-danger mt-3 text-center">
                <?php echo $message ?>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
