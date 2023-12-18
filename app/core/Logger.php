<?php

namespace core;
use core\App;
class Logger
{
	private static function log($file, $log) {
		file_put_contents($file,$log. "\n", FILE_APPEND);
	}
	private static function writeTimed($file,$log) {
		static::log($file, '['.date(DATE_ATOM).'] '. $log );
	}
	public static function logAUTH($log) {
		static::writeTimed( App::dir().'auth.log', $log);
	}
	public static function logERROR($log) {
		static::writeTimed( App::dir().'error.log', $log);
	}
}