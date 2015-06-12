<?php
namespace NamelessCoder\Flux\Tests\Unit\Form;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\ContainerInterface;
use NamelessCoder\Flux\Form\FieldInterface;
use NamelessCoder\Flux\Service\FluxService;
use NamelessCoder\Flux\Form;
use NamelessCoder\Flux\Form\FormInterface;
use NamelessCoder\Flux\Tests\Unit\AbstractTestCase;

/**
 * @package Flux
 */
abstract class AbstractFormTest extends AbstractTestCase {

	/**
	 * @var array
	 */
	protected $chainProperties = array('name' => 'test', 'label' => 'Test field', 'enabled' => TRUE);

	/**
	 * @return FormInterface
	 */
	protected function createInstance() {
		$className = $this->getObjectClassName();
		return new $className();
	}

	/**
	 * @test
	 */
	public function canGetAndSetExtensionName() {
		$form = $this->createInstance();
		$form->setExtensionName('Flux');
		$this->assertEquals('Flux', $form->getExtensionName());
	}

	/**
	 * @test
	 */
	public function canGetAndSetVariables() {
		$variables = array('test' => 'foobar');
		$this->assertGetterAndSetterWorks('variables', $variables, $variables, TRUE);
	}

	/**
	 * @test
	 */
	public function canGetAndSetSingleVariable() {
		$test = 'foobar';
		$instance = $this->createInstance();
		$instance->setVariable('test', $test);
		$this->assertEquals($test, $instance->getVariable('test'));
	}

	/**
	 * @return string
	 */
	protected function getObjectClassName() {
		$class = get_class($this);
		$class = substr($class, 0, -4);
		$class = str_replace('\\Tests\\Unit', '', $class);
		return $class;
	}

	/**
	 * @test
	 * @param array $chainPropertiesAndValues
	 * @return FieldInterface
	 */
	public function canChainAllChainableSetters($chainPropertiesAndValues = NULL) {
		if (NULL === $chainPropertiesAndValues) {
			$chainPropertiesAndValues = $this->chainProperties;
		}
		$instance = $this->createInstance();
		foreach ($chainPropertiesAndValues as $propertyName => $propertValue) {
			$setterMethodName = 'set' . ucfirst($propertyName);
			$chained = call_user_func_array(array($instance, $setterMethodName), array($propertValue));
			$this->assertSame($instance, $chained, 'The setter ' . $setterMethodName . ' on ' . $this->getObjectClassName() . ' does not support chaining.');
			if ($chained === $instance) {
				$instance = $chained;
			}
		}
		return $instance;
	}

	/**
	 * @test
	 */
	public function canCallAllGetterCounterpartsForChainableSetters() {
		$instance = $this->createInstance();
		foreach ($this->chainProperties as $propertyName => $propertValue) {
			$setterMethodName = 'set' . ucfirst($propertyName);
			$instance->$setterMethodName($propertValue);
			$getter = 'get' . ucfirst($propertyName);
			$result = $instance->$getter();
			$this->assertEquals($propertValue, $result);
		}
	}

	/**
	 * @test
	 */
	public function canCreateFromDefinition() {
		$properties = array($this->chainProperties);
		$class = $this->getObjectClassName();
		$type = implode('/', array_slice(explode('_', substr($class, 13)), 1));
		$properties['type'] = $type;
		$instance = call_user_func_array(array($class, 'create'), array($properties));
		$this->assertInstanceOf('NamelessCoder\Flux\Form\FormInterface', $instance);
	}

	/**
	 * @test
	 */
	public function canModifyProperties() {
		$mock = $this->getMock($this->createInstanceClassName(), array('dummy'));
		$properties = array('enabled' => FALSE);
		$mock->modify($properties);
		$result = $mock->getEnabled();
		$this->assertFalse($result);
	}

	/**
	 * @test
	 */
	public function canModifyVariablesSelectively() {
		$mock = $this->getMock($this->createInstanceClassName(), array('dummy'));
		$mock->setVariables(array('foo' => 'baz', 'abc' => 'xyz'));
		$properties = array('options' => array('foo' => 'bar'));
		$mock->modify($properties);
		$this->assertEquals('bar', $mock->getVariable('foo'));
		$this->assertEquals('xyz', $mock->getVariable('abc'));
	}

}
