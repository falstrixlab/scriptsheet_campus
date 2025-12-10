<?php
defined('APPPATH') OR exit('No direct script access allowed');

if (! isset($heading) || empty($heading)) {
	$heading = 'Error';
}
if (! isset($message) || empty($message)) {
	$message = 'An unexpected error occurred.';
}

echo "\nERROR: ",
	$heading,
	"\n\n",
	$message,
	"\n\n";