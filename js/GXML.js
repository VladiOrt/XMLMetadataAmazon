function lenguaje(){
    let FLenguaje = document.getElementById("FLenguaje");

    let MmcSubtitle1 = document.getElementById("SubtitleIDCaption");
    let MmcSubtitle2 = document.getElementById("SubtitleIDSubtitle");
    let MmcSubtitle3 = document.getElementById("SubtitleIDForce");
    let NLenguaje = document.getElementById("NLenguaje").value;
    let Leng = 1;
    if (NLenguaje > 0) {
      a="";
      LenguajeEncabezado ="";
      Seleccionar ="";
      In_Lenguaje = "";
      In_Titulo60 = "";
      In_Titulo = "";
      In_Titulo_Corto = "";
      In_Imagen = "";
      In_Sipnosis_Corta = "";
      In_Sipnosis_Requerida = "";
      In_Original = "";
      In_Copyright ="";


      In_Type="";
      In_frameRate="";
      In_Location="";
      In_manifestHash="";
      Lenguajes ="";
      Type ="";
      FrameRate ="";      
      ContainerLocation ="";      
      ManifestHash ="";



      for (var i = 1; i <= NLenguaje; i++) {
        LenguajeEncabezado = LenguajeEncabezado + '<label style="width:18%;" align="center">Lenguaje'+ i +'</label>';
        Seleccionar = Seleccionar + '<input type="radio" name="Seleccion" id="Seleccion'+i+'" value="'+i+'" style="margin-right:18%;">';
        In_Lenguaje = In_Lenguaje + '<input type="text" class="lenguaje" name="In_Lenguaje'+i+'" style="margin-right:5%;">';
        In_Titulo60 = In_Titulo60 + '<input type="text" class="lenguaje" name="In_Titulo60'+i+'" style="margin-right:5%;">';
        In_Titulo = In_Titulo + '<input type="text" class="lenguaje" id= "In_Titulo"'+i+' name="In_Titulo'+i +'" style="margin-right:5%;">';
        In_Titulo_Corto = In_Titulo_Corto + '<input type="text" class="lenguaje" id=In_Titulo_Corto'+i +' name="In_Titulo_Corto'+i +'" style="margin-right:5%;display:none">';
        In_Imagen = In_Imagen + '<input type="text" class="lenguaje" id=In_Imagen'+i+' name="In_Imagen'+i +'" style="margin-right:5%;">';
        In_Sipnosis_Corta = In_Sipnosis_Corta + '<input type="text" class="lenguaje" id="In_Sipnosis_Corta"'+i +' name="In_Sipnosis_Corta'+i +'"   style="margin-right:5%;display:none">';
        In_Sipnosis_Requerida = In_Sipnosis_Requerida + '<input type="text" class="lenguaje" id="In_Sipnosis_Requerida"'+i +' name="In_Sipnosis_Requerida'+i +'" style="margin-right:5%;">';
        In_Original = In_Original + '<input type="text" class="lenguaje" id="In_Original"'+i +' name="In_Original'+i +'" style="margin-right:5%;">';
        In_Copyright = In_Copyright + '<input type="text" class="lenguaje" id="In_Copyright"'+i +' name="In_Copyright'+i +'" style="margin-right:5%;">';
      }
      Encabezado ="<label style='width:15%;'></label>";  
      Select ="<label style='width:15%;'>Idioma Original de la Pelicula Principal</label>";  
      Lenguaje ="<label style='width:15%;'>Idioma de la Informacion Localizada</label>";
      Titulo60 ="<label style='width:15%;'>Titulo Localizado de la Pelicula(60 char)</label>";
      Titulo ="<label style='width:15%;'>Titulo Localizado de la Pelicula (ilimitado)</label>";
      TituloCorto ="";
      Imagen ="<label style='width:15%;'>Poster Localizado de la Pelicula</label>";
      SipnosisCorta ="<label style='width:15%;'></label>";
      SipnosisRequerida ="<label style='width:15%;'>Sipnosis Localizada de la pelicula</label>";
      TituloOriginal ="<label style='width:15%;'>Titulo original de la Pelicula</label>";
      Copyright ="<label style='width:15%;'>Productora</label>";
      FLenguaje.innerHTML =   
            Encabezado+ LenguajeEncabezado+"<br>" +
            Select + Seleccionar + "<br>" +
            Lenguaje + In_Lenguaje + "<br>" +
            Titulo60 + In_Titulo60 + "<br>" +
            Titulo + In_Titulo + "<br>"+ 
            In_Titulo_Corto +"<br>" +
            Imagen + In_Imagen +"<br>" +
            SipnosisCorta + In_Sipnosis_Corta +"<br>" +
            SipnosisRequerida + In_Sipnosis_Requerida+"<br>" +
            TituloOriginal+ In_Original+"<br>"+
            Copyright +In_Copyright;


      // Subtitle ID Caption
       for (var i = 1; i <= NLenguaje; i++) {
        Lenguajes = Lenguajes + '<label style="width:18%;" align="center">Lenguaje'+ i +'</label>';
        In_Type = In_Type + '<input type="text" class="lenguaje" id="CaptionType'+i +'" name="CaptionType'+i +'" style="margin-right:5%;">';
      //In_frameRate = In_frameRate + '<input type="text" class="lenguaje"  id="SubtitleFrame'+i +'" name="SubtitleFrame'+i +'" style="margin-right:5%;">';
        In_Location = In_Location + '<input type="text" class="lenguaje" id="CaptionLocation'+i +'" name="CaptionLocation'+i +'" style="margin-right:5%;">';
        In_manifestHash = In_manifestHash + '<input type="text" class="lenguaje" id="CaptionHash'+i +'" name="CaptionHash'+i +'" style="margin-right:5%;">';       
      }      
      Encabezado ="<label style='width:15%;'></label>";  
      Type ="<label style='width:15%;'>Type</label>";
    //  FrameRate ="<label style='width:15%;'>FrameRate</label>";      
      ContainerLocation ="<label style='width:15%;'>Container Location</label>";      
      ManifestHash ="<label style='width:15%;'>Manifest Hash</label>";
      MmcSubtitle1.innerHTML = 
            Encabezado + Lenguajes+   "<br>" +
            "<label style='width:80%;' align='center'>Caption</label>" + "<br>" +
            Type + In_Type + "<br>" +
           // FrameRate + In_frameRate + "<br>" +
            ContainerLocation + In_Location + "<br>" +
            ManifestHash + In_manifestHash + "<br>";

      Lenguajes='';
      In_Type ='';
      In_frameRate ='';
      In_Location ='';
      In_manifestHash ='';
    // Subtitle ID Subtitle
       for (var i = 1; i <= NLenguaje; i++) {
        Lenguajes = Lenguajes + '<label style="width:18%;" align="center">Lenguaje'+ i +'</label>';
        In_Type = In_Type + '<input type="text" class="lenguaje" id="SubtitleTypeS'+i +'" name="SubtitleTypeS'+i +'" style="margin-right:5%;">';
       // In_frameRate = In_frameRate + '<input type="text" class="lenguaje"  id="SubtitleFrameS'+i +'" name="SubtitleFrame'+i +'" style="margin-right:5%;">';
        In_Location = In_Location + '<input type="text" class="lenguaje" id="SubtitleLocationS'+i +'" name="SubtitleLocationS'+i +'" style="margin-right:5%;">';
        In_manifestHash = In_manifestHash + '<input type="text" class="lenguaje" id="SubtitleHashS'+i +'" name="SubtitleHashS'+i +'" style="margin-right:5%;">';       
      }      
      Encabezado ="<label style='width:15%;'></label>";  
      Type ="<label style='width:15%;'>Type</label>";
     // FrameRate ="<label style='width:15%;'>FrameRate</label>";      
      ContainerLocation ="<label style='width:15%;'>Container Location</label>";      
      ManifestHash ="<label style='width:15%;'>Manifest Hash</label>";
      MmcSubtitle2.innerHTML = 
            //Encabezado + Lenguajes+   "<br>" +
            "<label style='width:80%;' align='center'>Subtitle</label>" + "<br>" +
            Type + In_Type + "<br>" +
           // FrameRate + In_frameRate + "<br>" +
            ContainerLocation + In_Location + "<br>" +
            ManifestHash + In_manifestHash + "<br>";
  

      Lenguajes='';
      In_Type ='';
      In_frameRate ='';
      In_Location ='';
      In_manifestHash ='';

       // Subtitle ID Force
       for (var i = 1; i <= NLenguaje; i++) {
        Lenguajes = Lenguajes + '<label style="width:18%;" align="center">Lenguaje'+ i +'</label>';
        In_Type = In_Type + '<input type="text" class="lenguaje" id="SubtitleTypeF'+i +'" name="SubtitleTypeF'+i +'" style="margin-right:5%;">';
       // In_frameRate = In_frameRate + '<input type="text" class="lenguaje"  id="SubtitleFrameF'+i +'" name="SubtitleFrame'+i +'" style="margin-right:5%;">';
        In_Location = In_Location + '<input type="text" class="lenguaje" id="SubtitleLocationF'+i +'" name="SubtitleLocationF'+i +'" style="margin-right:5%;">';
        In_manifestHash = In_manifestHash + '<input type="text" class="lenguaje" id="SubtitleHashF'+i +'" name="SubtitleHashF'+i +'" style="margin-right:5%;">';       
      }      
      Encabezado ="<label style='width:15%;'></label>";  
      Type ="<label style='width:15%;'>Type</label>";
     // FrameRate ="<label style='width:15%;'>FrameRate</label>";      
      ContainerLocation ="<label style='width:15%;'>Container Location</label>";      
      ManifestHash ="<label style='width:15%;'>Manifest Hash</label>";
      MmcSubtitle3.innerHTML = 
            //Encabezado + Lenguajes+ "<br>" +
            "<label style='width:80%;' align='center'>FN</label>" + "<br>" +
            Type + In_Type + "<br>" +
            //FrameRate + In_frameRate + "<br>" +
            ContainerLocation + In_Location + "<br>" +
            ManifestHash + In_manifestHash + "<br>";

    }
}




