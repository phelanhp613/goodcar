<?php

namespace App\Commons\Notifications;

interface NotificationInterface {
	public function getToken();
	public function init();
}