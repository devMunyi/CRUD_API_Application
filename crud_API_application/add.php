<?php
include_once 'dbconn.php';
  //Handling User input
  if(isset($_POST['save'])){
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
            //checking email uniqueness
            $unsql = "SELECT `email` FROM members where `email` = ?";
            $stmt = $conn->prepare($unsql);
            
            $stmt->bindValue(1, $email);
            $stmt->execute();
            
            $rows = $stmt->fetchAll(PDO::FETCH_NUM);
            if(count($rows) > 0){
              $email_error = "A member with this email already exists.";
            }else{
              //encrypting pasword
              $password_encrypted = md5($password);

              //reassigning new member variables
              $mem_first_name = $first_name;
              $mem_last_name = $last_name;
              $mem_email = $email;
              $mem_password = $password_encrypted;

              //INSERTING member details into database db_members at table members
              $un_insert_sql =  "INSERT INTO members(`first_name`, `last_name`, `email`, `password`)
              VALUES(?, ?, ?, ?) ";
              $un_insert_stmt = $conn->prepare($un_insert_sql);

              $un_insert_stmt->bindValue(1, $mem_first_name);
              $un_insert_stmt->bindValue(2, $mem_first_name);
              $un_insert_stmt->bindValue(3, $mem_email);
              $un_insert_stmt->bindValue(4, $mem_password);

              $un_insert_stmt->execute();

              $conn = null;
              header('location: index.php');
            }


          }
        }
      }
      //$pdo = null;
      //header('Location: index.php');    
    }
?>