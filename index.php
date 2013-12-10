<?php
include("assets/cnx.php");

$action = $_GET['action'];
$code = $_GET['code'];


?>
<html>
	<head>
		<meta charset="utf-8" />
		<script type="text/javascript"></script>
		<link rel="stylesheet" media="screen" href="css/style.css"/>
	</head>


		<body>
			<header>
				<div id="esquerda">
				</div>
			</header>
		<section>
			<?php 
				//Signin
			//================================================\\
				if(!isset($action)){ ?>
				<div id="formulario">
				<form action="index.php" method="post">
					<fieldset>
						<ul>
							<li>
								<label for="email">E-mail:</label>
								<input type="text" name="email" id="email" placeholder="Insira o email">
							</li>

							<li>
								<label for="password">Password:</label>
								<input type="password" name="password" id="password" placeholder="Insira a password">
							</li>
						</lu>
					</fieldset>
					<fieldset>
						<input type="submit" class="btns" name="sbmt_signin" value="Entrar">
					</fieldset>
				</form>			
	
				<a href="index.php?action=signup">Registar</a> |
				<a href="index.php?action=restore">Recuperar</a>
				
			<?php	

			if(isset($_POST['sbmt_signin'])){
				$email = $_POST['email'];
				$password = crypt($_POST['password'], $email);

				$q = mysql_query("SELECT * FROM users WHERE user_mail = '$email' AND user_password = '$password' AND user_activated = 1") or die('Erro: '.mysql_error());
				$n = mysql_num_rows($q);
					if($n == 1){
						$r = mysql_fetch_assoc($q);
						session_start();
						$_SESSION['id'] = $r['user_id'];
						$_SESSION['name'] = $r['user_name'];
						echo "<script>window.location.href='jogos.php'</script>";
					}else{
					?>
					<script>
				document.getElementById("formulario").style.height="170px";
					</script>
					<?php
				echo "<br /><br />A autenticação falhou! <br /> Deseja <a href='index.php?action=restore'>recuperar a passwor</a>?";
			}


				}


			}	

				?> </div> <?php


			//SIGNUP
			//================================================\\
			if($action == 'signup'){ ?>
			<div id="formulario2">
				<form action="index.php?action=<?php echo $action; ?>" method="post">
					<fieldset>
						<label>Registo</label>
						<ul>

							<li>
								<label for="name">Nome</label>
								<input type="text" name="name" id="name">
							</li>


							<li>
								<label for="email">E-mail</label>
								<input type="text" name="email" id="email">
							</li>

							<li>
								<label for="password">Password</label>
								<input type="password" name="password" id="password">
							</li>

							<li>
								<label for="passwordc">Password (Confirmação)</label>
								<input type="password" name="passwordc" id="passwordc">
							</li>
						</ul>

					</fieldset>
					<fieldset>
							<input type="submit" name="sbmt_signup" value="Registar" class="btns">
					</fieldset>
				</form>

				<a href="index.php">Entrar</a> |
				<a href="index.php?action=restore">Recuperar</a>
			</div>
			<?php 

				if(isset($_POST['sbmt_signup'])){
					$name = $_POST['name'];
					$email = $_POST['email'];
					$code = md5($time);
					
					$time = date('Y-m-d G:i:s');




					$passwordc = $_POST['passwordc'];
					$password = $_POST['password'];

					if($password !== $passwordc){
						echo "As passwords não são iguais";
					}else{

						$password = crypt($_POST['password'], $email);

						$i = mysql_query("INSERT INTO users (user_name,user_mail,user_password, user_time, user_code, user_activated) VALUES ('$name','$email', '$password', '$time', '$code', '0') ") or die('Erro '.mysql_error());

						$msg ="A sua conta foi criada com sucesso mas precisa de ser activada.<br> <a href='http://localhost/miniprojecto/index.php?action=activate?code=".$code."'>Clique aqui para activar</a>";
						//echo "<script>window.location.href='index.php'</script>";

						// ENVIO de EMAIL

						require_once('class.phpmailer.php');
						include('class.smtp.php');
						

$mail             = new PHPMailer();

$mail->IsSMTP();
// telling the class to use SMTP
$mail->Host       = "ssl://smtp.gmail.com";
// SMTP server
$mail->SMTPDebug  = 1;   // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth   = true;   // enable SMTP authentication
$mail->SMTPSecure = "ssl";  // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      	
// sets GMAIL as the SMTP server
$mail->Port       = 465;                  
// set the SMTP port for the GMAIL server
$mail->Username   = '';  	
// GMAIL username
$mail->Password   = "";          
// GMAIL password

$mail->SetFrom($email, $name);
$mail->AddReplyTo($email, $name);
$mail->Subject    = 'Activação de Conta';

//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($msg);
$mail->AddAddress($email, $name);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
 echo "Ocorreu um erro: " . $mail->ErrorInfo;
} else {
 echo "Registo efectuado com sucesso! Verifique o seu e-mail!<br />";
}


					}
					
				}



			}
				//RECUPERAÇÂO
				//==============================

				if($action == 'restore'){ ?>
					<div id="formulario3">
					<form action="index.php?action<?php echo $action; ?>" method="post">
							<fieldset>
								<legend>Recuperação de Password</legend>
							<ul>
								<li>
									<label for="email">E-mail</label>
									<input type="text" name="email" id="email">
								</li>
								
							</ul>
							</fieldset>
							<fieldset>
								<input type="submit" name="sbmt_restore" value="Recuperar" class="btns">
							</fieldset>	

					</form>
					<a href="index.php">Entrar</a> |
					<a href="index.php?action=signup">Registar</a>
					</div>
					<?php }

				//ACTIVAÇÂO
				//=======================================
				if($action == 'activate'){
						$q = mysql_query("SELECT * FROM users WHERE user_code = '$code'") or die('Erro: '.mysql_error());

						$n = mysql_num_rows($q);

					if($n = 1){
						$u = mysql_query("UPDATE users SET user_activated = '1' WHERE user_code = '$code'") or die('Erro: '.mysql_error());
						echo "Conta Activada com Sucesso";
					}


				}	
			?>

		</section>
		<footer>
		</footer>
		</body>
</html>