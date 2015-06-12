<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Container;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

/**
 * @package Flux
 */
class RowTest extends AbstractContainerTest {

	/**
	 * @test
	 */
	public function canUseGetColumnsMethod() {
		/** @var Row $instance */
		$instance = $this->createInstance();
		$this->assertEmpty($instance->getColumns());
	}

}
