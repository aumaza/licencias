<?php      

	
	$archivo = basename($_GET['file_name']);
	//echo $archivo;

//Si la variable archivo que pasamos por URL no esta 
//establecida acabamos la ejecucion del script.
if($archivo){
//if (!isset($_GET['file_name']) || empty($_GET['file_name'])) {
   
   $path = 'gen_pass/'.$archivo;
  
  
//Utilizamos basename por seguridad, devuelve el 
//nombre del archivo eliminando cualquier ruta. 
//$file = basename($_GET['file_name']);

//$path = 'uploads/tabs'.$file;

if (is_file($path))
{
   header('Content-Type: application/force-download');
   header('Content-Disposition: attachment; filename='.$archivo);
   header('Content-Transfer-Encoding: binary');
   header('Content-Length: '.filesize($path));

   readfile($path);
}
}else{
   exit();
   }
?>
