<?php
	$user = (object) ['id' => 20, 'name' => 'John Dow', 'role' => 'QA', 'salary' => 100];
	$apiTemplatesSet1 = ['/api/items/%id%/%name%', '/api/items/%id%/%role%', '/api/items/%id%/%salary%'];

	function getApiPath($template, $user)
	{
		$result = '';
		$str = str_replace('%', '', $template);
		$arr = array_diff(explode('/', $str), array(''));

		foreach ($arr as $value) {
			if ($user->$value) {
				$result .= '/' . $user->$value;
				continue;
			}

			$result .= '/' . $value;
		}

		return $result;
	}

	$apiPathes = array_map(function($template)
		{
			return getApiPath($template, $GLOBALS['user']);
		}, 
		$apiTemplatesSet1);

	echo json_encode($apiPathes);
?>
