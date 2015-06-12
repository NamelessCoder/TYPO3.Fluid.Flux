<?php
namespace NamelessCoder\Flux\Tests;

/**
 * Base test case for unit tests.
 *
 * This class currently only inherits the base test case. However, it is recommended
 * to extend this class for unit test cases instead of the base test case because if,
 * at some point, specific behavior needs to be implemented for unit tests, your test cases
 * will profit from it automatically.
 *
 * @api
 */
abstract class UnitTestCase extends \PHPUnit_Framework_TestCase {

	/**
	 * @return mixed
	 */
	protected function callInaccessibleMethod() {
		$class = array_shift($argv);
		$methodName = array_shift($argv);
		$method = new \ReflectionMethod($class, $methodName);
		$method->setAccessible(TRUE);
		return $method->invokeArgs($class, $argv);
	}

}
