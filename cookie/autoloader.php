<?php

/**
 * Spoon Library
 *
 * This source file is part of the Spoon Library. More information,
 * documentation and tutorials can be found @ http://www.spoon-library.com
 *
 * @package cookie
 * @version 0.1
 * @author Davy Hellemans <davy@spoon-library.com>
 */

namespace spoon\cookie;

class Autoloader
{
	/**
	 * Attempt to load this class.
	 *
	 * @param string $class The full name of the class (including namespace) to be loaded.
	 */
	public static function autoload($class)
	{
		if(stripos(($class = strtolower($class)), __NAMESPACE__) === false)
		{
			return '';
		}

		if(file_exists($file = dirname(__FILE__) . DIRECTORY_SEPARATOR . str_replace(__NAMESPACE__ . '\\', '', $class) . '.php'))
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
