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
use NamelessCoder\Flux\Form\FieldContainerInterface;
use NamelessCoder\Flux\Form\FieldInterface;

/**
 * @package Flux
 * @subpackage Form\Container
 */
class Sheet extends AbstractFormContainer implements ContainerInterface, FieldContainerInterface {

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var string
	 */
	protected $shortDescription;

	/**
	 * @param string $shortDescription
	 * @return self
	 */
	public function setShortDescription($shortDescription) {
		$this->shortDescription = $shortDescription;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getShortDescription() {
		return $this->shortDescription;
	}

	/**
	 * @param string $description
	 * @return self
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

}
