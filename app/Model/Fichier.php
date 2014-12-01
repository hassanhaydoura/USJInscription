<?php
App::uses('AppModel', 'Model');
/**
 * Fichier Model
 *
 */
class Fichier extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nom';

public $belongsTo = array(
		'Dossier' => array(
			'className' => 'Dossier',
			'foreignKey' => 'dossier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Attribut' => array(
			'className' => 'Attribut',
			'foreignKey' => 'attribut_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			
		)
	);

public function beforeDelete($cascade=true) {

    App::uses('File', 'Utility');
    $fichier = $this->read();
    $dossierid = $fichier['Dossier']['id'];
    $filename = $fichier['Fichier']['nom'];
    $file = new File("files".DS.$dossierid.DS.$filename);
   
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
$filetype=finfo_file($finfo, "files".DS.$dossierid.DS.$filename);
$filetype = strstr($filetype, '/', true);
 if($filetype=="image")
{
    $imgfile = new File("files".DS.$dossierid.DS."thumbs".DS.$filename);
    $imgfile->delete();
}
 $file->delete();
 
		finfo_close($finfo);
    
}
}
