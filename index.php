<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/lock.png">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Cripta</title>
</head>
<body>
    <header class="header">
    <h1>Sistema de encriptacion y desincriptación</h1>
    </header>

    <form method="post" action="index.php">

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Ingrese el texto a encriptar:</span>
            <input type="text" class="form-control" name="message" placeholder="Su texto" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div class="button_encrypt">
            <input type="submit" name="encripta" class="btn btn-success" value="Encriptar">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Ingrese el texto a desencriptar</span>
            <input type="text" class="form-control" name="messageForDesencrypt" placeholder="Su texto" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div class="button_encrypt">
            <input type="submit" name="desencripta" class="btn btn-success" value="Desencriptar">
        </div>
    </form>
</body>
</html>

<?php

function encrp($mensaje){
    $mensaje = strtolower($mensaje);
    $index = array();
    $alphabet = range('a', 'z');
    array_push($alphabet," ");
    $codigo= array("#","L","s","m","$","0","P","t","n","k","Q","@","c","*","B","/","y","A","f","x","W","d","&","<","1","3","E");
    for($i=0;$i<strlen($mensaje);$i++)
    {
        array_push($index,array_search($mensaje[$i],$alphabet));
    }
    $mensaje_encriptado = array();
    for($i=0;$i< count($index);$i++){
        array_push($mensaje_encriptado,$codigo[intval($index[$i])]);
    }
    $yourMessage = implode($mensaje_encriptado);

    $magic = array();
    for($i=0;$i< strlen($yourMessage);$i++){
        array_push($magic,(rand(0, count($alphabet)-1))) ;
    }
    $finalPhrase = array();
    for($i=0;$i< strlen($yourMessage);$i++){
        array_push($finalPhrase,$yourMessage[$i].$alphabet[$magic[$i]]);
    }
    return trim(implode($finalPhrase));
    
}



if(isset($_POST['encripta'])){
    $mensaje = $_POST['message'];
    if(!empty($mensaje)){
        $message_encryp = encrp($mensaje);
        ?>
         <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Su texto encriptado es:</span>
            <input type="text" class="form-control" value="<?php echo ($message_encryp);  ?>" aria-label="Username" readonly >
        </div>
        <?php 
    }
    else{
        ?>
        <div class="no_content">
            <h3>Texto vacio</h3>
        </div>

        <?php 
    }
}


function desencripta($message){
    $alphabet = range('a', 'z');
    array_push($alphabet," ");
    $codigo= array("#","L","s","m","$","0","P","t","n","k","Q","@","c","*","B","/","y","A","f","x","W","d","&","<","1","3","E");
    $desencripta = array();
    
    for($i = 0 ; $i < strlen($message);$i++){
        if($i%2 == 0){
            array_push($desencripta,$message[$i]);
        }
    }
    $index = array();
    for($i=0;$i<strlen(implode($desencripta));$i++)
    {
        array_push($index,array_search($desencripta[$i],$codigo));
    }
    $mensaje_desencriptado = array();
    for($i=0;$i < count($index);$i++){
        array_push($mensaje_desencriptado,$alphabet[intval($index[$i])]);
    }
    return implode($mensaje_desencriptado);



}



if(isset($_POST['desencripta'])){
    $mensaje = $_POST['messageForDesencrypt'];
    if(!empty($mensaje)){
        $message_desencryp = desencripta($mensaje);
        ?>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Su texto desencriptado es:</span>
            <input type="text" class="form-control" value="<?php echo ($message_desencryp);  ?>" aria-label="Username" readonly >
        </div>
        <?php
    }
    else{
        ?>
        <div class="no_content">
            <h3>Texto vacio</h3>
        </div>

        <?php 
    }
}


?>