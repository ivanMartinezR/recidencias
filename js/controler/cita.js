    

 $("#btnGuardarCita").click(function(){
   var minutos=document.getElementById("minutos").value;
   var hora=document.getElementById("hora").value;
   var cita=$("#frmCitaNueva")[0];


   $.post("php/cita.php",
    {
        accion: "GUARDA_CITA",
        nombrePaciente:cita[0].value,
        telefonoPaciente:cita[1].value,
        email:cita[2].value,
        fechaCita:cita[3].value,
        horaCita:hora,
        minutosCita:minutos,
        
    },
    function(data, status){
       console.log("Data: " + data + "\nStatus: " + status)
       if(data==1)
       	alert("Cita Registrada")
       else
       	alert("Ocurrió un Error")

    });

});