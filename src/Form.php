<?php
namespace NamelessCoder\Flux;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\Container\Sheet;
use NamelessCoder\Flux\Outlet\OutletInterface;
use NamelessCoder\Flux\Utility\ExtensionNamingUtility;

/**
 * @package Flux
 */
class Form extends Form\AbstractFormContainer implements Form\FieldContainerInterface {

	const OPTION_TRANSLATION = 'translation';
	const OPTION_GROUP = 'group';
	const OPTION_ICON = 'icon';
	const OPTION_TCA_LABELS = 'labels';
	const OPTION_TCA_HIDE = 'hide';
	const OPTION_TCA_START = 'start';
	const OPTION_TCA_END = 'end';
	const OPTION_TCA_DELETE = 'delete';
	const OPTION_TCA_FEGROUP = 'frontendUserGroup';
	const OPTION_TEMPLATEFILE = 'templateFile';
	const OPTION_RECORD = 'record';
	const OPTION_RECORD_FIELD = 'recordField';
	const OPTION_RECORD_TABLE = 'recordTable';
	const TRANSLATION_DISABLED = 'disabled';
	const TRANSLATION_SEPARATE = 'separate';
	const TRANSLATION_INHERIT = 'inherit';
	const POSITION_TOP = 'top';
	const POSITION_BOTTOM = 'bottom';
	const POSITION_BOTH = 'both';
	const POSITION_NONE = 'none';
	const CONTROL_INFO = 'info';
	const CONTROL_NEW = 'new';
	const CONTROL_DRAGDROP = 'dragdrop';
	const CONTROL_SORT = 'sort';
	const CONTROL_HIDE = 'hide';
	const CONTROL_DELETE = 'delete';
	const CONTROL_LOCALISE = 'localize';
	const DEFAULT_LANGUAGEFILE = '/Resources/Private/Language/locallang.xlf';

	/**
	 * Machine-readable, lowerCamelCase ID of this form. DOM compatible.
	 *
	 * @var string
	 */
	protected $id;

	/**
	 * Should be set to contain the extension name in UpperCamelCase of
	 * the extension implementing this form object.
	 *
	 * @var string
	 */
	protected $extensionName;

	/**
	 * If TRUE, removes sheet wrappers if there is only a single sheet.
	 *
	 * @var boolean
	 */
	protected $compact = FALSE;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var array
	 */
	protected $options = array();

	/**
	 * @var OutletInterface
	 */
	protected $outlet;

	/**
	 * @param Form\FormInterface $child
	 * @return Form\FormInterface
	 */
	public function add(Form\FormInterface $child) {
		foreach ($this->children as $existingChild) {
			if ($child->getName() === $existingChild->getName()) {
				return $this;
			}
		}
		$this->children->attach($child);
		$child->setParent($this);
		return $this;
	}

	/**
	 * @param boolean $includeEmpty
	 * @return Form\Container\Sheet[]
	 */
	public function getSheets($includeEmpty = FALSE) {
		$sheets = array();
		foreach ($this->children as $sheet) {
			if (FALSE === $sheet->hasChildren() && FALSE === $includeEmpty) {
				continue;
			}
			$name = $sheet->getName();
			$sheets[$name] = $sheet;
		}
		return $sheets;
	}

	/**
	 * @return Form\FieldInterface[]
	 */
	public function getFields() {
		$fields = array();
		foreach ($this->getSheets() as $sheet) {
			$fieldsInSheet = $sheet->getFields();
			$fields = array_merge($fields, $fieldsInSheet);
		}
		return $fields;
	}

	/**
	 * @param boolean $compact
	 * @return Form\FormInterface
	 */
	public function setCompact($compact) {
		$this->compact = $compact;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getCompact() {
		return $this->compact;
	}

	/**
	 * @param string $extensionName
	 * @return Form\FormInterface
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
	 * @param string $id
	 * @return Form\FormInterface
	 */
	public function setId($id) {
		$allowed = 'a-z0-9_';
		$pattern = '/[^' . $allowed . ']+/i';
		if (preg_match($pattern, $id)) {
			throw new \RuntimeException('Flux FlexForm with id "' . $id . '" uses invalid characters in the ID; valid characters
				are: "' . $allowed . '" and the pattern used for matching is "' . $pattern . '". This bad ID name will prevent
				you from utilising some features, fx automatic LLL reference building, but is not fatal');
		}
		$this->id = $id;
		if (TRUE === empty($this->name)) {
			$this->name = $id;
		}
		return $this;
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $description
	 * @return Form\FormInterface
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param array $options
	 * @return Form\FormInterface
	 */
	public function setOptions(array $options) {
		$this->options = $options;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 * @return Form\FormInterface
	 */
	public function setOption($name, $value) {
		$this->options[$name] = $value;
		return $this;
	}

	/**
	 * @param string $name
	 * @return mixed
	 */
	public function getOption($name) {
		return $this->options[$name];
	}

	/**
	 * @param string $name
	 * @return boolean
	 */
	public function hasOption($name) {
		return TRUE === isset($this->options[$name]);
	}

	/**
	 * @param OutletInterface $outlet
	 * @return Form\FormInterface
	 */
	public function setOutlet(OutletInterface $outlet) {
		$this->outlet = $outlet;
		return $this;
	}

	/**
	 * @return OutletInterface
	 */
	public function getOutlet() {
		return $this->outlet;
	}

	/**
	 * @param array $structure
	 * @return ContainerInterface
	 */
	public function modify(array $structure) {
		if (TRUE === isset($structure['options']) && TRUE === is_array($structure['options'])) {
			foreach ($structure['options'] as $name => $value) {
				$this->setOption($name, $value);
			}
			unset($structure['options']);
		}
		if (TRUE === isset($structure['sheets'])) {
			foreach ((array) $structure['sheets'] as $index => $sheetData) {
				$sheetName = TRUE === isset($sheetData['name']) ? $sheetData['name'] : $index;
				// check if field already exists - if it does, modify it. If it does not, create it.
				if (TRUE === $this->has($sheetName)) {
					$sheet = $this->get($sheetName);
				} else {
					$sheet = $this->createContainer('Sheet', $sheetName);
				}
				$sheet->modify($sheetData);
			}
		}
		return parent::modify($structure);
	}

}
