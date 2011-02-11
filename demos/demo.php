<?php

require_once '..'.DIRECTORY_SEPARATOR.'PDFBox.php';
require_once '..'.DIRECTORY_SEPARATOR.'PDFBox'.DIRECTORY_SEPARATOR.'ExtractText.php';

$jar = "pdfbox-app-1.4.0.jar";
$pdf_box = new PDFBox($jar);
$extract_text = new PDFBox\ExtractText($pdf_box);

$extract_text->parse('regular.pdf');
