<?php

/* Start output buffering for redirection and sessions
   for storing user details on login and authentication
   and error reporting for MYSQL
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();
ob_start();