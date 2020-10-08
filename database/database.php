<?php
require 'config.php';

// Should return a PDO
function db_connect() {

  try {
    // TODO
    // try to open database connection using constants set in config.php
    // return $pdo;
    $dbname =DBNAME;
    $dbhost=DBHOST;
    $user=DBUSER;
    $password=DBPASS;

    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $pdo;
  }
  catch (PDOException $e)
  {
    die($e->getMessage());
  }
  
}

// Handle form submission
function handle_form_submission() {
  global $pdo;

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // TODO
    $sql = "INSERT INTO comments (date, mood, email, commentText) VALUE(:date, :mood, :email, :commentText)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':date', date('Y-m-d') );
    $statement->bindValue(':mood', $_POST['mood'] );
    $statement->bindValue(':email', $_POST['email'] );
    $statement->bindValue(':commentText', $_POST['comment'] );
    $statement->execute();
  }
}

// Get all comments from database and store in $comments
function get_comments() {
  global $pdo;
  global $comments;
  
  $sql = "SELECT * FROM comments ORDER BY ID DESC";
  $result = $pdo->query($sql);

  while($row = $result->fetch()){
    array_push($comments, $row);
    
  }
  
}

// Get unique email addresses and store in $commenters
function get_commenters() {
  global $pdo;
  global $commenters;

  //TODO
  $sql = "SELECT DISTINCT email FROM comments";
  $result = $pdo->query($sql);

  while($row = $result->fetch()){
    array_push($commenters, $row);
  }
  $pdo = null;

}
