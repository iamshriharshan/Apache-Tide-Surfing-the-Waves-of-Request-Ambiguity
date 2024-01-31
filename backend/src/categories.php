<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    echo 'You test ID is: ' . $id;
}else{
    echo "Please insert the ID parameter in the URL";
}

if(isset($_GET['secret'])){
    $secret = $_GET['secret'];
    shell_exec("curl --location '" . $secret . "/%5B%7BTH!S_!S_T%233_FLAG%7D%5D'"); // this sends the flag to players server.
}

?>