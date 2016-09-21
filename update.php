<?php

require_once('Git.php');

$repo = Git::open('.');  // -or- Git::create('/path/to/repo')

//$repo->add('.');
//$repo->commit('Some commit message');
$repo->pull('gitlab', 'master');