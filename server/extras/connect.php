<?php
// BUILD MESSAGE
$msg = 'M-SEARCH * HTTP/1.1' . "\r\n";
$msg .= 'HOST: 239.255.255.250:1900' . "\r\n";
$msg .= 'MAN: "ssdp:discover"' . "\r\n";
$msg .= 'ST: roku:ecp' . "\r\n";
$msg .= '' . "\r\n";

// MULTICAST MESSAGE
$sock     = socket_create(AF_INET, SOCK_DGRAM, 0);
$send_ret = socket_sendto($sock, $msg, strlen($msg), 0, '239.255.255.250', 1900);

// SET TIMEOUT FOR RECIEVE
socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 5, 'usec' => '0'));

// RECIEVE RESPONSE
$response = array();
do {
	$buf = NULL;
	@socket_recvfrom($sock, $buf, 1024, MSG_WAITALL, $from, $port);
	if(!is_null($buf)) $response[] = $buf;
}
while(!is_null($buf));

// CLOSE SOCKET
socket_close($sock);
var_dump($response);
