<?php

session_start();

if(isset($_POST['bt_limpa']))
{
session_destroy();
header('Location:index.php');
}
?>
 

<div id="conteiner_tabela">

<?php
if(isset($_SESSION['server_banco']))
{
?>
<form name="frm2" method="post">
<?php
	 
	$connexao=mssql_pconnect($_SESSION['server_banco'],$_SESSION['usu_banco'],$_SESSION['usu_senha'])or die("Erro na conexao".mssql_get_last_message());
	//$banco=mysql_select_db($_SESSION['nome_banco'],$connexao)or die(mysql_error());
	
	$_SESSION['connexao']=$connexao;
	$consulta= "SHOW TABLES FROM  ".$_SESSION['nome_banco'];
	
	$resultado = mysql_query($consulta,$_SESSION['connexao'])or die("Erro na consulta".mysql_error());
	//echo "passou 1";
	//print_r($resultado);
	echo "Escolha apenas uma tabela.<br>";
	while ($linha = mysql_fetch_row($resultado)) 
	{
	?>
	<input type="radio" name="tb_escolhida" value="<?php echo ($linha[0]); ?>"/>
		<?php echo ($linha[0]); ?>
	<?php
	}

	mysql_free_result($resultado);
?>
<input type="hidden" name="busca_tabela"/>
<input type="submit" value="Buscar Campos"/>
</form>
<?php
}
?>
</div>

<div id="conteiner_gerar_codigo">
<?php
if(isset($_POST['busca_tabela']))
{
?>
<form name="frm3" method="post">
<?php	
//echo "passou";
	$connexao=mysql_connect($_SESSION['server_banco'],$_SESSION['usu_banco'],$_SESSION['usu_senha'])or die(mysql_error());
	$banco=mysql_select_db($_SESSION['nome_banco'],$connexao)or die(mysql_error());
	$consulta= "SHOW COLUMNS FROM ".$_POST['tb_escolhida'];
	$resultado = mysql_query($consulta)or die(mysql_error());
	//print_r($resultado);
	echo "Escolha o tipo de cada compo.<br>";
	while ($linha = mysql_fetch_row($resultado)) 
	{
	?>
	<?php echo ($linha[0]); ?>
	<select name="op_<?php echo ($linha[0]); ?>">
		<option>hidden</option>
		<option>nada</option>
		<option selected="selected">text</option>
		<option>textarea</option>
		<option>password</option>
		<option>select</option>
		<option>checkbox</option>
		<option>radio</option>

	</select>	
	<br>
	<?php
	}

	mysql_free_result($resultado);
?>
<input type="hidden" name="cria_codigo"/>
<input type="submit" value="Gerar Código" name="btn_gerar_codigo"/>
</form>
</div>
<?
}
?>

<?php
 
if(isset($_POST['cria_codigo']))
{
 $campo="Exemplo Campos\n<!--\n";
	foreach($_POST as $linha=>$valor)
	{
		if($linha=="cria_codigo")break; //se chegar ao fim deve sair do for
		
		
		 switch($valor)
		 {
		  case "nada":
			$campo.= "\n";
			break;
		  case "textarea": 
			$campo.= "<textarea name='txta_".$linha."'>teste</textarea>";
			break;
		  case "select":
			$campo.= "<select name='sel_".$linha."'><option value=''>teste</option></select>\n";
			break;
		  default:
			$campo.= "<input type='".$valor."' name='".$linha."' value=''/>\n";
			break;
		}	
		//echo $linha." valor ".$valor."<br>";	
	}
	  $campo.="\n-->";
	echo "<textarea name='txtareass' rows='15' style='width:600px'>".$campo."</textarea><br>";
}
print_r($_SESSION);
echo "<br>";
print_r($_POST);
?>
<form name="frm_limpa_sessao" method="post">
<input type="submit" name="bt_limpa" value="limpa Sessão"/>
</form>