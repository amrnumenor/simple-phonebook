<?php
if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $new_user = array(
      "fullname" => $_POST['fullname'],
      "telno" => $_POST['telno']
    );
    
    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($new_user)), 
      ":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error -> getMessage();
  }
}
?>

<?php include "templates/header.php"; ?>

<h2 class="bg-secondary text-center text-light p-3">Add a friend</h2>
<div class="container">
  <form method="post">
    <div class="row">
      <div class="col pt-3">
        <input class="form-control" type="text" name="fullname" id="fullname" placeholder="Fullname">
      </div>
      <div class="col pt-3">
        <input class="form-control" type="text" name="telno" id="telno" placeholder="Phone number">
      </div>
    </div>
    <div class="d-flex justify-content-center m-3">
      <input class="btn btn-primary mt-2" type="submit" name="submit" value="Submit">
    </div>
  </form>
</div>
<div class="d-flex justify-content-center m-3">
  <a class="btn btn-dark mt-2" href="read.php">View Contacts</a>
</div>

<?php if (isset($_POST['submit']) && $statement) { ?>
<div class="d-flex justify-content-center m-3">
  <div class="alert alert-success" role="alert"><?php echo escape($_POST['fullname']); ?>
    successfully added</div>
</div>
<?php } ?>

<?php include "templates/footer.php"; ?>