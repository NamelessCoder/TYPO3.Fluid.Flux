<?php
namespace NamelessCoder\Flux\Tests\Unit;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form;
use NamelessCoder\Flux\Form\Field\Custom;
use NamelessCoder\Flux\Service\FluxService;
use NamelessCoder\Flux\Tests\Fixtures\Data\Records;
use NamelessCoder\Flux\View\TemplatePaths;
use NamelessCoder\Flux\View\ViewContext;
use NamelessCoder\Flux\Tests\UnitTestCase;
use TYPO3\CMS\Core\Tests\UnitTestCase as BaseTestCase;

/**
 * @package Flux
 */
abstract class AbstractTestCase extends UnitTestCase {

	/**
	 * @param string $propertyName
	 * @param mixed $value
	 * @param mixed $expectedValue
	 * @param mixed $expectsChaining
	 * @return void
	 */
	protected function assertGetterAndSetterWorks($propertyName, $value, $expectedValue = NULL, $expectsChaining = FALSE) {
		$instance = $this->createInstance();
		$setter = 'set' . ucfirst($propertyName);
		$getter = 'get' . ucfirst($propertyName);
		$chained = $instance->$setter($value);
		if (TRUE === $expectsChaining) {
			$this->assertSame($instance, $chained);
		} else {
			$this->assertNull($chained);
		}
		$this->assertEquals($expectedValue, $instance->$getter());
	}

	/**
	 * @param mixed $value
	 * @return void
	 */
	protected function assertIsArray($value) {
		$isArrayConstraint = new \PHPUnit_Framework_Constraint_IsType(\PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY);
		$this->assertThat($value, $isArrayConstraint);
	}

	/**
	 * @param mixed $value
	 * @return void
	 */
	protected function assertIsString($value) {
		$isStringConstraint = new \PHPUnit_Framework_Constraint_IsType(\PHPUnit_Framework_Constraint_IsType::TYPE_STRING);
		$this->assertThat($value, $isStringConstraint);
	}

	/**
	 * @param mixed $value
	 * @return void
	 */
	protected function assertIsInteger($value) {
		$isIntegerConstraint = new \PHPUnit_Framework_Constraint_IsType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT);
		$this->assertThat($value, $isIntegerConstraint);
	}

	/**
	 * @param mixed $value
	 * @return void
	 */
	protected function assertIsBoolean($value) {
		$isBooleanConstraint = new \PHPUnit_Framework_Constraint_IsType(\PHPUnit_Framework_Constraint_IsType::TYPE_BOOL);
		$this->assertThat($value, $isBooleanConstraint);
	}

	/**
	 * @return object
	 */
	protected function createInstanceClassName() {
		return str_replace('Tests\\Unit\\', '', substr(get_class($this), 0, -4));
	}

	/**
	 * @return object
	 */
	protected function createInstance() {
		$class = $this->createInstanceClassName();
		return new $class();
	}

}
