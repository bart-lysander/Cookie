<?php

/*
* This file is part of Spoon Library.
*
* (c) Davy Hellemans <davy@spoon-library.com>
*
* For the full copyright and license information, please view the license
* file that was distributed with this source code.
*/

namespace Spoon\Cookie\Tests;
use Spoon\Cookie\Cookie;

use Spoon\Cookie\Autoloader;

require_once realpath(dirname(__FILE__) . '/../') . '/Autoloader.php';
require_once 'PHPUnit/Framework/TestCase.php';

class AutoloaderTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		Autoloader::register();
	}

	public function testAutoloaderSuccess()
	{
		$this->assertFalse(Cookie::exists('foo'));
	}

	public function testAutoloaderFailure()
	{
		$this->assertFalse(method_exists('FooBar', 'baz'));
	}
}
