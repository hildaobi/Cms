<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );
//ensuring this page cannot be access without log in
secure();
//It checks that there is a field with name title
if( isset( $_POST['title'] ) )
{
  //if statement
  if( $_POST['title'] )
  {
    //query to insert in database
    //.mysqli_real_escape_string function prevents sql injection
    $query = 'INSERT INTO education (
        title,
        school,
        start_date,
        end_date
        ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['school'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['start_date'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['end_date'] ).'"
        )';
    mysqli_query( $connect, $query );
    
    set_message( 'Education has been added' );
    
  }
  //redirects to another page
  header( 'Location: education.php' );
  die();
  
}

include( 'includes/header.php' );

?>
<!-- creating form with it's content-->
<h2>Add Education</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
    
  <br>
  
  <label for="school">School:</label>
  <input type="text" name="school" id="school">
 
  <br>
 
  <label for="start_date">Start Date:</label>
  <input type="date" name="start_date" id="start_date">

  <br>
  
  <label for="end_date">End Date:</label>
  <input type="date" name="end_date" id="end_date">

  <br>
  
  <input type="submit" value="Add Education">
  
</form>

<p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>