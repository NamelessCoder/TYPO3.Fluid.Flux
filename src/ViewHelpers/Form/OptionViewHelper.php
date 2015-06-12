<?php
namespace NamelessCoder\Flux\ViewHelpers\Form;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form;
use NamelessCoder\Flux\ViewHelpers\AbstractFormViewHelper;

/**
 * Form option ViewHelper
 *
 * @package Flux
 * @subpackage ViewHelpers/Form
 */
class OptionViewHelper extends AbstractFormViewHelper {

	/**
	 * @var string
	 */
	protected $option;

	/**
	 * Initialize arguments
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerArgument('name', 'string', 'Name of the option to be set', TRUE, NULL);
		$this->registerArgument('value', 'string', 'Option value', FALSE, NULL);
	}

	/**
	 * Render method
	 * @return void
	 */
	public function render() {
		$option = $this->hasArgument('name') ? $this->arguments['name'] : $this->option;
		$value = NULL === $this->arguments['value'] ? $this->renderChildren() : $this->arguments['value'];

		$this->getForm()->setOption($option, $value);
	}
}
