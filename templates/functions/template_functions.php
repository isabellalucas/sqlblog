<?php
require "format_comment_text.php";
// Output comments to HTML
function the_comments() {
  global $comments;
  global $pdo;
  foreach($comments as $row){
    $comment = "<div class='comment'><div class='ID'>Post ID:". $row['ID']. "</div> <div class='date'>Posted on:". $row['date']."</div><h3>New Comment by: ". $row['email'] . "</h3><div class='mood'>Current mood: ".$row['mood']."</div><div class='comment-text'>".$row['commentText']."</div></div>";
    echo formatCommentText($comment);
  }
  
}

// Output unique email addresses to HTML
function the_commenters() {
  global $filter;
  global $commenters;

  //TODO
  echo "<div class='commenters'>
  <h2>People Who have Commented:</h2>";
  foreach($commenters as $com){
    echo "
    <ul>
      <li><a rel='noopener' href='http://localhost/a8/database/myComments.php'>".$com['email']."</a></li>
    </ul>
  </div>";
  };
  
}
