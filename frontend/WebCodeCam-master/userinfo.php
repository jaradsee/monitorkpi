<?php
$conn = mysql_connect ('localhost','root','123456');
$db   = mysql_select_db('student');

$studentid = $_POST['studentid'];
if (strpos($studentid,','))!==false) {

  $studentid=explod(',',$studentid)[1];
}

if (mysql_query("INSERT INTO usercheckin (studentid) VALUES ($studentid)")){

        $query =mysql_query("SELECT usercheckin.checkin,userinfo.id,userinfo.firstname,userinfo.lastname,userinfo.level FROM userinfo, usercheckin WHERE usercheckin.studentid=userinfo.id
        ORDER BY usercheckin.id DESC LIMIT 5");

       $resultArray  = array();
       while ($result = mysql_fetch_assoc($query)) {
         $array_push($resultArray,$result);
         // code...
       }
       mysql_close($conn);
       echo json_encode($resultArray);
       //echo "Successfully Inserted";
} else {
  echo json_encode(null);
  //echo "Insertion Faild";
}




 ?>
