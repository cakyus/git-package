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

namespace Controller;

// DOC Git Package Management
// DOC Usage: git-package <command> [argument..]
// DOC Commands:

class Index {

	// DOC   status - Show package(s) status
	public function status() {

		$console = new \Pdr\Console;
		// TODO determine git root dir
		// TODO check vendor dir existance
		$gitRootDir = getcwd();
		$vendorRootDir = $gitRootDir.'/vendor';
		if (is_dir($vendorRootDir) == FALSE) {
			return TRUE;
		}
		foreach ($console->line('find'
			.' '.escapeshellarg($vendorRootDir.'/')
			.' -mindepth 2 -maxdepth 2 -type d'
			) as $vendorDir) {
			$vendorGitDir = $vendorDir.'/.git';
			$vendorName = substr($vendorDir, strlen($vendorRootDir) + 1);
			$vendorCommandGitStatus = 'git'
				.' --git-dir='.$vendorGitDir
				.' --work-tree='.$vendorDir
				.' status --short';
			$vendorGitStatus = $console->text($vendorCommandGitStatus);
			if (empty($vendorGitStatus) == FALSE) {
				echo "$vendorName\n";
			}
		}
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
