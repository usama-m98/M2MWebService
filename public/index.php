<?php

/**
 * PHP program that implements an sms client
 */

ini_set('xdebug.trace_output_name', 'coursework');
ini_set('display_errors', 'On');
ini_set('html_errors', 'On');
ini_set('xdebug.trace_format', 1);

if (function_exists(xdebug_start_trace()))
{
xdebug_start_trace();
}

include 'coursework/bootstrap.php';

if (function_exists(xdebug_stop_trace()))
{
xdebug_stop_trace();
}