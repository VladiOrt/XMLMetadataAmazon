<?php
	
	$boton = $_POST['boton'];
	// Datos Generales del Formulario
	$NLenguajes = $_POST['NLenguaje'];
	$NGeneros = $_POST['NGeneros'];

	$Rating = $_POST['Rating'];
	$NActores = $_POST['NActores'];
	$NDirectores = $_POST['NDirectores'];
	$NProductores = $_POST['NProductores'];
	$NEscritores = $_POST['NEscritores'];
	//Fin//
	
	// Datos Individuales del Formulario //
	$ContenId = $_POST['ContentID'];
	//Fin //
	
	if ($boton === "MEC") {
		crear($ContenId,$NLenguajes,$NGeneros,$Rating,$NActores,$NDirectores,$NProductores,$NEscritores);
	}elseif ($boton === "MMC") {
		crearMMC($NLenguajes);
	}
	


	
	
	
	



	function crear($ContenId,$Lenguajes,$Generos,$Rating,$Actores,$Directores,$Productores,$Escritores){
		$Lenguajes = $Lenguajes;

		$xml = new DomDocument('1.0', 'UTF-8');

	//CoreMetadata
		$Encabezado = $xml->createElement('mdmec:CoreMetadata');
		$Encabezado = $xml->appendChild($Encabezado);
			//xmln
			$xmlns = $xml->createAttribute('xmlns:xsi');
			$xmlns->value = 'http://www.w3.org/2001/XMLSchema-instance';
			$Encabezado->appendChild($xmlns);
			$xml->appendChild($Encabezado);
			//xsi
			$xsi = $xml->createAttribute('xsi:schemaLocation');
			$xsi->value = 'http://www.movielabs.com/schema/mdmec/v2.5 ../mdmec-v2.5.xsd';
			$Encabezado->appendChild($xsi);
			$xml->appendChild($Encabezado);
			//xmlns
			$xmlnsmd = $xml->createAttribute('xmlns:md');
			$xmlnsmd->value = 'http://www.movielabs.com/schema/md/v2.5/md';
			$Encabezado->appendChild($xmlnsmd);
			$xml->appendChild($Encabezado);
			//xmlns:mdmec
			$xmlnsmdmec = $xml->createAttribute('xmlns:mdmec');
			$xmlnsmdmec->value = 'http://www.movielabs.com/schema/mdmec/v2.5';
			$Encabezado->appendChild($xmlnsmdmec);
			$xml->appendChild($Encabezado);
		
		//UniqueID
		$UniID = "md:cid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'];
		$UniqueID = $xml->createElement('mdmec:Basic',"");
		$UniqueID = $Encabezado->appendChild($UniqueID);
		$Attrib_UniqueID = $xml->createAttribute('ContentID');
		$Attrib_UniqueID->value = $UniID;
		$UniqueID->appendChild($Attrib_UniqueID);
	
		$LenguajeOriginal = "";
	//Lenguaje   *--------- CICLO PARA EL LENGUAJE---------*
		$Seleccion = $_POST['Seleccion'];
 		for ($i=1; $i <=$Lenguajes ; $i++) { 
 			$LenguajeActual= 'In_Lenguaje'.$i;
			$Titulo60Actual= 'In_Titulo60'.$i;
			$TituloActual= 'In_Titulo'.$i;
			$TituloCortoActual= 'In_Titulo_Corto'.$i;
			$ImagenActual= 'In_Imagen'.$i;
			$SipCortaActual= 'In_Sipnosis_Corta'.$i;
			$SipRequeridaActual= 'In_Sipnosis_Requerida'.$i;
			
			$Localized = $xml->createElement('md:LocalizedInfo',"");
			$Localized = $UniqueID->appendChild($Localized);
			$Attrib_Localized = $xml->createAttribute('language');
			$Attrib_Localized->value = $_POST[$LenguajeActual];
			$Localized->appendChild($Attrib_Localized);

			if ($i == $Seleccion) { 
				$LenguajeOriginal = $_POST[$LenguajeActual];
				$Attrib_default = $xml->createAttribute('default');
				$Attrib_default->value = 'true';
				$Localized->appendChild($Attrib_default);
			}


				//TitleDisplay60
				$TitleDisplay60 = $xml->createElement('md:TitleDisplay60',$_POST[$Titulo60Actual]);
				$TitleDisplay60 = $Localized->appendChild($TitleDisplay60);
				//TitleDisplayUnlimited
				$TitleDisplayUnlimited = $xml->createElement('md:TitleDisplayUnlimited',$_POST[$TituloActual]);
				$TitleDisplayUnlimited = $Localized->appendChild($TitleDisplayUnlimited);
				//TitleShort
				$TitleSort = $xml->createElement('md:TitleSort',$_POST[$TituloCortoActual]);
				$TitleSort = $Localized->appendChild($TitleSort);
				//ArtReference
				$ArtReference = $xml->createElement('md:ArtReference',$_POST[$ImagenActual]);
				$ArtReference = $Localized->appendChild($ArtReference);
					//Resolution
					$Attrib_resolution = $xml->createAttribute('resolution');
					$Attrib_resolution->value = '1920x2560';
					$ArtReference->appendChild($Attrib_resolution);
					//Resolution
					$Attrib_purpose = $xml->createAttribute('purpose');
					$Attrib_purpose->value = 'boxart';
					$ArtReference->appendChild($Attrib_purpose);
				//Summary190
				$Summary190 = $xml->createElement('md:Summary190',$_POST[$SipCortaActual]);
				$Summary190 = $Localized->appendChild($Summary190);				
				//Summary400
				$Summary400 = $xml->createElement('md:Summary400',$_POST[$SipRequeridaActual]);
				$Summary400 = $Localized->appendChild($Summary400);

				for ($j=1; $j <=$Generos ; $j++) { 
					$GeneroActual= 'Genero'.$j."L".$i;
					$SourceActual= 'Source'.$j."L".$i;
					$TextoActual= 'Texto'.$j."L".$i;
					
					$Genero = $xml->createElement('md:Genre',$_POST[$TextoActual]);
					$Genero = $Localized->appendChild($Genero);
						//Id del genero
						$Attrib_Genero = $xml->createAttribute('id');
						$Attrib_Genero->value = $_POST[$GeneroActual];
						$Genero->appendChild($Attrib_Genero);
						//level
						$Attrib_level = $xml->createAttribute('level');
						$Attrib_level->value = $j-1;
						$Genero->appendChild($Attrib_level);
						//source
						$Attrib_source = $xml->createAttribute('source');
						$Attrib_source->value = $_POST[$SourceActual];
						$Genero->appendChild($Attrib_source);
				}
				//OriginalTitle
				$OriginalActual= 'In_Original'.$i;
				$Original= $xml->createElement('md:OriginalTitle',$_POST[$OriginalActual]);
				$Original = $Localized->appendChild($Original);
				//Teorema
				$Copyright= 'In_Copyright'.$i;
				$Copyright= $xml->createElement('md:CopyrightLine',$_POST[$Copyright]);
				$Copyright = $Localized->appendChild($Copyright);
		}
		//ReleaseYear
		$ReleaseYear = $xml->createElement('md:ReleaseYear',$_POST['ReleaseYear']);
		$ReleaseYear = $UniqueID->appendChild($ReleaseYear);
		//ReleaseDate
		$ReleaseDate = $xml->createElement('md:ReleaseDate',$_POST['ReleaseDate']);
		$ReleaseDate = $UniqueID->appendChild($ReleaseDate);

		//ReleaseHistory
		$ReleaseHistory = $xml->createElement('md:ReleaseHistory',"");
		$ReleaseHistory = $UniqueID->appendChild($ReleaseHistory);
			//ReleaseType
			$ReleaseType = $xml->createElement('md:ReleaseType',$_POST['ReleaseType']);
			$ReleaseType = $ReleaseHistory->appendChild($ReleaseType);
			//Distr
			$DistrTerritory = $xml->createElement('md:DistrTerritory',"");
			$DistrTerritory = $ReleaseHistory->appendChild($DistrTerritory);
				//country
				$country = $xml->createElement('md:country',$_POST['Country']);
				$country = $DistrTerritory->appendChild($country);
			//mdDate
			$mdDate = $xml->createElement('md:Date',$_POST['Date']);
			$mdDate = $ReleaseHistory->appendChild($mdDate);
		

		//WorkType
		$WorkType = $xml->createElement('md:WorkType',$_POST['Tipo']);
		$WorkType = $UniqueID->appendChild($WorkType);

		//AltIdentifier
		$AltIdentifier = $xml->createElement('md:AltIdentifier', '');
		$AltIdentifier = $UniqueID->appendChild($AltIdentifier);
			//ORG
			$ORG = $xml->createElement('md:Namespace', 'ORG');
			$ORG = $AltIdentifier->appendChild($ORG);
			//Identifier
			$Identifier = $xml->createElement('md:Identifier', $_POST['ORG']);
			$Identifier = $AltIdentifier->appendChild($Identifier);
		//AltIdentifier2
		$AltIdentifier2 = $xml->createElement('md:AltIdentifier', '');
		$AltIdentifier2 = $UniqueID->appendChild($AltIdentifier2);
			//IMDB
			$IMDB = $xml->createElement('md:Namespace', 'IMDB');
			$IMDB = $AltIdentifier2->appendChild($IMDB);
			//Identifier
			$Identifier2 = $xml->createElement('md:Identifier', $_POST['IMBD']);
			$Identifier2 = $AltIdentifier2->appendChild($Identifier2);


		if ($Rating === "SI") {
			$RatingSet = $xml->createElement('md:RatingSet',"");
			$RatingSet = $UniqueID->appendChild($RatingSet);
				//mdRating
				$mdRating = $xml->createElement('md:Rating',"");
				$mdRating = $RatingSet->appendChild($mdRating);
					//Region
					$Region = $xml->createElement('md:Region',"");
					$Region = $mdRating->appendChild($Region);
						//mdCountry
						$mdCountry = $xml->createElement('md:country',$_POST['RatingCountry']);
						$mdCountry = $Region->appendChild($mdCountry);
					//mdCountry
					$mdSystem = $xml->createElement('md:System',$_POST['System']);
					$mdSystem = $mdRating->appendChild($mdSystem);
					//mdCountry
					$mdValue = $xml->createElement('md:Value',$_POST['Value']);
					$mdValue = $mdRating->appendChild($mdValue);
		}else{
			//RatingSet
			$RatingSet = $xml->createElement('md:RatingSet',"");
			$RatingSet = $UniqueID->appendChild($RatingSet);
				//notrated
				$notrated = $xml->createElement('md:notrated',"true");
				$notrated = $RatingSet->appendChild($notrated);
		}

		//--------*ACTORES*---------------
		for ($i=1; $i <=$Actores ; $i++) {
			//People
			$People = $xml->createElement('md:People',"");
			$People = $UniqueID->appendChild($People);
				//Job
				$Job = $xml->createElement('md:Job',"");
				$Job = $People->appendChild($Job);
					//JobFunction
					$JobFunction = $xml->createElement('md:JobFunction',"Actor");
					$JobFunction = $Job->appendChild($JobFunction);
					//BillingBlock
					$BillingBlock = $xml->createElement('md:BillingBlockOrder',$i);
					$BillingBlock = $Job->appendChild($BillingBlock);
				//Name
				$Name = $xml->createElement('md:Name',"");
				$Name = $People->appendChild($Name);
				for ($j=1; $j <=$Generos ; $j++) { 
					$ActorActual= 'Actor'.$i.$j;
					$LenguajeActual= 'In_Lenguaje'.$j;
					$Actor = $xml->createElement('md:DisplayName',$_POST[$ActorActual]);
					$Actor = $Name->appendChild($Actor);
					$Attrib_Actor = $xml->createAttribute('language');
					$Attrib_Actor->value = $_POST[$LenguajeActual];
					$Actor->appendChild($Attrib_Actor);
				}
		}
		//--------*DIRECTORES*---------------
		for ($i=1; $i <=$Directores ; $i++) {
			//People
			$People = $xml->createElement('md:People',"");
			$People = $UniqueID->appendChild($People);
				//Job
				$Job = $xml->createElement('md:Job',"");
				$Job = $People->appendChild($Job);
					//JobFunction
					$JobFunction = $xml->createElement('md:JobFunction',"Director");
					$JobFunction = $Job->appendChild($JobFunction);
					//BillingBlock
					$BillingBlock = $xml->createElement('md:BillingBlockOrder',$i);
					$BillingBlock = $Job->appendChild($BillingBlock);
				//Name
				$Name = $xml->createElement('md:Name',"");
				$Name = $People->appendChild($Name);
				for ($j=1; $j <=$Generos ; $j++) { 
					$ActorActual= 'Director'.$i.$j;
					$LenguajeActual= 'In_Lenguaje'.$j;
					$Actor = $xml->createElement('md:DisplayName',$_POST[$ActorActual]);
					$Actor = $Name->appendChild($Actor);
					$Attrib_Actor = $xml->createAttribute('language');
					$Attrib_Actor->value = $_POST[$LenguajeActual];
					$Actor->appendChild($Attrib_Actor);
				}
		}
		//--------*PRODUCTORES*---------------
		for ($i=1; $i <=$Productores ; $i++) {
			//People
			$People = $xml->createElement('md:People',"");
			$People = $UniqueID->appendChild($People);
				//Job
				$Job = $xml->createElement('md:Job',"");
				$Job = $People->appendChild($Job);
					//JobFunction
					$JobFunction = $xml->createElement('md:JobFunction',"Producer");
					$JobFunction = $Job->appendChild($JobFunction);
					//BillingBlock
					$BillingBlock = $xml->createElement('md:BillingBlockOrder',$i);
					$BillingBlock = $Job->appendChild($BillingBlock);
				//Name
				$Name = $xml->createElement('md:Name',"");
				$Name = $People->appendChild($Name);
				for ($j=1; $j <=$Generos ; $j++) { 
					$ActorActual= 'Productor'.$i.$j;
					$LenguajeActual= 'In_Lenguaje'.$j;
					$Actor = $xml->createElement('md:DisplayName',$_POST[$ActorActual]);
					$Actor = $Name->appendChild($Actor);
					$Attrib_Actor = $xml->createAttribute('language');
					$Attrib_Actor->value = $_POST[$LenguajeActual];
					$Actor->appendChild($Attrib_Actor);
				}
		}
		//--------*ESCRITOR*---------------
		for ($i=1; $i <=$Escritores ; $i++) {
			//People
			$People = $xml->createElement('md:People',"");
			$People = $UniqueID->appendChild($People);
				//Job
				$Job = $xml->createElement('md:Job',"");
				$Job = $People->appendChild($Job);
					//JobFunction
					$JobFunction = $xml->createElement('md:JobFunction',"Writer");
					$JobFunction = $Job->appendChild($JobFunction);
					//BillingBlock
					$BillingBlock = $xml->createElement('md:BillingBlockOrder',$i);
					$BillingBlock = $Job->appendChild($BillingBlock);
				//Name
				$Name = $xml->createElement('md:Name',"");
				$Name = $People->appendChild($Name);
				for ($j=1; $j <=$Generos ; $j++) { 
					$ActorActual= 'Escritor'.$i.$j;
					$LenguajeActual= 'In_Lenguaje'.$j;
					$Actor = $xml->createElement('md:DisplayName',$_POST[$ActorActual]);
					$Actor = $Name->appendChild($Actor);
					$Attrib_Actor = $xml->createAttribute('language');
					$Attrib_Actor->value = $_POST[$LenguajeActual];
					$Actor->appendChild($Attrib_Actor);
				}
		}



		//Original_Language
		$Original_Language = $xml->createElement('md:OriginalLanguage',$LenguajeOriginal);
		$Original_Language = $UniqueID->appendChild($Original_Language);
		//Associate
		$Associate = $xml->createElement('md:AssociatedOrg','');
		$Associate = $UniqueID->appendChild($Associate);
				//Attrib_Organization
				$Attrib_Organization = $xml->createAttribute('organizationID');
				$Attrib_Organization->value = $_POST['partnerAlias'];
				$Associate->appendChild($Attrib_Organization);
				//Attrib_role
				$Attrib_role = $xml->createAttribute('role');
				$Attrib_role->value = 'licensor';
				$Associate->appendChild($Attrib_role);



		//CompanyDisplayCredit
		$CompanyDisplayCredit = $xml->createElement('mdmec:CompanyDisplayCredit','');
		$CompanyDisplayCredit = $Encabezado->appendChild($CompanyDisplayCredit);
			//DisplayString
			$DisplayString = $xml->createElement('md:DisplayString', $_POST['Company']);
			$DisplayString = $CompanyDisplayCredit->appendChild($DisplayString);
				//language
				$Attrib_language= $xml->createAttribute('language');
				$Attrib_language->value = $LenguajeOriginal;
				$DisplayString->appendChild($Attrib_language);

		$xml->formatOutput = true;
		$el_xml = $xml->saveXML();
		$xml->save('libros.xml');

	

	header('Content-type: text/xml');
	header('Content-Disposition:attachment; filename= libros.xml');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header("Pragma: no-cache");
		ob_clean();
		flush();
		echo file_get_contents("libros.xml");;
		exit;
	}




























