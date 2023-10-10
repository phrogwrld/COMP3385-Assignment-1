<?php

/**
 * A function for autoloading classes.
 *
 * @param string $className The name of the class to load.
 */
spl_autoload_register(function ($className) {
	// Get the filepath of the class.
	$filepath = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

	// Remove the namespace from the filepath.
	$filepath = str_replace('App' . DIRECTORY_SEPARATOR, '', $filepath);

	// If the file exists, require it.
	if (file_exists($filepath)) {
		include_once $filepath;
	} else {
		trigger_error('The class `' . $className . '` does not exist.', E_USER_ERROR);
		exit();
	}
});
