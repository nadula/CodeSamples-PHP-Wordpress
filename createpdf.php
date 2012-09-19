<?php

/* 

This script reads a given CSV file and creates a downloadable PDF file with image in the background, using fpdf.

*/

error_reporting(0);
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    private $report_date;
    private $report_location;

function Header()
{
    $this-> Image('fpdf/bg-pdf.v3.jpg', 0, 0,-150,300); 
    
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(2);
    // Title
    $this->Cell(52,-15,$this->report_location.' - '.$this->report_date,0,0,'C');
    // Line break
    $this->Ln(0);     

}

function dateFinder($data){
    foreach($data as $row)
    {
	if(strlen($this->report_date)<2){
                $this->report_date=$row[1];
                $this->report_location=$row[0];
                break;
        }
    }
}

function drawLabelDetails($lineTime,$grade,$tips,$dist){
    // Arial bold 15
    $this->SetFont('Arial','B',6);
    // Move to the right
    $this->Cell(-10);
    // Title
    $this->Cell(10,28,$lineTime,0,0,'C');
	
	$this->Cell(-10,34,$dist." M",0,0,'C');
    $this->Ln(0);
	
    $this->Cell(-13,42,"Grade ".$grade,0,0,'C');
    $this->Ln(0);
	
    $this->Cell(-15,48,'Tips',0,0,'C');
    $this->Ln(0);
	
    $this->Cell(-16,54,$tips,0,0,'C');
    
    $this->SetFont('','B',6);
    // Line break
    $this->Ln(0);    
}

function numberLabels($count){
    $this->Ln(3);
    $this->SetFont('Arial','B',15);
    $this->SetDrawColor(0,0,0);
    // Move to the right
    $this->Cell(-12);
    // Title
    $this->Cell(10,10,$count,1,0,'C');
    $this->SetFont('','B',9);
    // Line break    
}
// for Load data
function LoadData($file)
{
	$path = "http://www.hotdogs.com.au/uploads/guidedogs/";
    // for Read file lines    
	$lines = file($path.$file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(',',trim($line));
    return $data;
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,-20,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


// Colored table
function FancyTable($header, $data, $pdf)
{
    $lineTime="";
    $grade="";
    $tips="";
    
	$setCounter=0;
	
    foreach($data as $row)
    {
       	 
        if($row[7]==1){

			if($setCounter<=4){
		   		$setCounter++;
           	}
						
			if($row[2]>1 && (($row[2]-1)%5)==0){
				$setCounter=0;
				$pdf->AddPage();     
			}
				
           $distance=$row[3];
		   $lineTime=$row[4];
           $grade=$row[5];
           $tips=$row[6];
           
            $this->numberLabels($row[2]);
            $this->drawLabelDetails($lineTime,$grade,$tips,$distance);
           
            $this->SetFillColor(0,0,0);
            $this->SetTextColor(255);
            $this->SetDrawColor(255,255,255);
            $this->SetFont('','B');
           
            $w = array(5,8, 26, 8, 8, 12, 8, 9, 20, 78);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],5,$header[$i],0,0,'L',true);
            $this->Ln();
            
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('','B');       
        	$this->Ln(3);    
        }
             
        $this->Cell($w[0],3,$row[7],'LR');
		$this->Cell($w[1],3,$row[8],'LR');
        $this->Cell($w[2],3,$row[9],'LR');
        $this->Cell($w[3],3,$row[10],'LR');
        $this->Cell($w[4],3,$row[11],'LR');
		$this->Cell($w[5],3,$row[12],'LR');
        $this->Cell($w[6],3,$row[13],'LR');
        $this->Cell($w[7],3,$row[14],'LR');
		$this->SetFont('','B',4);
        $this->Cell($w[8],3,$row[15],'LR');
		
		    $this->SetFont('','B',6);
			
        $this->Cell($w[9],3,$row[16],'LR');
		
		    $this->SetFont('','B',6);

        $this->Ln();
        $fill = !$fill;
		
        $count++;
        
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');

}
}

$pdf = new PDF();
$pdf->AliasNbPages();

$file = $_GET['file'];
//echo $file;
$data = $pdf->LoadData($file);
//$data = $pdf->LoadData('APK10825.csv');
$pdf->dateFinder($data);

$pdf->Header();
$pdf->SetMargins(20, 30);
// Column headings
$header = array('Box', 'Last6', 'Dog Name', 'Odds','Best','Total starts','Rating','Trk+dist','Trainer','Comment');
// Data loading

$pdf->SetFont('Arial','',6);
//$pdf-> Image('bg-pdf.jpg', 0, 0, 0, 0); 
$pdf->AddPage();
$pdf->FancyTable($header,$data,$pdf);
$pdf->Output(); // $pdf->Output('myFile.pdf', 'F'); save file to the same folder | other options I, D
?>