/*  GENERAR ARCHIVO MMC  */


	function crearMMC($Lenguajes){
		$Lenguajes = $Lenguajes;
		$captionDescription = '';
		$subtitleDescription = '';
		$forcedDescription = '';




		$xml = new DomDocument('1.0', 'UTF-8');

		$LenguajeSeleccionado = '';
		if (isset($_POST['Seleccion'])){
			$LenguajeSeleccionado =$_POST['Seleccion'];
		}
			

	//CoreMetadata
		$Encabezado = $xml->createElement('manifest:MediaManifest');
		$Encabezado = $xml->appendChild($Encabezado);
			//xmln
			$xmlns = $xml->createAttribute('xmlns:manifest');
			$xmlns->value = 'http://www.movielabs.com/schema/manifest/v1.5/manifest';
			$Encabezado->appendChild($xmlns);
			$xml->appendChild($Encabezado);
			//xsi
			$xsi = $xml->createAttribute('xmlns:md');
			$xsi->value = 'http://www.movielabs.com/schema/md/v2.4/md';
			$Encabezado->appendChild($xsi);
			$xml->appendChild($Encabezado);
			//xmlns
			$xmlnsmd = $xml->createAttribute('xmlns:xsi');
			$xmlnsmd->value = 'http://www.w3.org/2001/XMLSchema-instance';
			$Encabezado->appendChild($xmlnsmd);
			$xml->appendChild($Encabezado);
			//xmlns:mdmec
			$xmlnsmdmec = $xml->createAttribute('xsi:schemaLocation');
			$xmlnsmdmec->value = 'http://www.movielabs.com/schema/manifest/v1.5/manifest manifest-v1.5.xsd';
			$Encabezado->appendChild($xmlnsmdmec);
			$xml->appendChild($Encabezado);
			//ManifestID
			
			$Manifest = $xml->createAttribute('ManifestID');
			$Manifest->value = 'md:manifestid:org:'.$_POST['partnerAlias'].":".$_POST['ContentID'];
			$Encabezado->appendChild($Manifest);
			$xml->appendChild($Encabezado);



		//Compatibility
		$Compatibility = $xml->createElement('manifest:Compatibility',"");
		$Compatibility = $Encabezado->appendChild($Compatibility);
			//SpecVersion
			$SpecVersion = $xml->createElement('manifest:SpecVersion',"1.5");
			$SpecVersion = $Compatibility->appendChild($SpecVersion);
			//Profile
			$profile = $xml->createElement('manifest:Profile',"MMC-1");
			$profile = $Compatibility->appendChild($profile);

		//Lenguaje   *--------- CICLO PARA EL LENGUAJE---------*
		$LenguajeOriginal ="";
		$Seleccion = $_POST['Seleccion'];
 		for ($i=1; $i <=$Lenguajes ; $i++) { 
 			$LenguajeActual= 'In_Lenguaje'.$i;
			if ($i == $Seleccion) { 
				$LenguajeOriginal = $_POST[$LenguajeActual];
			}
		}
		echo $LenguajeOriginal;
		/*Lenguaje Seleccionado*/


		//Inventory
		$Inventory = $xml->createElement('manifest:Inventory',"");
		$Inventory = $Encabezado->appendChild($Inventory);




/*------------- 	Audio de  Pelicula	------------------------*/
		//manifestAudio
		$manifestAudio = $xml->createElement('manifest:Audio',"");
		$manifestAudio = $Inventory->appendChild($manifestAudio);
		//AudioTrackID
		$AudioTrackID = $xml->createAttribute('AudioTrackID');
		$AudioTrackID->value="md:audtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.audio.".substr($LenguajeOriginal, 0,2);
		$AudioTrackID = $manifestAudio->appendChild($AudioTrackID);
		/*Obtenemos el lenguaje ID seleccionado*/		
			//md:Type
			$Type = $xml->createElement('md:Type',$_POST['tipo_audio_2']);
			$Type = $manifestAudio->appendChild($Type);
			//md:Language
			$Language = $xml->createElement('md:Language',$LenguajeOriginal);
			$Language = $manifestAudio->appendChild($Language);
			//containerReference
			$Reference = $xml->createElement('manifest:ContainerReference',"");
			$Reference = $manifestAudio->appendChild($Reference);			
				//ContainerLocation
				$ContainerLocation = $xml->createElement('manifest:ContainerLocation',$_POST['location_audio_2']);
				$ContainerLocation = $Reference->appendChild($ContainerLocation);
				//Has
				$Has = $xml->createElement('manifest:Hash', $_POST['hash_audio_2']);
				$Has = $Reference->appendChild($Has);
				//AudioTrackID
				$methodVideo = $xml->createAttribute('method');
				$methodVideo->value="MD5";
				$methodVideo = $Has->appendChild($methodVideo);					
/*------------- 	Fin de Audio de  Pelicula	------------------------*/


/*------------- 	Audio de  Trailer	------------------------*/
		//manifestAudio
		$manifestAudio_Trailer = $xml->createElement('manifest:Audio',"");
		$manifestAudio_Trailer = $Inventory->appendChild($manifestAudio_Trailer);
		//AudioTrackID
		$AudioTrackID_Trailer = $xml->createAttribute('AudioTrackID');
		$AudioTrackID_Trailer->value="md:audtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":trailer.1.audio.".substr($LenguajeOriginal, 0,2);
		$AudioTrackID_Trailer = $manifestAudio_Trailer->appendChild($AudioTrackID_Trailer);
		/*Obtenemos el lenguaje ID seleccionado*/		
			//md:Type
			$Type_Trailer = $xml->createElement('md:Type',$_POST['tipo_audio_1']);
			$Type_Trailer = $manifestAudio_Trailer->appendChild($Type_Trailer);
			//md:Language
			$Language_Trailer = $xml->createElement('md:Language',$LenguajeOriginal);
			$Language_Trailer = $manifestAudio_Trailer->appendChild($Language_Trailer);
			//containerReference
			$Reference_Trailer = $xml->createElement('manifest:ContainerReference',"");
			$Reference_Trailer = $manifestAudio_Trailer->appendChild($Reference_Trailer);			
				//ContainerLocation
				$ContainerLocation_Trailer = $xml->createElement('manifest:ContainerLocation',$_POST['location_audio_1']);
				$ContainerLocation_Trailer = $Reference_Trailer->appendChild($ContainerLocation_Trailer);
				//Has
				$Has_Trailer = $xml->createElement('manifest:Hash', $_POST['hash_audio_1']);
				$Has_Trailer = $Reference_Trailer->appendChild($Has_Trailer);
					$methodTraile = $xml->createAttribute('method');
					$methodTraile->value="MD5";
					$methodTraile = $Has_Trailer->appendChild($methodTraile);	
/*------------- 	Fin de Audio de  Trailer	------------------------*/


/*-------------     Inicio de Video   ---------------------------------*/
		$Video_Trailer = $xml->createElement('manifest:Video',"");
		$Video_Trailer = $Inventory->appendChild($Video_Trailer);
		//TrackID
		$TrackID_Triler = $xml->createAttribute('VideoTrackID');
		$TrackID_Triler->value="md:vidtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":trailer.1.video.".substr($LenguajeOriginal, 0,2);
		$Video_Trailer->appendChild($TrackID_Triler);
			//Type
			$VideoType_Trailer = $xml->createElement('md:Type',$_POST['tipo_audio_1']);
			$VideoType_Trailer = $Video_Trailer->appendChild($VideoType_Trailer);
			//Picture
			$Picture_Trailer = $xml->createElement('md:Picture');
			$Picture_Trailer = $Video_Trailer->appendChild($Picture_Trailer);
				//Width
				$Width_Trailer = $xml->createElement('md:WidthPixels',$_POST['width_video_1']);
				$Width_Trailer = $Picture_Trailer->appendChild($Width_Trailer);
				//Height
				$Height_Trailer = $xml->createElement('md:HeightPixels',$_POST['height_video_1']);
				$Height_Trailer = $Picture_Trailer->appendChild($Height_Trailer);
				if ( $_POST['opcion_video_1'] === 'Progressive') {
					//Progresive
					$Progresive_Trailer = $xml->createElement('md:Progressive',"true");
					$Progresive_Trailer = $Picture_Trailer->appendChild($Progresive_Trailer);
				}else{
					//ProScanOrder
					$ProScanOrder_Trailer = $xml->createElement('md:Progressive',"false");
					$ProScanOrder_Trailer = $Picture_Trailer->appendChild($ProScanOrder_Trailer);
					//ScanOrder 
					$ScanOrder_Trailer = $xml->createAttribute('scanOrder');
					$ScanOrder_Trailer->value = $_POST['opcion_video_1'];
					$ProScanOrder_Trailer->appendChild($ScanOrder_Trailer);
				}
				
			
			//$ContainerRef
			$ContainerRef_Trailer = $xml->createElement('manifest:ContainerReference',"");
			$ContainerRef_Trailer = $Video_Trailer->appendChild($ContainerRef_Trailer);
				//Location
				$Location_Trailer =$xml->createElement('manifest:ContainerLocation',$_POST['location_audio_1']);
				$Location_Trailer = $ContainerRef_Trailer->appendChild($Location_Trailer);
				//manifestHash
				$manifestHash_Trailer = $xml->createElement('manifest:Hash',$_POST['hash_audio_1']);
				$manifestHash_Trailer = $ContainerRef_Trailer->appendChild($manifestHash_Trailer);
					//method 
					$method_Trailer = $xml->createAttribute('method');
					$method_Trailer->value = "MD5";
					$manifestHash_Trailer->appendChild($method_Trailer);
/* ---------  Fin de Video Trailer*/



/*-------------     Inicio de Video  Pelicula ---------------------------------*/
		$Video = $xml->createElement('manifest:Video',"");
		$Video = $Inventory->appendChild($Video);
		//TrackID
		$TrackID = $xml->createAttribute('VideoTrackID');
		$TrackID->value="md:vidtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.video.".substr($LenguajeOriginal, 0,2);
		$Video->appendChild($TrackID);
			//Type
			$VideoType = $xml->createElement('md:Type',$_POST['tipo_audio_2']);
			$VideoType = $Video->appendChild($VideoType);
			//Picture
			$Picture = $xml->createElement('md:Picture');
			$Picture = $Video->appendChild($Picture);
				//Width
				$Width = $xml->createElement('md:WidthPixels',$_POST['width_video_2']);
				$Width = $Picture->appendChild($Width);
				//Height
				$Height = $xml->createElement('md:HeightPixels',$_POST['height_video_2']);
				$Height = $Picture->appendChild($Height);
				
				if ( $_POST['opcion_video_2'] === 'Progressive') {
					//Progresive
					$Progresive = $xml->createElement('md:Progressive',"true");
					$Progresive = $Picture->appendChild($Progresive);
				}else{
					//ProScanOrder
					$ProScanOrder = $xml->createElement('md:Progressive',"false");
					$ProScanOrder = $Picture->appendChild($ProScanOrder);
					//ScanOrder 
					$ScanOrder = $xml->createAttribute('scanOrder');
					$ScanOrder->value = $_POST['opcion_video_2'];
					$ProScanOrder->appendChild($ScanOrder);
				}

				
			//$ContainerRef
			$ContainerRef = $xml->createElement('manifest:ContainerReference',"");
			$ContainerRef = $Video->appendChild($ContainerRef);
				//Location
				$Location =$xml->createElement('manifest:ContainerLocation',$_POST['location_audio_2']);
				$Location = $ContainerRef->appendChild($Location);
				//manifestHash
				$manifestHash = $xml->createElement('manifest:Hash',$_POST['hash_audio_2']);
				$manifestHash = $ContainerRef->appendChild($manifestHash);
					//method 
					$method = $xml->createAttribute('method');
					$method->value = "MD5";
					$manifestHash->appendChild($method);
/* ---------  Fin de Video Pelicula*/






		$Seleccion = $_POST['Seleccion'];








/*
	AREGLO DE DATOS PARA EL FRAME 
*/
	function Datos(){
		$FrameRat  = $_POST['FrameRateMmc'];
		switch ($FrameRat) {
					case '23.976':	
							$Valor_Frame = '24';	
						break;
					case '24':						
							$Valor_Frame = '24';
						break;
					case '25':						
							$Valor_Frame = '25';
						break;
					case '29.97 NDF':						
							$Valor_Frame = '30';
						break;
					case '29.97 DF':						
							$Valor_Frame = '30';
						break;
					case '30':						
							$Valor_Frame = '30';
						break;
					case '50':						
							$Valor_Frame = '50';				
						break;
					case '59.94 NDF':						
							$Valor_Frame = '60';
						break;
					case '59.94 DF':						
							$Valor_Frame = '60';
						break;
					case '60':
							$Valor_Frame = '60';
						break;
					
					default:
						break;
				}
			return $Valor_Frame;
	}
/*
	function Multiplicador(){
		$FrameRat  = $_POST['FrameRateMmc'];
			switch ($FrameRat) {
					case '23.976':	
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);		

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);					
						break;
					case '24':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '25':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '29.97 NDF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '29.97 DF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'Drop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '30':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '50':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '59.94 NDF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '59.94 DF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'Drop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '60':
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);						
						break;
					
					default:
						break;
				}

	}
*/
/* FIN DE AREGLO DE DATOS PARA EL FRAME*/

/*   -----------    INICIO DE ARCHIVOS      ----------------*/

/*   Caption */
		for ($i=1; $i <=$Lenguajes ; $i++) { 
				$LenguajeActual= 'In_Lenguaje'.$i;
 				$SubtitleTy= 'CaptionType'.$i;				
				$SubtitleLocation= 'CaptionLocation'.$i;
				$SubtitleHash= 'CaptionHash'.$i;
			
				$FrameRat  = $_POST['FrameRateMmc'];
				$Valor_Frame = Datos();
								

				$manifestSub = $xml->createElement('manifest:Subtitle',"");
				$manifestSub = $Inventory->appendChild($manifestSub);
				$Attrib_manifest = $xml->createAttribute('SubtitleTrackID');
				$Attrib_manifest->value = "md:subtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.caption.".substr($_POST[$LenguajeActual], 0,2);
				$manifestSub->appendChild($Attrib_manifest);

					$type = $xml->createElement('md:Type', $_POST[$SubtitleTy]);
					$type = $manifestSub->appendChild($type);
					
					$mdLanguage = $xml->createElement('md:Language',$_POST[$LenguajeActual]);
					$mdLanguage = $manifestSub->appendChild($mdLanguage);

					$Encoding = $xml->createElement('md:Encoding',"");
					$Encoding = $manifestSub->appendChild($Encoding);
						$frameRate = $xml->createElement('md:FrameRate',$Valor_Frame);
						$frameRate = $Encoding->appendChild($frameRate);
							
						$FrameRat  = $_POST['FrameRateMmc'];
			switch ($FrameRat) {
					case '23.976':	
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);		

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);					
						break;
					case '24':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '25':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '29.97 NDF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '29.97 DF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'Drop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '30':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '50':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '59.94 NDF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '59.94 DF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'Drop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '60':
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);						
						break;
					
					default:
						break;
				}






					$ContainerRef = $xml->createElement('manifest:ContainerReference',"");
					$ContainerRef = $manifestSub->appendChild($ContainerRef);
						$ContainerLocation = $xml->createElement('manifest:ContainerLocation', $_POST[$SubtitleLocation] );
						$ContainerLocation = $ContainerRef->appendChild($ContainerLocation);
						$ContainerHash = $xml->createElement('manifest:Hash',$_POST[$SubtitleHash]);
						$ContainerHash = $ContainerRef->appendChild($ContainerHash);
							$has = $xml->createAttribute('method');
							$has->value = 'MD5';
							$ContainerHash->appendChild($has);
		}
