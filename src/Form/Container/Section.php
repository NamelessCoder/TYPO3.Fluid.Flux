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
class Section extends AbstractFormContainer implements ContainerInterface {

	/**
	 * @param array $settings
	 * @return \NamelessCoder\Flux\Form\Container\Section
	 */
	public static function create(array $settings = array()) {
		$section = new Section($settings);
		if (TRUE === isset($settings['objects'])) {
			foreach ($settings['objects'] as $fieldName => $objectSettings) {
				if (FALSE === isset($objectSettings['name'])) {
					$objectSettings['name'] = $fieldName;
				}
				$object = Object::create($objectSettings);
				$section->add($object);
			}
		}
		return $section;
	}

}
