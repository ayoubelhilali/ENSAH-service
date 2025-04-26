<?php

$conne = mysqli_connect("127.0.0.1", "root", "", "ensah_service", 3307);
if(!$conne){
    die("Error:".mysqli_connect_error());
}else {
    echo "Database connected !";
}
