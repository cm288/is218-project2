<?php
error_reporting(-1);

ini_set('display_errors', 'On');

$db = new PDO('mysql:host=localhost;dbname=schools;charset=utf8', 'root', 'blank288', array(PDO::ATTR_EMULATE_PREPARES => false,

            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$sql = 'select instnm, EFAGE07 from (select UNITID, instnm from hd2013) as test1 left join (select UNITID, ((EFAGE07/EFAGE09)*100) as EFAGE07 from ef2013b) as test2 on test1.UNITID = test2.UNITID WHERE NOT EFAGE07 IS NULL group by test1.instnm order by EFAGE07 desc limit 5';

if(!$result = $db->query($sql))
{
	die('error'.$db->error);
}

echo '<table border="1" style="width:100%">';
echo "<tr>";
echo "<th>School</th>";
echo "<th>Percentage</th>";
echo "</tr>";

while($row = $result->fetch())
{
	echo "<tr>";
	echo "<td>".$row['instnm']."</td>";
	echo "<td>".$row['EFAGE07']."</td>";
	echo "</tr>";
}









?>
