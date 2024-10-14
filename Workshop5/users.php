<?php
require('utils/functions.php');
$conn = getConnection();
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>
<?php require('inc/header.php') ?>
<div class="container-fluid">
  <div class="jumbotron">
    <h1 class="display-4">Users</h1>
    <p class="lead">List of users</p>
    <hr class="my-4">
  </div>
  <a href="signup.php" class="btn btn-adding">Agregar</a>
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>name</th>
        <th>Lastname</th>
        <th>Username</th>
        <th>Province</th>
        <th>Password</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
          <td><?php echo htmlspecialchars($row['id']); ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['lastname']); ?></td>
          <td><?php echo htmlspecialchars($row['username']); ?></td>
          <td><?php echo htmlspecialchars($row['province']); ?></td>
          <td><?php echo htmlspecialchars($row['password']); ?></td>
          <td>
            <a href="actions/Update.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-warning">Editar</a>
            <a href="actions/delete.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-danger">Eliminar</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>

<?php require('inc/footer.php');