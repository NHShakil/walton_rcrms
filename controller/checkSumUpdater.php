<?php
/* Get the name of the uploaded file */
$filename = $_FILES['file']['name'];

//$filename = "01675702741.txt";
/* Choose where to save the uploaded file */
$title = explode(".", $filename);
$location = "uploads/".$title[0].".txt";

/* Save the uploaded file to the local filesystem */
if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
  echo "<script type ='text/JavaScript'>";  
    echo "alert('LULU  You')";  
    echo "</script>";  
} else { 
  echo 'Failure'; 
}
?>