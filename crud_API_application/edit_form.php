<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
  <?php
 include_once "update.php";
 ?>
  <nav class="navbar bg-primary navbar-dark">
    <div class="container-fluid">
      <a href="index.php" class="navbar-brand">Home</a>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="alert alert-info" style="margin: 10px 0px 25px 0px;">
          <h3 class="text-primary">Edit Your Details Here</h3>
          <hr style="border-top:1px dotted #ccc;" />
          <div class="col-md-3"></div>
          <div>

            <?php
            include_once "dbconn.php";
            
              if(ISSET($_GET['id'])){
                $id = $_GET['id'];
                $unsql = "SELECT * FROM `members` WHERE `mem_id`= ?";
                $stmt = $conn->prepare($unsql);
                $stmt->bindValue(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $conn = null;
              }

            ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>?id=<?php echo $id?>">
              <div class="form-group">
                <label>Firstname</label><span
                  class="text-danger">*<?php if(isset($fn_error)) {echo " ".$fn_error;}?></span>
                <input class="form-control" type="text" name="first_name" value="<?php
					        if(isset($row['first_name'])){
						        echo $row['first_name'];}?>" />
              </div>
              <div class=" form-group">
                <label>Lastname</label><span
                  class="text-danger">*<?php if(isset($ln_error)) { echo " ".$ln_error;} ?></span>
                <input class="form-control" type="text" name="last_name" value="<?php
                  if(isset($row['last_name'])){
                    echo $row['last_name'];}?>" />
              </div>
              <div class="form-group">
                <label>Email</label><span
                  class="text-danger">*<?php if(isset($email_error)) { echo " ".$email_error ;} ?></span>
                <input class="form-control" type="text" name="email" value="<?php
                  if(isset($row['email'])){
                    echo $row['email'];}?>" />
              </div>
              <div class="form-group">
                <label>Password</label><span class="text-danger"
                  style="font-size: 14px;">*<?php if(isset($pwd_error)){echo " ".$pwd_error;} ?></span>
                <input class="form-control" type="password" name="password" value="" />
              </div>
              <div class="form-group">
                <button class="btn btn-warning form-control" type="submit" name="update">Update</button>
              </div>
            </form>
          </div>

          <?php $conn = null;?>
        </div>
      </div>
    </div>

</body>

</html>