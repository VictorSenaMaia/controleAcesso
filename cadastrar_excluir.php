<?php
require_once('conexaoBd.php');
//verificar se a conexao está funcionando

function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

//Armazenando os valores do formulário
$nome = strip_tags($_POST ['nome']);
$email = strip_tags($_POST ['email']);
$codigo=strip_tags ($_POST ['codigo']);
$codigo2=strip_tags ($_POST ['codigoRep']);
$excluir=!empty($_POST['op_excluir']);//isset($_POST['op_excluir']) ? $_POST['op_excluir'] : '2';
$cadastrar=!empty($_POST['op_cadastrar']);//isset($_POST['op_cadastrar']) ? $_POST['op_cadastrar'] : '1';



$tamanhoCodigo=strlen($codigo);

if($tamanhoCodigo<6){
	echo "<br>O código deve possuir no minimo 6 caracteres<br>";
	echo $tamanhoCodigo;
	die();
	}

//$codigo2=sha1 (strip_tags ($_POST['codigoRep']));

if($nome==NULL ||$email==NULL || $codigo==NULL || $codigo2==NULL){
	echo "Para completar o registro é preciso que todos os campos estejam preenchidos";
	die();
}

if(!$excluir && !$cadastrar){
	echo "<br>Para registrar é necessário escolher a opção cadastrar ou excluir";
	die();
}
if($excluir && $cadastrar){
	echo "Por favor selecione apenas uma opção";
	die();
}

$query=@mysqli_query($conexao,"SELECT `email` FROM `usuariosCadastrados` WHERE email= '$email'");
$row= mysqli_fetch_array($query);

$query2=@mysqli_query($conexao,"SELECT `email` FROM `usuariosEmEspera` WHERE email= '$email'");
$row2= mysqli_fetch_array($query2);
if($excluir){
	$acao="exclusão";
        $acao_cod=0;
}
if ($cadastrar) {
	$acao="cadastro";
        $acao_cod=1;
}
if($row2[0]==$email){
	echo " Usuário já está em processo de ".$acao.", favor aguardar confirmação no email ";
	echo $email;
	die();
}
if ($cadastro !=NULL){
	if($row[0]==$email){
	echo " Este email já está cadastrado!";
	die();
	}
}
if($excluir) {
	if($row[0] ==NUll){
        echo " Usuário não estava cadastrado";
	die();
	}
}
if($codigo!= $codigo2){
	echo "Os códigos não são iguais, favor digitar novamente<br>";
	die();

}

if($cadastrar){
    echo "Solicitação para ". $acao." realizada com sucesso, favor agaurdar a confirmação no email";
    $sql="INSERT INTO `usuariosEmEspera` (`id`, `nome`, `email`, `tag`, `acao`) VALUES (NULL, '$nome','$email','$codigo','$acao_cod');";
    $query = @mysqli_query($conexao,$sql);
          
}
if($excluir){
    echo "Solicitação para ". $acao." realizada com sucesso, favor agaurdar a confirmação no email";
    $sql="INSERT INTO `usuariosEmEspera` (`id`, `nome`, `email`, `tag`,`acao`) VALUES (NULL, '$nome','$email','$codigo','$acao_cod');";
    $query = @mysqli_query($conexao,$sql);
}
mysqli_close($conexao);

  
    //Para enviar email
/*
    $receptor=$email;
    $titulo="Controle de Acesso";
    $mensagem=$email . ", seu usuário foi registrado com sucesso, a partir de agora já podes usar o sistema.";
    $cabecario= 'From: testando@iot.ufla.br' . "\r\n" . 'Reply-To: victorsena9828@gmail.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion ();

    $secure_check = sanitize_my_email($email);
    if ($secure_check == false) {
                     echo "Email inválido";
    } else { //send email 
                    $enviar_email= mail($email, $titulo, $mensagem, $cabecario);

                    if($enviar_email){
                            echo "<br>email enviado<br>";
                    }else{
                            echo "<br>Falha ao enviar o email<br>";
                    }
      }
    echo $cabecario;
    echo "<br>";
    echo "<br>";
    */
?>
  
          