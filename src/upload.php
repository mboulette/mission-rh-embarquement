<?php

//var_dump(  is_dir('attachments')  );

if (empty($_FILES['file_data'])) {
    echo json_encode(['error '=> 'Aucun fichier trouvé pour le téléchargement.']); 
    die();
}

$dir = 'attachments/'.$_POST['subdir'].'/'.$_POST['id'];
$target = $dir.'/'.$_FILES['file_data']['name'];

if (!is_dir($dir)) mkdir($dir);

if (move_uploaded_file($_FILES['file_data']['tmp_name'], $target)) {

    $files = array();
    if (is_dir($dir)) {

        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != '.' && $file != '..') {

                    $files[] = array(
                        'name' => $file,
                        'path' => '/inscriptions/'.$dir.'/'.$file,
                        'size' => human_filesize(filesize(realpath(__DIR__.'/../'.$dir.'/'.$file))),
                        'type' => mime_content_type(realpath(__DIR__.'/../'.$dir.'/'.$file)),
                    );
                }
            }
            closedir($dh);
        }
    }

    $attachments_lst = get_template('partial/attachments_lst', array('files' => $files));


    echo json_encode(['success' => 'Téléchargement terminé!', 'attachments_lst' => $attachments_lst]);
} else {
    echo json_encode(['error' => 'Erreur lors du téléchargement!']);
}
die();