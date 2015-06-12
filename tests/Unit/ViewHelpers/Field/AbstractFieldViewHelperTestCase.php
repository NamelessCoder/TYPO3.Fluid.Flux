<?php
namespace NamelessCoder\Flux\Tests\Unit\ViewHelpers\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Tests\Unit\ViewHelpers\AbstractFormViewHelperTestCase;

/**
 * @package Flux
 */
abstract class AbstractFieldViewHelperTestCase extends AbstractFormViewHelperTestCase {

	/**
	 * @test
	 */
	public function createsValidFieldInterfaceComponents() {
		$instance = $this->buildViewHelperInstance($this->defaultArguments);
		$instance->render();
		$component = $instance->getComponent();
		$this->assertInstanceOf('NamelessCoder\Flux\Form\FieldInterface', $component);
	}

}
