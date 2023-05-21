
<?php
        $urd=$_SESSION['id'];
        //$rappor = $db->real_escape_string($_POST['rapport']);
    if(isset($_POST['submit']))
    {
      $file=$_FILES['files'];
     
      $fileName=$_FILES['files']['name'];
      $fileTmpName=$_FILES['files']['tmp_name'];
      $fileSize=$_FILES['files']['size'];
      $fileError=$_FILES['files']['error'];
      $fileType=$_FILES['files']['type'];

      $fileExt=explode('.',$fileName);
      $fileActualExt=strtolower(end($fileExt));
      $allowed=array('jpg','jpeg','png','pdf');
      
          if(in_array($fileActualExt,$allowed))
              {
                  if($fileError===0)
                      {
                          if($fileSize<10000000)
                              {
                                
                                  $fileNameNew=uniqid('',true).".".$fileActualExt;
                                  $fileDestination='files_upload/'.$fileNameNew ;
                                  move_uploaded_file($fileTmpName,$fileDestination);
                                  //$query = "INSERT into `utilisateur` (`namefile`, `file_url`) VALUES ('$fileName', '$fileDestination')";
                                  /*
                                  $password=hash('sha256', $password);
                                 
                                  $query=" UPDATE `users` SET `namefile`='$fileName',`file_url`='$fileDestination'WHERE email='$mail'";
                                 */
       
                                  $sql =  "UPDATE `rapport_jour` 
                                  SET `fichier`='$fileDestination',`nom`='$fileName' WHERE rapport = '$rapport' ";
        
                                             // Exécuter la requête sur la base de données
      
                                             if ($db->query($sql) === true)
                                        {
                                            
                                            
                                            //header('location:formulaire.php?uploadsuccess');
                                        }
                              }
                              else
                                  {
                                      echo "votre fichier est enorme!!";
                                  }
                      }
                      else
                          {
                              echo "Erreur lors du telechargement  du fichier!";

                          }

              }
              else
                  {
                      echo "vous ne pouvez pas telecharger ce type de fichier!";
                    }
    }

              ?>
             