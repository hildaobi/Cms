<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );
//ensures login before accessing this page
secure();
//checks  if id  index exist
if( !isset( $_GET['id'] ) )
{
  //redirects to another page
  header( 'Location: education.php' );
  die();
  
}
//It checks that there is a field with name title
if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    //query that updates the database
    //.mysqli_real_escape_string preventing sql injections
    $query = 'UPDATE education SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      school = "'.mysqli_real_escape_string( $connect, $_POST['school'] ).'",
      start_date = "'.mysqli_real_escape_string( $connect, $_POST['start_date'] ).'",
      end_date = "'.mysqli_real_escape_string( $connect, $_POST['end_date'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    // display message
    set_message( 'Education has been updated' );
    
  }
 //redirects to another page
  header( 'Location: education.php' );
  die();
  
}

//checks  if id  index exist
if( isset( $_GET['id'] ) )
{
  //query that gets data from the database
  $query = 'SELECT *
    FROM education
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
    //storing query result in a variable
  $result = mysqli_query( $connect, $query );
  //returns the number of rows present in the result set
  if( !mysqli_num_rows( $result ) )
  {
     //redirects to another page
    header( 'Location: education.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Education</h2>
<!-- creating form with it's content-->
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