/*  Fin de Caption*/
/*   Subtitle */
		for ($i=1; $i <=$Lenguajes ; $i++) { 
				$LenguajeActual= 'In_Lenguaje'.$i;
 				$SubtitleTy= 'SubtitleTypeS'.$i;				
				$SubtitleLocation= 'SubtitleLocationS'.$i;
				$SubtitleHash= 'SubtitleHashS'.$i;
			

				$FrameRat  = $_POST['FrameRateMmc'];

				$Valor_Frame = Datos();
				
				$manifestSub = $xml->createElement('manifest:Subtitle',"");
				$manifestSub = $Inventory->appendChild($manifestSub);
				$Attrib_manifest = $xml->createAttribute('SubtitleTrackID');
				$Attrib_manifest->value = "md:subtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.subtitle.".substr($_POST[$LenguajeActual], 0,2);				
				$manifestSub->appendChild($Attrib_manifest);

					$type = $xml->createElement('md:Type', $_POST[$SubtitleTy]);
					$type = $manifestSub->appendChild($type);
					
					$mdLanguage = $xml->createElement('md:Language',$_POST[$LenguajeActual]);
					$mdLanguage = $manifestSub->appendChild($mdLanguage);

					$Encoding = $xml->createElement('md:Encoding',"");
					$Encoding = $manifestSub->appendChild($Encoding);
						$frameRate = $xml->createElement('md:FrameRate',$Valor_Frame);
						$frameRate = $Encoding->appendChild($frameRate);
							

							$FrameRat  = $_POST['FrameRateMmc'];
			switch ($FrameRat) {
					case '23.976':	
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);		

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);					
						break;
					case '24':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '25':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '29.97 NDF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '29.97 DF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'Drop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '30':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '50':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '59.94 NDF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '59.94 DF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'Drop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '60':
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);						
						break;
					
					default:
						break;
				}



					$ContainerRef = $xml->createElement('manifest:ContainerReference',"");
					$ContainerRef = $manifestSub->appendChild($ContainerRef);
						$ContainerLocation = $xml->createElement('manifest:ContainerLocation', $_POST[$SubtitleLocation] );
						$ContainerLocation = $ContainerRef->appendChild($ContainerLocation);
						$ContainerHash = $xml->createElement('manifest:Hash',$_POST[$SubtitleHash]);
						$ContainerHash = $ContainerRef->appendChild($ContainerHash);
							$has = $xml->createAttribute('method');
							$has->value = 'MD5';
							$ContainerHash->appendChild($has);
		}
