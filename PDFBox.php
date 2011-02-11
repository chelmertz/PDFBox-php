<?php

use \InvalidArgumentException;

/**
 * @author Carl Helmertz <carl.helmertz@gmail.com>
 * @link http://pdfbox.apache.org
 */
class PDFBox {

	/**
	 * @var string
	 */
	protected $path_to_jar;

	/**
	 * @param string $path_to_jar
	 * @throws InvalidArgumentException
	 */
	public function __construct($path_to_jar) {
		$this->_validatePathToJar($path_to_jar);
		$this->path_to_jar = $path_to_jar;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getPathToJar();
	}

	/**
	 * @param string $path
	 * @throws InvalidArgumentException
	 */
	protected function _validatePathToJar($path) {
		if(!is_file($path)) {
			throw new InvalidArgumentException("The path '$path' is not a file");
		}
		if(!is_executable($path)) {
			throw new InvalidArgumentException("The path '$path' is not executable, check its permissions. You could set it to something like 0755");
		}
	}

	/**
	 * @return string
	 */
	public function getPathToJar() {
		return $this->path_to_jar;
	}

}
