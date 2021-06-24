<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <?php
  include_once "add.php";
?>

<body>
  <nav class="navbar bg-primary navbar-dark">
    <div class="container-fluid">
      <a href="" class="navbar-brand">Home</a>
      <ul class="navbar nav">
        <li class="nav-item btn btn-default"><a href="index.php" class="nav_link" style="color: white;">Add Members</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row" style="margin-top: 10px;">
      <div class="col-md-4 alert alert-info">
        <h3 class=" text-primary">Add New Members Here</h3>
        <hr style="border-top:1px dotted #ccc;" />
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
          <div class="form-group">
            <label>First Name</label><span
              class="text-danger">*<?php if(isset($fn_error)) {echo " ".$fn_error;}?></span>
            <input class="form-control" type="text" name="first_name" value="<?php
					 if(isset($_POST['first_name'])){
						 echo $_POST['first_name'];}?>" />
          </div>
          <div class="form-group">
            <label>Last Name</label><span
              class="text-danger">*<?php if(isset($ln_error)) { echo " ".$ln_error;} ?></span>
            <input class="form-control" type="text" name="last_name" value="<?php
					 if(isset($_POST['last_name'])){
						 echo $_POST['last_name'];}?>" />
          </div>
          <div class="form-group">
            <label>Email</label><span
              class="text-danger">*<?php if(isset($email_error)) { echo " ".$email_error ;} ?></span>
            <input class="form-control" type="text" name="email" value="<?php
					 if(isset($_POST['email'])){
						 echo $_POST['email'];}?>" />
          </div>
          <div class="form-group">
            <label>Password</label><span class="text-danger"
              style="font-size: 14px;">*<?php if(isset($pwd_error)){echo " ".$pwd_error;} ?></span>
            <input class="form-control" type="password" name="password" />
          </div>
          <div class="form-group">
            <button class="btn btn-primary form-control" type="submit" name="save">Save</button>
          </div>
        </form>
      </div>
      <div class="col-md-8">
        <div class="alert alert-info text-primary">
          <h3>Members' Details Will Appear Below:</h3>
        </div>
        <table class="table table-bordered">
          <thead class="alert-danger">
            <tr>
              <th>Firt Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="alert-warning">
            <?php
            include_once "dbconn.php";
            $stmt = $conn->prepare("SELECT * FROM `members` ORDER BY `mem_id` DESC");
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
				    ?>
            <tr>
              <td><?php echo $row['first_name'];?></td>
              <td><?php echo $row['last_name'];?></td>
              <td><?php echo $row['email'];?></td>
              <td><?php echo $row['password'];?></td>
              <td><a href="edit_form.php?id=<?php echo $row['mem_id']?>">Edit</a> | <a
                  href="delete.php?id=<?php echo $row['mem_id'] ?>">Delete</a></td>
            </tr>
            <?php endwhile; $conn = null; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>