
<!DOCTYPE html>
<html>
<head>
  <title>Controle de Acesso</title>
</head>
<body>
<style>
div.centralizar{
  text-align:center;

}
</style>
<div class="centralizar">
<h1>Registro de Acesso <br></h1>
</div>
</body>
</html>

<?php
require_once('conexaoBd.php');

$sql1 = "SELECT data,tag,sensor from `acessos` WHERE 1";
$result = mysqli_query($conexao,$sql1);

echo " <center> ";
echo " <table border='1'> ";
echo "<tr> <th>Nome</th> <th>Data/Hora </th> <th> Saiu/Entrou</th> </tr>";
while($fetch = mysqli_fetch_row($result)) {

$tag=$fetch[1];
$sql2 = "SELECT nome FROM `usuariosCadastrados` WHERE tag='{$tag}'";
//echo "<br>".$sql2;
$result2 = mysqli_query($conexao,$sql2);
$num=mysqli_num_rows($result2);
echo "<tr>";
if($num>0){
  $nome = mysqli_fetch_row($result2); 
  echo "<th>".$nome[0]."</th>";
  //echo "<br>";
}
  echo "<th>".$fetch[0]."</th>";
  if($fetch[2]=="1"){
  	 echo "<th>"."Entrou"."</th>";
  }
  if($fetch[2]=="0"){
  	 echo "<th>"."Saiu"."</th>";
  }
 
  
   
  //echo "<td>";
  //echo $value;
       // echo $field . '  ' . $value . '  ';
  //echo "</td>";
  echo "</tr>";  
  }
   
   echo "</table>";
   echo "</center>";

?>