/*  Fin de Subtitle*/
		






	$LenguajePrincipal= 'In_Lenguaje'.$LenguajeSeleccionado;





/*   Forced */
		for ($i=1; $i <=$Lenguajes ; $i++) { 
			if ($i!=$LenguajeSeleccionado){
				$LenguajeActual= 'In_Lenguaje'.$i;
 				$SubtitleTy= 'SubtitleTypeF'.$i;				
				$SubtitleLocation= 'SubtitleLocationF'.$i;
				$SubtitleHash= 'SubtitleHashF'.$i;
			

				$FrameRat  = $_POST['FrameRateMmc'];

				$Valor_Frame = Datos();


				$manifestSub = $xml->createElement('manifest:Subtitle',"");
				$manifestSub = $Inventory->appendChild($manifestSub);
				$Attrib_manifest = $xml->createAttribute('SubtitleTrackID');
				$Attrib_manifest->value = "md:subtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.forced.".substr($_POST[$LenguajeActual], 0,2);
				$forcedDescription = $forcedDescription +"<*-*>"+"md:subtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.forced.".substr($_POST[$LenguajeActual], 0,2);

				$manifestSub->appendChild($Attrib_manifest);

					$type = $xml->createElement('md:Type', $_POST[$SubtitleTy]);
					$type = $manifestSub->appendChild($type);
					
					$mdLanguage = $xml->createElement('md:Language',$_POST[$LenguajeActual]);
					$mdLanguage = $manifestSub->appendChild($mdLanguage);

					$Encoding = $xml->createElement('md:Encoding',"");
					$Encoding = $manifestSub->appendChild($Encoding);
						$frameRate = $xml->createElement('md:FrameRate',$Valor_Frame);
						$frameRate = $Encoding->appendChild($frameRate);
							
							$FrameRat  = $_POST['FrameRateMmc'];
			switch ($FrameRat) {
					case '23.976':	
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);		

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);					
						break;
					case '24':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '25':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '29.97 NDF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '29.97 DF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'Drop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '30':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '50':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);
						break;
					case '59.94 NDF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '59.94 DF':						
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'Drop';
							$frameRate->appendChild($timecode);

							$multiplier = $xml->createAttribute('multiplier');
							$multiplier->value = '1000/1001';
							$frameRate->appendChild($multiplier);
						break;
					case '60':
							$timecode = $xml->createAttribute('timecode');
							$timecode->value = 'NonDrop';
							$frameRate->appendChild($timecode);						
						break;
					
					default:
						break;
				}


					$ContainerRef = $xml->createElement('manifest:ContainerReference',"");
					$ContainerRef = $manifestSub->appendChild($ContainerRef);
						$ContainerLocation = $xml->createElement('manifest:ContainerLocation', $_POST[$SubtitleLocation] );
						$ContainerLocation = $ContainerRef->appendChild($ContainerLocation);
						$ContainerHash = $xml->createElement('manifest:Hash',$_POST[$SubtitleHash]);
						$ContainerHash = $ContainerRef->appendChild($ContainerHash);
							$has = $xml->createAttribute('method');
							$has->value = 'MD5';
							$ContainerHash->appendChild($has);
			}
		}
