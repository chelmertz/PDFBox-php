<?php

namespace PDFBox;

use InvalidArgumentException;

/**
 * @author Carl Helmertz
 **/
class ExtractText {

	/**
	 * @var string
	 */
	protected $password;

	/**
	 * @var string
	 */
	protected $path_to_jar;

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @return string
	 */
	public function getPathToJar() {
		return $this->path_to_jar;
	}

	/**
	 * @param string|null $password
	 * @return PDFBox
	 */
	public function setPassword($password = null) {
		$this->password = $password;
		return $this;
	}

	/**
	 * @param string $path
	 * @throws InvalidArgumentException
	 * @return PDFBox
	 */
	public function setPathToJar($path) {
		if(!is_file($path)) {
			throw new InvalidArgumentException("The path '$path' is not a file");
		}
		if(!is_executable($path)) {
			throw new InvalidArgumentException("The path '$path' is not executable, check its permissions");
		}
		$this->path_to_jar = $path;
		return $this;
	}
}
