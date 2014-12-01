<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Fichiers');
define('THUMBNAIL_IMAGE_MAX_WIDTH', 150);
define('THUMBNAIL_IMAGE_MAX_HEIGHT', 150);

class UploadsController extends AppController{

  protected function fix_integer_overflow($size) {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }
        function get_config_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $this->fix_integer_overflow($val);
    }
    protected function upcount_name_callback($matches) {
        $index = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        $ext = isset($matches[2]) ? $matches[2] : '';
        return ' ('.$index.')'.$ext;
    }

    protected function upcount_name($name) {
        return preg_replace_callback(
            '/(?:(?: \(([\d]+)\))?(\.[^.]+))?$/',
            array($this, 'upcount_name_callback'),
            $name,
            1
        );
    }
    protected function get_file_size($file_path, $clear_stat_cache = false) {
        if ($clear_stat_cache) {
            if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
                clearstatcache(true, $file_path);
            } else {
                clearstatcache();
            }
        }
        return $this->fix_integer_overflow(filesize($file_path));
    }

    protected function get_unique_filename($file_path, $name, $size, $type, $error,$index, $content_range)
    {
        while(is_dir($this->get_upload_path($name))) {
            $name = $this->upcount_name($name);
        }
        // Keep an existing filename if this is part of a chunked upload:
        $uploaded_bytes = $this->fix_integer_overflow(intval($content_range[1]));
        while(is_file($this->get_upload_path($name))) {
            if ($uploaded_bytes === $this->get_file_size(
                    $this->get_upload_path($name))) {
                break;
            }
            $name = $this->upcount_name($name);
        }
        return $name;
    }

    protected function trim_file_name($file_path, $name, $size, $type, $error,$index, $content_range)
    {
        // Remove path information and dots around the filename, to prevent uploading
        // into different directories or replacing hidden system files.
        // Also remove control characters and spaces (\x00..\x20) around the filename:
        $name = trim(basename(stripslashes($name)), ".\x00..\x20");
        // Use a timestamp for empty filenames:
        if (!$name) {
            $name = str_replace('.', '-', microtime(true));
        }
        // Add missing file extension for known image types:
        if (strpos($name, '.') === false &&
                preg_match('/^image\/(gif|jpe?g|png)/', $type, $matches)) {
            $name .= '.'.$matches[1];
        }
        if (function_exists('exif_imagetype')) {
            switch(@exif_imagetype($file_path)){
                case IMAGETYPE_JPEG:
                    $extensions = array('jpg', 'jpeg');
                    break;
                case IMAGETYPE_PNG:
                    $extensions = array('png');
                    break;
                case IMAGETYPE_GIF:
                    $extensions = array('gif');
                    break;
            }
            // Adjust incorrect image file extensions:
            if (!empty($extensions)) {
                $parts = explode('.', $name);
                $extIndex = count($parts) - 1;
                $ext = strtolower(@$parts[$extIndex]);
                if (!in_array($ext, $extensions)) {
                    $parts[$extIndex] = $extensions[0];
                    $name = implode('.', $parts);
                }
            }
        }
        return $name;
    }

    protected function get_file_name($file_path, $name, $size, $type, $error, $index, $content_range) {
        return $this->get_unique_filename(
            $file_path,
            $this->trim_file_name($file_path, $name, $size, $type, $error,
                $index, $content_range),
            $size,
            $type,
            $error,
            $index,
            $content_range
        );
    }

 public function  index($fid=null) 
   { 
  
   //   if ($this->request->is('ajax'))
//       { 
//             $this->autoRender=false;
//             $this->layout='ajax';
// 	  		$ret = array("filename"=>"mahmoud");
//    		   //var_dump($this->request->query);
//     	  echo json_encode($ret);
//     }
//     
//     if ($this->request->is('get'))
//       { 
//             $this->autoRender=false;
//             $this->layout='ajax';
// 	  		$ret = array("filename"=>"mahmoud");
//    		   //var_dump($this->request->query);
//     	  echo json_encode($ret);
//     }
//    
//    
//     if($this->request->is('post'))
//     {
//    	}

	if($this->request->is('delete'))
      { 
            $this->autoRender=false;
            $this->layout='ajax';
	  		$ret = array("filename"=>"mahmoud");
   		   //var_dump($this->request->query);
    	  echo json_encode($this->Session->read('dossier_id'));
     }


if($this->request->is('ajax')) //review code if dossierid = null
{
  $this->autoRender=false;
  $a = array("userid"=> $this->Auth->user('id'));
  $allowed = array('png', 'jpg', 'gif','zip','pdf');
  $dossierid=$this->request->data['dossierid'];    
  $attid = array_keys($_FILES);

  $attid=$attid[0];
  $attid=substr($attid, strlen('inputfile'));

 if(isset($_FILES['inputfile'.$attid]) && $_FILES['inputfile'.$attid]['error'] == 0)
	{
  	// 	  $extension = pathinfo($_FILES['inputfile'.$attid]['name'], PATHINFO_EXTENSION);
// 
// 	if (!file_exists('files/'.$dossierid))
//     		 		{
//    					   mkdir('files/'.$dossierid, 0777, true);
//  					}
//     	if(move_uploaded_file($_FILES['inputfile'.$attid]['tmp_name'], 'files/'.$dossierid.'/'.$_FILES['inputfile'.$attid]['name'])){
//     	    echo json_encode($_FILES);
//         	exit;
// 	    }

        $file = new stdClass();
        $file->name = $this->get_file_name($_FILES['inputfile'.$attid]['tmp_name'], $_FILES['inputfile'.$attid]['name'], null, null, null,
           null,null);
        //$file->size = $this->fix_integer_overflow(intval($size));
       // $file->type = $type;

   $upload_dir = $this->get_upload_path();
    $file_path = $this->get_upload_path($file->name);
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
        //     echo json_encode(array("dossierid"=>$dossierid));
// 				exit ;

	
              move_uploaded_file($_FILES['inputfile'.$attid]['tmp_name'], $file_path);
				
			$fichierconttroller = new FichiersController;

			$fichier = $fichierconttroller->SaveByNomDossierAttribut($file->name,$dossierid,$attid);

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$filetype=finfo_file($finfo, $file_path);
$filetype = strstr($filetype, '/', true);
 if($filetype=="image")
 {
			$upload_dir.="thumbs";
			    if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
			$this->thumbnail($file_path,$upload_dir.DS.$file->name);
}
		finfo_close($finfo);
			
   echo json_encode(array("status"=>"sucess","filename"=>$file->name,"fichierid"=>$fichier["Fichier"]["id"]));
   exit;	
    }
}

if($this->request->is('post')) //review code if dossierid = null
{
  $this->autoRender=false;
  $a = array("userid"=> $this->Auth->user('id'));
  $allowed = array('png', 'jpg', 'gif','zip','pdf');
  $dossierid=$this->request->data['dossierid'];    
  $attid = array_keys($_FILES);

  $attid=$attid[0];
  $attid=substr($attid, strlen('inputfile'));

 if(isset($_FILES['inputfile'.$attid]) && $_FILES['inputfile'.$attid]['error'] == 0)
	{
  	// 	  $extension = pathinfo($_FILES['inputfile'.$attid]['name'], PATHINFO_EXTENSION);
// 
// 	if (!file_exists('files/'.$dossierid))
//     		 		{
//    					   mkdir('files/'.$dossierid, 0777, true);
//  					}
//     	if(move_uploaded_file($_FILES['inputfile'.$attid]['tmp_name'], 'files/'.$dossierid.'/'.$_FILES['inputfile'.$attid]['name'])){
//     	    echo json_encode($_FILES);
//         	exit;
// 	    }

        $file = new stdClass();
        $file->name = $this->get_file_name($_FILES['inputfile'.$attid]['tmp_name'], $_FILES['inputfile'.$attid]['name'], null, null, null,
           null,null);
        //$file->size = $this->fix_integer_overflow(intval($size));
       // $file->type = $type;

   $upload_dir = $this->get_upload_path();
    $file_path = $this->get_upload_path($file->name);
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
        //     echo json_encode(array("dossierid"=>$dossierid));
// 				exit ;

	
              move_uploaded_file($_FILES['inputfile'.$attid]['tmp_name'], $file_path);
				
			$fichierconttroller = new FichiersController;

			$fichier = $fichierconttroller->SaveByNomDossierAttribut($file->name,$dossierid,$attid);

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$filetype=finfo_file($finfo, $file_path);
$filetype = strstr($filetype, '/', true);
 if($filetype=="image")
 {
			$upload_dir.="thumbs";
			    if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
			$this->thumbnail($file_path,$upload_dir.DS.$file->name);
}
		finfo_close($finfo);
		$this->Session->write('appreciation','succes');
	return	$this->redirect(array('controller'=>'pages','action' => 'merciapp')); 
	
    }
}

	echo '{"status":"error"}';	
//	exit;
}
   
