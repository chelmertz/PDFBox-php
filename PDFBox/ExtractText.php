<?php

namespace PDFBox;

use \InvalidArgumentException;

/**
 * @author Carl Helmertz <helmertz@gmail.com>
 * @link http://pdfbox.apache.org/commandlineutilities/ExtractText.html
 */
class ExtractText {

	/**
	 * @var int
	 */
	protected $end_page = null;

	/**
	 * @var boolean
	 */
	protected $ignore_corrupt_objects = false;

	/**
	 * @var string
	 */
	protected $output_encoding;

	/**
	 * @var string
	 */
	protected $output_filename = self::DEFAULT_FILENAME;

	/**
	 * @var string
	 */
	protected $output_format = self::FORMAT_RAW_TEXT;

	/**
	 * @var boolean
	 */
	protected $output_medium = self::OUTPUT_FILE;

	/**
	 * @var string
	 */
	protected $password;

	/**
	 * @var PDFBox
	 */
	protected $pdf_box;

	/**
	 * @var boolean
	 */
	protected $separate_output_by_beads = false;

	/**
	 * @var boolean
	 */
	protected $sort_output;

	/**
	 * @var int
	 */
	protected $start_page = 1;

	const DEFAULT_FILENAME = null;

	const FORMAT_HTML = true;
	const FORMAT_RAW_TEXT = false;

	const OUTPUT_CONSOLE = true;
	const OUTPUT_FILE = false;

	/**
	 * @param PDFBox $pdf_box
	 */
	public function __construct(PDFBox $pdf_box) {
		$this->pdf_box = $pdf_box;
	}

	/**
	 * @return string
	 */
	public function getOutputEncoding() {
		return $this->output_encoding;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param boolean $ignore_corrupt_objects
	 * @return ExtractText
	 */
	public function ignoreCorruptObjects($ignore_corrupt_objects = false) {
		$this->ignore_corrupt_objects = (boolean) $ignore_corrupt_objects;
		return $this;
	}

	/**
	 * @todo password-detection for protected pdf-file
	 * @param string $file
	 * @throws InvalidArgumentException
	 * @return int
	 */
	public function parse($pdf_file) {
		if(!is_file($pdf_file)) {
			$pdf_file = (string) $pdf_file;
			throw new InvalidArgumentException("'$pdf_file' is not a file");
		}
		if(!is_readable($pdf_file)) {
			throw new InvalidArgumentException("'$pdf_file' is not a readable file. Change its permissions");
		}
		$output_file = $this->output_file;

		$options = array();

		if(self::OUTPUT_CONSOLE == $this->output_method) {
			$options[] = '-console';
			$output_file = null;
		}

		if(self::FORMAT_HTML == $this->output_format) {
			$options[] = '-html';
		}

		if($this->password) {
			$options[] = "-password $this->password";
		}

		if($this->ignore_corrupt_objects) {
			$options[] = '-force';
		}

		if($this->sort_output) {
			$options[] = '-sort';
		}

		if($this->ignore_beads) {
			$options[] = '-ignoreBeads';
		}

		if($this->start_page && 1 != $this->start_page) {
			$options[] = "-startPage $this->start_page";
		}

		if($this->end_page) {
			$options[] = "-endPage $this->end_page";
		}

		$cli_options = null;
		if($options) {
			$cli_options = implode(' ', $options);
		}

		$command = escapeshellcmd("java -jar $this->pdf_box ExtractText $cli_options $pdf_file $output_file");

		exec($command, $output, $exit_code);
		return $exit_code;
	}

	/**
	 * @param boolean $separate_output_by_beads
	 * @return ExtractText
	 */
	public function separateOutputByBeads($separate_output_by_beads = false) {
		$this->separate_output_by_beads = (boolean) $separate_output_by_beads;
		return $this;
	}

	/**
	 * @param int $end_page
	 * @return ExtractText
	 */
	public function setEndPage($end_page = null) {
		if(!is_numeric($end_page) || $end_page < 1) {
			throw new InvalidArgumentException("End page must be a positive integer, '".gettype($end_page)."' given");
		}
		$this->end_page = $end_page;
		return $this;
	}

	/**
	 * If left empty
	 *
	 * @param string|null $filename
	 * @return ExtractText
	 */
	public function setOutputFilename($filename = self::DEFAULT_FILENAME) {
		$this->filename = (string) $filename;
		return $this;
	}

	/**
	 * @param boolean $format
	 * @throws InvalidArgumentException
	 * @return ExtractText
	 */
	public function setOuputFormat($format = self::RAW_TEXT) {
		switch ($format) {
			case self::RAW_TEXT:
			case self::HTML:
				break;
			default:
				throw new InvalidArgumentException("Only ".__CLASS__."::RAW_TEXT and ".__CLASS__."::HTML are valid arguments in ".__medium__);
				break;
		}
		$this->output_format = $format;
		return $this;
	}

	/**
	 * @param ExtractText::OUPUT_FILE|ExtractText::OUTPUT_CONSOLE $output_medium
	 * @throws InvalidArgumentException
	 * @return ExtractText
	 */
	public function setOutputMedium($output_medium = self::OUTPUT_FILE) {
		switch ($output_medium) {
			case self::OUTPUT_CONSOLE:
			case self::OUTPUT_FILE:
				break;
			default:
				throw new InvalidArgumentException("Only ".__CLASS__."::OUPUT_CONSOLE and ".__CLASS__."::OUPUT_FILE are valid arguments in ".__medium__);
				break;
		}
		$this->output_medium = $output_medium;
		return $this;
	}

	/**
	 * @param string|null $encoding
	 * @return ExtractText
	 */
	public function setOutputEncoding($encoding = null) {
		$this->output_encoding = $encoding;
		return $this;
	}

	/**
	 * @param string|null $password
	 * @return ExtractText
	 */
	public function setPassword($password = null) {
		$this->password = $password;
		return $this;
	}

	/**
	 * @param int $start_page
	 * @throws InvalidArgumentException
	 * @return ExtractText
	 */
	public function setStartPage($start_page = 1) {
		if(!is_numeric($start_page) || $start_page < 1) {
			throw new InvalidArgumentException("Start page must be a positive integer, '".gettype($start_page)."' given");
		}
		$this->start_page = $start_page;
		return $this;
	}

	/**
	 * @param boolean $sort_output
	 * @return ExtractText
	 */
	public function sortOutput($sort_output = false) {
		$this->sort_output = (boolean) $sort_output;
		return $this;
	}
}
