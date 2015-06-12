<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Field;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form;
use NamelessCoder\Flux\Form\AbstractFormField;
use NamelessCoder\Flux\Tests\Unit\Form\AbstractFormTest;

/**
 * author Claus Due <claus@namelesscoder.net>
 * @package Flux
 */
abstract class AbstractFieldTest extends AbstractFormTest {

	/**
	 * @var array
	 */
	protected $chainProperties = array('name' => 'test', 'label' => 'Test field', 'enabled' => TRUE);

	/**
	 * @test
	 */
	public function canGetAndSetInheritEmpty() {
		$instance = $this->canChainAllChainableSetters();
		$this->assertFalse($instance->setInheritEmpty(FALSE)->getInheritEmpty());
		$this->assertTrue($instance->setInheritEmpty(TRUE)->getInheritEmpty());
	}

	/**
	 * @test
	 */
	public function canGetAndSetInherit() {
		$instance = $this->canChainAllChainableSetters();
		$this->assertFalse($instance->setInherit(FALSE)->getInherit());
		$this->assertTrue($instance->setInherit(TRUE)->getInherit());
	}

	/**
	 * @test
	 */
	public function canUseClearableProperty() {
		$instance = $this->canChainAllChainableSetters();
		$this->assertFalse($instance->setClearable(FALSE)->getClearable());
		$this->assertTrue($instance->setClearable(TRUE)->getClearable());
	}
	/**
	 * @test
	 */
	public function canCreateFromDefinition() {
		$properties = $this->chainProperties;
		$class = $this->getObjectClassName();
		$properties['type'] = implode('/', array_slice(explode('\\', $class), 4, 1));;
		$instance = call_user_func_array(array($class, 'create'), array($properties));
		$this->assertInstanceOf('NamelessCoder\Flux\Form\FormInterface', $instance);
	}

	/**
	 * @test
	 */
	public function throwsExceptionOnInvalidFieldTypeWhenCreatingFromDefinition() {
		$properties = $this->chainProperties;
		$properties['type'] = 'InvalidType';
		$this->setExpectedException('RuntimeException', NULL, 1375373527);
		call_user_func_array(array($this->getObjectClassName(), 'create'), array($properties));
	}

	/**
	 * @test
	 */
	public function canCreateFromSettingsUsingFullClassName() {
		$properties = $this->chainProperties;
		$properties['type'] = $this->getObjectClassName();
		$instance = call_user_func_array(array($this->getObjectClassName(), 'create'), array($properties));
		$this->assertInstanceOf('NamelessCoder\Flux\Form\FormInterface', $instance);
	}

	/**
	 * @test
	 */
	public function canCreateSectionUsingShortcutMethod() {
		$definition = array(
			'name' => 'test',
			'label' => 'Test section',
			'type' => 'Section'
		);
		$section = AbstractFormField::create($definition);
		$this->assertInstanceOf('NamelessCoder\Flux\Form\Container\Section', $section);
		$this->assertSame($definition['name'], $section->getName());
	}

}
