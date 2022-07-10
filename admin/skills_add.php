<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'INSERT INTO skills (
        title,
        url,
        percent
        ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['percent'] ).'"
        )';
    mysqli_query( $connect, $query );
    
    set_message( 'Skill has been added' );
    
  }
  
  header( 'Location: skills.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Skill</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
    
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">
 
  <br>
 
  <label for="percent">Percent:</label>
  <input type="text" name="percent" id="percent">

  <br>
  
  <input type="submit" value="Add Skill">
  
</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skills List</a></p>


<?php

include( 'includes/footer.php' );

?>