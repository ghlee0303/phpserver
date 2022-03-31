<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $iden = $_POST["iden"];
  $date = $_POST["date"];
  $address = $_POST["address"];
  $region = $_POST["region"];
  $location = $_POST["location"];
  $maneger = $_POST["maneger"];
  //echo "<script>alert('$date' +' / '+ '$address[0]' +' / '+ '$address[1]' +' / '+ '$maneger[2]' +' / '+ '$region' +' / '+ '$location' +' / '+ '$maneger[0]' +' / '+ '$maneger[1]' +' / '+ '$maneger[2]');</script>";
  $network = $_POST["network"];
  $server = $_POST["server"];
  $scale1 = $_POST["scale1"];
  $scale2 = $_POST["scale2"];
  $scale3 = $_POST["scale3"];
  $scale4 = $_POST["scale4"];
  $distance = $_POST["distance"];
  echo "<script>alert(network : + '$network[0]' +' / '+ '$network[1]' +' / '+ '$network[2]' +' / '+ '$network[3]');</script>";
  echo "<script>alert(server : + '$server[0]' +' / '+ '$server[1]' +' / '+ '$server[2]' +' / '+ '$server[3]');</script>";
  echo "<script>alert(scale1 : + '$scale1[0]' +' / '+ '$scale1[1]' +' / '+ '$distance[0]');</script>";
  echo "<script>alert(scale2 : + '$scale2[0]' +' / '+ '$scale2[1]' +' / '+ '$distance[1]');</script>";
  echo "<script>alert(scale3 : + '$scale3[0]' +' / '+ '$scale3[1]' +' / '+ '$distance[2]');</script>";
  echo "<script>alert(scale4 : + '$scale4[0]' +' / '+ '$scale4[1]' +' / '+ '$distance[3]');</script>";
  
  echo "<script>location.href='./install';</script>";
}
?>