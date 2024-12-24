<?php
// Mendapatkan hostname dari server/container
$hostname = gethostname();

// Mendapatkan alamat IP dari server/container
$server_ip_address = $_SERVER['SERVER_ADDR'];

// Menampilkan informasi hostname dan alamat IP
echo "<h1>Status Load Balancer</h1>";
echo "<p>Hostname Container: " . $hostname . "</p>";
echo "<p>Alamat IP Server: " . $server_ip_address . "</p>";
?>