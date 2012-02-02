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

	public function testDelete()
	{
		$this->assertNull(@Cookie::delete('foo'));
		$this->assertNull(@Cookie::delete('foo', 'bar', 'baz'));
		$this->assertNull(@Cookie::delete(array('foo', 'bar', 'baz')));
	}

	public function testExists()
	{
		$this->assertFalse(Cookie::exists('does not exist'));
		$this->assertFalse(Cookie::exists('foo', 'bar', 'baz'));
		$this->assertFalse(Cookie::exists(array('foo', 'bar', 'baz')));

		$_COOKIE['foo'] = 'bar';
		$this->assertTrue(Cookie::exists('foo'));

		$_COOKIE['foo'] = 'bar';
		$_COOKIE['bar'] = 'baz';
		$this->assertTrue(Cookie::exists('foo', 'bar'));
		$this->assertTrue(Cookie::exists(array('foo', 'bar')));
	}

	public function testGet()
	{
		$this->assertFalse(Cookie::get('does not exist'));

		$_COOKIE['foo'] = 'bar';
		$this->assertFalse(Cookie::get('foo'));
	}

	public function testSet()
	{
		$this->assertFalse(@Cookie::set('foo', 'bar'));
	}
}
