<?php

/*
* This file is part of Spoon Library.
*
* (c) Davy Hellemans <davy@spoon-library.com>
*
* For the full copyright and license information, please view the license
* file that was distributed with this source code.
*/

namespace spoon\cookie;

/**
 * This class is used to manipulate cookies.
 *
 * @author Davy Hellemans <davy@spoon-library.com>
 */
class Cookie
{
	/**
	 * Delete one or more cookies.
	 */
	public static function delete()
	{
		foreach(func_get_args() as $argument)
		{
			// array element
			if(is_array($argument))
			{
				foreach($argument as $key)
				{
					unset($_COOKIE[(string) $key]);
					setcookie((string) $key, null, time() - 3600);
				}
			}

			// other type(s)
			else
			{
				unset($_COOKIE[(string) $argument]);
				setcookie((string) $argument, null, time() - 3600);
			}
		}
	}

	/**
	 * Check if the given cookie(s) exist(s).
	 *
	 * @return bool If the cookie(s) exist(s), returns true otherwise false.
	 */
	public static function exists()
	{
		foreach(func_get_args() as $argument)
		{
			// array element
			if(is_array($argument))
			{
				foreach($argument as $key)
				{
					if(!isset($_COOKIE[(string) $key])) return false;
				}
			}

			// other type(s)
			else
			{
				if(!isset($_COOKIE[(string) $argument])) return false;
			}
		}

		return true;
	}


	/**
	 * Get the value that was stored in a cookie.
	 *
	 * @return mixed The value that was stored in the cookie or if something went wrong.
	 * @param string $key The name of the cookie that should be retrieved.
	 */
	public static function get($key)
	{
		if(!self::exists($key)) return false;
		$value = (get_magic_quotes_gpc()) ? stripslashes($_COOKIE[$key]) : $_COOKIE[$key];
		$actualValue = @unserialize($value);

		// check for invalid value
		return ($actualValue === false && serialize(false) != $value) ? false : $actualValue;
	}


	/**
	 * Stores a value in a cookie, by default the cookie will expire in one day.
	 *
	 * @return bool If set with succes, returns true otherwise false.
	 * @param string $key A name for the cookie.
	 * @param mixed $value The value to be stored. Keep in mind that they will be serialized.
	 * @param int[optional] $time The number of seconds that this cookie will be available.
	 * @param string[optional] $path The path on the server in which the cookie will be availabe. Use / for the entire domain, /foo if you just want it to be available in /foo.
	 * @param string[optional] $domain The domain that the cookie is available on. Use .example.com to make it available on all subdomains of example.com.
	 * @param bool[optional] $secure Should the cookie be transmitted over a HTTPS-connection? If true, make sure you use a secure connection, otherwise the cookie won't be set.
	 * @param bool[optional] $httpOnly Should the cookie only be available through HTTP-protocol? If true, the cookie can't be accessed by Javascript, ...
	 */
	public static function set($key, $value, $time = 86400, $path = '/', $domain = null, $secure = false, $httpOnly = false)
	{
		$key = (string) $key;
		$value = serialize($value);
		$time = time() + (int) $time;
		$path = (string) $path;
		$domain = ($domain !== null) ? (string) $domain : null;
		$secure = (bool) $secure;
		$httpOnly = (bool) $httpOnly;

		// set cookie
		$cookie = setcookie($key, $value, $time, $path, $domain, $secure, $httpOnly);
		return ($cookie === false) ? false : true;
	}
}
