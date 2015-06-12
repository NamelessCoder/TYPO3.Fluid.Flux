<?php
namespace NamelessCoder\Flux\Tests\Unit\ViewHelpers;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Fluid\Core\Parser\ParsingState;
use NamelessCoder\Fluid\Core\Variables\StandardVariableProvider;
use NamelessCoder\Fluid\Core\ViewHelper\ViewHelperInterface;
use NamelessCoder\Fluid\Core\ViewHelper\ViewHelperResolver;
use NamelessCoder\Fluid\Core\ViewHelper\ViewHelperVariableContainer;
use NamelessCoder\Flux\Tests\Fixtures\Data\Records;
use NamelessCoder\Flux\Tests\Unit\AbstractTestCase;
use NamelessCoder\Fluid\Core\Parser\SyntaxTree\NodeInterface;
use NamelessCoder\Fluid\Core\Parser\SyntaxTree\ViewHelperNode;
use NamelessCoder\Fluid\Core\Rendering\RenderingContext;
use NamelessCoder\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * @package Flux
 */
abstract class AbstractViewHelperTestCase extends AbstractTestCase {

	/**
	 * @var array
	 */
	protected $defaultArguments = array(
		'name' => 'test'
	);

	/**
	 * @test
	 */
	public function canCreateViewHelperInstance() {
		$instance = $this->createInstance();
		$this->assertInstanceOf($this->getViewHelperClassName(), $instance);
	}

	/**
	 * @test
	 */
	public function canPrepareArguments() {
		$instance = $this->createInstance();
		$arguments = $instance->prepareArguments();
		$this->assertThat($arguments, new \PHPUnit_Framework_Constraint_IsType(\PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY));
	}

	/**
	 * @return string
	 */
	protected function getViewHelperClassName() {
		$class = get_class($this);
		$class = str_replace('Tests\\Unit\\', '', $class);
		return substr($class, 0, -4);
	}

	/**
	 * @param string $type
	 * @param mixed $value
	 * @return NodeInterface
	 */
	protected function createNode($type, $value) {
		if ('Boolean' === $type) {
			$value = $this->createNode('Text', strval($value));
		}
		/** @var NodeInterface $node */
		$className = 'NamelessCoder\Fluid\Core\Parser\SyntaxTree\\' . $type . 'Node';
		$node = new $className($value);
		return $node;
	}

	/**
	 * @return ViewHelperInterface
	 */
	protected function createInstance() {
		$className = $this->getViewHelperClassName();
		/** @var ViewHelperInterface $instance */
		$instance = new $className();
		$instance->initialize();
		return $instance;
	}

	/**
	 * @param array $arguments
	 * @param array $variables
	 * @param NodeInterface $childNode
	 * @param string $extensionName
	 * @param string $pluginName
	 * @return AbstractViewHelper
	 */
	protected function buildViewHelperInstance($arguments = array(), $variables = array(), $childNode = NULL, $extensionName = NULL, $pluginName = NULL) {
		/** @var ViewHelperInterface $instance */
		$instance = $this->createInstance();
		/** @var TemplateVariableContainer $container */
		$container = new StandardVariableProvider($variables);
		/** @var ViewHelperVariableContainer $viewHelperContainer */
		$viewHelperContainer = new ViewHelperVariableContainer();

		foreach ($instance->prepareArguments() as $argumentDefinition) {
			if (FALSE === array_key_exists($argumentDefinition->getName(), $arguments)) {
				$arguments[$argumentDefinition->getName()] = $argumentDefinition->getDefaultValue();
			}
		}

		$name = substr(get_class($this), 41, -14);
		$name = str_replace('\\', '.', $name);
		$name = implode('.', array_map('lcfirst', explode('.', $name)));
		$node = $this->getMock('NamelessCoder\\Fluid\\Core\\Parser\\SyntaxTree\\ViewHelperNode', array('evaluate'), array(), '', FALSE);;
		$node->expects($this->any())->method('evaluate')->willReturn('test');

		/** @var RenderingContext $renderingContext */
		$renderingContext = new RenderingContext();
		$renderingContext->setVariableProvider($container);
		$instance->setArguments($arguments);
		$instance->setRenderingContext($renderingContext);
		$instance->setViewHelperNode($node);
		if (NULL !== $childNode) {
			$instance->setChildNodes(array($childNode));
		}

		return $instance;
	}

	/**
	 * @param array $arguments
	 * @param array $variables
	 * @param NodeInterface $childNode
	 * @param string $extensionName
	 * @param string $pluginName
	 * @return mixed|AbstractViewHelper
	 */
	protected function executeViewHelper($arguments = array(), $variables = array(), $childNode = NULL, $extensionName = NULL, $pluginName = NULL) {
		$instance = $this->buildViewHelperInstance($arguments, $variables, $childNode, $extensionName, $pluginName);
		$output = $instance->initializeArgumentsAndRender();
		return $output;
	}

	/**
	 * @param string $nodeType
	 * @param mixed $nodeValue
	 * @param array $arguments
	 * @param array $variables
	 * @param string $extensionName
	 * @param string $pluginName
	 * @return mixed|AbstractViewHelper
	 */
	protected function executeViewHelperUsingTagContent($nodeType, $nodeValue, $arguments = array(), $variables = array(), $extensionName = NULL, $pluginName = NULL) {
		$childNode = $this->createNode($nodeType, $nodeValue);
		$instance = $this->buildViewHelperInstance($arguments, $variables, $childNode, $extensionName, $pluginName);
		$output = $instance->initializeArgumentsAndRender();
		return $output;
	}

}
