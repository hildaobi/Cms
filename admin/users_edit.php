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
  header( 'Location: users.php' );
  die();
  
}

if( isset( $_POST['first'] ) )
{
  
  if( $_POST['first'] and $_POST['last'] and $_POST['email'] )
  {
    //query that updates the database
    //.mysqli_real_escape_string preventing sql injections
    $query = 'UPDATE users SET
      first = "'.mysqli_real_escape_string( $connect, $_POST['first'] ).'",
      last = "'.mysqli_real_escape_string( $connect, $_POST['last'] ).'",
      email = "'.mysqli_real_escape_string( $connect, $_POST['email'] ).'",
      active = "'.$_POST['active'].'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    if( $_POST['password'] )
    {
      //query that updates the database
  //checks if password matches after encryption
      $query = 'UPDATE users SET
        password = "'.md5( $_POST['password'] ).'"
        WHERE id = '.$_GET['id'].'
        LIMIT 1';
      mysqli_query( $connect, $query );
      
    }
        // display message
    set_message( 'User has been updated' );
    
  }
 //redirects to another page
  header( 'Location: users.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
   //query that gets data from the database
  $query = 'SELECT *
    FROM users
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  //storing query result in a variable
    $result = mysqli_query( $connect, $query );
  //returns the number of rows present in the result set
  if( !mysqli_num_rows( $result ) )
  {
     //redirects to another page
    header( 'Location: users.php' );
    die();
    
  }
   //storing query result in a variable
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit User</h2>
<!-- creating form with it's content-->
<form method="post">
  
  <label for="first">First:</label>
  <input type="text" name="first" id="first" value="<?php echo htmlentities( $record['first'] ); ?>">
  
  <br>
  
  <label for="last">Last:</label>
  <input type="text" name="last" id="last" value="<?php echo htmlentities( $record['last'] ); ?>">
  
  <br>
  
  <label for="email">Email:</label>
  <input type="email" name="email" id="email" value="<?php echo htmlentities( $record['email'] ); ?>">
  
  <br>
  
  <label for="password">Password:</label>
  <input type="password" name="password" id="password">
  
  <br>
  
  <label for="active">Active:</label>
  <?php
  
  $values = array( 'Yes', 'No' );
  
  echo '<select name="active" id="active">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    if( $value == $record['active'] ) echo ' selected="selected"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Edit User">
  
</form>

<p><a href="users.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>


<?php

include( 'includes/footer.php' );

?>