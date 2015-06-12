<?php
namespace NamelessCoder\Flux\Form\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\AbstractMultiValueFormField;

/**
 * @package Flux
 * @subpackage Form\Field
 */
class File extends AbstractMultiValueFormField {

	/**
	 * @var string
	 */
	protected $disallowed = '';

	/**
	 * @var string
	 */
	protected $allowed = '';

	/**
	 * @var integer
	 */
	protected $maxSize;

	/**
	 * @var string
	 */
	protected $uploadFolder;

	/**
	 * @var boolean
	 */
	protected $showThumbnails = FALSE;

	/**
	 * Overrides parent method to ensure properly formatted
	 * default values for files
	 *
	 * @param mixed $default
	 * @return \NamelessCoder\Flux\Form\FieldInterface
	 */
	public function setDefault($default) {
		if (NULL !== $default) {
			$files = array();
			$filePaths = array_map('trim', explode(',', $default));
			foreach ($filePaths as $path) {
				if (FALSE === strpos($path, '|')) {
					$files[] = $path . '|' . rawurlencode($path);
				} else {
					$files[] = $path;
				}
			}
			$default = implode(',', $files);
		}
		$this->default = $default;
		return $this;
	}

	/**
	 * @param string $allowed
	 * @return File
	 */
	public function setAllowed($allowed) {
		$this->allowed = $allowed;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAllowed() {
		return $this->allowed;
	}

	/**
	 * @param string $disallowed
	 * @return File
	 */
	public function setDisallowed($disallowed) {
		$this->disallowed = $disallowed;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDisallowed() {
		return $this->disallowed;
	}

	/**
	 * @param integer $maxSize
	 * @return File
	 */
	public function setMaxSize($maxSize) {
		$this->maxSize = $maxSize;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getMaxSize() {
		return $this->maxSize;
	}

	/**
	 * @param string $uploadFolder
	 * @return File
	 */
	public function setUploadFolder($uploadFolder) {
		$this->uploadFolder = $uploadFolder;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUploadFolder() {
		return $this->uploadFolder;
	}

	/**
	 * @param boolean $showThumbnails
	 * @return File
	 */
	public function setShowThumbnails($showThumbnails) {
		$this->showThumbnails = (boolean) $showThumbnails;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getShowThumbnails() {
		return (boolean) $this->showThumbnails;
	}

}
