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

use Spoon\Cookie\Autoloader;
use Spoon\Cookie\Cookie;

require_once realpath(dirname(__FILE__) . '/../') . '/Autoloader.php';
require_once 'PHPUnit/Framework/TestCase.php';

class CookieTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		parent::setUp();
		Autoloader::register();
	}

	public function testExists()
	{
		$this->assertFalse(Cookie::exists('does not exist'));
	}

	public function testGet()
	{
		$this->assertFalse(Cookie::get('does not exist'));
	}
}
