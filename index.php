<?php

include( 'admin/includes/database.php' );
include( 'admin/includes/config.php' );
include( 'admin/includes/functions.php' );

?>
<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <title>Hilda's Portfolio</title>
  <link href="admin/styles.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Petit+Formal+Script&display=swap" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

</head>
<body>
  <div style="height: 120px; background-color:lightgrey; hover: display: block; margin:0;">
    <h1 style="color:teal; font-family: 'Petit Formal Script', cursive;">Hilda Obioma</h1>
    <!--creating the nav links-->
    <div style="text-align:center;">
        <a href=index.php style="color: teal;padding: 12px 16px;text-decoration: none;display:inline-block;">Home</a>
        <a href="#about" style="color: teal;padding: 12px 16px;text-decoration: none;display: inline-block;">About</a>
        <a href="#projects" style="color:teal;padding: 12px 16px;text-decoration: none;display: inline-block;">Projects</a>
        <a href="#skills" style="color:teal;padding: 12px 16px;text-decoration: none;display: inline-block;">Skills</a>
        <a href="#education" style="color: teal;padding: 12px 16px;text-decoration: none;display: inline-block;">Education</a>
        <a href="#contact" style="color:teal;padding: 12px 16px;text-decoration: none;display: inline-block;">Contact</a>
      </div>
    </div>
  </div>
  <!--creating the about div-->
 <div id="about" style=" height:500px; background-color:#1f1f21;" >
    <h2 style="color:white;">About Me</h2>
    <main style="height:200px; width:30%; margin-left:10%; display:inline-block; background-color:white;">
      <p style="font-family: sans-serif; color:black;">I am an ethuasiatic web developer who is result driven, persistent,a problem solver and works well collaboratively
      with others to achieve a common goal.Talented professional with an ardent desire to better herself and willing to learn new ideas, 
      languages and technology.Worked on some projects from the ideation stage to mvp level. </p>
   </main>
   <div style="height:200px; width:30%; marginn-left:3%;margin-right:10%; display:inline-block; background-color:white;"><p>image</p></div>
</div>
  
 
 <div id="skills" style="background-color:lightgrey;" >
  <h2 style="text-align:center;">Skills</h2>
  <div style="display:flex; flex-flow:row wrap; gap: 5px;">
  <?php
   //query to get content from database
    $query = 'SELECT *
    FROM skills
    ORDER BY percent DESC';
     //storing result of query in a variable
    $result = mysqli_query( $connect, $query );
    ?>
  <!--looping to display content gotten fron database-->
  <?php while($record = mysqli_fetch_assoc($result)): ?>
  <div style="width:400px; height:440px; border:1px solid grey; margin:20px;  flex:1 0 0 ;">
    <img src="admin/image.php?type=skill&id=<?php echo $record['id']; ?>&width=400&height=300">
    <div> 
      <h2 ><?php echo $record['title']; ?></h2> 
      <h3><?php echo $record['percent'];?>%</h3>
      <div style="background-color:#85F4FF;">
        <div style="background-color:teal; width:<?php echo $record['percent'];?>%; height:30px;"></div>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
 </div>
 </div>