/*  Fin de Forced*/

































/*-------------- Inicio de Metadata   ---------------*/
	//Metadata Trailer
	$Metadata_Trailer = $xml->createElement('manifest:Metadata',"");
	$Metadata_Trailer = $Inventory->appendChild($Metadata_Trailer);
		//ContentId
		$ContentId_Metadata_Trailer = $xml->createAttribute('ContentID');
		$ContentId_Metadata_Trailer->value="md:cid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'];
		$ContentId_Metadata_Trailer = $Metadata_Trailer->appendChild($ContentId_Metadata_Trailer);

		//ContainerReference
		$ContainerReference_Metadata_Trailer = $xml->createElement('manifest:ContainerReference',"");
		$ContainerReference_Metadata_Trailer = $Metadata_Trailer->appendChild($ContainerReference_Metadata_Trailer);
			//ContainerLocation
			$ContainerLocation_Metadata_Trailer = $xml->createElement('manifest:ContainerLocation',$_POST['location']);
			$ContainerLocation_Metadata_Trailer = $ContainerReference_Metadata_Trailer->appendChild($ContainerLocation_Metadata_Trailer);
	//Metadata Pelicula
	$Metadata = $xml->createElement('manifest:Metadata',"");
	$Metadata = $Inventory->appendChild($Metadata);
		//ContentId
		$ContentId_Metadata = $xml->createAttribute('ContentID');
		$ContentId_Metadata->value="md:cid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":trailer.1";
		$ContentId_Metadata = $Metadata->appendChild($ContentId_Metadata);

		//ContainerReference
		$ContainerReference_Metadata = $xml->createElement('manifest:ContainerReference',"");
		$ContainerReference_Metadata = $Metadata->appendChild($ContainerReference_Metadata);
			//ContainerLocation
			$Container_Location_Metadata = $xml->createElement('manifest:ContainerLocation', $_POST['location']);
			$Container_Location_Metadata = $ContainerReference_Metadata->appendChild($Container_Location_Metadata);
