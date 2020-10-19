
<?php

require_once('conexaoBd.php'); //arquivo que conecta ao banco de dados
///conectar();//função que  conecta ao banco de dados

$dados= $_POST ['dados'];
$tag=substr($dados, 0, -1);
$sensor=substr($dados,-1);
$numeroEsp="mdskamvkd";
 
echo "tag:";
echo $tag;

echo "<br>sensor: ";
echo $sensor;

//mysqli_query($conexao," INSERT INTO `acessos` (`id`, `data`, `tag`, `sensor`,`numeroEsp`) VALUES (NULL, current_timestamp(), '$tag','$sensor','$numeroEsp');" );
$sql="INSERT INTO `acessos` (`id`, `data`, `tag`, `sensor`, `numeroEsp`) VALUES (NULL, CURRENT_TIMESTAMP, '{$tag}', '{$sensor}', '{$numeroEsp}');";
echo $sql;
mysqli_query($conexao,$sql);
//mysqli_close($conexao);

echo "<br>Dados salvos com sucesso!";
?>

