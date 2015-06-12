<?php
namespace NamelessCoder\Flux\ViewHelpers\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\Field\Select;

/**
 * Select-type FlexForm field ViewHelper
 *
 * @package Flux
 * @subpackage ViewHelpers/Field
 */
class SelectViewHelper extends AbstractMultiValueFieldViewHelper {

	/**
	 * Initialize
	 * @return void
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('items', 'mixed', 'Items for the selector; array / CSV / Traversable / Query supported', TRUE);
	}

	/**
	 * @return Select
	 */
	public function getComponent() {
		/** @var Select $component */
		$component = $this->getPreparedComponent('Select');
		$component->setItems($this->arguments['items']);
		return $component;
	}

}
