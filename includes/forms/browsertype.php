<?php
	function getbrowsertype()
	{
		$browser = strtolower($_SERVER['HTTP_USER_AGENT']);

		// Firefox?
		$pos=strpos($browser, "firefox");

		if (!($pos === false))
		{
			// Dies ist ein Firefox - Browser:
			return "firefox";
		}

		// Alle anderen:
		$browser = explode("/",$browser);
		$browser = $browser[0];
		return trim($browser);
	}
?>