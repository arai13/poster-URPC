<?php
// new comment naseothu
include('./include/db_connect.php');
include('./mpdf/mpdf.php');
$conn = new mysqli("$host", "$username", "$password", "$db");
$biochem = "SELECT * FROM applications WHERE department=1";
$bio = "SELECT * FROM applications WHERE department=2";
$chem = "SELECT * FROM applications WHERE department=3";
$cs = "SELECT * FROM applications WHERE department=4";
$env = "SELECT * FROM applications WHERE department=5";
$geo = "SELECT * FROM applications WHERE department=6";
$math = "SELECT * FROM applications WHERE department=7";
$physics = "SELECT * FROM applications WHERE department=9";
$sql = array(
	"I Biochemistry" => $biochem, 
	"II Biology" => $bio, 
	"III Chemistry" => $chem, 
	"IV Computer Science" => $cs, 
	"V Environmental Science" => $env, 
	"VI Geology" => $geo, 
	"VII Mathematics" => $math, 
	"VII Physics and Astronomy" => $physics
);


if ($conn->connect_error){
	die("Connection to the db failed: ". $conn->connect_error);
}

$mpdf=new mPDF();
$stylesheet = file_get_contents('css/pdf.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->AddPage('P', 'Letter', 1);
$mpdf->WriteHTML("<div class='div_center'><br /><br />");
$mpdf->WriteHTML("<p style='font-size: 22px; text-align: center;'> PROCEEDINGS OF THE NATURAL SCIENCES DIVISION UNDERGRADUATE RESEARCH POSTER CONFERENCE </p>");
$mpdf->WriteHTML("<br /><br /><br /><br />");
$mpdf->WriteHTML("<p style='font-size: 18px; text-align: center;'> EARLHAM COLLEGE </p>");
$mpdf->WriteHTML("<p style='font-size: 18px; text-align: center;'> RICHMOND INDIANA </p>");
$mpdf->WriteHTML("<p style='font-size: 18px; text-align: center;'> OCTOBER 23, 2015 </p>");
$mpdf->WriteHTML("<br /><br /><br />");
$mpdf->WriteHTML("<p style='font-size: 16px; text-align: center;'> COMMITTEE MEMBERS: </p>");
$mpdf->WriteHTML("</div>");
$mpdf->WriteHTML("<div class='names'>");
$mpdf->WriteHTML('<columns column-count="2" column-gap="12" vAlign="justify" />');
$mpdf->WriteHTML("<p style='font-size: 16px; text-align: left; float: left;'><i> Students: </i></span>");
$mpdf->WriteHTML("<columnbreak />");
$mpdf->WriteHTML("<p style='font-size: 16px; text-align: right; float: right;'><i> Faculty: </i> </span>");
$mpdf->WriteHTML("</div>");

$mpdf->TOCpagebreak(array('toc-preHTML'=>'<h1> Contents </h1>'));


$mpdf->AddPage('P', 'Letter', '1');
//$mpdf->WriteHTML('<pagebreak resetpagenum="1" />');
$mpdf->WriteHTML('<columns column-count="2" column-gap="17" />');
$mpdf->keepColumns=true;
$mpdf->pagenumPrefix = "Page ";
$mpdf->SetHeader('{PAGENO}');
foreach($sql as $name=> $dep){
	$result = $conn -> query($dep);
	$mpdf->WriteHTML('<h4 class="text-align: center"> '.strtoupper($name).'</h4>');
	$letter = 'A';
	$mpdf->TOC_Entry($name, 0);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$text = $row['abstract'];
			$title = $row['title'];
			$mpdf->TOC_Entry($title, 1);
			$text = iconv("UTF-8", "UTF-8//IGNORE", $text);
			$title = iconv("UTF-8", "UTF-8//IGNORE", $title);
			$authors = array();
			array_push($authors, $row['pauthor']);
			// getting authors
			$app_id = $row['app_id'];
			$author_sql = "SELECT author_name FROM authors WHERE app_id='$app_id'";
			$author_result = $conn->query($author_sql);

			if($author_result->num_rows > 0){
				while($auth=$author_result->fetch_assoc()){
						array_push($authors, $auth['author_name']);	
				}
			}
			print_r($authors);
			foreach($authors as &$author){
				$mpdf->WriteHTML('<indexentry content="'.$author.'" />');
			}

			$faculty = array();

			$faculty_sql = "SELECT * FROM faculty WHERE app_id='$app_id'";
			$faculty_result = $conn->query($faculty_sql);
			

			$institution = NULL;
			$city = NULL;
			$state = NULL;
			$postcode = NULL;


			if($faculty_result->num_rows > 0){
				while($fac=$faculty_result->fetch_assoc()){
					array_push($faculty, $fac['name']);
					$institution = $fac['institution'];
					$city = $fac['city'];
					$state = $fac['state'];
					$postcode = $fac['postcode'];
				}
			}
			
			if(!empty($faculty)){
				foreach($faculty as &$facult){
					$mpdf->WriteHTML('<indexentry content="'.$facult.'" />');
				}
			}
			if (is_null($institution)){
				$institution = "Earlham College";
				$city = "Richmond";
				$state = "IN";
				$postcode = '47374';
			}
			$mpdf->WriteHTML('<h5>'. $letter .'. ' . $title. '</h5> <br /><b>'. join(', ', $authors) . '</b> <br /><b> Faculty Advisor: '. join(', ', $faculty) . '</b><br /> <b>'.$institution .", ". $city. ", ". $state . " " . $postcode. 
			'<p>'.$text .'</p>' );
			$letter++;
		}
	}
	$mpdf->WriteHTML('<columnbreak />');
}

$mpdf->AddPage('P', 'Letter');
$mpdf->TOC_Entry("X. ACKNOWLEDGEMENTS", 0);
$mpdf->WriteHTML("<h4>X. ACKNOWLEDGEMENTS<h4>");

$mpdf->AddPage('P', 'Letter');
$mpdf->TOC_Entry("XI. AUTHORS AND FACULTY ADVISORS", 0);
$mpdf->WriteHTML("<h4>XI. AUTHORS AND FACULTY ADVISORS</h4>");
$mpdf->WriteHTML($out);
$mpdf->InsertIndex();

$mpdf->Output();