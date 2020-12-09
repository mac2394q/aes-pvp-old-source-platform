<?php $target_path = "../archivos/";
$target_path = $target_path . $archivo; 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	header('Location: ' . $_SERVER['HTTP_REFERER']);
} else{
    echo "Hubo un error al subir el archivo, intente nuevamente";
} ?>