<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Container;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\ContainerInterface;
use NamelessCoder\Flux\Tests\Unit\Form\AbstractFormTest;

/**
 * @package Flux
 */
abstract class AbstractContainerTest extends AbstractFormTest {

	/**
	 * @var array
	 */
	protected $chainProperties = array('name' => 'test', 'label' => 'Test field', 'transform' => 'string');

	/**
	 * @return ContainerInterface
	 */
	protected function createInstance() {
		$className = $this->getObjectClassName();
		return new $className();
	}

	/**
	 * @test
	 */
	public function returnsFalseIfChildObjectNameDoesNotExist() {
		$instance = $this->createInstance();
		$result = $instance->get('doesNotExist');
		$this->assertSame(FALSE, $result);
	}

	/**
	 * @test
	 */
	public function canGetAndSetInheritEmpty() {
		$instance = $this->createInstance();
		$instance->setInheritEmpty(TRUE);
		$this->assertEquals(TRUE, $instance->getInheritEmpty());
	}

	/**
	 * @test
	 */
	public function canGetAndSetInherit() {
		$instance = $this->createInstance();
		$instance->setInherit(FALSE);
		$this->assertEquals(FALSE, $instance->getInherit());
	}

	/**
	 * @test
	 */
	public function returnsFalseIfChildObjectNameDoesNotExistRecursively() {
		$instance = $this->createInstance();
		$subContainer = $instance->createContainer('Container', 'testcontainer');
		$subField = $instance->createField('Input', 'test');
		$subContainer->add($subField);
		$instance->add($subContainer);
		$result = $instance->get('doesNotExist', TRUE);
		$this->assertSame(FALSE, $result);
	}

	/**
	 * @test
	 */
	public function canCreateFromDefinitionContainingFields() {
		$properties = array($this->chainProperties);
		$properties['fields'] = array(
			'foo' => array(
				'type' => 'Input'
			),
			'bar' => array(
				'type' => 'Input'
			),
		);
		$instance = call_user_func_array(array($this->getObjectClassName(), 'create'), array($properties));
		$this->assertInstanceOf('NamelessCoder\Flux\Form\FormInterface', $instance);
	}

}
