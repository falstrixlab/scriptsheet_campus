<?php
defined('APPPATH') OR exit('No direct script access allowed');

if (! isset($heading) || empty($heading)) {
	$heading = 'Database error';
}
if (! isset($message) || empty($message)) {
	$message = 'A database error occurred.';
}

echo "\nDatabase error: ",
	$heading,
	"\n\n",
	$message,
	"\n\n";