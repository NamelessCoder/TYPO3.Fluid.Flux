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
class Grid extends AbstractFormContainer implements ContainerInterface {

	/**
	 * @return Row[]
	 */
	public function getRows() {
		return (array) iterator_to_array($this->children);
	}

}
