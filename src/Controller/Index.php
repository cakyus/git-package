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

	// DOC   create <vendorName/projectName> - Create new project

	public function create($packageName) {

		if (!preg_match("/^([a-z][a-z0-9]*)\/([a-z][a-z0-9]*)$/", $packageName, $match)) {
			throw new \Exception("Invalid projectName");
		}

		$vendorName = $match[1];
		$projectName = $match[2];

		$projectDir = tempnam(sys_get_temp_dir(), 'php');

		unlink($projectDir);
		mkdir($projectDir);

		echo "create package $vendorName/$projectName in $projectDir ..\n";

		echo "create LICENSE ..\n";
		copy(FCPATH.'/LICENSE', $projectDir.'/LICENSE');

		echo "create bin/ ..\n";
		mkdir($projectDir.'/bin');
		touch($projectDir.'/bin/.htaccess');

		echo "create docs/ ..\n";
		mkdir($projectDir.'/docs');
		touch($projectDir.'/docs/.htaccess');

		echo "create src/ ..\n";
		mkdir($projectDir.'/src');
		touch($projectDir.'/src/.htaccess');

		echo "create tests/ ..\n";
		mkdir($projectDir.'/tests');
		touch($projectDir.'/tests/.htaccess');

		echo "create gitignore\n";
		file_put_contents($projectDir.'/.gitignore', 'vendor');

		echo "create composer.json ..\n";
		$text = '{
	 "name": "'.$packageName.'"
	,"description": "'.$packageName.'"
	,"license": "GPL-2.0"
	,"autoload": {
		"psr-4": {
			 "\\\\'.ucwords($vendorName).'\\\\'.ucwords($projectName).'\\\\": "src/"
			,"\\\\'.ucwords($vendorName).'\\\\'.ucwords($projectName).'\\\\Test\\\\": "tests/"
		}
	}
}';
		file_put_contents($projectDir.'/composer.json', $text);
	}

	// DOC   list - List repositories

	public function list() {

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
