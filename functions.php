<?php include "db.php";

function createRows() {
  if(isset($_POST['submit'])) {
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    // used to encript password
    $hashformat = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hashF_and_salt = $hashformat . $salt;

    // encripted password
    $password = crypt($password, $hashF_and_salt);


    $query = "INSERT INTO users(username,password)";
    $query .= "VALUES ('$username', '$password')";
  
    $result = mysqli_query($connection, $query);
  
    if(!$result) {
      die("Query Failed" .mysqli_error());
    } else {
      echo "Record Created";
    }
  } 
}

function readRows() {
  global $connection;
  $query = "SELECT * FROM users";
  $result = mysqli_query($connection, $query);

  if(!$result) {
    die("Query Failed" .mysqli_error());
  }
  while($row = mysqli_fetch_assoc($result)) {
  ?> 
  <ul>
    <li><?php echo "Username: " . $row['username'] . "<br>" . "Encrypted Password: ". $row['password'] ?></li>
  </ul>
  <?php
  }
}

function showAllData() {
  global $connection;
  $query = "SELECT * FROM users";
  $result = mysqli_query($connection, $query);

  if(!$result) {
    die("Query Failed " .mysqli_error());
  }

  while($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    echo "<option value='$id'>$id</option>";
  }
}

function updateTable() {
  if(isset($_POST['submit'])) {
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];
      
    $query = "UPDATE users SET ";
    $query .= "username = '$username', ";
    $query .= "password = '$password' ";
    $query .= "WHERE id = $id ";
    $result = mysqli_query($connection, $query);

    if(!$result) {
      die("Query Failed " . mysqli_error($connection));
    } else {
      echo "Record Updated";
    }
  }
}

function deleteRows() {
  if(isset($_POST['submit'])) {
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];
      
    $query = "DELETE FROM  users ";
    $query .= "WHERE id = $id ";
    $result = mysqli_query($connection, $query);

    if(!$result) {
      die("Query Failed " . mysqli_error($connection));
    } else {
      echo "Record Deleted";
    }
  }
}

?>