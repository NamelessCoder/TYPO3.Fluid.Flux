<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Field;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form\FormInterface;
use NamelessCoder\Flux\Service\FluxService;
use TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager;

/**
 * @package Flux
 */
class TextTest extends InputTest {

	/**
	 * @var array
	 */
	protected $chainProperties = array(
		'name' => 'test',
		'label' => 'Test field',
		'enabled' => TRUE,
		'maxCharacters' => 30,
		'maximum' => 10,
		'minimum' => 0,
		'validate' => 'trim,int',
		'default' => 'test',
		'columns' => 85,
		'rows' => 8,
		'requestUpdate' => TRUE,
	);

	/**
	 * @test
	 */
	public function canChainSetterForEnableRichText() {
		/** @var Text $instance */
		$instance = $this->createInstance();
		$chained = $instance->setEnableRichText(TRUE);
		$this->assertSame($instance, $chained);
		$this->assertTrue($instance->getEnableRichText());
	}

	/**
	 * @test
	 */
	public function canChainSetterForDefaultExtras() {
		/** @var Text $instance */
		$instance = $this->createInstance();
		$chained = $instance->setDefaultExtras('void');
		$this->assertSame($instance, $chained);
		$this->assertSame('void', $instance->getDefaultExtras());
	}

}
