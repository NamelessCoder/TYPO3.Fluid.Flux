<?php
namespace NamelessCoder\Flux\Form\Field;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Service\FluxService;
use NamelessCoder\Flux\Tests\Unit\Form\Field\AbstractFieldTest;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * @package Flux
 */
class SelectTest extends AbstractFieldTest {

	/**
	 * @var array
	 */
	protected $chainProperties = array(
		'name' => 'test',
		'label' => 'Test field',
		'itemListStyle' => 'color: red',
		'selectedListStyle' => 'color: blue',
		'emptyOption' => TRUE,
		'minItems' => 1,
		'maxItems' => 3,
		'requestUpdate' => TRUE,
	);

	/**
	 * @test
	 */
	public function canConsumeCommaSeparatedItems() {
		/** @var Select $instance */
		$instance = $this->createInstance();
		$instance->setItems('1,2');
		$this->assertSame(2, count($instance->getItems()));
	}

	/**
	 * @test
	 */
	public function canConsumeSingleDimensionalArrayItems() {
		/** @var Select $instance */
		$instance = $this->createInstance();
		$instance->setItems(array(1, 2));
		$this->assertSame(2, count($instance->getItems()));
	}

	/**
	 * @test
	 */
	public function canConsumeMultiDimensionalArrayItems() {
		/** @var Select $instance */
		$instance = $this->createInstance();
		$items = array(
			array('foo' => 'bar'),
			array('baz' => 'bay')
		);
		$instance->setItems($items);
		$this->assertSame(2, count($instance->getItems()));
	}

}
