<?php
phpinfo();
error_reporting(E_ALL);

session_start();
require_once('conexaoBd.php');


$email= mysqli_real_escape_string($conexao,strip_tags ($_POST ['email']));
$codigo= mysqli_real_escape_string($conexao,strip_tags ($_POST['codigo']));
//echo "email: ";
//echo $email;
//echo "<br>";
//echo $codigo;
//echo "<br>";

//$codigo= mysqli_real_escape_string($conexao,strip_tags (sha1($_POST['codigo'])));
	
$sql = "SELECT * FROM `usuarioSistema` WHERE `email` ='{$email}' AND `senha`='{$codigo}'";
echo $sql;
 
$query=@mysqli_query($conexao,$sql);

if($existe = @mysqli_fetch_object($query)){
	$_SESSION ['logged'] = 'yes';
	
	$query= mysqli_query($conexao,"SELECT * FROM `usuarioSistema`");
	
	$row= mysqli_fetch_array($conexao,$query);
	
	$_SESSION ['login'] = 'yes';
	$_SESSION ['senha'] = 'yes';		
	
	mysqli_close($conexao);
	echo '<meta http-equiv="Refresh" content="0;url=http://200.131.250.10//iot-bd/controleAcesso2/testeHTML2.php">';
}
else{
	$_SESSION ['logged'] = 'no';
	echo "Usuário não cadastrado ou senha incorreta";	
}	
?>