function generos(){
  let NLenguaje = document.getElementById("NLenguaje").value;
    let FGeneros = document.getElementById("FGeneros");
    let NGeneros = document.getElementById("NGeneros").value;
    if (NGeneros > 0) {
      Genero_Id="";
      Genero_Source="";
      Genero_Texto="";
      for (var i = 1; i <= NGeneros; i++) {
        Genero_Id= Genero_Id +"<label style='width:15%;'>Codigo del Genero "+i+"</label>";
        Genero_Source= Genero_Source +"<label style='width:15%;'>Fuente del Codigo de Genero "+i+"</label>";      
        Genero_Texto= Genero_Texto +"<label style='width:15%;'>Genero"+i+"</label>";      
        for (var j = 1; j <= NLenguaje; j++) {
          Genero_Id=Genero_Id + "<input type='text' class='lenguaje' id='G"+i+"L"+j+"' name='Genero"+i+"L"+j+"' style='margin-right:5%;'>";          
          Genero_Source=Genero_Source + "<input type='text' class='lenguaje' id='G"+i+"L"+j+"' name='Source"+i+"L"+j+"' style='margin-right:5%;'>";          
          Genero_Texto=Genero_Texto + "<input type='text' class='lenguaje' id='G"+i+"L"+j+"' name='Texto"+i+"L"+j+"' style='margin-right:5%;'>";          
        }
        Genero_Id=Genero_Id+"<br>";
        Genero_Source=Genero_Source+"<br>";
        Genero_Texto=Genero_Texto+"<br>";
      }
      Genero_Id= Genero_Id;
      Genero_Source= Genero_Source;
      Genero_Texto= Genero_Texto;
    }   
    FGeneros.innerHTML = Genero_Id + Genero_Source + Genero_Texto;          
}
function actores(){
    let NLenguaje = document.getElementById("NLenguaje").value;
    let FActores = document.getElementById("FActores");
    let NActores = document.getElementById("NActores").value;
    if (NActores > 0) {
      a="";
      for (var j = 1; j <= NActores; j++) {
        a= a +"<label style='width:15%;'>Actor "+j+"</label>";
        for (var i = 1; i <= NLenguaje; i++) {
           a=a + '<input type="text" class="lenguaje" id="Actor'+j+i+'" name="Actor'+j+i+'"  style="margin-right:5%;">';
         }
      a=a+ "<br>";
      }       
      FActores.innerHTML = a ;
  }
}

