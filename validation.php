<?php
    session_start();
	
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
	
	function hsu_conn_sess($usr, $pwd)
    {
        // set up db connection string

        $db_conn_str = 
            "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";

        // let's try to log on using this string!

        $connctn = oci_connect($usr, $pwd, $db_conn_str);
  
        // complain and destroy session exit from HERE if fails!

        if (! $connctn)
        {
        ?>
            <p> Could not log into Oracle, sorry. </p>
            <?php
            require_once("328footer.html");
            session_destroy();
            exit;        
        }
        return $connctn;
		
		$register_query = "select * from quizRegistration
							where name = '$usr' && password = '$pwd'";
		//$register_stmt = oci_parse($connctn, $register_query);
		
		$result = mysqli_query($connctn, $register_query);
		$num = mysqli_num_rows($result);
		
		if($num == 1)
		{
			$_SESSION['username'] = $name;
			require_once('home.php');
		}
		else{
			require_once('login.php');
		}
		
		oci_free_statement($register_query);
		oci_close($connctn);
		
    }