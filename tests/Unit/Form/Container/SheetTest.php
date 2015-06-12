<?php
namespace NamelessCoder\Flux\Tests\Unit\Form\Container;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form;

/**
 * author Claus Due <claus@namelesscoder.net>
 * @package Flux
 */
class SheetTest extends AbstractContainerTest {

	/**
	 * @test
	 */
	public function testDescriptionPropertyWorks() {
		$this->assertGetterAndSetterWorks('description', 'foobardescription', 'foobardescription', TRUE);
	}

	/**
	 * @test
	 */
	public function testShortDescriptionPropertyWorks() {
		$this->assertGetterAndSetterWorks('shortDescription', 'foobarshortdescription', 'foobarshortdescription', TRUE);
	}

	/**
	 * @test
	 */
	public function modifyCreatesFields() {
		$form = Form::create();
		$sheet = $form->createContainer('Sheet', 'testsheet');
		$sheet->modify(array('fields' => array('test' => array('name' => 'test', 'label' => 'Test', 'type' => 'Input'))));
		$fields  = $sheet->getChildren();
		$this->assertArrayHasKey('test', $fields);
	}

	/**
	 * @test
	 */
	public function modifyModifiesFields() {
		$form = Form::create();
		$sheet = $form->createContainer('Sheet', 'testsheet');
		$field = $sheet->createField('Input', 'testfield', 'Testfield');
		$sheet->modify(array('fields' => array('testfield' => array('label' => 'Test'))));
		$fields = $sheet->getChildren();
		$this->assertEquals('Test', reset($fields)->getLabel());
	}

}
