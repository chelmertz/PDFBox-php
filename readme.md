#PDFBox-php
Parsing text from PDF-files using the java utility [PDFBox](http://pdfbox.apache.org/) from Apache.

##Usage

###Basic
This is a basic use case, found in `demos/demo.php`.

	<?php

	require_once '..'.DIRECTORY_SEPARATOR.'PDFBox.php';
	require_once '..'.DIRECTORY_SEPARATOR.'PDFBox'.DIRECTORY_SEPARATOR.'ExtractText.php';

	$jar = "pdfbox-app-1.4.0.jar";
	$pdf_box = new PDFBox($jar);
	$extract_text = new PDFBox\ExtractText($pdf_box);

	$extract_text->parse('regular.pdf');

Input:

  - Path to jar
  - Path to pdf

Output:

  - The contents of "regular.pdf" located in "regular.txt" in the same folder

###Full API
Read through the interface (public methods) of `PDFBox\ExtractText`. There are corresponding methods for every option available in the .jar.

##Requirements
 - java
 - [PDFBox](http://pdfbox.apache.org/) - one single .jar file necessary - and it must be executable
 - PHP 5.3 (for namespaces)

##License
The bundled .jar is licensed under [the Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0). The same goes for PDFBox-php:

Copyright 2011 Carl Helmertz

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
