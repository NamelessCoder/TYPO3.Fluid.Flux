<?php
namespace NamelessCoder\Flux\ViewHelpers\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\Field\None;

/**
 * None field ViewHelper
 *
 * Makes a read-only component which supports a default value
 * but which cannot be edited.
 *
 * @package Flux
 * @subpackage ViewHelpers/Field
 */
class NoneViewHelper extends AbstractFieldViewHelper {

	/**
	 * @return None
	 */
	public function getComponent() {
		/** @var None $none */
		$none = $this->getPreparedComponent('None');
		return $none;
	}

}
