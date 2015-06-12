<?php
namespace NamelessCoder\Flux\ViewHelpers\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\RelationFieldInterface;

/**
 * Multi-table-relation FlexForm field ViewHelper
 *
 * @package Flux
 * @subpackage ViewHelpers/Field
 */
class MultiRelationViewHelper extends AbstractRelationFieldViewHelper {

	/**
	 * @param string $type
	 * @return RelationFieldInterface
	 */
	public function getComponent($type = 'MultiRelation') {
		$component = $this->getPreparedComponent($type);
		return $component;
	}

}
