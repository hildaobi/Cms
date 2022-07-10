<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM contact
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Contact has been deleted' );
  
  header( 'Location: contact.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM contact
  ORDER BY firstname ';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Contact</h2>

<table>
  <tr>
    <th align="center">ID</th>
    <th align="left">Name</th>
    <th align="center">Email</th>
    <th align="center">Subject</th>
    <th align="center">Message</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left"><?php echo htmlentities( $record['firstname'] ); ?> <?php echo htmlentities( $record['lastname'] ); ?></td>
      <td align="left"><a href="mailto:<?php echo htmlentities( $record['email'] ); ?>"><?php echo htmlentities( $record['email'] ); ?></a></td>
      <td align="left">
        <?php echo htmlentities( $record['subject'] ); ?>
      </td>
      <td>
       <small><?php echo $record['message']; ?></small>
      </td>


     
      <td align="center">
        <a href="contact.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this question?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="contact_add.php"><i class="fas fa-plus-square"></i> Add contact</a></p>


<?php

include( 'includes/footer.php' );

?>