<?php

// All references to "dir" is needed to run the demo from any older folder

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'PDFBox'.DIRECTORY_SEPARATOR.'PDFBox.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'PDFBox'.DIRECTORY_SEPARATOR.'ExtractText.php';

$jar = __DIR__.DIRECTORY_SEPARATOR."pdfbox-app-1.4.0.jar";
$pdf_box = new PDFBox\PDFBox($jar);
$extract_text = new PDFBox\ExtractText($pdf_box);

$extract_text->parse(__DIR__.DIRECTORY_SEPARATOR.'regular.pdf');
