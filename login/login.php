<?php
require_once("includes/connection.php");
//include("includes/header.php");
session_start();

if(isset($_POST["login"])){

if(!empty($_POST['username']) && !empty($_POST['password'])){
	$username=$_POST['username'];
	$password=$_POST['password'];

	$query= $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
	$query->bindParam("username", $username, PDO::PARAM_STR);
	$query->execute();

	$result = $query->fetch(PDO::FETCH_ASSOC);

	if(!$result){
		echo'<p class="error">La combinacion del usuarui y la contraseña son invalidos!</p>';
	}else {
		if(password_verify($password, $result['password'])){
			$_SESSION['session_username']=$username;

			header("Location: intropage.php");

		}

		else{
			$message="Nombre de usuario o contraseña invalida";
		}
	}
}
 else{
 	$message="Todos los campos son requeridos";
 }

}
?>
	<div class="container mlogin">
		<div id="login">
	<h1>Autenticacion de Usuario</h1>
<form name="loginform" id="loginform" action="" method="POST">
	<p>
		<label for="user_login">Nombre de Usuario<br />
		<input type="text" name="username" id="username" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">Contraseña<br />
		<input type="password" name="password" id="password" class="input" value="" size="20" /></label>
	</p>
		<p class="submit">
		<input type="submit" name="login" class="button" value="Entar"	 />
	</p>
		<p class="regtext">No estas registrado? <a href="register.php">Registrate Aqui</a>!</p>
</form>
	
	</div>
    </div>

    <?php include("includes/footer.php");?>
    <?php if(!empty($message)) {echo "<p class=\"error\">" . $message . "</p>";}?>