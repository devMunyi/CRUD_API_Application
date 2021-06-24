<?php
	include_once 'dbconn.php';

	if(isset($_POST['update'])){
			$id = $_GET['id'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      //validating inputs
      $fn_error = $ln_error= $email_error = $pwd_error = "";

      //checking for empty fields
      if(empty($first_name)){
        $fn_error = "First name cannot be empty.";
      }elseif(empty($last_name)){
        $ln_error = "Last name cannot be empty.";
      }elseif(empty($email)){
        $email_error = "Email cannot be empty.";
      }elseif(empty($password)){
        $pwd_error = "Password cannot be empty.";
      }else{
        //checking for invalid string
        if(!preg_match("/^[a-zA-Z]*$/", $first_name)){
          $fn_error = "First name should only contain letters.";
        }elseif(!preg_match("/^[a-zA-Z]*$/", $last_name)){
          $ln_error ="Last name hould only contain letters.";
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $password)){
          $pwd_error = "Pasword should only contain letter or/and numbers.";
        }else{
          //email validation
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_error = "You entered invalid email address.";
          }else{
              //encrypting pasword
              $password_encrypted = md5($password);

              //reassigning edited member variables
              $ed_first_name = $first_name;
              $ed_last_name = $last_name;
              $ed_email = $email;
              $ed_password = $password_encrypted;

              //INSERTING edited member details into database db_members at table members
              $unsql = "UPDATE `members` SET `first_name` = ?, `last_name` = ?, `email` = ?, `password` = ? 
							WHERE `mem_id` = ?";
							$stmt = $conn->prepare($unsql);

							$stmt->bindValue(1, "$ed_first_name");
							$stmt->bindValue(2, "$ed_last_name");
							$stmt->bindValue(3, "$ed_email");
							$stmt->bindValue(4, "$ed_password");
							$stmt->bindValue(5, $id);

							$stmt->execute();
							
							$conn = null;
							header('location:index.php');
            }
          }
        }
      }   
		 
?>