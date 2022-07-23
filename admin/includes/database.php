<?php
//creating a variable that stores our database connections
$connect = mysqli_connect( 
    "sql300.epizy.com", 
    "epiz_32221100", 
    "R2ui9HFcp7Hi8", 
    "epiz_32221100_cms" 
);

mysqli_set_charset( $connect, 'UTF8' );
