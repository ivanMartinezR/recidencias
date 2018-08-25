<?php
	 $id=0;
     $host="localhost";
     $usu="root";
     $pwd="";	 
     $db="dentista";
$conn = new mysqli($host, $usu, $pwd, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if($_POST["accion"]=="GUARDA_CITA"){

$fechaHora=date('Y-m-d H:i:s', strtotime($_POST["fechaCita"]." ".$_POST["horaCita"].":".$_POST["minutosCita"].":00"));

$query="insert into cita(nom_paciente,telefono,email,fecha_cita) values('".$_POST["nombrePaciente"]."','".$_POST["telefonoPaciente"]."','".$_POST["email"]."','".$fechaHora."') ";



//echo $id=$conn->insert_id;

echo $conn->query($query);
 
}

  
