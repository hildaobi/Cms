<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
//ensures login before accessing this page
secure();
//checks  if id  index exist
if( !isset( $_GET['id'] ) )
{
  //redirects to another page
  header( 'Location: skills.php' );
  die();
  
}
//It checks that there is a field with name title
if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
      //query that updates the database
    //.mysqli_real_escape_string preventing sql injections
    $query = 'UPDATE skills SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      url = "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
      percent = "'.mysqli_real_escape_string( $connect, $_POST['percent'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
     // display message
    set_message( 'Skill has been updated' );
    
  }
//redirects to another page
  header( 'Location:skills.php' );
  die();
  
}

//checks  if id  index exist
if( isset( $_GET['id'] ) )
{
   //query that gets data from the database
  $query = 'SELECT *
    FROM skills
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
 //storing query result in a variable
  $result = mysqli_query( $connect, $query );
  //returns the number of rows present in the result set
  if( !mysqli_num_rows( $result ) )
  {
      //redirects to another page
    header( 'Location: skills.php' );
    die();
    
  }
   //storing query result in a variable
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Skill</h2>
<!-- creating form with it's content-->
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