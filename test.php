<?php

include('./mpdf/mpdf.php');
$mpdf=new mPDF();
$mpdf->TOCpagebreak();

$mpdf->TOC_Entry("X Acknowledgements");
$mpdf->Output();
exit();



