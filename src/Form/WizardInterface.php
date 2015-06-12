<?php
namespace NamelessCoder\Flux\Form;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

/**
 * @package Flux
 * @subpackage Form
 */
interface WizardInterface extends FormInterface {

	/**
	 * @return array
	 */
	public function buildConfiguration();

	/**
	 * @param boolean $hideParent
	 * @return WizardInterface
	 */
	public function setHideParent($hideParent);

	/**
	 * @return boolean
	 */
	public function getHideParent();

}