<?php
namespace NamelessCoder\Flux\Tests\Unit\ViewHelpers\Form;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Flux\Tests\Unit\ViewHelpers\AbstractViewHelperTestCase;

/**
 * @package Flux
 */
class VariableViewHelperTest extends AbstractViewHelperTestCase {

	/**
	 * @test
	 */
	public function addsVariableToContainer() {
		$containerMock = $this->getMock('NamelessCoder\Flux\Form', array('setVariable'));
		$containerMock->expects($this->once())->method('setVariable')->with('test', 'testvalue');
		$instance = $this->getMock($this->createInstanceClassName(), array('getContainer'));
		$instance->expects($this->once())->method('getContainer')->will($this->returnValue($containerMock));
		$instance->setArguments(array('name' => 'test', 'value' => 'testvalue'));
		$instance->render();
	}

}
