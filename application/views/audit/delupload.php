<?php $target_path = "../archivos/";
$target_path = $target_path . $archivo["id"] . "." . $archivo["extension"]; 

if(unlink($target_path)) {
	header('Location: ' . $_SERVER['HTTP_REFERER']);
} else{
    echo "Hubo un error al borrar el archivo, intente nuevamente";
}
?>