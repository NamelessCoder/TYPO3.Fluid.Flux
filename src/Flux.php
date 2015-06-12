<?php
namespace NamelessCoder\Flux;

/**
 * Flux master API
 *
 * Class instanciated whenever code needs to extract
 * Flux definitions from a file. The constructor supports
 * a mixed input type which can be either a ViewInterface
 * instance or a string filename pointing to the template.
 *
 * When the constructor argument is a template reference,
 * a standalone View is created. When the argument is an
 * instance of ViewInterface, that View is used instead of
 * creating a fresh instance.
 *
 * The methods that extract data from the template support
 * further arguments to select which section to render, the
 * variables that must be used, the rendering context etc.
 */
class Flux {


}
