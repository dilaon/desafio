<?php
    include "../PDO/Banco.php"; 
    include "../controller/Sistema.php";
    $s = new Sistema;
    $s->userLogout();