/*-------------- Fin de Metadata  -------------------*/



		$selection_number = $_POST['selection_number'];

















		
/*------------- Inicio de Presentacion ------------------------*/
		//Presentations
		$Presentation = $xml->createElement('manifest:Presentations',"");
		$Presentation = $Inventory->appendChild($Presentation);
		//Presentation /* PELICULA */
			//PresentationID
		$Parnet_Content  = $_POST['partnerAlias'].":".$_POST['ContentID'];
			$PresentId = $xml->createAttribute('PresentationID');
			$PresentId->value="md:presentationid:org:".$Parnet_Content.":feature.presentation";
			$Presentation->appendChild($PresentId);

				$TrackMetadata = $xml->createElement('manifest:TrackMetadata',"");
				$TrackMetadata = $Presentation->appendChild($TrackMetadata);
					//TrackSelection
					$TrackSelection  =$xml->createElement('manifest:TrackSelectionNumber','0');
					$TrackSelection = $TrackMetadata->appendChild($TrackSelection);
					//VideoTrackReference
					$VideoTrackReference = $xml->createElement('manifest:VideoTrackReference',"");
					$VideoTrackReference= $TrackMetadata->appendChild($VideoTrackReference);
					//VideoTrackID
						$VideoTrackID = $xml->createElement('manifest:VideoTrackID',"md:vidtrackid:org:".$Parnet_Content.":feature.video.".substr($_POST[$LenguajePrincipal], 0,2));
						$VideoTrackID = $VideoTrackReference->appendChild($VideoTrackID);
					//AudioTrackReference
					$AudioTrackReference = $xml->createElement('manifest:AudioTrackReference',"");
					$AudioTrackReference= $TrackMetadata->appendChild($AudioTrackReference);
						//AudioTrackID
						$AudioTrackID = $xml->createElement('manifest:AudioTrackID',"md:audtrackid:org:".$Parnet_Content.":feature.audio.".substr($_POST[$LenguajePrincipal], 0,2));
						$AudioTrackID = $AudioTrackReference->appendChild($AudioTrackID);
					
					/////////////////////Subtitle Reference /////////////////////
					


					for ($i=1; $i <=$Lenguajes ; $i++) { 
						$LenguajeActual= 'In_Lenguaje'.$i; 										
					$SubtitleTrackReference = $xml->createElement('manifest:SubtitleTrackReference',"");
					$SubtitleTrackReference= $TrackMetadata->appendChild($SubtitleTrackReference);
						//AudioTrackID
						$SubtitleTrackID = $xml->createElement('manifest:SubtitleTrackID',"md:subtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.caption.".substr($_POST[$LenguajeActual], 0,2));
						$SubtitleTrackID = $SubtitleTrackReference->appendChild($SubtitleTrackID);		
					}


					for ($i=1; $i <=$Lenguajes ; $i++) { 
					$LenguajeActual= 'In_Lenguaje'.$i;
					$SubtitleTrackReference = $xml->createElement('manifest:SubtitleTrackReference',"");
					$SubtitleTrackReference= $TrackMetadata->appendChild($SubtitleTrackReference);
						//AudioTrackID
						$SubtitleTrackID = $xml->createElement('manifest:SubtitleTrackID',"md:subtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.subtitle.".substr($_POST[$LenguajeActual], 0,2));
						$SubtitleTrackID = $SubtitleTrackReference->appendChild($SubtitleTrackID);
					}

					for ($i=1; $i <=$Lenguajes ; $i++) { 
 						if ($i!=$LenguajeSeleccionado){
 							$LenguajeActual= 'In_Lenguaje'.$i;
          					$SubtitleTrackReference = $xml->createElement('manifest:SubtitleTrackReference',"");
          					$SubtitleTrackReference= $TrackMetadata->appendChild($SubtitleTrackReference);
				            //AudioTrackID
            				$SubtitleTrackID = $xml->createElement('manifest:SubtitleTrackID',"md:subtrackid:org:".$_POST['partnerAlias'].":".$_POST['ContentID'].":feature.forced.".substr($_POST[$LenguajeActual], 0,2));
            				$SubtitleTrackID = $SubtitleTrackReference->appendChild($SubtitleTrackID);
          				}
      				}


