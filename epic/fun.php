<?php
$salt = bin2hex(random_bytes(32));
echo $salt . PHP_EOL;
$hash = hash_pbkdf2("sha512", "password1", $salt, 262144);
echo $hash . PHP_EOL;