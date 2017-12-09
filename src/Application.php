<?php

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 **/

class Application {
	public function start() {

		$controller = new \Controller\Index;

		$functionName = 'help';
		$arguments = array();

		if ($_SERVER['argc'] > 1 ) {
			$functionName = $_SERVER['argv'][1];
		}

		call_user_func_array(
			array($controller, $functionName)
			, $arguments
			);
	}
}