/* ----------------------- Fin de la Presentacion --------------*/
/* ----------------------  TRAILER PRESENTATION ------*/
		$Presentations_Trailer = $xml->createElement('manifest:Presentation',"");
		$Presentations_Trailer = $Inventory->appendChild($Presentations_Trailer);
			//Presentation Id Trailer
			$PresentationID_Trailer = $xml->createAttribute('PresentationID');
			$PresentationID_Trailer->value="md:subtrackid:org:".$Parnet_Content.":trailer.1.video.".substr($_POST[$LenguajePrincipal], 0,2);
			$Presentations_Trailer->appendChild($PresentationID_Trailer);


			//TrackMetadata
			$TrackMetadata_Trailer = $xml->createElement('manifest:TrackMetadata',"");
			$TrackMetadata_Trailer = $Presentations_Trailer->appendChild($TrackMetadata_Trailer);

				//TrackSelectionNumber
				$TrackSelectionNumber_Trailer=$xml->createElement('manifest:TrackSelectionNumber','0');
				$TrackSelectionNumber_Trailer = $TrackMetadata_Trailer->appendChild($TrackSelectionNumber_Trailer);

				//VideoTrackReference
				$TrackReference_Trailer = $xml->createElement('manifest:VideoTrackReference',"");
				$TrackReference_Trailer = $TrackMetadata_Trailer->appendChild($TrackReference_Trailer);
					//VideoTrackID
					$VideoTrackID_Trailer = $xml->createElement('manifest:VideoTrackID',"md:vidtrackid:org:".$Parnet_Content.":trailer.1.video.".substr($_POST[$LenguajePrincipal], 0,2));
					$VideoTrackID_Trailer = $TrackReference_Trailer->appendChild($VideoTrackID_Trailer);

				//AudioTrackReference
				$AudioTrackReference_Trailer = $xml->createElement('manifest:AudioTrackReference',"");
				$AudioTrackReference_Trailer = $TrackMetadata_Trailer->appendChild($AudioTrackReference_Trailer);
					//VideoTrackID
					$AudioTrackID_Trailer = $xml->createElement('manifest:AudioTrackID',"md:audtrackid:org:".$Parnet_Content.":trailer.1.audio.".substr($_POST[$LenguajePrincipal], 0,2));
					$AudioTrackID_Trailer = $AudioTrackReference_Trailer->appendChild($AudioTrackID_Trailer);
				
