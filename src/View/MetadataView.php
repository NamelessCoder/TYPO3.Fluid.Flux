<?php
namespace NamelessCoder\Flux\View;

/*
 * This file is part of the NamelessCoder/Flux project under MIT license.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use NamelessCoder\Fluid\Core\Parser\TemplateParser;
use NamelessCoder\Fluid\View\AbstractTemplateView;
use NamelessCoder\Fluid\View\TemplatePaths;
use NamelessCoder\Flux\Form;

/**
 * Class MetadataView
 */
class MetadataView extends AbstractTemplateView {

	/**
	 * @param string $section
	 * @param array $variables
	 * @return Form
	 */
	public function getFormFromSection($section = 'Configuration', $variables = array()) {
		$controllerName = $this->baseRenderingContext->getControllerName();
		$controllerAction = $this->baseRenderingContext->getControllerAction();
		$parsedTemplate = $this->getOrParseAndStoreTemplate(
			$this->templatePaths->getTemplateIdentifier($controllerName, $controllerAction),
			function($parent, TemplatePaths $paths) use ($controllerName, $controllerAction) {
				return $paths->getTemplateSource($controllerName, $controllerAction);
			}
		);
		$this->startRendering(TemplateParser::CONTEXT_OUTSIDE_VIEWHELPER_ARGUMENTS, $parsedTemplate, $this->baseRenderingContext);
		$this->renderSection($section, $variables, FALSE);
		$this->stopRendering();
		return $this->baseRenderingContext
			->getViewHelperVariableContainer()
			->get('NamelessCoder\\Flux\\ViewHelpers\\FormViewHelper', 'form');
	}

}
