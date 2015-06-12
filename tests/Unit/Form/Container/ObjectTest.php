<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Container;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\Container\Object;

/**
 * @package Flux
 */
class ObjectTest extends AbstractContainerTest {

	/**
	 * @test
	 */
	public function getFieldsGetsFields() {
		$container = Object::create(array('name' => 'test'));
		$container->createField('Input', 'test');
		$this->assertCount(1, $container->getChildren());
	}

}