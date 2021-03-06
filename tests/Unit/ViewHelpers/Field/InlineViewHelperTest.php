<?php
namespace NamelessCoder\Flux\Tests\Unit\ViewHelpers\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Tests\Unit\ViewHelpers\Field\AbstractFieldViewHelperTestCase;

/**
 * @package Flux
 */
class InlineViewHelperTest extends AbstractFieldViewHelperTestCase {

	/**
	 * @var array
	 */
	protected $defaultArguments = array(
		'name' => 'test',
		'enabledControls' => array(
			'new' => TRUE,
			'hide' => TRUE
		),
		'foreignTypes' => array(
			0 => array(
				'showitem' => 'a,b,c'
			)
		)
	);

}
