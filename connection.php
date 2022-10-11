<?php 
    $link=mysqli_connect('localhost','root','');
    if(!$link)
    {
        echo "Database Not Connected";
    }
    mysqli_select_db($link,'bit_academy_task');
?>
