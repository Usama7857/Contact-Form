<?php

		$name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
	    $subject = $_POST['subject'];
		
		if(!empty($name) || !empty($email) || !empty($message) || !empty(subject))
		{
			$host="localhost";
			$user="root";
			$password="";
			$db="youtube"
			$conn=new mysqli($host,$user,$password,$db);
			if(mysqli_connect_error())
			{
				die('Connect Error('.mysqli_connect_error().')'.mysql_connect());
				
			}
			else
			{
				$select="SELECT email FROM register WHERE email = ? LIMIT 1";
				$Insert = "INSERT INTO register(name, email, message, subject) values(?, ?, ?, ?)";
				$stmt = $conn->prepare($Select);
				$stmt->bind_param("s", $email);
				 $stmt->execute();
				$stmt->bind_result($resultEmail);
				$stmt->store_result();
				$stmt->fetch();
				$rnum = $stmt->num_rows;
				if ($rnum == 0) {
					$stmt->close();
					$stmt = $conn->prepare($Insert);
					$stmt->bind_param("ssssii",$name, $email, $message, $subject);
					if ($stmt->execute()) {
						echo "New record inserted sucessfully.";
					}
					else {
						echo $stmt->error;
					}
				
			}
			
		}
		else
		{
			echo "All field are required ";
			die();
			
		}
?>