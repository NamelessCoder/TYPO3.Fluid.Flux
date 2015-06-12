<?php
namespace NamelessCoder\Flux\Form;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form;
use NamelessCoder\Flux\Form\Container\Column;
use NamelessCoder\Flux\Form\Container\Container;
use NamelessCoder\Flux\Form\Container\Grid;
use NamelessCoder\Flux\Form\Container\Object;
use NamelessCoder\Flux\Form\Container\Section;
use NamelessCoder\Flux\Form\Container\Sheet;
use NamelessCoder\Flux\Service\FluxService;
use NamelessCoder\Flux\Utility\ExtensionNamingUtility;

/**
 * @package Flux
 * @subpackage Form
 */
abstract class AbstractFormComponent implements FormInterface {

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var boolean
	 */
	protected $enabled = TRUE;

	/**
	 * @var string
	 */
	protected $label = NULL;

	/**
	 * @var string
	 */
	protected $extensionName = 'NamelessCoder.Flux';

	/**
	 * @var ContainerInterface
	 */
	protected $parent;

	/**
	 * @var array
	 */
	protected $variables = array();

	/**
	 * @var boolean
	 */
	protected $inherit = FALSE;

	/**
	 * @var boolean
	 */
	protected $inheritEmpty = FALSE;

	/**
	 * @param array $settings
	 * @return FormInterface
	 */
	public static function create(array $settings = array()) {
		$className = get_called_class();
		return new $className($settings);
	}

	/**
	 * @param string $type
	 * @param string $prefix
	 * @return string
	 */
	protected function createComponentClassName($type, $prefix) {
		$className = str_replace('/', '\\', $type);
		$className = TRUE === class_exists($prefix . '\\' . $className) ? $prefix . '\\' . $className : $className;
		return $className;
	}

	/**
	 * @param string $type
	 * @param string $name
	 * @param string $label
	 * @return FieldInterface
	 */
	public function createField($type, $name, $label = NULL) {
		return $this->createComponent('NamelessCoder\Flux\Form\Field', $type, $name, $label);
	}

	/**
	 * @param string $type
	 * @param string $name
	 * @param string $label
	 * @return ContainerInterface
	 */
	public function createContainer($type, $name, $label = NULL) {
		return $this->createComponent('NamelessCoder\Flux\Form\Container', $type, $name, $label);
	}

	/**
	 * @param string $namespace
	 * @param string $type
	 * @param string $name
	 * @param string|NULL $label
	 * @return FormInterface
	 */
	public function createComponent($namespace, $type, $name, $label = NULL) {
		/** @var FormInterface $component */
		$className = $this->createComponentClassName($type, $namespace);
		$component = new $className();
		if (NULL === $component->getName()) {
			$component->setName($name);
		}
		$component->setLabel($label);
		$component->setExtensionName($this->getExtensionName());
		return $component;
	}

	/**
	 * @param string $name
	 * @return FormInterface
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return boolean
	 */
	public function getEnabled() {
		return (boolean) $this->enabled;
	}

	/**
	 * @param boolean $enabled
	 * @return Form\FormInterface
	 */
	public function setEnabled($enabled) {
		$this->enabled = (boolean) $enabled;
		return $this;
	}

	/**
	 * @param string $extensionName
	 * @return FormInterface
	 */
	public function setExtensionName($extensionName) {
		$this->extensionName = $extensionName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getExtensionName() {
		return $this->extensionName;
	}

	/**
	 * @param string $label
	 * @return FormInterface
	 */
	public function setLabel($label) {
		$this->label = $label;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		$prefix = '';
		if (TRUE === $this instanceof Sheet) {
			$prefix = 'sheets';
		} elseif (TRUE === $this instanceof Section) {
			$prefix = 'sections';
		} elseif (TRUE === $this instanceof Grid) {
			$prefix = 'grids';
		} elseif (TRUE === $this instanceof Column) {
			$prefix = 'columns';
		} elseif (TRUE === $this instanceof Object) {
			$prefix = 'objects';
		} elseif (TRUE === $this instanceof Container) {
			$prefix = 'containers';
		} elseif (TRUE === $this instanceof FieldInterface) {
			if (TRUE === $this->isChildOfType('Object')) {
				$prefix = 'objects.' . $this->getParent()->getName();
			} else {
				$prefix = 'fields';
			}
		}
		return trim($prefix . '.' . $this->getName(), '.');
	}

	/**
	 * @return string
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @param ContainerInterface $parent
	 * @return FormInterface
	 */
	public function setParent($parent) {
		$this->parent = $parent;
		return $this;
	}

	/**
	 * @return ContainerInterface
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * @param array $variables
	 * @return FormInterface
	 */
	public function setVariables($variables) {
		$this->variables = (array) $variables;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getVariables() {
		return $this->variables;
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 * @return FormInterface
	 */
	public function setVariable($name, $value) {
		$this->variables[$name] = $value;
		return $this;
	}

	/**
	 * @param string $name
	 * @return mixed
	 */
	public function getVariable($name) {
		return $this->variables[$name];
	}

	/**
	 * @return ContainerInterface
	 */
	public function getRoot() {
		if (NULL === $this->getParent()) {
			return $this;
		}
		return $this->getParent()->getRoot();
	}

	/**
	 * @param string $type
	 * @return boolean
	 */
	public function isChildOfType($type) {
		$parent = $this->getParent();
		if ($parent === NULL) {
			return FALSE;
		}
		return ('NamelessCoder\Flux\Form\Container\\' . $type === get_class($parent) || TRUE === is_a($parent, $type));
	}

	/**
	 * @param boolean $inherit
	 * @return FormInterface
	 */
	public function setInherit($inherit) {
		$this->inherit = (boolean) $inherit;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getInherit() {
		return (boolean) $this->inherit;
	}

	/**
	 * @param boolean $inheritEmpty
	 * @return FormInterface
	 */
	public function setInheritEmpty($inheritEmpty) {
		$this->inheritEmpty = (boolean) $inheritEmpty;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getInheritEmpty() {
		return (boolean) $this->inheritEmpty;
	}

	/**
	 * Modifies the current Form Component by changing any properties
	 * that were passed in $structure. If a component supports special
	 * indices in $structure (for example a "fields" property) then
	 * that component may specify its own `modify()` method and manually
	 * process each of the specially supported keywords.
	 *
	 * For example, the AbstractFormContainer supports passing "fields"
	 * and each field is then attempted fetched from children. If not
	 * found, it is created (and the structure passed to the `create()`
	 * function which uses the same structure syntax). If it already
	 * exists, the `modify()` method is called on that object to trigger
	 * the recursive modification of all child components.
	 *
	 * @param array $structure
	 * @return FormInterface
	 */
	public function modify(array $structure) {
		if (TRUE === isset($structure['options']) && TRUE === is_array($structure['options'])) {
			foreach ($structure['options'] as $name => $value) {
				$this->setVariable($name, $value);
			}
			unset($structure['options']);
		}
		foreach ($structure as $propertyName => $propertyValue) {
			$setterMethodName = 'set' . ucfirst($propertyName);
			if (TRUE === method_exists($this, $setterMethodName)) {
				$this->$setterMethodName($propertyValue);
			}
		}
		return $this;
	}

	/**
	 * @return FormInterface[]
	 */
	public function getChildren() {
		$mapped = array();
		foreach ($this->children as $object) {
			$mapped[$object->getName()] = $object;
		}
		return $mapped;
	}

}
