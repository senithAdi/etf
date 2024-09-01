<?php session_start();

				if(isset($_POST["btnSubmit"]))
				{	
				$name = $_POST["txtName"];
				$email = $_POST["txtEmail"];
				$password =  $_POST["txtPassword"];
				$contact =  $_POST["txtContact"];	
				
	            $con = mysqli_connect("localhost","root","","socialbook","3307");
				if(!$con)
				{	
						die("Sorry, We are facing a technical issue");		
				}	
		        $sql = "INSERT INTO `tbluser` (`email`, `name`, `password`, `contactNumber`,`isAdmin`) VALUES ('".$email."', '".$name."', '".$password."', '".$contact."',0);";
					
				mysqli_query($con,$sql)	;
										
			    header('Location:Login.php');
				
			    }
?>