function directores(){
    let NLenguaje = document.getElementById("NLenguaje").value;
    let FDirectores = document.getElementById("FDirectores");
    let NDirectores = document.getElementById("NDirectores").value;
    if (NDirectores > 0) {
      a="";
      for (var j = 1; j <= NDirectores; j++) {
        a= a +"<label style='width:15%;'>Director "+j+"</label>";
        for (var i = 1; i <= NLenguaje; i++) {
      a=a + '<input type="text" class="lenguaje" id="D'+i+j+'" name="Director'+j+i+'" style="margin-right:5%;">';
      }
      a=a+ "<br>";
      }       
      FDirectores.innerHTML = a ;
  }
}
function productores(){
    let NLenguaje = document.getElementById("NLenguaje").value;
    let FProductores = document.getElementById("FProductores");
    let NProductores = document.getElementById("NProductores").value;
    if (NProductores > 0) {
      a="";
      for (var j = 1; j <= NProductores; j++) {
        a= a +"<label style='width:15%;'>Productor "+j+"</label>";
        for (var i = 1; i <= NLenguaje; i++) {
      a=a + '<input type="text" class="lenguaje" id="P'+i+j+'" name="Productor'+j+i+'"  style="margin-right:5%;">';
      }
      a=a+ "<br>";
      }       
      FProductores.innerHTML = a ;
  }
}
function escritores(){
    let NLenguaje = document.getElementById("NLenguaje").value;
    let FEscritores = document.getElementById("FEscritores");
    let NEscritores = document.getElementById("NEscritores").value;
    if (NEscritores > 0) {
      a="";
      for (var j = 1; j <= NEscritores; j++) {
        a= a +"<label style='width:15%;'>Escritor "+j+"</label>";
        for (var i = 1; i <= NLenguaje; i++) {
      a=a + '<input type="text" class="lenguaje" id="E'+i+j+'" name="Escritor'+j+i+'"  style="margin-right:5%;">';
      }
      a=a+ "<br>";
      }       
      FEscritores.innerHTML = a ;
  }
}

