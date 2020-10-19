<?php

/* Arquivo que monitora o banco de dados de modo a saber se exite usuários novos para serem cadastrados ou excluidos
 */

//phpinfo();
//error_reporting(E_ALL);

session_start();
$tag= $_POST ['tag'];
$acao=intval(substr($tag,0,1));
$tag=substr($tag,1);
//echo "tag: ".$tag;
$vouapagar=true;
 
$mysqli = new MySQLi( '127.0.0.1', 'root', 'IoTdgti2018', 'controleAcesso' );
if ($mysqli->connect_errno) {
    // The connection failed. What do you want to do? 
    // You could contact yourself (email?), log the error, show a nice page, etc.
    // You do not want to reveal sensitive information
    /*
    // Let's try this:
    echo "Sorry, this website is experiencing problems.";

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    */
    // You might want to show them something nice, but we will simply exit
    exit;
}
$tamanho=strlen($tag);

//echo "<br>Tamanho: ".$tamanho;
if(strlen($tag)>1){
    $vouapagar=false;
 //Pega as informações do usuário que já foi cadastrado/excluido
 $query="SELECT `nome`,`email`,`tag` FROM `usuariosEmEspera` WHERE `usuariosEmEspera`.`tag` = '$tag'";
//echo"<br>".$query."<br>";
    echo "m".$tag."m";
   if($result = $mysqli->query($query)){
       
       if($row=$result->fetch_assoc()){
            
       $sucesso=false;
           if($acao==1){//cadastrar
          //echo"acao 1"; 
                //Armazenar as informações do usuário na tabela definitiva(usuariosCadastrados)
                $query="INSERT INTO usuariosCadastrados(nome,email,tag) VALUES('".$row["nome"]."','".$row["email"]."','".$row["tag"]."')";
                
                if($result = $mysqli->query($query)){
                    $sucesso=true;     
                } 
                
           }
           if($acao==0){
          //echo"acao 0";
              
               $query="DELETE FROM `usuariosCadastrados` WHERE `usuariosCadastrados`.`tag` = '$tag'"; 
                if($mysqli->query($query)){
                    $sucesso=true;                    
                }
           }
           if($sucesso){
                    //DELETA AS INFORMACÕES NA TABELA DE ESPERA DO USUARIO "ATENDIDO"
                     $query="DELETE FROM `usuariosEmEspera` WHERE `usuariosEmEspera`.`tag` = '$tag'"; 

                      if($mysqli->query($query)){
                          //echo "Deletado";
                          //exit;
                      }else{
                          /*
                          echo "erro na exclusão do usuário";
                          echo "Error: Our query failed to execute and here is why: \n";
                          echo "Query: " . $sql . "\n";
                          echo "Errno: " . $mysqli->errno . "\n";
                          echo "Error: " . $mysqli->error . "\n";
                           * 
                           */
                      }
                }
           
            //echo $query;
       }      
    }
}
 
//SELECIONA A ATUALIZAÇÃO PARA O ESP(EXCLUSÃO/CADASTRO)
$query = "SELECT tag,acao FROM usuariosEmEspera";

if (!$result = $mysqli->query($query)) {
    // Oh no! The query failed. 
    /*
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
     
     */
}

$elementos=mysqli_num_rows($result);
if( $elementos> 0){
   if($row=$result->fetch_assoc()){
   if($vouapagar){
    echo $row["acao"].$row["tag"];
   }    
    
   }
}
else{
  //echo "5";
}

?>
