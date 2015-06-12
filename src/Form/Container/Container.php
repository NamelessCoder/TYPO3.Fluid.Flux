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
class Container extends AbstractFormContainer implements ContainerInterface, FieldContainerInterface {

	/**
	 * @return FieldInterface[]
	 */
	public function getChildren() {
		return (array) iterator_to_array($this->children);
	}

}
