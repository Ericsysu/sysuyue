
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
  $introduction=$_POST['selfintroduction'];
  $username=$_COOKIE['username'];
  #echo $month;
  $mysql_server_name='localhost'; //改成自己的mysql数据库服务器
  $mysql_username='root'; //改成自己的mysql数据库用户名
  $mysql_password=''; //改成自己的mysql数据库密码
  $mysql_database='test'; //改成自己的mysql数据库名
  $conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库

  mysql_query("set names 'utf8'"); //数据库输出编码

  mysql_select_db($mysql_database); //打开数据库
  $sql = "select * from selfintroduction";
  $rs = mysql_query($sql);
  $is = true;
  while ($row = mysql_fetch_array($rs)) {
   if($row['user_name'] == $username) {
     $is = false;
   }
  }
  if ($is) {
    $sql = "insert into selfintroduction (user_name,introduction) values ('$username','$introduction')";
    mysql_query($sql);
  }
  else {
    $sql = "update selfintroduction set introduction = '$introduction' where user_name = '$username'";
    mysql_query($sql);
  }

  mysql_close(); //关闭MySQL连接
?>
<meta http-equiv="refresh" content="0;url=index-information.php">
