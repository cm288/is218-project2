<?php
error_reporting(0);
echo '<h4> Top 10 Colleges For Each Question Below:</h4>';

//Query Links #'s 1-6
echo '<a href="index.php?query=q1">Colleges with the highest percentage of women students</a><br>';
echo '<a href="index.php?query=q2">Colleges with the highest percentage of male students</a><br>';
echo '<a href="index.php?query=q3">Colleges with the largest endowment overall</a><br>';
echo '<a href="index.php?query=q4">Colleges with the largest enrollment of freshman</a><br>';
echo '<a href="index.php?query=q5">Colleges with the highest revenue from tuition</a><br>';
echo '<a href="index.php?query=q6">Colleges with the lowest non-zero tuition revenue</a><br>';

//Query Links #'s 7-16
echo '<h4>Top 10 Colleges by Region</h4>';
echo '<a href="index.php?query=q7">US Service Schools</a><br>';
echo '<a href="index.php?query=q8">New England</a><br>';
echo '<a href="index.php?query=q9">Mid East</a><br>';
echo '<a href="index.php?query=q10">Great Lakes</a><br>';
echo '<a href="index.php?query=q11">Plains</a><br>';
echo '<a href="index.php?query=q12">Southeast</a><br>';
echo '<a href="index.php?query=q13">Southwest</a><br>';
echo '<a href="index.php?query=q14">Rocky Mountains</a><br>';
echo '<a href="index.php?query=q15">Far West</a><br>';
echo '<a href="index.php?query=q16">Outlying Areas</a><br>';

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


//Query 6 print
if($_GET['query']=="q6")
{
	$sql = 'select instnm, F1B01 from (select UNITID, instnm from hd2013) as test1 left join (select UNITID, F1B01 from f1213_f1a) as test2 on test1.UNITID = test2.UNITID WHERE NOT F1B01 IS NULL and not F1B01 = 0 group by test1.instnm order by F1B01 asc limit 10';
	
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


//Query 7 print (US Service  Schoools)
if($_GET['query']=="q7")
{
	$sql = 'select instnm, F1H02 from (select UNITID, instnm from hd2013 where OBEREG = "0") as test1 left join (select UNITID, F1H02 from f1213_f1a) as test2 on test1.UNITID = test2.UNITID WHERE NOT F1H02 IS NULL and not F1H02 = 0 group by test1.instnm order by F1H02 desc limit 10';
	
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



	$a2 = 'select instnm, F1A01 from (select UNITID, instnm from hd2013 where OBEREG = "0") as test1 left join (select UNITID, F1A01 from f1213_f1a) as test2 on test1.UNITID = test2.UNITID WHERE NOT F1A01 IS NULL and not F1A01 = 0 group by test1.instnm order by F1A01 desc limit 10';
	$a3 = 'select instnm, F1A09 from (select UNITID, instnm from hd2013 where OBEREG = "0") as test1 left join (select UNITID, F1A09 from f1213_f1a) as test2 on test1.UNITID = test2.UNITID WHERE NOT F1A09 IS NULL and not F1A09 = 0 group by test1.instnm order by F1A09 desc limit 10';
	$a4 = 'select instnm, F1B01 from (select UNITID, instnm from hd2013 where OBEREG = "0") as test1 left join (select UNITID, F1B01 from f1213_f1a) as test2 on test1.UNITID = test2.UNITID WHERE NOT F1B01 IS NULL and not F1B01 = 0 group by test1.instnm order by F1B01 asc limit 10';
	$a5 = 'select instnm, F1B01 from (select UNITID, instnm from hd2013 where OBEREG = "0") as test1 left join (select UNITID, F1B01 from f1213_f1a) as test2 on test1.UNITID = test2.UNITID WHERE NOT F1B01 IS NULL and not F1B01 = 0 group by test1.instnm order by F1B01 desc limit 10';


/*
	$array = array ('Endowment'=>$a1,'Total Current Assets'=>$a2,'Total current liabilities'=>$a3,'Lowest non-zero tuition'=>$a4,'Highest Tuition'=>$a5);
	
	foreach($array as $title => $sql)
	{
		echo $title;
		
		$num=1;
		echo "<table class='imagetable'  border='1' style='width:100%' table-layout: fixed>";
	
		foreach($db->query($sql) as $row)
		{
			$remove=0;
        		
			foreach($row as $x)
			{
        			unset($row[$remove]);
                		$remove++;
        		}
			
			echo "<tr>";
        		echo "<td>";
        		echo ($title);
        		echo "</td>";
        		echo "<td>";
        		echo ("Result Number ".$num);
        		echo "</td>";
        		echo "</tr>";
				
			foreach ($row as $key => $value)
        		{
        			echo "<tr>";
                		echo "<td>";
                		echo ($key);
                		echo "</td>";
                		echo "<td>";
                		echo ($value);
                		echo "</td>";
                		echo "</tr>";
        		}

			$num++;
        		echo("<tr><td><br></td><td><br></td></tr>");		


		}
		
		echo "</table>";
		echo '<br><br>';
	}	
}


*/
?>
