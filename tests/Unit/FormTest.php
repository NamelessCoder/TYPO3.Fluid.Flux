<?php
namespace NamelessCoder\Flux\Tests\Unit;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Form;
use NamelessCoder\Flux\Form\Field\Input;
use NamelessCoder\Flux\Outlet\StandardOutlet;
use NamelessCoder\Flux\Tests\Unit\AbstractTestCase;
use NamelessCoder\Flux\View\TemplatePaths;
use NamelessCoder\Flux\View\ViewContext;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

/**
 * @package Flux
 */
class FormTest extends AbstractTestCase {

	/**
	 * @return Form
	 */
	protected function getEmptyDummyForm() {
		return new Form();
	}

	/**
	 * @test
	 */
	public function canAddSameFieldTwiceWithoutErrorAndWithoutDoubles() {
		$form = $this->getEmptyDummyForm();
		$field = $form->createField('Input', 'input', 'Input field');
		$form->add($field)->add($field);
		$this->assertTrue($form->has($field));
	}

	/**
	 * @test
	 */
	public function canAddSameContainerTwiceWithoutErrorAndWithoutDoubles() {
		$form = $this->getEmptyDummyForm();
		$sheet = $form->createContainer('Sheet', 'sheet', 'Sheet object');
		$form->add($sheet)->add($sheet);
		$this->assertTrue($form->has($sheet));
	}

	/**
	 * @test
	 */
	public function canAddMultipleFieldsToContainer() {
		$form = $this->getEmptyDummyForm();
		$fields = array(
			$form->createField('Input', 'test1'),
			$form->createField('Input', 'test2'),
		);
		$form->addAll($fields);
		$this->assertTrue($form->has($fields[0]));
		$this->assertTrue($form->has($fields[1]));
	}

	/**
	 * @test
	 */
	public function canRemoveFieldFromContainerByName() {
		$form = $this->getEmptyDummyForm();
		$field = $form->createField('Input', 'test');
		$form->add($field);
		$form->remove('test');
		$this->assertFalse($form->has('test'));
	}

	/**
	 * @test
	 */
	public function canRemoveFieldFromContainerByInstance() {
		$form = $this->getEmptyDummyForm();
		$field = $form->createField('Input', 'test');
		$form->add($field);
		$form->remove($field);
		$this->assertFalse($form->has('test'));
	}

	/**
	 * @test
	 */
	public function canRemoveBadFieldByNameWithoutErrorAndReturnFalse() {
		$form = $this->getEmptyDummyForm();
		$this->assertFalse($form->remove('test'));
	}

	/**
	 * @test
	 */
	public function canRemoveBadFieldByInstanceWithoutErrorAndReturnFalse() {
		$form = $this->getEmptyDummyForm();
		$field = Input::create(array('type' => 'Input', 'name' => 'badname'));
		$child = $form->remove($field);
		$this->assertFalse($child);
	}

	/**
	 * @test
	 */
	public function canCreateAndAddField() {
		$form = $this->getEmptyDummyForm();
		$field = $form->createField('Input', 'input');
		$form->add($field);
		$this->assertTrue($form->has('input'));
	}

	/**
	 * @test
	 */
	public function canCreateAndAddContainer() {
		$form = $this->getEmptyDummyForm();
		$container = $form->createContainer('Section', 'section');
		$form->add($container);
		$this->assertTrue($form->has('section'));
	}

	/**
	 * @test
	 */
	public function canCreateFromDefinition() {
		$properties = array(
			'name' => 'test',
			'label' => 'Test field'
		);
		$instance = Form::create($properties);
		$this->assertInstanceOf('NamelessCoder\Flux\Form', $instance);
	}

	/**
	 * @test
	 */
	public function canCreateFromDefinitionWithSheets() {
		$properties = array(
			'name' => 'test',
			'label' => 'Test field',
			'sheets' => array(
				'sheet' => array(
					'fields' => array()
				),
				'anotherSheet' => array(
					'fields' => array()
				),
			)
		);
		$instance = Form::create($properties);
		$this->assertInstanceOf('NamelessCoder\Flux\Form', $instance);
	}

	/**
	 * @test
	 */
	public function canDetermineHasChildrenFalse() {
		$instance = Form::create();
		$this->assertFalse($instance->hasChildren());
	}

	/**
	 * @test
	 */
	public function canDetermineHasChildrenTrue() {
		$instance = Form::create();
		$instance->createField('Input', 'test');
		$this->assertTrue($instance->hasChildren());
	}

	/**
	 * @test
	 */
	public function canSetAndGetOptions() {
		$instance = Form::create();
		$instance->setOption('test', 'testing');
		$this->assertSame('testing', $instance->getOption('test'));
		$this->assertIsArray($instance->getOptions());
		$this->assertArrayHasKey('test', $instance->getOptions());
		$options = array('foo' => 'bar');
		$instance->setOptions($options);
		$this->assertSame('bar', $instance->getOption('foo'));
		$this->assertArrayHasKey('foo', $instance->getOptions());
		$this->assertArrayNotHasKey('test', $instance->getOptions());
	}

	/**
	 * @test
	 */
	public function modifySetsProperty() {
		$form = Form::create();
		$form->modify(array('name' => 'test'));
		$this->assertEquals('test', $form->getName());
	}

	/**
	 * @test
	 */
	public function modifySetsOptions() {
		$form = Form::create();
		$form->modify(array('options' => array('test' => 'testvalue')));
		$this->assertEquals('testvalue', $form->getOption('test'));
	}

	/**
	 * @test
	 */
	public function modifyCreatesSheets() {
		$form = Form::create();
		$form->modify(array('sheets' => array('test' => array('name' => 'test', 'label' => 'Test'))));
		$sheets = $form->getSheets(TRUE);
		$this->assertArrayHasKey('test', $sheets);
	}

	/**
	 * @test
	 */
	public function modifyModifiesSheets() {
		$form = Form::create();
		$form->modify(array('sheets' => array('options' => array('label' => 'Test'))));
		$sheets = $form->getSheets(TRUE);
		$this->assertEquals('Test', reset($sheets)->getLabel());
	}

}
