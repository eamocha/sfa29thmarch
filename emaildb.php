<?php
$tables="*";   // use * for all tables or use , to seperate table names
$email="eric.atinga@usalamaforum.org,e.eatinga@yahoo.com";     //your email id
    //your email id
include("assets/lib/config.php");
include("assets/lib/functions.php");
///////////////////////////////////////////////////////////////////////////////////////////

/////////don't need to change bellow //////

backup($mysqli,$tables,$email);
function backup($mysqli,$tables = '*',$email)
{

 // $con= mysql_connect($db_host,$db_username,$db_password);
  //mysql_select_db($db_name,$con);

  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysqli_query($mysqli,'SHOW TABLES');
    while($row = mysqli_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
$return='';
  //cycle through
  foreach($tables as $table)
  {
    $result = mysqli_query($mysqli,'SELECT * FROM '.$table);
    $num_fields = mysqli_num_fields($result);

    $return.= 'DROP TABLE IF EXISTS '.$table.';';
    $row2 = mysqli_fetch_row(mysqli_query($mysqli,'SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";

    for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysqli_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    $return.="\n\n\n";
  }

  //save file
  $today=date("Y-m-d h:m:s");
  $filename=$today.'-db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
  $handle = fopen($filename,'w+');
  fwrite($handle,$return);
  fclose($handle);
  compress($filename);
send_mail_withAttachment($filename.".zip",$email,"Database Backup");
}
                   ?>