public function appreciation()
{
if($this->request->is('post')) //review code if dossierid = null
{
 
  $this->autoRender=false;
  $a = array("userid"=> $this->Auth->user('id'));
  $allowed = array('png', 'jpg', 'gif','zip','pdf');
  $dossierid=$this->request->data['dossierid'];    
  $attid = array_keys($_FILES);

  $attid=$attid[0];
  $attid=substr($attid, strlen('inputfile'));

 if(isset($_FILES['inputfile'.$attid]) && $_FILES['inputfile'.$attid]['error'] == 0)
	{
  	// 	  $extension = pathinfo($_FILES['inputfile'.$attid]['name'], PATHINFO_EXTENSION);
// 
// 	if (!file_exists('files/'.$dossierid))
//     		 		{
//    					   mkdir('files/'.$dossierid, 0777, true);
//  					}
//     	if(move_uploaded_file($_FILES['inputfile'.$attid]['tmp_name'], 'files/'.$dossierid.'/'.$_FILES['inputfile'.$attid]['name'])){
//     	    echo json_encode($_FILES);
//         	exit;
// 	    }

        $file = new stdClass();
        $file->name = $this->get_file_name($_FILES['inputfile'.$attid]['tmp_name'], $_FILES['inputfile'.$attid]['name'], null, null, null,
           null,null);
        //$file->size = $this->fix_integer_overflow(intval($size));
       // $file->type = $type;

   $upload_dir = $this->get_upload_path();
    $file_path = $this->get_upload_path($file->name);
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
        //     echo json_encode(array("dossierid"=>$dossierid));
// 				exit ;

	
              move_uploaded_file($_FILES['inputfile'.$attid]['tmp_name'], $file_path);
				
			$fichierconttroller = new FichiersController;

			$fichier = $fichierconttroller->SaveByNomDossierAttribut($file->name,$dossierid,$attid);

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$filetype=finfo_file($finfo, $file_path);
$filetype = strstr($filetype, '/', true);
 if($filetype=="image")
 {
			$upload_dir.="thumbs";
			    if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
			$this->thumbnail($file_path,$upload_dir.DS.$file->name);
}
		finfo_close($finfo);
		$this->Session->write('appreciation','succes');
	return	$this->redirect(array('controller'=>'pages','action' => 'merciapp')); 
	
    }
}

}

