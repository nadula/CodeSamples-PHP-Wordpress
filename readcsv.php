<html><head>
<link rel="stylesheet" type="text/css" href="/format/css/gdcsv.css" media="print" >
</head>
<body>
<?php 

/* 

This script reads a given csv file and display on the screen.

*/

$fpath = $_SERVER['DOCUMENT_ROOT'].$_GET['fpath']; 
$handle = fopen($fpath , "r");

$data = fgetcsv($handle, 1000, ",");
//$count = 0;

echo "<div class='maindiv'><h1>".$data[0]."&nbsp;-&nbsp;".$data[1]."</h1>"; 

//do { //if((trim($data[0])=="") && (trim($data[7])=="")) { break; } 
for($i=0; $i<=12;$i++) {
	if((trim($data[0])=="") && (trim($data[7])=="")) { break; } 
	if( ($data[2]==6) || ($data[2]==11)) {    	
		echo"</div><div class='maindiv'><h1 class='gdcsv-pagebreak'>".$data[0]."&nbsp;-&nbsp;".$data[1]."</h1>"; }
?>
<table border="0" class="gdcsv-tablemain">
  <tr>
    <td valign="top" class="gdcsv-leftcell">
    <div class="race_number"><? echo $data[2]; ?></div><p><br />
    <? echo $data[4]; ?> PM<br />
    <? echo $data[3]; ?> M<br />    
    Grade <? echo $data[5]; ?><br /><br />   
    Tips<br /><? echo $data[6]; ?><br /></p>      
    </td>
    <td valign="top">
		<table border="0" class="gdcsv-tablerace">
			<tr class="gdcsv-header" align="center">
				<td width="3%">Box</td>
				<td width="7%">Last 6</td>
				<td width="15%">Dog</td>
				<td width="7%">Odds</td>
				<td width="7%">Best time</td>
				<td width="8%">Total</td>
				<td width="5%">Rating</td>
				<td width="8">Starts</td>
				<td width="15%">Trainer</td>
				<td width="25%">Comment</td>
			</tr>

<?php
		
			do {
?>
			<tr>			
				<td><? echo $data[7]; ?></td>
				<td><? echo $data[8]; ?></td>
				<td><? echo $data[9]; ?></td>
				<td><? echo $data[10]; ?></td>
				<td><? echo $data[11]; ?></td>
				<td><? echo $data[12]; ?></td>
				<td><? echo $data[13]; ?></td>
				<td><? echo $data[14]; ?></td>
				<td><? echo $data[15]; ?></td>
				<td><? if($data[16]=="") echo "&nbsp;"; else echo $data[16]; ?></td>
			</tr>
<?php
			$data = fgetcsv($handle, 1000, ",");			
			} while( (trim($data[7])!="") && (trim($data[0])==""));

?>

			</table>
    </td>
  </tr>
</table>
<? 
} echo "</div>"; 
fclose($handle);  ?>  

</body>
</html>
