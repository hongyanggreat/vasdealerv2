<?php
define ("BASE_URL", "http://vas.mang4gmobi.com/");

define ("USERNAME", "TDL_1SOLUTION");
define ("PASSWORD", "1solution@123456");
define ("MASTER_ID", 1019);
define ("SHAREKEY", "1solution@123456");


define ("URL_API", "http://210.211.98.80:8989/api/");

define ("URL_GET_SERVICES", URL_API."getServiceList?");

define ("URL_CREATE_DEALER", URL_API."createDealer?");
define ("URL_UPDATE_DEALER", URL_API."updateDealer?");
define ("URL_STATUS_DEALER", URL_API."getStatusDealer?");

define ("URL_SUB_SCRIPT", URL_API."subscript?");
define ("URL_SUB_SCRIPT_STATUS", URL_API."querySubscribeStatus?");

return [
	'baseUrl'    => "http://vas.mang4gmobi.com/",
	'suffix'    => "",
];
