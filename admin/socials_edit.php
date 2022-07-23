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
  header( 'Location: socials.php' );
  die();
  
}
//It checks that there is a field with name title
if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    //query that updates the database
    //.mysqli_real_escape_string preventing sql injections
    $query = 'UPDATE socials SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      url = "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
     // display message
    set_message( 'Socials has been updated' );
    
  }
 //redirects to another page
  header( 'Location: socials.php' );
  die();
  
}

//checks  if id  index exist
if( isset( $_GET['id'] ) )
{
 //query that gets data from the database 
  $query = 'SELECT *
    FROM socials
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
   //storing query result in a variable 
  $result = mysqli_query( $connect, $query );
    //returns the number of rows present in the result set
  if( !mysqli_num_rows( $result ) )
  {
     //redirects to another page
    header( 'Location: socials.php' );
    die();
    
  }
  //storing query result in a variable
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Socials</h2>
<!-- creating form with it's content-->
<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
    
  <br>
  
  
  
 
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url" value="<?php echo htmlentities( $record['url'] ); ?>">
    
  <br>
  
  
  
  
  <input type="submit" value="Edit Socials">
  
</form>

<p><a href="socials.php"><i class="fas fa-arrow-circle-left"></i> Return to Socials List</a></p>


<?php

include( 'includes/footer.php' );

?>