<?php

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
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

namespace Controller;

// DOC Git Package Management
// DOC Usage: git-package <command> [argument..]
// DOC Commands:

class Index {

	// DOC   status - Show package(s) status
	public function status() {
		// code...
	}

	// DOC   help - Show this information and exit

	public function help() {
		foreach (file(__FILE__) as $line) {
			$line = trim($line);
			if (substr($line, 0, 7) == '// DOC ') {
				echo substr($line, 7)."\n";
			}
		}
	}
}
