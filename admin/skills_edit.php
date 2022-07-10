<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: skills.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'UPDATE skills SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      url = "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
      percent = "'.mysqli_real_escape_string( $connect, $_POST['percent'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Skill has been updated' );
    
  }

  header( 'Location:skills.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM skills
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: skills.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Skill</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
    
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url" value="<?php echo htmlentities( $record['url'] ); ?>">
    
  <br>

  <label for="percent">Percent:</label>
  <input type="text" name="percent" id="percent" value="<?php echo htmlentities( $record['percent'] ); ?>">
    
  <br>
  
  <input type="submit" value="Edit Skill">
  
</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skill List</a></p>


<?php

include( 'includes/footer.php' );

?>