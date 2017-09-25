<?php
session_start();
class mySession
{
	public static function setSession($name,$value)
	{
		$_SESSION[$name] = $value;
	}
	
	public static function getSession($name)
	{
		return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
	}
}