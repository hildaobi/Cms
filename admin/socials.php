<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM socials
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Social has been deleted' );
  
  header( 'Location: socials.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM socials
  ORDER BY title DESC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Social</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Title</th>
    <th align="left">URL</th>
    
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=social&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['title'] ); ?>
     
      </td>
      <td align="center"><a href="<?php echo $record['url']; ?>"><?php echo $record['url'];?></a></td>
   
      <td align="center"><a href="socials_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
      <td align="center"><a href="socials_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="socials.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this sociallinks?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="
socials_add.php"><i class="fas fa-plus-square"></i> Add Social</a></p>


<?php

include( 'includes/footer.php' );

?>