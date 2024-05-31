<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="nav.css">
   <title>upload document</title>
</head>

<body>
   <nav class="navbar navbar-expand-lg" style="color:aqua">
      <div class="container-fluid">
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="register_form.php">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="upload.php">Upload File</a>
               </li>
            </ul>
            <form class="d-flex" role="search">
               <button class="btn btn-outline-success" type="submit"> <a href="gethint.html">Search</a></button>
            </form>
         </div>
      </div>
   </nav>
   <?php
   $servername = "localhost";
   $username = "root";
   $password = "";

   $conn = mysqli_connect($servername, $username, $password);


   // $sql="create database user_file";
   // if(mysqli_query($conn,$sql)){
   //     echo"database create successfully.<br>";
   // }
   // else {
   //     echo" error creating database.<br>" .mysqli_error($conn);
   // }

   $sql = "use user_file";
   mysqli_query($conn, $sql);
   // if(mysqli_query($conn,$sql)){
   //     echo"use database successfully.<br>";
   // }
   // else{
   //     echo"error using database" .mysqli_error($conn);
   // }


   // $sql = "create table filedownload(
   //     filename varchar(500)
   //     )";

   // if(mysqli_query($conn,$sql)){
   //     echo"table create successfully";
   // }
   // else{
   //     echo"error creating table" .mysqli_error($conn);
   // }




   if (isset($_POST['submit'])) {
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $path = "C:\Users\Bhavna\Downloads" . $fileName;

      $query = "INSERT INTO user_file(filename) VALUES ('$fileName')";
      $run = mysqli_query($conn, $query);

      if ($run) {
         move_uploaded_file($fileTmpName, $path);
         echo "success";
      } else {
         echo "error" . mysqli_error($conn);
      }
   }

   ?>

   <table>
      <tr>
         <td>
            <form action="upload.php" method="post" enctype="multipart/form-data">
               <input type="file" name="file">
               <button type="submit" name="submit"> Upload</button>
            </form>  
         </td>
      </tr>
      <tr>
         <td>
            <?php
            $query2 = "SELECT * FROM user_file";
            $run2 = mysqli_query($conn, $query2);

            while ($rows = mysqli_fetch_assoc($run2)) {
            ?>

               <a href="download.php?file=<?php echo $rows['filename'] ?>"><?php echo $rows['filename'] ?></a><br>
            <?php
            }
            ?>
         </td>
      </tr>
   </table>

</body>

</html>