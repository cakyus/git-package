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

namespace Pdr;

class Console {

	public function exec($command) {
		passthru($command, $exitCode);
		if ($exitCode !== 0) {
			throw new \Exception('command return non zero value');
		}
	}

	public function text($command) {
		$output = $this->line($command);
		return implode("\n", $output);
	}

	public function line($command) {
		exec($command, $output, $exitCode);
		if ($exitCode !== 0) {
			throw new \Exception('command return non zero value');
		}
		return $output;
	}
}
