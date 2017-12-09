
	TEMP_DIR=$( mktemp --directory )
	TEMP_REPO_NAME=pdr/browser
	TEMP_REPO_URL=https://github/user/repo.git
	TEMP_GIT_DIR=$TEMP_DIR/.git
	TEMP_GIT="git --git-dir=$TEMP_GIT_DIR --work-tree=$TEMP_GIT_DIR"

	git init $TEMP_DIR
	cp LICENSE $TEMP_DIR
	c.phar init --no-interaction --working-dir=$TEMP_DIR --name=$TEMP_REPO_NAME --license=GPL-2.0
	$TEMP_GIT add .
	$TEMP_GIT commit -m 'initial commit'
	$TEMP_GIT remote add origin $TEMP_REPO_URL
	$TEMP_GIT push origin master
	c.phar config --global repositories.$TEMP_REPO_NAME vcs $TEMP_REPO_URL
	rm -rf $TEMP_DIR
