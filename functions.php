<?php


function get_template($filename, $var = array(), $admin = '') {
    
    if (is_file('src/'.$admin.'templates/'.$filename.'.php')) {
        extract($var);

        ob_start();
        include 'src/'.$admin.'templates/'.$filename.'.php';
        return ob_get_clean();

    }
    return false;
}


function render($template) {
	return get_template('main', array('template' => $template));
}

function str_cut($string, $nb_char_max) {

	if (strlen($string) <= $nb_char_max) return $string;

	$string = wordwrap($string, $nb_char_max, '<[SEP]>', true);
	$string = explode('<[SEP]>', $string);

	return $string[0].'...';
}

function human_filesize($bytes) {
    $size = array(' Octets',' Ko',' Mo',' Go',' To','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return round($bytes / pow(1024, $factor)).$size[$factor];
}