function Info(){
    let Existe = document.getElementById("ChangeRating").checked;
    let FInfo = document.getElementById("FInfo");
    if (Existe) {
      a="<label style='width:20%;'>Region de Clasificacion</label><input type='text' class='lenguaje' name='RatingCountry' style='margin-right:5%;'>" +
        "<br>"+"<label style='width:15%;'>Sistema de Clasificacion</label><input type='text' class='lenguaje' name='System' style='margin-right:5%;'>" +
        "<br>"+"<label style='width:15%;'>Valor de Clasificacion</label><input type='text' class='lenguaje' name='Value' style='margin-right:5%;'>"+"<br>";
      
      FInfo.innerHTML = a ;
    }else{a="<label>No Existe Informacion de Rating</label>";
      FInfo.innerHTML = a ;}
}


function Archivos(){
  let NArchivos = document.getElementById("numeroarchivos").value;
  let NLenguaje = document.getElementById("NLenguaje").value;
  let FArchivos = document.getElementById("contenidoarchivos");

  let MMCSubtitle = document.getElementById("SubtitleID");

    if (NArchivos > 0) {
    let label = "";
    let input1 ="";
    let salida = "";
    let Ldrop = "";
    let Idrop = "";
    let LNdrop = "";
    let INdrop = "";
    let LLocation = "";
    let ILocation = "";
    let Lmethod = "";
    let Imethod = "";
    let LManifest = "";
    let IManifest = "";
    

      for (var i = 1; i <= NArchivos; i++) {      
        for (var j = 1; j <= NLenguaje; j++) {
          var Ndoc = i + "-Idioma-" + j; 
          label=  "asss<label style='width:20%;'>Tipo de Archivo "+Ndoc+"</label>";
          input1 =  "<select style='width:80%' id='Option"+i+j+"'><option value=''></option><option value='caption'>caption</option><option value='subtitle'>subtitle</option><option value='forced'>forced</option></select>"
          Ldrop=  "<label style='width:20%;'>FrameRate "+Ndoc+"</label>";
          Idrop =  "<input type='text'  style='width:80%; id='Drop"+i+j+"'>";
          LNdrop=  "<label style='width:20%;'>FrameRate multiplier "+Ndoc+"</label>";
          INdrop =  "<input type='text'  style='width:80%;' id='NDrop"+i+j+"'>";
          LLocation=  "<label style='width:20%;'>FrameRate multiplier "+Ndoc+"</label>";
          ILocation =  "<input type='text'  style='width:80%;' id='Location"+i+j+"'>";
          Lmethod=  "<label style='width:20%;'>ContainerLocation "+Ndoc+"</label>";
          Imethod = "<input type='text'  style='width:80%;' id='Method"+i+j+"'>";
          LManifest=  "<label style='width:20%;'>Hash "+Ndoc+"</label>";
          IManifest = "<input type='text'  style='width:80%;' id='Manifest"+i+j+"'>";

        salida = salida + 
        label + input1 + 
        Ldrop + Idrop + 
        LNdrop + INdrop + 
        LLocation + ILocation + 
        Lmethod + Imethod + 
        LManifest + IManifest;
        }
      }   
      FArchivos.innerHTML = salida;  
    }       
}