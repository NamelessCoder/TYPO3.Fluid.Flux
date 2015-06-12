<?php
namespace NamelessCoder\Flux\Form\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\AbstractFormField;

/**
 * @package Flux
 * @subpackage Form\Field
 */
class Checkbox extends AbstractFormField {

	/**
	 * @return array
	 */
	public function buildConfiguration() {
		$fieldConfiguration = $this->prepareConfiguration('check');
		return $fieldConfiguration;
	}

}
