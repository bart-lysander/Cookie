<?php

/*
* This file is part of Spoon Library.
*
* (c) Davy Hellemans <davy@spoon-library.com>
*
* For the full copyright and license information, please view the license
* file that was distributed with this source code.
*/

namespace Spoon\Cookie;

/**
 * Autoloader for this component.
 *
 * @author Davy Hellemans <davy@spoon-library.com>
 */
class Autoloader
{
	/**
	 * Attempt to load this class.
	 *
	 * @param string $class The full name of the class (including namespace) to be loaded.
	 */
	public static function autoload($class)
	{
		if(strpos($class, 'Spoon\\') === false)
		{
			return '';
		}

		$file = dirname(dirname(dirname(__FILE__)));
		$file .= DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

		if(file_exists($file))
		{
			require $file;
		}
	}

	/**
	 * Register this autoloader.
	 */
	public static function register()
	{
		spl_autoload_register(array(new self, 'autoload'));
	}
}
