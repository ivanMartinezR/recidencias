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

	$consultaExiste="select concat(fecha_cita,' a ',date_add(fecha_cita,interval 1 hour)) as horarios from cita where '$fechaHora'>=fecha_cita and '$fechaHora'<=date_add(fecha_cita,interval 1 hour)";
	$resultadoExiste=$conn->query($consultaExiste);

   
	if($resultadoExiste->num_rows>0){
		$salida="Esta hora ya está ocupada! \n  ";
		while ( $ren=$resultadoExiste->fetch_assoc()) {
		     $salida.=" ".$ren["horarios"]." \n";
	     }
       echo $salida;

	}else{

		$query="insert into cita(nom_paciente,telefono,email,fecha_cita,id_servicio) values('".$_POST["nombrePaciente"]."','".$_POST["telefonoPaciente"]."','".$_POST["email"]."','".$fechaHora."',".$_POST["servicio"].") ";



		//echo $id=$conn->insert_id;

		if($conn->query($query)){
			echo "Consulta Capturada!";
		}else{
			echo "Ocurrió un error!";
		}
    }
 
}


if($_POST["accion"]=="GET_SERVICIOS"){
	$query="select * from servicio";
	$salida="";
	$result=$conn->query($query);

	while ( $row=$result->fetch_assoc()) {
		$salida.="<option value='".$row["id"]."'>".$row["nom_servicio"]."</option>";
	}

	echo $salida;
}


if($_POST["accion"]=="GET_CITAS"){


    $query="select nom_paciente,fecha_cita,s.nom_servicio from cita as c join servicio as s on c.id_servicio=s.id where date(fecha_cita)>='".date('Y-m-d',strtotime($_POST["fechaIni"]))."' and date(fecha_cita)<='".date('Y-m-d',strtotime($_POST["fechaFin"]))."'";
	$salida="<div id='cabeceroCitas' style='background-color:#00e4ff;' class='row'>
					  <div class='col'>Paciente</div>
					  <div class='col'>Fecha</div>
					  <div class='col'>Hora</div>
					
                  </div>";


	$result=$conn->query($query);

	while ($row=$result->fetch_assoc()) {
		$salida.="<div class='row'>
					  <div class='col'>".$row["nom_paciente"]."</div>
					  <div class='col'>".explode(" ", $row["fecha_cita"])[0]."</div>
					  <div class='col'>".explode(" ", $row["fecha_cita"])[1]."</div>
					
                  </div>";
	}

	echo $salida;
}

