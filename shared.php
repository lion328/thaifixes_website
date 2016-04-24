<?php
function filesListWithTime($folder) {
	$files = array();
	foreach (new DirectoryIterator($folder) as $fileInfo) $files[$fileInfo->getFileName()] = $fileInfo->getMTime();
	return $files;
}