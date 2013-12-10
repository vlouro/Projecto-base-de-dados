<?php

session_start();
if($_SESSION['id']<1){
	header("Location: index.php");
}else{
	$name = $_SESSION['name'];



include("assets/cnx.php");
$action = $_GET['action'];
$id = $_GET['id'];


if($action == 'add'){
	$sbmt_value = "Adicionar Jogo";
}else{
	$sbmt_value = "Editar Informações";
}

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
						<input type="submit" class="btns" value="pesquisar" name="sbmt_search">
		</form>		
		</div>
	</div>
		</header>

		<section>

		<?php

			//LISTAR
			//=============================================
			if($action == ''){

			$q = mysql_query("SELECT * FROM colecao ORDER BY game_name DESC") or die('Erro: ' .mysql_error());
			}

			//Pesquisar

			if($action == 'search'){
				$query = '%'.$_POST['query'].'%';
				$pesquisa = substr("$query",1,-1);
				echo "Pesquisou por: ".$pesquisa;
				$q = mysql_query("SELECT * FROM colecao WHERE game_name LIKE '$query' ORDER BY game_name DESC") or die ('Error: '.mysql_error());
			}


			if($action == '' || $action == 'search'){

				$n = mysql_num_rows($q);

			if($n > 0){?>
			<div id="tabela">
				<table>
					<thead>
						<tr>
							<th>Nome</th>
							<th>Código</th>
							<th>Plataforma</th>
							<th>Formato</th>
							<th>Tipo</th>
							<th>Estado</th>
							<th>Ano</th>
							<th>Preço</th>
							<th>Situação</th>

						</tr>
					</thead>
					<tbody>
						
						<?php


						while($r = mysql_fetch_assoc($q)){?>
						<tr>
							<?php $id = $r['game_id']; ?>

							<td><a href="game_details.php?id=<?php echo $id; ?>"><?php echo $r['game_name']; ?></td>
							<td><?php echo $r['game_code']; ?></td>
							<td><?php echo $r['game_console']; ?></td>
							<td><?php echo $r['game_format']; ?></td>
							<td><?php echo $r['game_type']; ?></td>
							<td><?php echo $r['game_state']; ?></td>
							<td><?php echo $r['game_year']; ?></td>
							<td><?php echo $r['game_price']; ?></td>
							<td><?php echo $r['game_borrowed']; ?></td>
							<td><a href="jogos.php?action=upd&id=<?php echo $id;  ?>">Editar</a></td>
							<td><a href="jogos.php?action=del&id=<?php echo $id;  ?>">Delete</a></td>

						</tr>
						<?php } ?>

					</tbody>

					<tfoot>
						<tr>
							<td colspan="8"><?php echo $n; ?> registo(s)</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<?php }}
			if($action == 'add' || $action == 'upd'){
				if($action == 'upd'){
					$q = mysql_query("SELECT * FROM colecao WHERE game_id = '$id'") or die('Erro '.mysql_error());
					$r = mysql_fetch_assoc($q);
			}
			?>


		<?php 

			//INSERIR
		?>

		<div id="inserir">
		<form action="jogos.php?action=<? echo $action; ?>" method="post" enctype="multipart/form-data">
			<label id="centro"><?php echo $sbmt_value; ?></label>
			<fieldset>
				<ul>
					<li>
						<label>Nome do jogo:</label>
						<input type="text" name="game_name" id="game_name" value="<?php echo $r['game_name']; ?>"/>
					</li>

					<li>
						<label>Código do Jogo:</label>
						<input type="text" name="game_code" id="game_code" value="<?php echo $r['game_code']; ?>"/>
					</li>

					<li>
						<label>Plataforma:</label>
							<select name="game_console" id="game_console">
									<option value="" selected="selected"> Selecionar uma Plataforma </option>
									<option value="PC" <?php if($r['game_console'] == "PC"){echo "selected ='selected'";} ?>>Computador</option>
									<option value="Playstation 1"<?php if($r['game_console'] == "Playstation 1"){echo "selected ='selected'";} ?>>Playstation 1</option>
									<option value="Playstation 2" <?php if($r['game_console']== "Playstation 2"){echo "selected ='selected'";} ?>>Playstation 2</option>
									<option value="Playstation 3" <?php if($r['game_console'] == "Playstation 3"){echo "selected ='selected'";} ?>>Playstation 3</option>
									<option value="PSP" <?php if($r['game_console'] == "PSP"){echo "selected ='selected'";} ?>>PSP</option>
							</select>		
					</li>

					<li>
						<label>Formato:</label>
							<select name="game_format" id="game_format">
								<option value="" selected="selected">Selecionar um formato</option>
								<option value="Físico" <?php if($r['game_format'] == "Físico"){echo "selected ='selected'";} ?>>Físico</option>
								<option value="Digital" <?php if($r['game_format'] == "Digital"){echo "selected ='selected'";} ?>>Digital</option>
							</select>
					</li>


					<li>
						<label>Tipo de jogo:</label>
							<select name="game_type" id="game_type">
									<option value="" selected="selected">Selecionar um Tipo</option>
									<option value="Acção" <?php if($r['game_type'] == "Acção"){echo "selected ='selected'";} ?>>Acção</option>
									<option value="Aventura" <?php if($r['game_type'] == "Aventura"){echo "selected ='selected'";} ?>>Aventura</option>
									<option value="Corridas" <?php if($r['game_type']== "Corridas"){echo "selected ='selected'";} ?>>Corridas</option>
									<option value="Desporto" <?php if($r['game_type'] == "Desporto"){echo "selected ='selected'";} ?>>Desporto</option>
									<option value="FPS" <?php if($r['game_type'] == "FPS"){echo "selected ='selected'";} ?>>FPS</option>
									<option value="RPG" <?php if($r['game_type']== "PC"){echo "selected ='selected'";} ?>>RPG</option>
							</select>
					</li>



					<li>
						<label>Estado do Jogo:</label>
							<select name="game_state" id="game_state">
								<option value="" selected="selected">Selecionar um estado</option>
								<option value="Novo" <?php if($r['game_state'] == "Novo"){echo "selected ='selected'";} ?>>Novo</option>
								<option value="Semi-Novo" <?php if($r['game_state'] == "Semi-Novo"){echo "selected ='selected'";} ?>>Semi-Novo</option>
								<option value="Riscado" <?php if($r['game_state'] == "Riscado"){echo "selected ='selected'";} ?>>Riscado</option>
								<option value="Estragado" <?php if($r['game_state'] == "Estragado"){echo "selected ='selected'";} ?>>Estragado</option>
							</select>
					</li>

					<li>
						<label>Ano de Lançamento:</label>
						<select name="game_year" id="game_year" >
						<option value="" selected="selected">Selecionar um Ano</option>
										<?php
											$year = date ("Y");

											for($i=$year; $i>=$year-30; $i--){
												if ($r['game_year']== $i){
													echo "<option selected = 'selected' value='".$i."'>".$i."</option>";
												}else{
													echo "<option value='".$i."'>".$i."</option>";
												}
											}
										?>
						</select>				
					</li>

					<li>
						<label>Preço de Compra:</label>
						<input type="text" name="game_price" id="game_price" value="<?php echo $r['game_price']; ?>"/>
					</li>

					<li>
						<label>Situação:</label>
						<input type="text" name="game_borrowed" id="game_borrowed" value="<?php echo $r['game_borrowed']; ?>"/>
					</li>	

				</ul>	

			</fieldset>
				<fieldset>
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" class="btns" value="<?php echo $sbmt_value ?>" name="sbmt">
				</fieldset>
		</form>

		<?php
			if(isset($_POST['sbmt'])){
				$id = $_POST['id'];
				$game_name = $_POST['game_name'];
				$game_code = $_POST['game_code'];
				$game_console = $_POST['game_console'];
				$game_format = $_POST['game_format'];
				$game_type = $_POST['game_type'];
				$game_state = $_POST['game_state'];
				$game_year = $_POST['game_year'];
				$game_price = $_POST['game_price'];
				$game_borrowed = $_POST['game_borrowed'];
					
				
				//Adicionar
				if($action == 'add'){
					$i = mysql_query("INSERT INTO colecao (game_name, game_code, game_console, game_format, game_type, game_state, game_year, game_price, game_borrowed) VALUES('$game_name','$game_code', '$game_console', '$game_format', '$game_type', '$game_state', '$game_year', '$game_price', '$game_borrowed')") or die("Erro: ".mysql_error());
				}

				//UPDATE

				if($action == 'upd'){
					$u = mysql_query("UPDATE colecao SET game_name = '$game_name', game_code = '$game_code', game_console = '$game_console', game_format = '$game_format', game_type ='$game_type', game_state = '$game_state', game_year = '$game_year', game_price = '$game_price', game_borrowed = '$game_borrowed' WHERE game_id = '$id'") or die("Erro: ".mysql_error());
						echo "<script>window.location.href='jogos.php'</script>";
				}

			}
			?></div><?php

		}
			//Eliminar

			if($action == 'del'){
				$d = mysql_query("DELETE FROM colecao WHERE game_id = '$id'") or die("Erro: ".mysql_error());
				echo "<script>window.location.href='jogos.php'</script>";

				unlink("covers/image.jpg");
				rmdir("covers");
				echo "<script>window.location.href='jogos.php'</script>";
			}


			//CONTACTOS --------------------------------------
			if($action == 'cot'){ ?>
				<div id="contacto">
				<form action="jogos.php?action=<? echo $action; ?>" method="post" enctype="multipart/form-data">
					<ul>
					    <li>	        
					    	<label>Email</label>
					    	<input name="email" type="email" id="email_contacto">
					    </li>	

						<li>
							<label>Assunto</label>
							<input name="assunto" id="assunto" id="assunto">
						</li>
					            
					    <li>       
					   		<label>Messagem</label>
					    	<textarea name="mensagem" class="texto" id="mensagem"></textarea>
					            
					    </li>	
		    		</ul>
		    		<input id="enviar_mail" name="submit" type="submit" value="Enviar">
		    	</form>

				<?php
					if (isset($_REQUEST['enviar_mail'])){
					  $email_contacto = $_REQUEST['email_contacto'];
					  $assunto = $_REQUEST['assunto'];
					  $mensagem = $_REQUEST['mensagem'];
					  mail("valterlouro@gmail.com", $assunto,
					  $mensagem, "From:".$email_contacto);
					  echo "Email enviado";
					}
				?>


				<div>
			<?php } ?>

	</section>
	</body>

</html>
<?php } ?>
