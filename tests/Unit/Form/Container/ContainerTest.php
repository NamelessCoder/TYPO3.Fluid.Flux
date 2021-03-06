<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Container;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\Container\Container;

/**
 * @package Flux
 */
class ContainerTest extends AbstractContainerTest {

	/**
	 * @test
	 */
	public function getFieldsGetsFields() {
		$container = Container::create(array('name' => 'test'));
		$container->createField('Input', 'test');
		$this->assertCount(1, $container->getChildren());
	}

	/**
	 * @test
	 */
	public function ifObjectIsFieldContainerItSupportsFetchingFields() {
		$instance = $this->createInstance();
		$field = $instance->createField('Input', 'test');
		$instance->add($field);
		$fields = $instance->getChildren();
		$this->assertNotEmpty($fields, 'The class ' . $this->getObjectClassName() . ' does not appear to support the required FieldContainerInterface implementation');
	}

}
