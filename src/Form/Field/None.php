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
class None extends AbstractFormField implements FieldInterface {

	/**
	 * @var integer
	 */
	protected $size = 12;

	/**
	 * @param integer $size
	 * @return None
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
