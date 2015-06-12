<?php
namespace NamelessCoder\Flux\ViewHelpers\Form\Option;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form;
use NamelessCoder\Flux\ViewHelpers\Form\OptionViewHelper;

/**
 * Form group option ViewHelper
 *
 * @package Flux
 * @subpackage ViewHelpers/Form
 */
class GroupViewHelper extends OptionViewHelper {

	/**
	 * @var string
	 */
	protected $option = Form::OPTION_GROUP;

	/**
	 * Initialize arguments
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerArgument('value', 'string', 'Name of the group (fx: shown as label of WizardTab)', FALSE, NULL);
	}
}
