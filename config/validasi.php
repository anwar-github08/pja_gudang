<?php
session_start();
if (!isset($_SESSION['user'])) {
	echo "<script>location='../akses/m_login.php';</script>";
	exit();
};
