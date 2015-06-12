<?php
namespace NamelessCoder\Flux\Form\Container;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\AbstractFormContainer;
use NamelessCoder\Flux\Form\ContainerInterface;

/**
 * @package Flux
 * @subpackage Form\Container
 */
class Column extends AbstractFormContainer implements ContainerInterface {

	/**
	 * @var integer
	 */
	protected $columnPosition = 0;

	/**
	 * @var integer
	 */
	protected $colspan = 1;

	/**
	 * @var integer
	 */
	protected $rowspan = 1;

	/**
	 * @var string
	 */
	protected $style = NULL;

	/**
	 * @param integer $colspan
	 * @return Column
	 */
	public function setColspan($colspan) {
		$this->colspan = $colspan;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getColspan() {
		return $this->colspan;
	}

	/**
	 * @param integer $columnPosition
	 * @return Column
	 */
	public function setColumnPosition($columnPosition) {
		$this->columnPosition = (integer) $columnPosition;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getColumnPosition() {
		return $this->columnPosition;
	}

	/**
	 * @param integer $rowspan
	 * @return Column
	 */
	public function setRowspan($rowspan) {
		$this->rowspan = $rowspan;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function getRowspan() {
		return $this->rowspan;
	}

	/**
	 * @param string $style
	 * @return Column
	 */
	public function setStyle($style) {
		$this->style = $style;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getStyle() {
		return $this->style;
	}

}
