<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title']  )
  {
    
    $query = 'INSERT INTO socials (
        title,
        url
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Socials has been added' );
    
  }
  
  header( 'Location: Socials.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Social</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
    
  <br>
  
  
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">
  
 
  
  <br>
  
  <input type="submit" value="Add socials">
  
</form>

<p><a href="socials.php"><i class="fas fa-arrow-circle-left"></i> Return to Socials List</a></p>


<?php

include( 'includes/footer.php' );

?>