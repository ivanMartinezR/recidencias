    

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
        servicio:cita[6].value,
        
    },
    function(data, status){
       console.log("Data: " + data + "\nStatus: " + status);
       alert(data);

    });

});


 function Load(){
    CargarComboServicios()
    listarCitas()
 }

 function CargarComboServicios(){
     $.post("php/cita.php",
    {
        accion: "GET_SERVICIOS",

        
    },
    function(data, status){

        $("#cmbServicio").html(data); 

    });
 }

 function listarCitas(){
    var fecha=new Date();
    $.post("php/cita.php",
    {
        accion: "GET_CITAS",
        fechaIni:fecha.getFullYear()+"-"+fecha.getMonth()+"-"+fecha.getDate(),
        fechaFin:fecha.getFullYear()+"-"+fecha.getMonth()+"-"+fecha.getDate(),
    },
    function(data, status){

        $("#listaCitas").html(data); 

    });
 }

 $("#btnBuscarPorFecha").click(function(e){
    var ini=$("#FechasEnModal :input")[0].value;
    var fin=$("#FechasEnModal :input")[1].value; 
    console.log(ini=="") 
    if(ini!="" && fin!=""){
        $.post("php/cita.php",
        {
            accion: "GET_CITAS",
            fechaIni:ini,
            fechaFin:fin,
        },
        function(data, status){
            $("#btnCierraModalFechas").click();
            $("#listaCitas").html(data); 

        });
    }else
        alert("elije las fechas")
     

 });
    

