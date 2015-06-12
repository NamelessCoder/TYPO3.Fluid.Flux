<?php
namespace NamelessCoder\Flux\Form;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\Container\Section;

/**
 * @package Flux
 * @subpackage Form
 */
abstract class AbstractFormField extends AbstractFormComponent implements FieldInterface {

	/**
	 * @var boolean
	 */
	protected $required = FALSE;

	/**
	 * @var mixed
	 */
	protected $default;

	/**
	 * @var string
	 */
	protected $transform;

	/**
	 * @var string
	 */
	protected $displayCondition = NULL;

	/**
	 * @var boolean
	 */
	protected $requestUpdate = FALSE;

	/**
	 * @var boolean
	 */
	protected $inherit = TRUE;

	/**
	 * @var boolean
	 */
	protected $inheritEmpty = FALSE;

	/**
	 * @var boolean
	 */
	protected $clearable = FALSE;

	/**
	 * @var boolean
	 */
	protected $exclude = TRUE;

	/**
	 * @var string
	 */
	protected $validate;

	/**
	 * @param array $settings
	 * @return FieldInterface
	 * @throws \RuntimeException
	 */
	public static function create(array $settings = array()) {
		if ('Section' === $settings['type']) {
			return Section::create($settings);
		} else {
			$prefix = 'NamelessCoder\Flux\Form\Field\\';
			$type = $settings['type'];
			$className = str_replace('/', '\\', $type);
			$className = TRUE === class_exists($prefix . $className) ? $prefix . $className : $className;
		}
		if (FALSE === class_exists($className)) {
			$className = $settings['type'];
		}
		if (FALSE === class_exists($className)) {
			$name = TRUE === isset($settings['name']) ? $settings['name'] : $className;
			throw new \RuntimeException(
				'Invalid class- or type-name used in type of field "' . $name . '"; "' . $className . '" is invalid',
				1375373527
			);
		}
		return new $className($settings);
	}

	/**
	 * @param boolean $required
	 * @return FieldInterface
	 */
	public function setRequired($required) {
		$this->required = (boolean) $required;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getRequired() {
		return (boolean) $this->required;
	}

	/**
	 * @param mixed $default
	 * @return FieldInterface
	 */
	public function setDefault($default) {
		$this->default = $default;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDefault() {
		if (FALSE === empty($this->default)) {
			$defaultValue = $this->default;
		} else {
			$defaultValue = NULL;
		}
		return $defaultValue;
	}

	/**
	 * @param string $transform
	 * @return FieldInterface
	 */
	public function setTransform($transform) {
		$this->transform = $transform;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTransform() {
		return $this->transform;
	}

	/**
	 * @param string $displayCondition
	 * @return FieldInterface
	 */
	public function setDisplayCondition($displayCondition) {
		$this->displayCondition = $displayCondition;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDisplayCondition() {
		return $this->displayCondition;
	}

	/**
	 * @param boolean $requestUpdate
	 * @return FieldInterface
	 */
	public function setRequestUpdate($requestUpdate) {
		$this->requestUpdate = (boolean) $requestUpdate;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getRequestUpdate() {
		return (boolean) $this->requestUpdate;
	}

	/**
	 * @param boolean $exclude
	 * @return FieldInterface
	 */
	public function setExclude($exclude) {
		$this->exclude = (boolean) $exclude;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getExclude() {
		return (boolean) $this->exclude;
	}

	/**
	 * @param string $validate
	 * @return FieldInterface
	 */
	public function setValidate($validate) {
		$this->validate = $validate;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getValidate() {
		if (FALSE === (boolean) $this->getRequired()) {
			$validate = $this->validate;
		} else {
			if (TRUE === empty($this->validate)) {
				$validate = 'required';
			} else {
				$validators = array_map('trim', explode(',', $this->validate));
				array_push($validators, 'required');
				$validate = implode(',', $validators);
			}
		}
		return $validate;
	}

	/**
	 * @param boolean $clearable
	 * @return FieldInterface
	 */
	public function setClearable($clearable) {
		$this->clearable = (boolean) $clearable;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getClearable() {
		return (boolean) $this->clearable;
	}

	/**
	 * @return boolean
	 */
	public function hasChildren() {
		return FALSE;
	}

}
