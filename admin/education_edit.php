<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: education.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'UPDATE education SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      school = "'.mysqli_real_escape_string( $connect, $_POST['school'] ).'",
      start_date = "'.mysqli_real_escape_string( $connect, $_POST['start_date'] ).'",
      end_date = "'.mysqli_real_escape_string( $connect, $_POST['end_date'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Education has been updated' );
    
  }

  header( 'Location: education.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM education
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: education.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Education</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
    
  <br>
  
  <label for="school">School:</label>
  <input type="text" name="school" id="school" value="<?php echo htmlentities( $record['school'] ); ?>">
  
  <br>

  <label for="start_date">Start Date:</label>
  <input type="date" name="start_date" id="start_date" value="<?php echo htmlentities( $record['start_date'] ); ?>">
    
 
  <br>
  
  <label for="end_date">End Date:</label>
  <input type="date" name="end_date" id="end_date" value="<?php echo htmlentities( $record['end_date'] ); ?>">
    

  <br>
  
  <input type="submit" value="Edit Education">
  
</form>

<p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>