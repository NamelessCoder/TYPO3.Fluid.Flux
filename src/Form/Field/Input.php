<?php
namespace NamelessCoder\Flux\Form\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\AbstractFormField;
use NamelessCoder\Flux\Form\FieldInterface;

/**
 * @package Flux
 * @subpackage Form\Field
 */
class Input extends AbstractFormField implements FieldInterface {

	/**
	 * @var integer
	 */
	protected $size = 32;

	/**
	 * @var integer
	 */
	protected $maxCharacters;

	/**
	 * @var integer
	 */
	protected $minimum;

	/**
	 * @var integer
	 */
	protected $maximum;

	/**
	 * @var string
	 */
	protected $placeholder;

	/**
	 * @param integer $maxCharacters
	 * @return Input
	 */
	public function setMaxCharacters($maxCharacters) {
		$this->maxCharacters = $maxCharacters;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getMaxCharacters() {
		return $this->maxCharacters;
	}

	/**
	 * @param integer $maximum
	 * @return Input
	 */
	public function setMaximum($maximum) {
		$this->maximum = $maximum;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getMaximum() {
		return $this->maximum;
	}

	/**
	 * @param integer $minimum
	 * @return Input
	 */
	public function setMinimum($minimum) {
		$this->minimum = $minimum;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getMinimum() {
		return $this->minimum;
	}

	/**
	 * @param string $placeholder
	 * @return Input
	 */
	public function setPlaceholder($placeholder) {
		$this->placeholder = $placeholder;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPlaceholder() {
		return $this->placeholder;
	}

	/**
	 * @param integer $size
	 * @return Input
	 */
	public function setSize($size) {
		$this->size = $size;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getSize() {
		return $this->size;
	}

}
