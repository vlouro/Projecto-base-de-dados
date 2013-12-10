<?php
session_start();
if($_SESSION['id']<1){
	header("Location: index.php");
}else{
	$name = $_SESSION['name'];


include("assets/cnx.php");
$id = $_GET['id'];

?>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" media="screen" href="css/style.css"/>
	</head>


		<body>
		<header>
		<div>
		<div id="esquerda">
		<span class="hello"> Olá <?php echo $name; ?>,</span>
		<a href="signout.php">Sair</a>
		<a href="jogos.php">Lista</a> 
		<a href="jogos.php?action=add">Inserir Jogo</a>
		<a href="jogos.php?action=cot">Contacto</a> 
		</div>
		<div id="direita">
		<form action ="jogos.php?action=search" method="post">
						<label>Pesquisa</label><input type="text" name="query" id="query" />
						<input type="submit" value="pesquisar" name="sbmt_search">
		</form>		
		</div>
		</div>
		</header>
		<section>
			<div id ="detalhes">
			<?php

			//DETALHES
			//=============================================
			$q = mysql_query("SELECT * FROM colecao WHERE game_id = '$id'") or die('Erro: ' .mysql_error());

			$n = mysql_num_rows($q);

			if($n > 0){
				$r = mysql_fetch_assoc($q)?>
					<h1> <?php echo $r['game_name'] ?></h1>
				<table>
					<tr> 
						<td>Código</td>
						<td><?php echo $r['game_code']; ?></td>
					</tr>

					<tr> 
						<td>Plataforma</td>
						<td><?php echo $r['game_console']; ?></td>
					</tr>

					<tr> 
						<td>Formato</td>
						<td><?php echo $r['game_format']; ?></td>
					</tr>

					<tr> 
						<td>Tipo</td>
						<td><?php echo $r['game_type']; ?></td>
					</tr>


					<tr> 
						<td>Estado</td>
						<td><?php echo $r['game_state']; ?></td>
					</tr>

					<tr> 
						<td>Ano</td>
						<td><?php echo $r['game_year']; ?></td>
					</tr>

					<tr> 
						<td>Preço</td>
						<td><?php echo $r['game_price']; ?></td>
					</tr>

					<tr> 
						<td>Situação</td>
						<td><?php echo $r['game_borrowed']; ?></td>
					</tr>

				</table>
			<?php } ?>
		<a href="jogos.php?action=upd&id=<?php echo $id; ?>">EDIT</a>
		<a href="jogos.php?action=del&id=<?php echo $id; ?>">DEL</a>
		</div>
		</section>
		</body>
</html>
<?php } ?>
