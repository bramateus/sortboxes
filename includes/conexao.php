<?php
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB_NAME', 'synapselabs_db');

// define( 'MYSQL_HOST', 'pleskdb.cxt9ad1y00cb.us-east-1.rds.amazonaws.com' );
// define( 'MYSQL_USER', 'synapselabs_user' );
// define( 'MYSQL_PASSWORD', 'pUji9&07' );
// define( 'MYSQL_DB_NAME', 'synapselabs_db' );

$sqlconex = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_NAME);
mysqli_set_charset ($sqlconex, 'utf8');