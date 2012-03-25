<?php
session_start();
?>
<style type="text/css">
#conteiner_dados select
{
	width:300px;
}
#conteiner_dados input
{
	width:200px;
	
}
#conteiner_dados
{
	background:#d2d2d2;
	width:600px;
	margin:0 auto;
	color:#666;
	text-align:center;
}
</style>

<div id="conteiner_dados">
<form name="frm1" method="post">
Escolha o Banco
<select name="sel_banco_con">
<option value="1">SqlServer</option>
<option value="2">Oracle</option>
<option value="3">PostgresSql</option>
<option value="4">Firebird</option>
<option value="5" selected="selected">Mysql</option>
</select><br>
Entre com o Servidor  
<input type="text" name="server_banco" value="localhost"/><br>
Entre com o usuario  
<input type="text" name="usu_banco" value="flavios"/><br>
Entre com a senha 
<input type="text" name="usu_senha" value="123456" /><br>
Entre com o banco
<input type="text" name="nome_banco" value="sys_sgp"/><br>
<input type="hidden" name="usu_post"/>
<input type="submit" name="bt_envia" value="Acessar"/>
</form>

</div>

<?php

if(isset($_POST['usu_post']))
{

	$_SESSION['server_banco']=$_POST['server_banco'];
	$_SESSION['usu_banco']=$_POST['usu_banco'];
	$_SESSION['usu_senha']=$_POST['usu_senha'];
	$_SESSION['nome_banco']=$_POST['nome_banco'];
	$_SESSION['sel_banco_con']=$_POST['sel_banco_con'];
	
	switch($_SESSION['sel_banco_con'])
	{
		case 1:
			header('Location:inc.bancoSqlServer.php');
		break;
		case 2:
			header('Location:inc.bancoMysql.php');
		break;
		case 3:
			header('Location:inc.bancoPostgres.php');
		break;
		case 4:
			header('Location:inc.bancoMysql.php');
		break;
		case 5:
			header('Location:inc.bancoMysql.php');
		break;
	}
	
}


?>
<form name="frm_limpa_sessao" method="post">
<input type="submit" name="bt_limpa" value="limpa Sessão"/>
</form>
