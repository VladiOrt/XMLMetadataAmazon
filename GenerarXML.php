<!DOCTYPE html>
<html>
<head>
    <?php include("../librerias.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/menuPag.css">
    <link rel="stylesheet" type="text/css" href="css/XML2.css">
    <script type="text/javascript" src="js/GXML.js"></script>
    <title>Generar XML</title>
    <meta charset="utf-8">
    </head>


<script type="text/javascript">
    function Mec(){
        let ventana1 = document.getElementById("MecContainer");
        let ventana2 = document.getElementById("MmcContainer");
        ventana1.style.display = "flex"; 
        ventana2.style.display = "none";   
    }
    function Mmc(){
        let ventana1 = document.getElementById("MecContainer");
        let ventana2 = document.getElementById("MmcContainer");
        ventana1.style.display = "none"; 
        ventana2.style.display = "flex";     
    }
</script>

<body>
<?php include("Menu.php");  ?>
    <div id="subcontainer">
        <button onclick="Mec()">MEC</button>
        <button onclick="Mmc()">MMC</button>
    </div>

    
    <form action="php/xml.php" method="post">
        <div id="cuerpo">
            <div id="preguntar">
                <div id="Lenguajes">
                    <label>Numero de Lenguajes:</label>
                    <select id="NLenguaje" name="NLenguaje" onchange="lenguaje()">
                        <?php 
                            for($i=0; $i<=3; $i++){echo "<option value='".$i."'>".$i."</option>";}
                        ?>
                    </select>
                </div>
                <div id="generos">
                    <label>Numero de Generos:</label>
                    <select id="NGeneros" name="NGeneros" onchange="generos()">
                        <?php 
                            for($i=0; $i<=3; $i++){echo "<option value='".$i."'>".$i."</option>";}
                        ?>
                    </select>
                </div>
                <div id="rating">
                    <label>Existe información de Rating?:</label>
                    <input type="checkbox" id="ChangeRating" name="Rating" value="SI" class="box" onchange="Info()">
                </div>
                <div id="actores">
                    <label>Numero de Actores:</label>
                    <select id="NActores" name="NActores" onchange="actores()">
                        <?php 
                            for($i=0; $i<=15; $i++){
                                echo "<option name='actores' value='".$i."'>".$i."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div id="directores">
                    <label>Numero de Directores:</label>
                    <select id="NDirectores" name="NDirectores" onchange="directores()">
                        <?php 
                            for($i=0; $i<=5; $i++){echo "<option value='".$i."'>".$i."</option>";}
                        ?>
                    </select>
                </div>
                <div id="productores">
                    <label>Numero de Productores:</label>
                    <select id="NProductores" name="NProductores" onchange="productores()">
                        <?php 
                            for($i=0; $i<=5; $i++){echo "<option value='".$i."'>".$i."</option>";}
                        ?>
                    </select>
                </div>
                <div id="escritores">
                    <label>Numero de Escritores:</label>
                    <select id="NEscritores" name="NEscritores" onchange="escritores()">
                        <?php 
                            for($i=0; $i<=5; $i++){echo "<option value='".$i."'>".$i."</option>";}
                        ?>
                    </select>
                </div>            
            </div>      
    
            <div id="formulario" class="resultado">
                <div id="MecContainer">
                    <center><h3>MEC</h3></center>
                    <label style="width: 15%;">Partner Alias :</label>
                    <input type="text" name="partnerAlias" id="partnerAlias">
                    <label style="width: 15%; text-align: center;">UniqueID :</label>
                    <input type="text" name="ContentID" id="ContentID">
                    <label style="width: 15%; text-align: center;">Distribuidora :</label>
                    <input type="text" name="Company" id="Company">
                    <br><br>
                    <div id="FLenguaje"></div>
                    <div id="FGeneros"></div>
                    <div id="Estaticos">
                    <div style="margin-top: 10px; margin-bottom: 10px">
                        <label>Ano de lanzamiento de la Pelicula</label>
                        <input type="text" name="ReleaseYear" id="">            
                    </div>
                    <div  style="margin-top: 10px; margin-bottom: 10px">
                        <label>Fecha de lanzamiento de la Pelicula</label>
                        <input type="text" name="ReleaseDate" id="">            
                    </div>
                    <div>  
                    </div>
                    <div>
                        <label>Tipo de Lanzamiento</label>
                        <input type="text" name="ReleaseType" id="">            
                    </div>
                    <div>
                        <label>País de Distribucion</label>
                        <input type="text" name="Country" id="">            
                    </div>
                    <div>
                        <label>Fecha de Distribucion</label>
                        <input type="text" name="Date" id="">            
                    </div>
                    <div>
                        <label>Tipo de Producción</label>
                        <input type="text" name="Tipo" id="">            
                    </div>
                    <div>
                        <label>Identificador ORG</label>
                        <input type="text" name="ORG" id="">            
                    </div>
                    <div>
                        <label>Identificador IMDB</label>
                        <input type="text" name="IMBD" id="">            
                    </div>
                    </div>
                    <div id="FInfo"></div>
                    <br>
                    <div id="FActores"></div>
                    <br>
                    <div id="FDirectores"></div>
                    <br>
                    <div id="FProductores"></div>
                    <br>
                    <div id="FEscritores"></div>
                    <br>
                    <div id="archivos">
                        <input type="submit" name="boton" class="btn btn-info btn-lg" value="MEC">
                        </input>
                    </div>
                </div>


                
                <div id="MmcContainer">
                    <center><h3>MMC</h3></center>     

                  
                    <div id="FormularioMMC" >
                    <div id="Subtitulo-MMC">Audio</div>
                    <div id="izquierda-MMC">
                    <div id="Subtitulo-MMC">Trailer</div>
                        <label>Tipo de Archivo</label>
                        <input type="text" name="tipo_audio_1" id="">    
                        <label>Nombre del Archivo</label>
                        <input type="text" name="location_audio_1" id="">
                        <label>Numero Hash</label>
                        <input type="text" name="hash_audio_1" id="">
                    </div>
                    <div id="derecha-MMC">
                    <div id="Subtitulo-MMC">Pelicula</div>
                    <label>Tipo de Archivo</label>
                    <input type="text" name="tipo_audio_2" id="">    
                    <label>Nombre del Archivo</label>
                    <input type="text" name="location_audio_2" id="">
                    <label>Numero Hash</label>
                    <input type="text" name="hash_audio_2" id="">
                    </div>

                    <div id="Subtitulo-MMC">Video</div>
                    <div id="izquierda-MMC">
                        <div id="Subtitulo-MMC">Trailer</div>                    
                        <!--
                        <label>Tipo</label>
                        <input type="text" name="tipo_video_1" id="">    
                        -->
                        <label>WidthPixels</label>
                        <input type="text" name="width_video_1" >
                        <label>HeightPixels</label>
                        <input type="text" name="height_video_1" >
                        <label>Tipo de Escaneo</label>
                        <select name="opcion_video_1">
                            <option value="TFF">TFF</option>
                            <option value="BFF">BFF</option>
                            <option value="Progressive">Progressive</option>
                        </select>
                        <!--
                        <label>Location</label>
                        <input type="text" name="location_video_1" id="">
                        
                        <label>Hash</label>
                        <input type="text" name="hash_video_1" id=""> 
                        -->
                    </div>
                    <div id="derecha-MMC">
                        <div id="Subtitulo-MMC">Pelicula</div>
                    
                        <!--
                        <label>Tipo</label>
                        <input type="text" name="tipo_video_2" id="">    
                        -->
                        <label>WidthPixels</label>                        
                        <input type="text" name="width_video_2" id="">
                        <label>HeightPixels</label>
                        <input type="text" name="height_video_2" id="">
                        <label>Tipo de Escaneo</label>
                        <select name="opcion_video_2">
                            <option value="TFF">TFF</option>
                            <option value="BFF">BFF</option>
                            <option value="Progressive">Progressive</option>
                        </select>
<!--
                        <label>Nombre de Archivo</label>
                        <input type="text" name="location_video_2" id="">
                        
                        <label>Hash</label>
                        <input type="text" name="hash_video_2" id="">            
                        -->
                    </div>
                    <div id="Subtitulo-MMC">Archivos de Subtitulos</div>
                    <label style="width: 12%">Frame Rate</label>
                   <!-- 
                    <input type="text" name="FrameRateMmc" id="FrameRateMmc"></input>
                    -->
                    <select name="FrameRateMmc" id="FrameRateMmc">
                        <option value="23.976">23.976</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="29.97 NDF">29.97 NDF</option>
                        <option value="29.97 DF">29.97 DF</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="59.94 NDF">59.94 NDF</option>
                        <option value="59.94 DF">59.94 DF</option>
                        <option value="60">60</option>

                    </select>


                    <div id="SubtitleIDCaption" style="width: 100%;"></div>
                    <div id="SubtitleIDSubtitle" style="width: 100%;"></div>
                    <div id="SubtitleIDForce" style="width: 100%;"></div>
                    
                    <div id="Subtitulo-MMC">Metadata</div>
                        <div id="Metadata">                   
                            <label>Nombre Archivo MEC</label>
                        <input type="text" name="location" >
                        <!--
                        <label>Location Pelicula</label>
                        <input type="text" name="location_pelicula" >
                        -->
                        </div>
                        <div id="Subtitulo-MMC">Presentaciones</div>
                        <div id="Presentacion">                   
                            <label>Slection Number</label>
                            <input type="text" name="selection_number" >
                        </div>
                        <div id="Subtitulo-MMC">Experiencias</div>
                        <div id="Experiencia"> </div>
                </div>







            <div id="archivos">
                <input type="submit" name="boton" class="btn btn-info btn-lg" value="MMC">
                </input>
            </div>            
            </div>
        </div>
    </form>
</body>
</html>







