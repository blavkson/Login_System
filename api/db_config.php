<?php
   
   $conn = mysqli_connect('localhost', 'root', '', 'registration_system');

   if(!$conn)
   {
     die("Error... failed to conne connect to database" . mysqli_connect_error());
   }

?>