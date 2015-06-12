<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Container;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Tests\Unit\Form\Container\AbstractContainerTest;
use NamelessCoder\Flux\Form\Container\Grid;
use NamelessCoder\Flux\Tests\Unit\Form\AbstractFormTest;
use NamelessCoder\Flux\View\ViewContext;

/**
 * @package Flux
 */
class GridTest extends AbstractContainerTest {

	/**
	 * @test
	 */
	public function canUseGetRowsMethod() {
		/** @var Grid $instance */
		$instance = $this->createInstance();
		$this->assertEmpty($instance->getRows());
	}

}
