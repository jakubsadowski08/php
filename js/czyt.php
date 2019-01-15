<?php
session_write_close(); // zakoncz sesje i zapisz dane
ignore_user_abort(true);
set_time_limit(3); // ustaw czas oczekiwania
	if (!isset($_COOKIE['lastUpdate'])) {
		setcookie('lastUpdate', 0);
		$_COOKIE['lastUpdate'] = 0;
	}

	$lastUpdate = $_COOKIE['lastUpdate'];
	$file = 'chat.txt';

	if (!file_exists($file)) {
		throw new Exception('chat.txt Does not exist');
	}

	while (true) {

		$fileModifyTime = filemtime($file);

		if ($fileModifyTime === false) {
			throw new Exception('Could not read last modification time');
		}

		// if the last modification time of the file is greater than the last update sent to the browser... 
		if ($fileModifyTime > $lastUpdate) {
			setcookie('lastUpdate', $fileModifyTime);

			// get file contents
			$fileRead = file_get_contents($file);

			exit(json_encode([
				'status' => true,
				'time' => $fileModifyTime, 
				'content' => $fileRead
			]));

		}

		// to clear cache
		clearstatcache();

		// to sleep
		sleep(1);
		
	}