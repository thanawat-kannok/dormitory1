<?php
        $server = "db-personal.rmuti.ac.th";
        $user = "charonchai.sa";
        $pass = "2542";

        $con = new mysqli($server, $user, $pass, "charonchai_sa");
        /* check connection */
        if ($con->connect_errno) {  
            printf("Connect failed: %s\n", $con->connect_error);  
            exit();  
        }  
        if(!$con->set_charset("utf8")) {  
            printf("Error loading character set utf8: %s\n", $con->error);  
            exit();  
        }

       
?>
