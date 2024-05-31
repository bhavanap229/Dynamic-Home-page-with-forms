<?php
$servername="localhost";
$username="root";
$password="";
$database="user_file";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Sorry we fail to connect " . mysqli_connect_error());
}
else{
    
    $query="SELECT * FROM `user_file`";
    $result = mysqli_query($conn,$query);

    while($row = mysqli_fetch_array($result))
    {
    $a[] = $row['filename'] ;
    }
}


$q = $_REQUEST["q"];

$hint = "";


if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

echo $hint === "" ? "no suggestion" : $hint;
mysqli_close($conn);
?>