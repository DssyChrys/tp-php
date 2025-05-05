<?php
$db = new PDO('mysql:host=localhost;dbname=tp_php', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);