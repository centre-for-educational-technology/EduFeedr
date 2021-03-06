<?php

    // Gatekeeper
    action_gatekeeper();

    $guid = (int) get_input('educourse');
    $type = get_input('type', 'blogs');
	$educourse = get_entity($guid);

	if ($educourse->getSubtype() == 'educourse') {
		$mime = 'text/x-opml';
		$filename = 'educourse_' . $guid . '_' . $type  . '.opml';
		header('Content-type:' . $mime);
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		$contents = edufeedrCourseOPML($educourse, $type);
		$splitString = str_split($contents, 8192);
		foreach ($splitString as $chunk) {
			echo $chunk;
		}
		exit;
	} else {
		/*translation:Download failed.*/
		register_error(elgg_echo('edufeedr:error:download:failed'));
	}

?>
