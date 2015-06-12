<?php
namespace NamelessCoder\Flux\Tests\Unit\ViewHelpers;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

/**
 * @package Flux
 */
abstract class AbstractFormViewHelperTestCase extends AbstractViewHelperTestCase {

	/**
	 * @test
	 */
	public function canCreateViewHelperInstanceAndRenderWithoutArguments() {
		$instance = $this->buildViewHelperInstance($this->defaultArguments);
		$this->assertInstanceOf($this->getViewHelperClassName(), $instance);
		$instance->render();
	}

}
