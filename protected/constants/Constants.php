<?php

/**
 *
 * TEST Constant Define 
 * *Note*: Do NOT modify the value for key _UNIT_TEST_ to "TRUE" to avoid UT in Staging,QA and Live Enviroment
 */
if (!defined('_UNIT_TEST_'))
	define('_UNIT_TEST_', FALSE);



/**
 *
 * Order
 *
 */
define('_ORDER_STATUS_ENABLE_', 1);   // order enable 
define('_ORDER_STATUS_DENABLE_', 0);  // order denable
define('_ORDER_RECEIVE_ORDER_', 1);   // customer only order
define('_ORDER_RECEIVE_RECEIVE_', 2); // bill have complete
