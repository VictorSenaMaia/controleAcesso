<?php


    //$conexao = mysqli_connect("200.131.250.10", "root", "IoTdgti2018");
    //mysqli_select_db($conexao,"controleAcesso");
    //mysqli_query($conexao,"SET NAMES 'utf8'");
    //if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());

    //exit();
	//}

$conexao = mysqli_connect("127.0.0.1", "root", "IoTdgti2018", "controleAcesso");

if (!$conexao) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

//echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

//mysqli_close($link);


?>
