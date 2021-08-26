<?php
// this file is use tin connect to database
// declaration des variables 
Define('DB_USER', 'admin');
Define('DB_PASSWORD', 'Falich@76');
Define('DB_HOST','localhost');
Define('DB_NAME','members');

//try to connect to to databas
try
{
  $dbcon = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
  mysqli_set_charset($dbcon,'utf8');
}
catch(Execption $e) // if connect to database have a problem
{
 //print "An Exception occurred. Message: " . $e->getMessage();
print "ce system est en apenne veillez ressayer plus tard";
}
catch(Error $e)
{
 //print "An Exception occurred. Message: " . $e->getMessage();
 print "ce system est en apenne veillez ressayer plus tard";
}
?>