<div style="background-color:#1f1f21;">
<h2 style="text-align:center;color:white; ">Projects</h2>
 <div id = "projects" style="height:500px;background-color:#1f1f21; display:flex; flex-flow:row wrap; gap: 5px;">
 
  <?php
   //query to get content from database
  $query = 'SELECT *
    FROM projects
    ORDER BY date DESC';
    //storing result of query in a variable
  $result = mysqli_query( $connect, $query );
  ?>
  
   <!--looping to display content gotten fron database-->
  <?php while($record = mysqli_fetch_assoc($result)): ?>
    <div style="width:400px; height:400px; border:1px solid grey; margin:20px;  flex:1 0 0 ;">
    <h2 style="color:white;"><?php echo $record['title']; ?></h2>
    <p style="font-family: 'Montserrat', sans-serif; color:white;"><?php echo $record['content'];?></p>
  <?php if($record['photo']): ?>
  <img src="<?php echo $record['photo']; ?>">
  
  <?php else: ?>
  <p>This record does not have an image!</p>
  <?php endif; ?>
  </div>
  <?php endwhile; ?>
 </div>

 <div style="background-color:lightgrey;" >
 <h2 style="text-align:center; ">Education</h2>
  <div id="education" style="height:500px; display:flex; flex-flow:row wrap; gap: 5px; background-color:lightgrey; "  >
  <?php
  //query to get content from database
    $query = 'SELECT *
    FROM education
    ORDER BY title DESC';
    //storing result of query in a variable
    $result = mysqli_query( $connect, $query );

 ?>
 <!--looping to display content gotten fron database-->
 <?php while($record = mysqli_fetch_assoc($result)): ?>
  <div style="width:200px; height:300px; border:1px solid grey; margin:20px;  flex:1 0 0 ;">
    <h2 ><?php echo $record['title']; ?></h2>
    
    <h3><?php echo $record['school']; ?></h3>
    
    <h3><?php echo $record['start_date']; ?></h3>
    
    <h3><?php echo $record['end_date']; ?></h3>
 </div> 
  <?php endwhile; ?>
 </div>
 </div>


 <?php
 //inline if statement to 
  $firstname = isset($_POST['firstname'])? $_POST['firstname'] : '' ;
  $lastname = isset($_POST['lastname'])? $_POST['lastname'] : '' ;
  $email = isset($_POST['email'])? $_POST['email'] : '' ;
  $subject = isset($_POST['subject'])? $_POST['subject'] : '' ;
  $message = isset($_POST['message'])? $_POST['message'] : '' ;

  $firstname_error= '';
  $lastname_error= '';
  $email_error= '';
  $subject_error= '';
  $message_error= '';

  // checking if form is submitted
  if (count($_POST))
  {
    //creating a counter variable
    $errors = 0;
    //form validation
    if ($firstname == '')
    {
        $errors ++;
        $firstname_error = 'Space cannot be blank';
    }
    if ($lastname == '')
    {
        $errors ++;
        $lastname_error = 'Space cannot be blank';
    }
    if ($email == '')
    {
        $errors ++;
        $email_error = 'Space cannot be blank';
    }
    if ($subject == '')
    {
        $errors ++;
        $subject_error = 'Space cannot be blank';
    }
    if ($message == '')
    {
        $errors ++;
        $message_error = 'Space cannot be blank';
    }
    // sending form content to database if content passes validation
    //addslashes function use  to prevent sql injections
    if ($errors == 0)
    {
      $query = 'INSERT INTO contact (
        firstname,
        lastname,
        email,
        subject,
        message
      ) VALUES (
         "'.addslashes($firstname).'",
         "'.addslashes($lastname).'",
         "'.addslashes($email).'",
         "'.addslashes($subject).'",
         "'.addslashes($message).'")';
      
         mysqli_query($connect,$query);

         //redirecting to html page
         //header('Location: thankyou.html');
         //die();
    }
  }
 ?>
   
<div style="background-color:#1f1f21;">
   <h2 style="text-align:center; color:white;">Get in Touch</h2> 
 <!--creating form elements -->
 <div id="contact" style="height:700px;background-color:#1f1f21; display:flex; flex-flow:row wrap; gap: 5px;">

 <form  method="POST" style="flex:1 0 0;">
  
  <label for= "firstname" style="color:white; font-family: 'Montserrat', sans-serif;" >Name:</label>
  <input type="text" name="firstname" value="<?php echo $firstname; ?>">
  <?php echo  $firstname_error ;?> <!--displaying error message -->
    
  <br>
  <label for= "lastname" style="color:white; font-family: 'Montserrat', sans-serif;">Last Name:</label>
  <input type="text" name="lastname" value="<?php echo $lastname; ?>">
  <?php echo  $lastname_error ;?>  <!--displaying error message -->
  
  <br>
  <label for= "email" style="color:white; font-family: 'Montserrat', sans-serif;">Email:</label>
  <input type="text" name="email" value="<?php echo $email; ?>">
  <?php echo  $email_error ;?>  <!--displaying error message -->
  
  <br>
  <label for= "subject" style="color:white; font-family: 'Montserrat', sans-serif;">Subject:</label>
  <input type="text" name="subject" value="<?php echo $subject; ?>">
  <?php echo  $subject_error ;?>   <!--displaying error message -->
    
  <br>
  <label for="message" style="color:white; font-family: 'Montserrat', sans-serif;">Message</label>
  <textarea  name="message"  rows="10" placeholder="type your message here"><?php echo $message; ?></textarea>
  <?php echo  $message_error ;?>   <!--displaying error message --> 
  <br>
  
 <input type="submit"  value="send">
  
 </form>

 </div>
</div>
 <footer>
  <div id="footer">
    <p style="color:white; font-family: 'Montserrat', sans-serif;">&copy;Copyright Reserved Hilda Obioma 2022</p>
    <?php
   //query to get content from database
    $query = 'SELECT *
    FROM socials
    ORDER BY title DESC';
     //storing result of query in a variable
    $result = mysqli_query( $connect, $query );
    ?>
   <!--looping to display content gotten fron database-->
   <?php while($record = mysqli_fetch_assoc($result)): ?>
    <img src="admin/image.php?type=social&id=<?php echo $record['id']; ?>&width=30&height=30">
    <?php endwhile; ?>
 </div> 
 </footer>
</body>
</html>
