<?php
namespace NamelessCoder\Flux\Tests\Unit;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Fluid\Core\Parser\ParsingState;
use NamelessCoder\Fluid\Core\ViewHelper\ViewHelperVariableContainer;
use NamelessCoder\Flux\Form;
use NamelessCoder\Flux\Tests\UnitTestCase;
use NamelessCoder\Flux\ViewHelpers\AbstractFormViewHelper;

/**
 * Class MetadataViewTest
 */
class MetadataViewTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function getFormFromSectionCallsExpectedMethodSequence() {
		$container = new ViewHelperVariableContainer();
		$paths = $this->getMock('NamelessCoder\\Fluid\\View\\TemplatePaths', array('getTemplateSource'));
		$paths->expects($this->any())->method('getTemplateSource')->willReturn('test');
		$context = $this->getMock('NamelessCoder\\Fluid\\Core\\Rendering\\RenderingContext', array('getViewHelperVariableContainer'));
		$context->expects($this->any())->method('getViewHelperVariableContainer')->willReturn($container);
		$instance = $this->getMock(
			'NamelessCoder\\Flux\\View\\MetadataView',
			array('startRendering', 'stopRendering', 'renderSection', 'getOrParseAndStoreTemplate'),
			array($paths, $context)
		);
		$form = Form::create();
		$container->add(AbstractFormViewHelper::SCOPE, AbstractFormViewHelper::SCOPE_VARIABLE_FORM, $form);
		$instance->setRenderingContext($context);
		$instance->expects($this->once())->method('startRendering');
		$instance->expects($this->once())->method('getOrParseAndStoreTemplate')->willReturn(new ParsingState());
		$instance->expects($this->once())->method('stopRendering');
		$instance->expects($this->once())->method('renderSection')->with('Test', array('foo' => 'bar'));
		$result = $instance->getFormFromSection('Test', array('foo' => 'bar'));
		$this->assertSame($form, $result);
	}

}
