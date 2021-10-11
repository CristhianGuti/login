<?php

require_once("includes/login.php");
include("includes/header.php");
session_start();

if(isset($_POST["register"])){

if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])){
	$full_name=$_POST['fullname'];
	$email=$_POST['email'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password_has = password_hash($password, PASSWORD_BCRYPT);

	$query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");

		$query->bindParam("email", $email, PDO::PARAM_STR);
		$query->execute();

		if($query->rowCount() > 0){
			echo '<p class= "error">EL email ya se encuentra registrado</p>';
		}
        
        if($result){
        	$message = "cuenta correctamente creada";
        }

        else{
        	$message= "Error al ingresar datos de la informacion ";
        }
    }
    else{
    	$message= "El nombre del usuario ya existe! Por favor, Intenta con otro";
    }
    }

    else{
    	$message="Todos los campos no deben de estar vacios ";

    }


?>

<?php if (!empty($message)) {echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";}?>
<div class="container mregister">
		<div id="login">
			<h1>Registrar</h1>

<form name="registerform" id="registerform" action="register.php" method="post">
	<p>
		<label for="user_login">Nombre Completo<br />
		<input type="text" name="fullname" id="fullname" class="input" size="32" value="" /></label>
	</p>
	
	<p>
	<label for="user_pass">E-mail<br />
	<input type="email" name="email" id="email" class="input" value="" size="32" /></label>
	</p>

	<p>
	<label for="user_pass">Nombre de Usuario<br />
	<input type="text" name="username" id="username" class="input" value="" size="20" /></label>
	</p>

	<p>
	<label for="user_pass">Contraseña<br />
	<input type="password" name="password" id="password" class="input" value="" size="32" /></label>
	</p>

	<p class="regtext">Ya tienes una cuenta? <a href="login.php">Entra Aqui</a>!</p>
	</form>	

</div>
</div>
<?php include("includes/footer.php");?>






