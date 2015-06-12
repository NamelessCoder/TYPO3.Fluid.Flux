<?php
namespace NamelessCoder\Flux\ViewHelpers\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\Field\Hidden;

/**
 * Hidden field ViewHelper
 *
 * Makes a hidden input field with a fixed value.
 *
 * @package Flux
 * @subpackage ViewHelpers/Field
 */
class HiddenViewHelper extends AbstractFieldViewHelper {

	/**
	 * @return None
	 */
	public function getComponent() {
		/** @var Hidden $hidden */
		$hidden = $this->getPreparedComponent('Hidden');
		return $hidden;
	}

}
