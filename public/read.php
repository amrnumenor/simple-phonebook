<?php 
  try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
      FROM users";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
?>

<?php include "templates/header.php"; ?>

<h2 class="bg-secondary text-center text-light p-3">Find your friends</h2>

<?php
  if ($result && $statement->rowCount() > 0) { ?>
<div class="container">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Fullname</th>
        <th>Phone no.</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row) { ?>
      <tr>
        <td><?php echo escape($row["id"]); ?></td>
        <td><?php echo escape($row["fullname"]); ?></td>
        <td><?php echo escape($row["telno"]); ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php } else { ?>
<p>No results found.</p>
<?php } ?>

<div class="d-flex justify-content-center m-3">
  <a class="btn btn-dark mt-2" href="index.php">Go back</a>
</div>

<?php include "templates/footer.php"; ?>