<x-app-layout>
    <head>
        <title>Visualizar Polígono en el Mapa</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <style>
            #map { height: 2500px; }
            .center {
text-align: center;
font-family: Arial, sans-serif;
font-size: 9pt;
}
        </style>
    </head>
    <body>

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Mapas unidades
                </div>
            </div>
            <div class="card-body">
                
                <div class="row ">
                    <div class="col-md-6">
                        <div id="map"></div>
                    </div>
                    <div class="col-md-2" >
                        <center>
                            <b >
                            Ordinario<br>Ojo de agua<br>Ciudad azteca
                            </b>
                        <table style="border:1px black solid; ">
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ojo De Agua </td><td  style=""><img src="{{url('/assets/img/ojo_agua.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="94"  width="30px;"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="25"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="24"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="23"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="22"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Esmeralda  </td><td  style=""><img src="{{url('/assets/img/esmeralda.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="21"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="20"></td></tr>     
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="19"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Cuauhtémoc Norte </td><td  style=""><img src="{{url('/assets/img/cuau_nor.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="18"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="17"></td></tr>    
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="16"></td></tr>  
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="15"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Cuauhtémoc Sur  </td><td  style=""><img src="{{url('/assets/img/cuau_sur.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="14"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="13"></td></tr>  
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hidalgo  </td><td  style=""><img src="{{url('/assets/img/hidalgo.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="12"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="11"></td></tr> 
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="10"></td></tr>  
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="9"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="8"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="7"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Torres </td><td  style=""><img src="{{url('/assets/img/insurgentes.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="6"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="5"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="4"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="3"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="2"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Central De Abasto </td><td  style=""><img src="{{url('/assets/img/central_abastos.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="1"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="26"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="27"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="28"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="29"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> 19 De Septiembre </td><td  style=""><img src="{{url('/assets/img/19_sep.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="30"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="31"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="32"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="33"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Palomas </td><td  style=""><img src="{{url('/assets/img/palomas.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="34"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="35"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="36"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="37"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="38"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Jardines De Morelos  </td><td  style=""><img src="{{url('/assets/img/jardines.ico')}}" width="30px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="39"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="40"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="41"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Aquiles Serdán  </td><td  style=""><img src="{{url('/assets/img/aquiles_cerdan.ico')}}" width="30px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="42"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="43"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="44"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hospital Las Américas </td><td  style=""><img src="{{url('/assets/img/hospital.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="45"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="46"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="47"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="48"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Primero De Mayo </td><td  style=""><img src="{{url('/assets/img/1_mayo.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="49"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="50"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="51"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="52"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Américas </td><td  style=""><img src="{{url('/assets/img/las_americas.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="53"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="54"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="55"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="56"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="57"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="58"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Valle De Ecatepec  </td><td  style=""><img src="{{url('/assets/img/valle_ecatepec.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="59"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="60"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="61"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> Vocacional 3 </td><td  style=""><img src="{{url('/assets/img/vocacional.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="62"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="63"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Adolfo López Mateos </td><td  style=""><img src="{{url('/assets/img/adolfo_lopez.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="64"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="65"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="66"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Zodiaco </td><td  style=""><img src="{{url('/assets/img/zodiaco.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="67"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="68"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="69"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="70"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Torres </td><td  style=""><img src="{{url('/assets/img/torres.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="71"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="72"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="73"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Unitec </td><td  style=""><img src="{{url('/assets/img/unitec.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="74"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="75"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="76"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="77"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Industrial </td><td  style=""><img src="{{url('/assets/img/industrial.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="78"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="79"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="80"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="81"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Josefa Ortíz</td><td  style=""><img src="{{url('/assets/img/josefa.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="82"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="83"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="84"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="85"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="86"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="87"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="88"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Quinto Sol</td><td  style=""><img src="{{url('/assets/img/quinto_sol.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="89"></td></tr> 
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="90"></td></tr>                            
			<tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="91"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td ><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="92"></td></tr>
<tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ciudad Azteca</td><td ><img src="{{url('/assets/img/ico_cdazteca.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="93"></td></tr>
                        </table>
                        
                        </center>

                    </div>
                    <div class="col-md-2">
                    <center>
                            <b >
                            Express<br>Ojo de agua<br>Ciudad azteca
                            </b>
                        <table style="border:1px black solid; ">
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ojo De Agua </td><td  style=""><img src="{{url('/assets/img/ojo_agua.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="94"  width="30px;"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="25"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="24"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="23"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="22"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Esmeralda  </td><td  style=""><img src="{{url('/assets/img/esmeralda.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="21"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="20"></td></tr>     
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="19"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Cuauhtémoc Norte </td><td  style=""><img src="{{url('/assets/img/cuau_nor.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="18"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="17"></td></tr>    
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="16"></td></tr>  
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="15"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Cuauhtémoc Sur  </td><td  style=""><img src="{{url('/assets/img/cuau_sur.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="14"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="13"></td></tr>  
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hidalgo  </td><td  style=""><img src="{{url('/assets/img/hidalgo.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="12"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="11"></td></tr> 
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="10"></td></tr>  
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="9"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="8"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="7"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Torres </td><td  style=""><img src="{{url('/assets/img/insurgentes.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="6"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="5"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="4"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="3"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="2"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Central De Abasto </td><td  style=""><img src="{{url('/assets/img/central_abastos.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="1"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="26"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="27"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="28"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="29"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> 19 De Septiembre </td><td  style=""><img src="{{url('/assets/img/19_sep.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="30"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="31"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="32"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="33"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Palomas </td><td  style=""><img src="{{url('/assets/img/palomas.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="34"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="35"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="36"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="37"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="38"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Jardines De Morelos  </td><td  style=""><img src="{{url('/assets/img/jardines.ico')}}" width="30px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="39"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="40"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="41"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Aquiles Serdán  </td><td  style=""><img src="{{url('/assets/img/aquiles_cerdan.ico')}}" width="30px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="42"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="43"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="44"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hospital Las Américas </td><td  style=""><img src="{{url('/assets/img/hospital.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="45"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="46"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="47"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="48"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Primero De Mayo </td><td  style=""><img src="{{url('/assets/img/1_mayo.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="49"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="50"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="51"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="52"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Américas </td><td  style=""><img src="{{url('/assets/img/las_americas.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="53"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="54"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="55"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="56"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="57"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="58"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Valle De Ecatepec  </td><td  style=""><img src="{{url('/assets/img/valle_ecatepec.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="59"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="60"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="61"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> Vocacional 3 </td><td  style=""><img src="{{url('/assets/img/vocacional.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="62"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="63"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Adolfo López Mateos </td><td  style=""><img src="{{url('/assets/img/adolfo_lopez.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="64"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="65"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="66"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Zodiaco </td><td  style=""><img src="{{url('/assets/img/zodiaco.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="67"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="68"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="69"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="70"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Torres </td><td  style=""><img src="{{url('/assets/img/torres.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="71"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="72"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="73"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Unitec </td><td  style=""><img src="{{url('/assets/img/unitec.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="74"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="75"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="76"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="77"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Industrial </td><td  style=""><img src="{{url('/assets/img/industrial.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="78"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="79"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="80"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="81"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Josefa Ortíz</td><td  style=""><img src="{{url('/assets/img/josefa.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="82"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="83"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="84"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="85"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="86"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="87"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="88"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Quinto Sol</td><td  style=""><img src="{{url('/assets/img/quinto_sol.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="89"></td></tr> 
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="90"></td></tr>                            
			<tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="91"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td ><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="92"></td></tr>
<tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ciudad Azteca</td><td ><img src="{{url('/assets/img/ico_cdazteca.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="93"></td></tr>
                        </table>
                        
                        </center>
                    </div>
                    <div class="col-md-2" >
                        <center>
                            <b >
                            Express<br>Central de abastos<br>Ciudad azteca
                            </b>
                        <table style="border:1px black solid; ">
                           <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Central De Abasto </td><td  style=""><img src="{{url('/assets/img/central_abastos.ico')}}" width="30px;"></td><td  width="30px;" style="border-top:1px black solid; border-bottom:1px black solid;"  id="1"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="26"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="27"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="28"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="29"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> 19 De Septiembre </td><td  style=""><img src="{{url('/assets/img/19_sep.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="30"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="31"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="32"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="33"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Palomas </td><td  style=""><img src="{{url('/assets/img/palomas.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="34"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="35"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="36"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="37"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="38"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Jardines De Morelos  </td><td  style=""><img src="{{url('/assets/img/jardines.ico')}}" width="30px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="39"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="40"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="41"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Aquiles Serdán  </td><td  style=""><img src="{{url('/assets/img/aquiles_cerdan.ico')}}" width="30px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="42"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="43"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="44"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hospital Las Américas </td><td  style=""><img src="{{url('/assets/img/hospital.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="45"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="46"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="47"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="48"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Primero De Mayo </td><td  style=""><img src="{{url('/assets/img/1_mayo.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="49"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="50"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="51"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="52"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Américas </td><td  style=""><img src="{{url('/assets/img/las_americas.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="53"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="54"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="55"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="56"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="57"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="58"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Valle De Ecatepec  </td><td  style=""><img src="{{url('/assets/img/valle_ecatepec.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="59"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="60"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="61"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> Vocacional 3 </td><td  style=""><img src="{{url('/assets/img/vocacional.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="62"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="63"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Adolfo López Mateos </td><td  style=""><img src="{{url('/assets/img/adolfo_lopez.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="64"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="65"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="66"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Zodiaco </td><td  style=""><img src="{{url('/assets/img/zodiaco.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="67"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="68"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="69"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="70"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Torres </td><td  style=""><img src="{{url('/assets/img/torres.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="71"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="72"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="73"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Unitec </td><td  style=""><img src="{{url('/assets/img/unitec.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="74"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="75"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="76"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="77"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Industrial </td><td  style=""><img src="{{url('/assets/img/industrial.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="78"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="79"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="80"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="81"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Josefa Ortíz</td><td  style=""><img src="{{url('/assets/img/josefa.ico')}}" width="30px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="82"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="83"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="84"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="85"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="86"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="87"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="88"></td></tr>
                            <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Quinto Sol</td><td  style=""><img src="{{url('/assets/img/quinto_sol.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="89"></td></tr> 
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="90"></td></tr>                            
			<tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="91"></td></tr>
                            <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td ><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="92"></td></tr>
<tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ciudad Azteca</td><td ><img src="{{url('/assets/img/ico_cdazteca.ico')}}" width="30px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="93"></td></tr>
                        </table>
                        
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </body>

    @section('jscustom')
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>

    <script type="text/javascript">
        const map = L.map('map').setView([19.61788, -99.011616], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const allPolygons = L.featureGroup(); // Usar FeatureGroup en lugar de LayerGroup

        @php $i=1; @endphp
        @foreach($secciones as $seccion)
            const polygonCoordinates{{$i}} = [
                @if($seccion->cord1 != null) [{{$seccion->cord1}}], @endif
                @if($seccion->cord2 != null) [{{$seccion->cord2}}], @endif
                @if($seccion->cord3 != null) [{{$seccion->cord3}}], @endif
                @if($seccion->cord4 != null) [{{$seccion->cord4}}], @endif
                @if($seccion->cord5 != null) [{{$seccion->cord5}}], @endif
                @if($seccion->cord6 != null) [{{$seccion->cord6}}], @endif
                @if($seccion->cord7 != null) [{{$seccion->cord7}}], @endif
                @if($seccion->cord8 != null) [{{$seccion->cord8}}], @endif
            ];
            @if($i==25)
                const polygon{{$i}} = L.polygon(polygonCoordinates{{$i}}, {
                    color: 'red',
                    fillColor: '#3388ff',
                    fillOpacity: 0.2
                }).addTo(allPolygons); // Agregar cada polígono al grupo
            @else
                const polygon{{$i}} = L.polygon(polygonCoordinates{{$i}}, {
                    color: 'blue',
                    fillColor: '#3388ff',
                    fillOpacity: 0.2
                }).addTo(allPolygons); // Agregar cada polígono al grupo
            @endif
            @php $i++; @endphp
        @endforeach

        @php $i=1; @endphp
        allPolygons.addTo(map); 
        map.fitBounds(allPolygons.getBounds()); 

        async function geo_ecotodos() {
    $.ajax({
        url: '{{ url("/geo_ecotodos") }}',
        type: 'get',
        data: {},
        success: function(response) {
            var economicos_a = [
                65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99,
                1000, 1001, 1002, 1003, 1004, 1005, 1006, 1007, 1008, 1009, 1010, 1011, 1012, 1, 15, 24, 25, 35, 41, 45, 46
            ];

            for (var i = 0; i < economicos_a.length; i++) {
                var index = economicos_a[i];
                
                // Verifica si el índice existe en la respuesta y tiene al menos un elemento
                if (response[index] && response[index].length > 0) {
                    var lat = response[index][0]['lat'];
                    var lon = response[index][0]['lon'];
                    var economico = response[index][0]['economico'];

                    console.log(lat); // Aquí imprime la latitud
                    console.log(lon); // Aquí imprime la longitud
                    console.log(economico); // Aquí imprime la longitud

                    navigator.geolocation.getCurrentPosition(function(position) {
                        const userLat = position.coords.latitude;
                        const userLon = position.coords.longitude;
                        const point = turf.point([lon, lat]);

                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$i}}.map(coord => [coord[1], coord[0]])]);
                        if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                            $('#{{$i}}').append('<center class="center" >'+economico+'</center>');
                            const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}', iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76]});
                            const userLocation = L.marker([userLat, userLon], {icon: customIcon}).addTo(map).bindPopup('Tu ubicación actual '+economico);
                            console.log('entro'+economico);
                        }
                        @php $i++; @endphp
                        @endforeach
                    }, function(error) {
                        console.log('Error al obtener la ubicación: ' + error.message);
                    });
                }
            }
        },
        error: function(xhr, status, error) {
            console.log('Error en la solicitud: ' + error);
        }
    });
}


        async function eco1000() {
            $.ajax({url: '{{ url("/geo_eco1000") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {
                      if(response){
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$i}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$i}}').append('<center class="center" >1000</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1000');
                                console.log('entro1000');
                            } 
                            @php $i++; @endphp
                        @endforeach
                    }, function(error) {
                        console.log('Error al obtener la ubicación: ' + error.message);
                    });
                      }
                },
                error: function(xhr, status, error) {
                    console.log('Error en la solicitud: ' + error);
                }
            });
        }
        async function eco65() {
            $.ajax({url: '{{ url("/geo_eco65") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                
                                $('#{{$a}}').append('<center class="center" >65</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 65');
                                console.log('65');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });
        }
        async function eco66() {
            $.ajax({url: '{{ url("/geo_eco66") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                
                                $('#{{$a}}').append('<center class="center" >66</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 66');
                                console.log('66');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco67() {
            $.ajax({url: '{{ url("/geo_eco67") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >67</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 67');
                                console.log('67');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco68() {
            $.ajax({url: '{{ url("/geo_eco68") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                
                                $('#{{$a}}').append('<center class="center" >68</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 68');
                                console.log('68');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco69() {
            $.ajax({url: '{{ url("/geo_eco69") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >69</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 69');
                                console.log('69');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco70() {
            $.ajax({url: '{{ url("/geo_eco70") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >70</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 70');
                                console.log('70');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco71() {
            $.ajax({url: '{{ url("/geo_eco71") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >71</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 71');
                                console.log('71');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco72() {
            $.ajax({url: '{{ url("/geo_eco72") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >72</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 72');
                                console.log('72');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco73() {
            $.ajax({url: '{{ url("/geo_eco73") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                
                                $('#{{$a}}').append('<center class="center" >73</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 73');
                                console.log('73');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco74() {
            $.ajax({url: '{{ url("/geo_eco74") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >74</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 74');
                                console.log('74');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco75() {
            $.ajax({url: '{{ url("/geo_eco75") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >75</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 75');
                                console.log('75');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco76() {
            $.ajax({url: '{{ url("/geo_eco76") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >76</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 76');
                                console.log('76');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco77() {
            $.ajax({url: '{{ url("/geo_eco77") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >77</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 77');
                                console.log('77');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco78() {
            $.ajax({url: '{{ url("/geo_eco78") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >78</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 78');
                                console.log('78');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco79() {
            $.ajax({url: '{{ url("/geo_eco79") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >79</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 79');
                                console.log('79');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}

            async function eco80() {
            $.ajax({url: '{{ url("/geo_eco80") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >80</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 80');
                                console.log('80');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco81() {
            $.ajax({url: '{{ url("/geo_eco81") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >81</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 81');
                                console.log('81');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco82() {
            $.ajax({url: '{{ url("/geo_eco82") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >82</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 82');
                                console.log('82');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco83() {
            $.ajax({url: '{{ url("/geo_eco83") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >83</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 83');
                                console.log('83');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco84() {
            $.ajax({url: '{{ url("/geo_eco84") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >84</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 84');
                                console.log('84');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco85() {
            $.ajax({url: '{{ url("/geo_eco85") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >85</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 85');
                                console.log('85');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco86() {
            $.ajax({url: '{{ url("/geo_eco86") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >86</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 86');
                                console.log('86');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco87() {
            $.ajax({url: '{{ url("/geo_eco87") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >87</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 87');
                                console.log('87');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco88() {
            $.ajax({url: '{{ url("/geo_eco88") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >88</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 88');
                                console.log('88');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco89() {
            $.ajax({url: '{{ url("/geo_eco89") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >89</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 89');
                                console.log('89');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco90() {
            $.ajax({url: '{{ url("/geo_eco90") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >90</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 90');
                                console.log('90');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco91() {
            $.ajax({url: '{{ url("/geo_eco91") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >91</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 91');
                                console.log('91');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco92() {
            $.ajax({url: '{{ url("/geo_eco92") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >92</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 92');
                                console.log('92');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco93() {
            $.ajax({url: '{{ url("/geo_eco93") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >93</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 93');
                                console.log('93');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco94() {
            $.ajax({url: '{{ url("/geo_eco94") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >94</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 94');
                                console.log('94');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco95() {
            $.ajax({url: '{{ url("/geo_eco95") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >95</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 95');
                                console.log('95');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco96() {
            $.ajax({url: '{{ url("/geo_eco96") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >96</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 96');
                                console.log('96');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco97() {
            $.ajax({url: '{{ url("/geo_eco97") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >97</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 97');
                                console.log('97');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco98() {
            $.ajax({url: '{{ url("/geo_eco98") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >98</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 98');
                                console.log('98');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco99() {
            $.ajax({url: '{{ url("/geo_eco99") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >99</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 99');
                                console.log('99');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}


            async function eco1001() {
            $.ajax({url: '{{ url("/geo_eco1001") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1001</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1001');
                                console.log('1001');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1002() {
            $.ajax({url: '{{ url("/geo_eco1002") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1002</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1002');
                                console.log('1002');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1003() {
            $.ajax({url: '{{ url("/geo_eco1003") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1003</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1003');
                                console.log('1003');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1004() {
            $.ajax({url: '{{ url("/geo_eco1004") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1004</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1004');
                                console.log('1004');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1005() {
            $.ajax({url: '{{ url("/geo_eco1005") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {   if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1005</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1005');
                                console.log('1005');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);});} },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1006() {
            $.ajax({url: '{{ url("/geo_eco1006") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1006</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1006');
                                console.log('1006');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1007() {
            $.ajax({url: '{{ url("/geo_eco1007") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1007</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1007');
                                console.log('1007');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1008() {
            $.ajax({url: '{{ url("/geo_eco1008") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1008</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1008');
                                console.log('1008');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1009() {
            $.ajax({url: '{{ url("/geo_eco1009") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1009</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1009');
                                console.log('1009');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1012() {
            $.ajax({url: '{{ url("/geo_eco1012") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1012</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 12');
                                console.log('1012');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1() {
            $.ajax({url: '{{ url("/geo_eco1") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1');
                                console.log('1');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco15() {
            $.ajax({url: '{{ url("/geo_eco15") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >15</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 15');
                                console.log('15');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco24() {
            $.ajax({url: '{{ url("/geo_eco24") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >24</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 24');
                                console.log('24');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco25() {
            $.ajax({url: '{{ url("/geo_eco25") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >25</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 25');
                                console.log('25');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco35() {
            $.ajax({url: '{{ url("/geo_eco35") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >35</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 35');
                                console.log('35');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco41() {
            $.ajax({url: '{{ url("/geo_eco41") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >41</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 41');
                                console.log('41');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}

            async function eco45() {
            $.ajax({url: '{{ url("/geo_eco45") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {  if(response){navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >45</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 45');
                                console.log('45');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco46() {
            $.ajax({url: '{{ url("/geo_eco46") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { if(response){ navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >46</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 46');
                                console.log('46');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); }},
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
           
        async function eco1011() {
            $.ajax({
                url: '{{ url("/geo_eco1011") }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}' // Necesario para Laravel
                },
                success: function(response) {
                     if(response){
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];
                        const lon = response['lon'];
                        const point = turf.point([lon, lat]);
                        @php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        const poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]);
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1011</center>');
                                const customIcon = L.icon({
                                    iconUrl: '{{url("/assets/img/mexibus2024.ico")}}', iconSize: [45, 45], iconAnchor: [22, 38],  popupAnchor: [-3, -76] 
                                });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map)
                                    .bindPopup('Tu ubicación actual 1011');
                                console.log('entro1011');
                            } 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {
                        console.log('Error al obtener la ubicación: ' + error.message);
                    });
                     }
                },
                error: function(xhr, status, error) {
                }
            });
        }

        async function eco1010() {
            $.ajax({
                url: '{{ url("/geo_eco1010") }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}' // Necesario para Laravel
                },
                success: function(response) {
                    if(response){
                        
                    
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];
                        const lon = response['lon'];
                        const point = turf.point([lon, lat]);
                        @php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); // Invertir las coordenadas para Turf.js
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center class="center" >1010</center>');
                                const customIcon = L.icon({ iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                        const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map)
                                    .bindPopup('Tu ubicación actual 1010');  
                        console.log('entro1010');
                            } 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {
                        console.log('Error al obtener la ubicación: ' + error.message);
                    });
                    
                    }
                },
                error: function(xhr, status, error) {
                }
            });
        }
        async function estaciones() {
            navigator.geolocation.getCurrentPosition(function(position) {
                const ico_cdazteca = L.icon({ iconUrl: '{{url("/assets/img/ico_cdazteca.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_quinto = L.icon({ iconUrl: '{{url("/assets/img/quinto_sol.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_josefa = L.icon({ iconUrl: '{{url("/assets/img/josefa.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_industrial = L.icon({ iconUrl: '{{url("/assets/img/industrial.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_unitec = L.icon({ iconUrl: '{{url("/assets/img/unitec.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_torres = L.icon({ iconUrl: '{{url("/assets/img/torres.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_zodiaco = L.icon({ iconUrl: '{{url("/assets/img/zodiaco.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_adolfo = L.icon({ iconUrl: '{{url("/assets/img/adolfo_lopez.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_vocacional = L.icon({ iconUrl: '{{url("/assets/img/vocacional.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_ecatepec = L.icon({ iconUrl: '{{url("/assets/img/valle_ecatepec.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_americas = L.icon({ iconUrl: '{{url("/assets/img/las_americas.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_mayo = L.icon({ iconUrl: '{{url("/assets/img/1_mayo.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_hospital = L.icon({ iconUrl: '{{url("/assets/img/hospital.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_aquiles = L.icon({ iconUrl: '{{url("/assets/img/aquiles_cerdan.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_jardines = L.icon({ iconUrl: '{{url("/assets/img/jardines.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_palomas = L.icon({ iconUrl: '{{url("/assets/img/palomas.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico__sep_19 = L.icon({ iconUrl: '{{url("/assets/img/19_sep.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_ojo_agua = L.icon({ iconUrl: '{{url("/assets/img/ojo_agua.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_esmeralda = L.icon({ iconUrl: '{{url("/assets/img/esmeralda.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_cuauhtemocN = L.icon({ iconUrl: '{{url("/assets/img/cuau_nor.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_cuauhtemoc = L.icon({ iconUrl: '{{url("/assets/img/cuau_sur.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_Hidalgo = L.icon({ iconUrl: '{{url("/assets/img/hidalgo.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_insurgentes = L.icon({ iconUrl: '{{url("/assets/img/insurgentes.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_estacionCentralA = L.icon({ iconUrl: '{{url("/assets/img/central_abastos.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const estacionCentralA = L.marker([19.616544424211213, -99.00803461449348], { icon: ico_estacionCentralA }).addTo(map).bindPopup('central');
                const insurgentes = L.marker([19.62539866895445, -99.00321162537098], { icon: ico_insurgentes }).addTo(map).bindPopup('insurgentes');
                const Hidalgo = L.marker([19.6335203965161, -99.00211895374885], { icon: ico_Hidalgo }).addTo(map).bindPopup('Hidalgo');
                const cuauhtemoc = L.marker([19.63818593844235, -99.00269947952754], { icon: ico_cuauhtemoc }).addTo(map).bindPopup('cuauhtemoc');
                const cuauhtemocN = L.marker([19.646488969117716, -99.00501819540179], { icon: ico_cuauhtemocN }).addTo(map).bindPopup('cuauhtemoc norte');
                const esmeralda = L.marker([19.651573299383497, -99.00508713918252], { icon: ico_esmeralda }).addTo(map).bindPopup('esmeralda');
                const ojo_agua = L.marker([19.66164577747433, -99.00125243200863], { icon: ico_ojo_agua }).addTo(map).bindPopup('ojo_agua');
                const _sep_19 = L.marker([19.610504659452694, -99.00931282896268], { icon: ico__sep_19 }).addTo(map).bindPopup('19_sep');                                
                const palomas = L.marker([19.607286596652425, -99.01159622487319], { icon: ico_palomas }).addTo(map).bindPopup('palomas');                                
                const jardines = L.marker([19.60064682598177, -99.01620617049123], { icon: ico_jardines }).addTo(map).bindPopup('jardines de morelos');
                const aquiles = L.marker([19.598452753663285, -99.01789483961944], { icon: ico_aquiles }).addTo(map).bindPopup('aquiles serdan');
                const hospital = L.marker([19.595194875743143, -99.01970904847443], { icon: ico_hospital }).addTo(map).bindPopup('hospital');
                const mayo = L.marker([19.588066122635382, -99.02445145403411], { icon: ico_mayo }).addTo(map).bindPopup('primero de mayo');
                const americas = L.marker([19.580643820091627, -99.02455850687326], { icon: ico_americas }).addTo(map).bindPopup('las americas');
                const ecatepec = L.marker([19.57300215007808, -99.02084490199081], { icon: ico_ecatepec }).addTo(map).bindPopup('valle de ecatepec');
                const vocacional = L.marker([19.57038443723783, -99.0183186579712], { icon: ico_vocacional }).addTo(map).bindPopup('vocacional 3');
                const adolfo = L.marker([19.567055250848544, -99.01552906612326], { icon: ico_adolfo }).addTo(map).bindPopup('adolfo lopez mateos');
                const zodiaco = L.marker([19.563166908362554, -99.0153123864357], { icon: ico_zodiaco }).addTo(map).bindPopup('zodiaco');
                const torres = L.marker([19.55775409434341, -99.01765080455169], { icon: ico_torres }).addTo(map).bindPopup('torres');
                const unitec = L.marker([19.554853971883578, -99.01914250009727], { icon: ico_unitec }).addTo(map).bindPopup('unitec');
                const industrial = L.marker([19.5502755054604, -99.0211687043753], { icon: ico_industrial }).addTo(map).bindPopup('industrial');
                const josefa = L.marker([19.546560376652867, -99.02278397780064], { icon: ico_josefa }).addTo(map).bindPopup('josefa ortiz');
                const quinto = L.marker([19.5396424745568, -99.0257623772034], { icon: ico_quinto }).addTo(map).bindPopup('quinto sol');
                const azteca = L.marker([19.534824127431403, -99.02695087270375], { icon: ico_cdazteca }).addTo(map).bindPopup('cd azteca');
            });
        }
        estaciones(); 
        geo_ecotodos(); 
        {{--
        eco77();       eco65();        eco66();        eco67();         eco68();         eco69();         eco70();         eco71();         eco72(); 
        eco73();         eco74();         eco75();         eco76();                 eco78();         eco79();         eco80();         eco81(); 
        eco82();         eco83();         eco84();         eco85();         eco86();         eco87();         eco88();         eco89();         eco90(); 
        eco91();         eco92();         eco93();         eco94();         eco95();         eco96();         eco97();         eco98();         eco99(); 
        eco1000();        eco1001();        eco1002();        eco1003();        eco1004();        eco1005();        eco1006();        eco1007();        eco1008();
        eco1009();        eco1012();        eco1();        eco15();        eco24();        eco25();        eco35();        eco41();        eco45();        eco46();
        eco1011();        eco1010();
        --}}

        @php $i=1; @endphp

       async function unifiedInterval() {
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
                console.log('limpio');
                @php 
                for($r=1; $r<=94;$r++){
                @endphp
                    $('#{{$r}}').html('');
                @php 
                }
                @endphp
            }
        });
                        
        
        setInterval(await estaciones(), 10);
        
        setInterval(await geo_ecotodos(), 10);
        {{--

        setInterval(await eco77(), 10);
        setInterval(await eco65(), 10);
        setInterval(await eco66(), 10);
        setInterval(await eco67(), 10);
        setInterval(await eco68(), 10);
        setInterval(await eco69(), 10);
        setInterval(await eco70(), 10);
        setInterval(await eco71(), 10);
        setInterval(await eco72(), 10);
        setInterval(await eco73(), 10);
        setInterval(await eco74(), 10);
        setInterval(await eco75(), 10);
        setInterval(await eco76(), 10);
        setInterval(await eco78(), 10);
        setInterval(await eco79(), 10);
        setInterval(await eco80(), 10);
        setInterval(await eco81(), 10);
        setInterval(await eco82(), 10);
        setInterval(await eco83(), 10);
        setInterval(await eco84(), 10);
        setInterval(await eco85(), 10);
        setInterval(await eco86(), 10);
        setInterval(await eco87(), 10);
        setInterval(await eco88(), 10);
        setInterval(await eco89(), 10);
        setInterval(await eco90(), 10);
        setInterval(await eco91(), 10);
        setInterval(await eco92(), 10);
        setInterval(await eco93(), 10);
        setInterval(await eco94(), 10);
        setInterval(await eco95(), 10);
        setInterval(await eco96(), 10);
        setInterval(await eco97(), 10);
        setInterval(await eco98(), 10);
        setInterval(await eco99(), 10);
        setInterval(await eco1001(), 10);
        setInterval(await eco1002(), 10);
        setInterval(await eco1003(), 10);
        setInterval(await eco1004(), 10);
        setInterval(await eco1005(), 10);
        setInterval(await eco1006(), 10);
        setInterval(await eco1007(), 10);
        setInterval(await eco1008(), 10);
        setInterval(await eco1009(), 10);
        setInterval(await eco1012(), 10);
        setInterval(await eco1(), 10);
        setInterval(await eco15(), 10);
        setInterval(await eco24(), 10);
        setInterval(await eco25(), 10);
        setInterval(await eco35(), 10);
        setInterval(await eco41(), 10);
        setInterval(await eco45(), 10);
        setInterval(await eco46(), 10);
        setInterval(await eco1000(), 10);
        setInterval(await eco1011(), 10);
        setInterval(await eco1010(), 10);
        --}}
        }


        setInterval(unifiedInterval, 10000);
    </script>
    @endsection
</x-app-layout>