/* ---------------------- Presentacion deTrailer    ---------*/
/*Fin de Presentacion de trailer*/

 				//Trailer Presentation
/*  -------------------------Manifest Experiences  --------*/ 
			$Manifest_Experiences = $xml->createElement('manifest:Experiences',"");
			$Manifest_Experiences = $Inventory->appendChild($Manifest_Experiences);
				//SubManifest_Experience
				$Manifest_Experience = $xml->createElement('manifest:Experience',"");
				$Manifest_Experience = $Manifest_Experiences->appendChild($Manifest_Experience);
				 	//ExperienceID
					$ExperienceID = $xml->createAttribute('ExperienceID');
				$ExperienceID->value = "md:experienceid:org:"."";
					$Manifest_Experience->appendChild($ExperienceID);
				//ManifestContentID
				$ManifestContentID = $xml->createElement('manifest:ContentID',"md:cid:org:");
				$ManifestContentID = $Manifest_Experiences->appendChild($ManifestContentID);
				//ManifestAudiovisual
				$ManifestAudiovisual = $xml->createElement('manifest:Audiovisual',"");
				$ManifestAudiovisual = $Manifest_Experience->appendChild($ManifestAudiovisual);
					//AudiovisualContentID
					$ContentID_Audio = $xml->createAttribute('ContentID');
					$ContentID_Audio->value="md:cid:org:videocine";
					$ManifestAudiovisual->appendChild($ContentID_Audio);

					//ManifestType
					$ManifestType = $xml->createElement('manifest:Type',"Main");
					$ManifestType = $ManifestAudiovisual->appendChild($ManifestType);
					//ManifestSubType
					$ManifestSubType = $xml->createElement('manifest:SubType',"Feature");
					$ManifestSubType = $ManifestAudiovisual->appendChild($ManifestSubType);
					//PresentationID
					$PresentationID = $xml->createElement('manifest:PresentationID',"md:experience");
					$PresentationID = $ManifestAudiovisual->appendChild($PresentationID);

				//ExperienceChild
				$ExperienceChild = $xml->createElement('manifest:ExperienceChild',"");
				$ExperienceChild = $Manifest_Experience->appendChild($ExperienceChild);
					//RelationShip
					$RelationShip = $xml->createElement('manifest:RelationShip',"ispromotionfor");
					$RelationShip = $ExperienceChild->appendChild($RelationShip);
					//ExperienceID_Child
					$ExperienceID_Child = $xml->createElement('manifest:ExperienceID',"md:experienceid");
					$ExperienceID_Child = $ExperienceChild->appendChild($ExperienceID_Child);

				//ManifesExperience2
				$ManifesExperience2 = $xml->createElement('manifest:Experience',"");
				$ManifesExperience2 = $Manifest_Experiences->appendChild($ManifesExperience2);
					//ExperienceID2
					$ExperienceID2 = $xml->createAttribute('ExperienceID');
					$ExperienceID2->value="md:experienceid:org";
					$ManifesExperience2->appendChild($ExperienceID2);

					//ContentID2
					$ContentID2 = $xml->createElement('manifest:ContentID',"md:cid:org");
					$ContentID2 = $ManifesExperience2->appendChild($ContentID2); 
					//Audiovisual2
					$Audiovisual2 = $xml->createElement('manifest:Audiovisual',"");
					$Audiovisual2 = $ManifesExperience2->appendChild($Audiovisual2);
						//ContentID_2
						$ContentID2 = $xml->createAttribute('ContentID');
						$ContentID2->value="md:cid:org";
						$Audiovisual2->appendChild($ContentID2);

						//Type2
						$Type2 = $xml->createElement('manifest:Type',"Promotion");
						$Type2 = $Audiovisual2->appendChild($Type2);
						//SubType2
						$SubType2 = $xml->createElement('manifest:SubType',"Default Trailer");
						$SubType2 = $Audiovisual2->appendChild($SubType2);
						//ManifestPresentation2
						$ManifestPresentation2 = $xml->createElement('manifest:PresentationID',"md:presentationid:org:");
						$ManifestPresentation2 = $Audiovisual2->appendChild($ManifestPresentation2);
						




				//ALIDE
				$ALIDEs = $xml->createElement('manifest:ALIDEExperienceMaps',"");
				$ALIDEs = $Encabezado->appendChild($ALIDEs);

				//ALIDE
				$ALIDE = $xml->createElement('manifest:ALIDEExperienceMap',"");
				$ALIDE = $ALIDEs->appendChild($ALIDE);
					//ALID
					$ALID = $xml->createElement('manifest:ALID',"md:ALID:org");
					$ALID = $ALIDE->appendChild($ALID);
					//ExperienceALID
					$ExperienceALID = $xml->createElement('manifest:ExperienceID',"md:experienceid");
					$ExperienceALID = $ALIDE->appendChild($ExperienceALID);

				





		$xml->formatOutput = true;
		$el_xml = $xml->saveXML();
		$xml->save('libros.xml');

	

	header('Content-type: text/xml');
	header('Content-Disposition:attachment; filename= libros.xml');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header("Pragma: no-cache");
		ob_clean();
		flush();
		echo file_get_contents("libros.xml");;
		exit;
	}




?>

	