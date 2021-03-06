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
interface FieldInterface extends FormInterface {

	/**
	 * @param boolean $clearable
	 * @return FieldInterface
	 */
	public function setClearable($clearable);

	/**
	 * @return boolean
	 */
	public function getClearable();

	/**
	 * @param boolean $required
	 * @return FieldInterface
	 */
	public function setRequired($required);

	/**
	 * @return boolean
	 */
	public function getRequired();

	/**
	 * @param mixed $default
	 * @return FieldInterface
	 */
	public function setDefault($default);

	/**
	 * @return mixed
	 */
	public function getDefault();

	/**
	 * @param string $transform
	 * @return FieldInterface
	 */
	public function setTransform($transform);

	/**
	 * @return string
	 */
	public function getTransform();

	/**
	 * @param string $displayCondition
	 * @return FieldInterface
	 */
	public function setDisplayCondition($displayCondition);

	/**
	 * @return string
	 */
	public function getDisplayCondition();

	/**
	 * @param boolean $requestUpdate
	 * @return FieldInterface
	 */
	public function setRequestUpdate($requestUpdate);

	/**
	 * @return boolean
	 */
	public function getRequestUpdate();

	/**
	 * @param string $validate
	 * @return FieldInterface
	 */
	public function setValidate($validate);

	/**
	 * @return string
	 */
	public function getValidate();

}
