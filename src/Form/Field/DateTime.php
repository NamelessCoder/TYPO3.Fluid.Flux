<?php
namespace NamelessCoder\Flux\Form\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\FieldInterface;

/**
 * @package Flux
 * @subpackage Form\Field
 */
class DateTime extends Input implements FieldInterface {

	/**
	 * @var string
	 */
	protected $validate = 'date';

	/**
	 * @param array $settings
	 * @return FieldInterface
	 */
	public static function create(array $settings = array()) {
		return parent::create($settings);
	}

}