private function thumbnail($source_image_path, $thumbnail_image_path)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
    if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
        $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
    } else {
        $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
        $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
}
 
  protected function get_upload_path($file_name = null, $version = null) {
        $dossierid=$this->request->data['dossierid'];
        $file_name = $file_name ? $file_name : '';

        return "files".DS.$dossierid.DS.$file_name;
    }
// A list of permitted file extensions
// $allowed = array('png', 'jpg', 'gif','zip');
// 
// if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
// 
//     $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
// 
//     if(!in_array(strtolower($extension), $allowed)){
//         echo '{"status":"error"}';
//         exit;
//     }
// 
//     if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
//         echo '{"status":"success"}';
//         exit;
//     }
// }
// 
// echo '{"status":"error"}';
// exit;
    

    
       public function beforeFilter()
{
    parent::beforeFilter();
   $this->Auth->allow('appreciation');
}
    
    // public function delete($print_response = true) {
//         $file_names = $this->get_file_names_params();
//         if (empty($file_names)) {
//             $file_names = array($this->get_file_name_param());
//         }
//         $response = array();
//         foreach($file_names as $file_name) {
//             $file_path = $this->get_upload_path($file_name);
//             $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
//             if ($success) {
//                 foreach($this->options['image_versions'] as $version => $options) {
//                     if (!empty($version)) {
//                         $file = $this->get_upload_path($file_name, $version);
//                         if (is_file($file)) {
//                             unlink($file);
//                         }
//                     }
//                 }
//             }
//             $response[$file_name] = $success;
//         }
//         return $this->generate_response($response, $print_response);
//     }

}
