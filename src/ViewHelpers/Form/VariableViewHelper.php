<?php
namespace NamelessCoder\Flux\ViewHelpers\Form;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\ViewHelpers\AbstractFormViewHelper;

/**
 * Sets an option in the Form instance
 *
 * @package Flux
 * @subpackage ViewHelpers/Form
 */
class VariableViewHelper extends AbstractFormViewHelper {

	/**
	 * Initialize arguments
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerArgument('name', 'string', 'Name of the option - valid values and their behaviours depend entirely on the consumer that will handle the Form instance', TRUE);
		$this->registerArgument('value', 'mixed', 'Value of the option', TRUE);
	}

	/**
	 * Render method
	 * @return string
	 */
	public function render() {
		$this->getContainer()->setVariable($this->arguments['name'], $this->arguments['value']);
	}

}
