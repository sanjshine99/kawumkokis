<?php
function connection() //connection is function name
{
    $server="127.0.0.1"; //"localhost"
    $user="root"; //server, default
    $pwd=""; //server password, no password for default
    $database="system_14"; //database name

    $conn=mysqli_connect($server,$user,$pwd,$database); //system and database connect krnwa, parameter 4 order ekata tiyena one, $conn is variable

    if(mysqli_connect_error($conn)) //connection eke error
    {
        return(null); //echo statement ekak danna puluwan
    }

    else
    {
        return($conn);
    }
}
?>