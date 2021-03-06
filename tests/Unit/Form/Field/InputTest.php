<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

/**
 * @package Flux
 */
class InputTest extends AbstractFieldTest {

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
		'requestUpdate' => TRUE,
	);

	/**
	 * @test
	 */
	public function canUseRequiredProperty() {
		$instance = $this->canChainAllChainableSetters();
		$instance->setRequired(TRUE);
		$this->assertEquals('trim,int,required', $instance->getValidate());
	}

	/**
	 * @test
	 */
	public function canUseRequiredPropertyThroughValidateProperty() {
		$instance = $this->canChainAllChainableSetters();
		$instance->setValidate(NULL);
		$instance->setRequired(TRUE);
		$this->assertEquals('required', $instance->getValidate());
	}

}
