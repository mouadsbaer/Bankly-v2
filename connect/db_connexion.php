<?php
    $connexion = mysqli_connect('localhost', 'root', '', 'bankly_v2');

    if(!$connexion){
        die ('Connexion Error' . mysqli_connect_error());
    }
?>