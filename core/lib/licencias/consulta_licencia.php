<?php  include "../../connection/connection.php";
       include "lib_licencias.php";
       
       if($conn){
       
        $tipo_licencia = mysqli_real_escape_string($conn, $_POST['tipo_licencia']);
        $sql = "SELECT descripcion, art_licencia FROM tipo_licencia WHERE clase_licencia = '$tipo_licencia' order by descripcion ASC";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn, $sql);

        if($query){
        
        while($row = mysqli_fetch_array($query)){
            
            echo '<option value="'.$row[descripcion].'">'.$row[descripcion].' - '.$row[art_licencia].'</option>';
        }
        }else{
            echo "error";
        }
        }else{
        
            echo "Sin conexion";
        
        }
        
        mysqli_close($conn);

?>
