<?php
//Query Links
echo '<a href="index.php?query=q1">Colleges with the highest percentage of women students</a><br>';
echo '<a href="index.php?query=q2">Colleges with the highest percentage of male students</a><br>';
echo '<a href="index.php?query=q3">Colleges with the largest endowment overall</a><br>';
echo '<a href="index.php?query=q4">Colleges with the largest enrollment of freshman</a><br>';
echo '<a href="index.php?query=q5">Colleges with the highest revenue from tuition</a><br>';
echo '<a href="index.php?query=q6">Colleges with the lowest non-zero tuition revenue</a><br>';


//DB Connection
error_reporting(-1);
ini_set('display_errors', 'On');

$db = new PDO('mysql:host=localhost;dbname=schools;charset=utf8', 'root', 'blank288', array(PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//Query 1 print
if($_GET['query']=="q1")
{
	$sql = 'select instnm, EFAGE08 from (select UNITID, instnm from hd2013) as test1 left join (select UNITID, ((EFAGE08/EFAGE09)*100) as EFAGE08 from ef2013b) as test2 on test1.UNITID = test2.UNITID WHERE NOT EFAGE08 IS NULL group by test1.instnm order by EFAGE08 desc limit 10';

	if(!$result = $db->query($sql))
		die('error'.$db->error);

		echo '<table border="1" style="width:100%">';
		echo "<tr>";
		echo "<th>School</th>";
		echo "<th>Percentage</th>";
		echo "</tr>";

		while($row = $result->fetch())
		{
			echo "<tr>";
			echo "<td>".$row['instnm']."</td>";
			echo "<td>".$row['EFAGE08']."</td>";
			echo "</tr>";
		}
}		

		
//Query 2 print
if($_GET['query']=="q2")
{
	$sql = 'select instnm, EFAGE07 from (select UNITID, instnm from hd2013) as test1 left join (select UNITID, ((EFAGE07/EFAGE09)*100) as EFAGE07 from ef2013b) as test2 on test1.UNITID = test2.UNITID WHERE NOT EFAGE07 IS NULL group by test1.instnm order by EFAGE07 desc limit 10';

	if(!$result = $db->query($sql))
		die('error'.$db->error);

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
}


//Query 3 print
if($_GET['query']=="q3")
{
	$sql = 'select instnm, F1H02 from (select UNITID, instnm from hd2013) as test1 left join (select UNITID, F1H02 from f1213_f1a) as test2 on test1.UNITID = test2.UNITID WHERE NOT F1H02 IS NULL and not F1H02 = 0 group by test1.instnm order by F1H02 desc limit 10';

	if(!$result = $db->query($sql))
                die('error'.$db->error);
     		
		echo '<table border="1" style="width:100%">';
                echo "<tr>";
                echo "<th>School</th>";
                echo "<th>Endowment</th>";
                echo "</tr>";



	 while($row = $result->fetch())
        	{
                	echo "<tr>";
                	echo "<td>".$row['instnm']."</td>";
                	echo "<td>".$row['F1H02']."</td>";
                	echo "</tr>";
        	}	
}

//Query 4 print
if($_GET['query']=="q4")
{
	$sql = 'select instnm, EFTOTLT from (select UNITID, instnm from hd2013) as test1 left join (select UNITID, EFTOTLT from ef2013a) as test2 on test1.UNITID = test2.UNITID WHERE NOT EFTOTLT IS NULL and not EFTOTLT = 0 group by test1.instnm order by EFTOTLT desc limit 10';

	 if(!$result = $db->query($sql))
                die('error'.$db->error);

		echo '<table border="1" style="width:100%">';
                echo "<tr>";
                echo "<th>School</th>";
                echo "<th>Freshman</th>";
                echo "</tr>";

	 while($row = $result->fetch())
                {
                        echo "<tr>";
                        echo "<td>".$row['instnm']."</td>";
                        echo "<td>".$row['EFTOTLT']."</td>";
                        echo "</tr>";
                }
}

//Query 5 print
if($_GET['query']=="q5")
{
	$sql = 'select instnm, F1B01 from (select UNITID, instnm from hd2013) as test1 left join (select UNITID, F1B01 from f1213_f1a) as test2 on test1.UNITID = test2.UNITID WHERE NOT F1B01 IS NULL and not F1B01 = 0 group by test1.instnm order by F1B01 desc limit 10';

	 if(!$result = $db->query($sql))
                die('error'.$db->error);

		echo '<table border="1" style="width:100%">';
                echo "<tr>";
                echo "<th>School</th>";
                echo "<th>Revenue</th>";
                echo "</tr>";

	while($row = $result->fetch())
                {
                        echo "<tr>";
                        echo "<td>".$row['instnm']."</td>";
                        echo "<td>".$row['F1B01']."</td>";
                        echo "</tr>";
                }
}











?>
