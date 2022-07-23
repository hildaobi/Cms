<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );
//checks to see if email and password match
//encrypting password and checking if it matches already encrypted password
if( isset( $_POST['email'] ) )
{
  //query to get data from the database
  $query = 'SELECT *
    FROM users
    WHERE email = "'.$_POST['email'].'"
    AND password = "'.md5( $_POST['password'] ).'"
    AND active = "Yes"
    LIMIT 1';
     //storing query result in a variable
  $result = mysqli_query( $connect, $query );
   //returns the number of rows present in the result set
  if( mysqli_num_rows( $result ) )
  {
    //getting data from databse andstoring in a variable
    $record = mysqli_fetch_assoc( $result );
    //storing user session details for reuse
    $_SESSION['id'] = $record['id'];
    $_SESSION['email'] = $record['email'];
    //redirecting to another page
    header( 'Location: dashboard.php' );
    die();
    
  }
  else
  {
    // display error message
    set_message( 'Incorrect email and/or password' );
    //redirecting to another page
    header( 'Location: index.php' );
    die();
    
  } 
  
}

include( 'includes/header.php' );

?>

<div style="max-width: 400px; margin:auto">
<!-- creating form with it's content-->
  <form method="post">

    <label for="email">Email:</label>
    <input type="text" name="email" id="email">

    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">

    <br>

    <input type="submit" value="Login">

  </form>
  
</div>

<?php

include( 'includes/footer.php' );

?>