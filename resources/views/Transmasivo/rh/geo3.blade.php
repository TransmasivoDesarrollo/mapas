
<x-app-layout>
    <head>
        <title>Visualizar Polígono en el Mapa</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <style>
            #map { height: 2000px; }
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
                            <b>Ordinario<br>Ojo de agua<br>Ciudad azteca</b>
                            <table style="border:1px black solid; ">
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ojo De Agua </td><td  style=""><img src="{{url('/assets/img/ojo_agua.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="94"  width="50px;"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="25"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="24"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="23"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="22"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Esmeralda  </td><td  style=""><img src="{{url('/assets/img/esmeralda.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="21"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="20"></td></tr>     
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="19"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Cuauhtémoc Norte </td><td  style=""><img src="{{url('/assets/img/cuau_nor.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="18"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="17"></td></tr>    
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="16"></td></tr>  
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="15"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Cuauhtémoc Sur  </td><td  style=""><img src="{{url('/assets/img/cuau_sur.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="14"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="13"></td></tr>  
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hidalgo  </td><td  style=""><img src="{{url('/assets/img/hidalgo.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="12"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="11"></td></tr> 
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="10"></td></tr>  
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="9"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="8"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="7"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Torres </td><td  style=""><img src="{{url('/assets/img/insurgentes.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="6"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="5"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="4"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="3"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="2"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Central De Abasto </td><td  style=""><img src="{{url('/assets/img/central_abastos.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="1"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="26"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="27"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="28"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="29"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> 19 De Septiembre </td><td  style=""><img src="{{url('/assets/img/19_sep.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="30"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="31"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="32"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="33"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Palomas </td><td  style=""><img src="{{url('/assets/img/palomas.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="34"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="35"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="36"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="37"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="38"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Jardines De Morelos  </td><td  style=""><img src="{{url('/assets/img/jardines.ico')}}" width="28px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="39"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="40"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="41"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Aquiles Serdán  </td><td  style=""><img src="{{url('/assets/img/aquiles_cerdan.ico')}}" width="28px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="42"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="43"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="44"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hospital Las Américas </td><td  style=""><img src="{{url('/assets/img/hospital.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="45"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="46"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="47"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="48"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Primero De Mayo </td><td  style=""><img src="{{url('/assets/img/1_mayo.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="49"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="50"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="51"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="52"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Américas </td><td  style=""><img src="{{url('/assets/img/las_americas.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="53"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="54"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="55"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="56"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="57"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="58"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Valle De Ecatepec  </td><td  style=""><img src="{{url('/assets/img/valle_ecatepec.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="59"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="60"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="61"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> Vocacional 3 </td><td  style=""><img src="{{url('/assets/img/vocacional.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="62"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="63"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Adolfo López Mateos </td><td  style=""><img src="{{url('/assets/img/adolfo_lopez.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="64"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="65"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="66"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Zodiaco </td><td  style=""><img src="{{url('/assets/img/zodiaco.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="67"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="68"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="69"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="70"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Torres </td><td  style=""><img src="{{url('/assets/img/torres.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="71"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="72"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="73"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Unitec </td><td  style=""><img src="{{url('/assets/img/unitec.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="74"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="75"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="76"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="77"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Industrial </td><td  style=""><img src="{{url('/assets/img/industrial.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="78"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="79"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="80"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="81"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Josefa Ortíz</td><td  style=""><img src="{{url('/assets/img/josefa.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="82"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="83"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="84"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="85"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="86"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="87"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="88"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Quinto Sol</td><td  style=""><img src="{{url('/assets/img/quinto_sol.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="89"></td></tr> 
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="90"></td></tr>                            
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="91"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td ><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="92"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ciudad Azteca</td><td ><img src="{{url('/assets/img/ico_cdazteca.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="93"></td></tr>
                            </table>
                        </center>
                    </div>
                    <div class="col-md-2">
                        <center>
                            <b>Express<br>Ojo de agua<br>Ciudad azteca</b>
                            <table style="border:1px black solid; ">
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ojo De Agua </td><td  style=""><img src="{{url('/assets/img/ojo_agua.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="94"  width="28px;"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="25"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="24"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="23"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="22"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Esmeralda  </td><td  style=""><img src="{{url('/assets/img/esmeralda.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="21"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="20"></td></tr>     
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="19"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Cuauhtémoc Norte </td><td  style=""><img src="{{url('/assets/img/cuau_nor.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="18"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="17"></td></tr>    
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="16"></td></tr>  
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="15"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Cuauhtémoc Sur  </td><td  style=""><img src="{{url('/assets/img/cuau_sur.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="14"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="13"></td></tr>  
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hidalgo  </td><td  style=""><img src="{{url('/assets/img/hidalgo.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="12"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="11"></td></tr> 
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="10"></td></tr>  
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="9"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="8"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="7"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Torres </td><td  style=""><img src="{{url('/assets/img/insurgentes.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="6"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="5"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="4"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="3"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="2"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Central De Abasto </td><td  style=""><img src="{{url('/assets/img/central_abastos.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="1"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="26"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="27"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="28"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="29"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> 19 De Septiembre </td><td  style=""><img src="{{url('/assets/img/19_sep.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="30"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="31"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="32"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="33"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Palomas </td><td  style=""><img src="{{url('/assets/img/palomas.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="34"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="35"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="36"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="37"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="38"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Jardines De Morelos  </td><td  style=""><img src="{{url('/assets/img/jardines.ico')}}" width="28px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="39"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="40"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="41"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Aquiles Serdán  </td><td  style=""><img src="{{url('/assets/img/aquiles_cerdan.ico')}}" width="28px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="42"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="43"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="44"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hospital Las Américas </td><td  style=""><img src="{{url('/assets/img/hospital.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="45"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="46"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="47"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="48"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Primero De Mayo </td><td  style=""><img src="{{url('/assets/img/1_mayo.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="49"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="50"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="51"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="52"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Américas </td><td  style=""><img src="{{url('/assets/img/las_americas.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="53"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="54"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="55"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="56"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="57"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="58"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Valle De Ecatepec  </td><td  style=""><img src="{{url('/assets/img/valle_ecatepec.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="59"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="60"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="61"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> Vocacional 3 </td><td  style=""><img src="{{url('/assets/img/vocacional.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="62"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="63"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Adolfo López Mateos </td><td  style=""><img src="{{url('/assets/img/adolfo_lopez.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="64"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="65"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="66"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Zodiaco </td><td  style=""><img src="{{url('/assets/img/zodiaco.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="67"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="68"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="69"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="70"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Torres </td><td  style=""><img src="{{url('/assets/img/torres.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="71"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="72"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="73"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Unitec </td><td  style=""><img src="{{url('/assets/img/unitec.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="74"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="75"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="76"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="77"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Industrial </td><td  style=""><img src="{{url('/assets/img/industrial.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="78"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="79"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="80"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="81"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Josefa Ortíz</td><td  style=""><img src="{{url('/assets/img/josefa.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="82"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="83"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="84"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="85"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="86"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="87"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="88"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Quinto Sol</td><td  style=""><img src="{{url('/assets/img/quinto_sol.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="89"></td></tr> 
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="90"></td></tr>                            
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="91"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td ><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="92"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ciudad Azteca</td><td ><img src="{{url('/assets/img/ico_cdazteca.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="93"></td></tr>
                            </table>
                        </center>
                    </div>
                    <div class="col-md-2" >
                        <center>
                            <b>Express<br>Central de abastos<br>Ciudad azteca</b>
                            <table style="border:1px black solid; ">
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Central De Abasto </td><td  style=""><img src="{{url('/assets/img/central_abastos.ico')}}" width="28px;"></td><td   width="28px;" style="border-top:1px black solid; border-bottom:1px black solid;"  id="1"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="26"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="27"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="28"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="29"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> 19 De Septiembre </td><td  style=""><img src="{{url('/assets/img/19_sep.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="30"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="31"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="32"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="33"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Palomas </td><td  style=""><img src="{{url('/assets/img/palomas.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="34"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="35"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="36"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="37"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="38"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Jardines De Morelos  </td><td  style=""><img src="{{url('/assets/img/jardines.ico')}}" width="28px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="39"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="40"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="41"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Aquiles Serdán  </td><td  style=""><img src="{{url('/assets/img/aquiles_cerdan.ico')}}" width="28px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;" id="42"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="43"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="44"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Hospital Las Américas </td><td  style=""><img src="{{url('/assets/img/hospital.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="45"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="46"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="47"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="48"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Primero De Mayo </td><td  style=""><img src="{{url('/assets/img/1_mayo.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="49"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="50"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="51"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="52"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Las Américas </td><td  style=""><img src="{{url('/assets/img/las_americas.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="53"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="54"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="55"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="56"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="57"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="58"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Valle De Ecatepec  </td><td  style=""><img src="{{url('/assets/img/valle_ecatepec.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="59"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="60"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="61"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;"> Vocacional 3 </td><td  style=""><img src="{{url('/assets/img/vocacional.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="62"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="63"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Adolfo López Mateos </td><td  style=""><img src="{{url('/assets/img/adolfo_lopez.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="64"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="65"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="66"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Zodiaco </td><td  style=""><img src="{{url('/assets/img/zodiaco.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="67"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="68"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="69"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="70"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Torres </td><td  style=""><img src="{{url('/assets/img/torres.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="71"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="72"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="73"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Unitec </td><td  style=""><img src="{{url('/assets/img/unitec.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="74"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="75"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="76"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="77"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Industrial </td><td  style=""><img src="{{url('/assets/img/industrial.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="78"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="79"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="80"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="81"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Josefa Ortíz</td><td  style=""><img src="{{url('/assets/img/josefa.ico')}}" width="28px;"></td><td   style="border-top:1px black solid; border-bottom:1px black solid;" id="82"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="83"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="84"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="85"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="86"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="87"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="88"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Quinto Sol</td><td  style=""><img src="{{url('/assets/img/quinto_sol.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;"  id="89"></td></tr> 
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="90"></td></tr>                            
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td><td style="border-top:1px black solid; border-bottom:1px black solid;"  id="91"></td></tr>
                                <tr><td ></td ><td ><img src="{{url('/assets/img/zvacio_vertical.png')}}" width="20px;"></td ><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="92"></td></tr>
                                <tr><td  style="border-top:1px black solid; border-bottom:1px black solid;">Ciudad Azteca</td><td ><img src="{{url('/assets/img/ico_cdazteca.ico')}}" width="28px;"></td><td  style="border-top:1px black solid; border-bottom:1px black solid;" id="93"></td></tr>
                            </table>
                        </center>
                    </div>
                    <div class="col-md-12" id="fuera">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
    @section('jscustom')
    <script src="{{url('/turf.min.js')}}"></script>
    <script type="text/javascript">
        const map = L.map('map').setView([19.61788, -99.011616], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        L.control.zoom({
            position: 'topright' // Posición de los controles de zoom (opcional)
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

        function geo_ecotodos() {
    estaciones();
    $.ajax({
    url: '{{ url("/geo_ecotodos") }}',
    type: 'get',
    data: {},
    success: function(response) {
        var disponibles = {};
        var economicos_a = [
            65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99,
            1000, 1001, 1002, 1003, 1004, 1005, 1006, 1007, 1008, 1009, 1010, 1011, 1012, 1, 15, 24, 25, 35, 41, 45, 46
        ];

        for (let i = 0; i < economicos_a.length; i++) {
            var index = economicos_a[i];

            if (response[index].length > 0) {
                console.log(response[index][0]['economico']);
                
                disponibles[response[index][0]['economico']] = response[index][0]['economico'];

                (function(economico, lat, lon) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const point = turf.point([lon, lat]);

                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$i}}.map(coord => [coord[1], coord[0]])]);

                        if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                            console.log(economico);
                            $('#{{$i}}').append('<p class="center"><img src="{{url("/assets/img/bus_v_fondo1.png")}}" width="20px">&nbsp;' + economico + '</p>');
                            const customIcon = L.icon({iconUrl: '{{url("/assets/img/bus_v_fondo1.png")}}', iconSize: [30, 30]});
                            const userLocation = L.marker([lat, lon], {icon: customIcon}).addTo(map).bindPopup('Economico ' + economico);
                            
                            // Borrar el economico del objeto disponibles
                            if (disponibles.hasOwnProperty(economico)) {
                                delete disponibles[economico];
                            }
                        } else {
                            const customIconOut = L.icon({iconUrl: '{{url("/assets/img/bus_v_fondo1.png")}}', iconSize: [30, 30]});
                            const userLocationOut = L.marker([lat, lon], {icon: customIconOut}).addTo(map).bindPopup('Economico ' + economico);
                        }
                        @php $i++; @endphp
                        @endforeach
                    }, function(error) {
                        console.log('Error al obtener la ubicación: ' + error.message);
                    });
                })(response[index][0]['economico'], response[index][0]['lat'], response[index][0]['lon']);
            }
        }
        
        console.log('disponible final '+ disponibles);
        for (var j = 0; j < disponibles.length; j++) {
            console.log(disponibles[0]+' '+response[disponibles[0]][0]['lat']+' '+ response[disponibles[0]][0]['lon']+' '+ response[disponibles[0]][0]['economico']);
            const customIconOut = L.icon({iconUrl: '{{url("/assets/img/bus_v_fondo1.png")}}', iconSize: [30, 30]});
            const userLocationOut = L.marker([response[disponibles[0]][0]['lat'], response[disponibles[0]][0]['lon']], {icon: customIconOut}).addTo(map).bindPopup('Economico '+response[disponibles[0]][0]['economico'] + ' fuera');
        }
    },
    error: function(xhr, status, error) {
        console.log('Error en la solicitud: ' + error);
    }
});


}



        async function estaciones() {
            navigator.geolocation.getCurrentPosition(function(position) {
                const ico_cdazteca = L.icon({ iconUrl: '{{url("/assets/img/ico_cdazteca.ico")}}',iconSize: [30, 30] });
                const ico_quinto = L.icon({ iconUrl: '{{url("/assets/img/quinto_sol.ico")}}',iconSize: [30, 30] });
                const ico_josefa = L.icon({ iconUrl: '{{url("/assets/img/josefa.ico")}}',iconSize: [30, 30] });
                const ico_industrial = L.icon({ iconUrl: '{{url("/assets/img/industrial.ico")}}',iconSize: [30, 30] });
                const ico_unitec = L.icon({ iconUrl: '{{url("/assets/img/unitec.ico")}}',iconSize: [30, 30] });
                const ico_torres = L.icon({ iconUrl: '{{url("/assets/img/torres.ico")}}',iconSize: [30, 30] });
                const ico_zodiaco = L.icon({ iconUrl: '{{url("/assets/img/zodiaco.ico")}}',iconSize: [30, 30] });
                const ico_adolfo = L.icon({ iconUrl: '{{url("/assets/img/adolfo_lopez.ico")}}',iconSize: [30, 30] });
                const ico_vocacional = L.icon({ iconUrl: '{{url("/assets/img/vocacional.ico")}}',iconSize: [30, 30] });
                const ico_ecatepec = L.icon({ iconUrl: '{{url("/assets/img/valle_ecatepec.ico")}}',iconSize: [30, 30] });
                const ico_americas = L.icon({ iconUrl: '{{url("/assets/img/las_americas.ico")}}',iconSize: [30, 30] });
                const ico_mayo = L.icon({ iconUrl: '{{url("/assets/img/1_mayo.ico")}}',iconSize: [30, 30] });
                const ico_hospital = L.icon({ iconUrl: '{{url("/assets/img/hospital.ico")}}',iconSize: [30, 30] });
                const ico_aquiles = L.icon({ iconUrl: '{{url("/assets/img/aquiles_cerdan.ico")}}',iconSize: [30, 30] });
                const ico_jardines = L.icon({ iconUrl: '{{url("/assets/img/jardines.ico")}}',iconSize: [30, 30] });
                const ico_palomas = L.icon({ iconUrl: '{{url("/assets/img/palomas.ico")}}',iconSize: [30, 30] });
                const ico__sep_19 = L.icon({ iconUrl: '{{url("/assets/img/19_sep.ico")}}',iconSize: [30, 30] });
                const ico_ojo_agua = L.icon({ iconUrl: '{{url("/assets/img/ojo_agua.ico")}}',iconSize: [30, 30] });
                const ico_esmeralda = L.icon({ iconUrl: '{{url("/assets/img/esmeralda.ico")}}',iconSize: [30, 30] });
                const ico_cuauhtemocN = L.icon({ iconUrl: '{{url("/assets/img/cuau_nor.ico")}}',iconSize: [30, 30] });
                const ico_cuauhtemoc = L.icon({ iconUrl: '{{url("/assets/img/cuau_sur.ico")}}',iconSize: [30, 30] });
                const ico_Hidalgo = L.icon({ iconUrl: '{{url("/assets/img/hidalgo.ico")}}',iconSize: [30, 30] });
                const ico_insurgentes = L.icon({ iconUrl: '{{url("/assets/img/insurgentes.ico")}}',iconSize: [30, 30] });
                const ico_estacionCentralA = L.icon({ iconUrl: '{{url("/assets/img/central_abastos.ico")}}',iconSize: [30, 30] });
                const estacionCentralA = L.marker([19.616544424211213, -99.00803461449348], { icon: ico_estacionCentralA }).addTo(map).bindPopup('Central de abastos');
                const insurgentes = L.marker([19.62539866895445, -99.00321162537098], { icon: ico_insurgentes }).addTo(map).bindPopup('Las Torres');
                const Hidalgo = L.marker([19.6335203965161, -99.00211895374885], { icon: ico_Hidalgo }).addTo(map).bindPopup('Hidalgo');
                const cuauhtemoc = L.marker([19.63818593844235, -99.00269947952754], { icon: ico_cuauhtemoc }).addTo(map).bindPopup('Cuauhtémoc Sur	');
                const cuauhtemocN = L.marker([19.646488969117716, -99.00501819540179], { icon: ico_cuauhtemocN }).addTo(map).bindPopup('Cuauhtémoc Norte');
                const esmeralda = L.marker([19.651573299383497, -99.00508713918252], { icon: ico_esmeralda }).addTo(map).bindPopup('Esmeralda');
                const ojo_agua = L.marker([19.66164577747433, -99.00125243200863], { icon: ico_ojo_agua }).addTo(map).bindPopup('Ojo De Agua');
                const _sep_19 = L.marker([19.610504659452694, -99.00931282896268], { icon: ico__sep_19 }).addTo(map).bindPopup('19 De Septiembre');                                
                const palomas = L.marker([19.607286596652425, -99.01159622487319], { icon: ico_palomas }).addTo(map).bindPopup('Palomas');                                
                const jardines = L.marker([19.60064682598177, -99.01620617049123], { icon: ico_jardines }).addTo(map).bindPopup('Jardines De Morelos');
                const aquiles = L.marker([19.598452753663285, -99.01789483961944], { icon: ico_aquiles }).addTo(map).bindPopup('Aquiles Serdán');
                const hospital = L.marker([19.595194875743143, -99.01970904847443], { icon: ico_hospital }).addTo(map).bindPopup('Hospital Las Américas	');
                const mayo = L.marker([19.588066122635382, -99.02445145403411], { icon: ico_mayo }).addTo(map).bindPopup('Primero De Mayo');
                const americas = L.marker([19.580643820091627, -99.02455850687326], { icon: ico_americas }).addTo(map).bindPopup('Las Américas');
                const ecatepec = L.marker([19.57300215007808, -99.02084490199081], { icon: ico_ecatepec }).addTo(map).bindPopup('Valle De Ecatepec	');
                const vocacional = L.marker([19.57038443723783, -99.0183186579712], { icon: ico_vocacional }).addTo(map).bindPopup('Vocacional 3');
                const adolfo = L.marker([19.567055250848544, -99.01552906612326], { icon: ico_adolfo }).addTo(map).bindPopup('Adolfo López Mateos');
                const zodiaco = L.marker([19.563166908362554, -99.0153123864357], { icon: ico_zodiaco }).addTo(map).bindPopup('Zodiaco');
                const torres = L.marker([19.55775409434341, -99.01765080455169], { icon: ico_torres }).addTo(map).bindPopup('Torres');
                const unitec = L.marker([19.554853971883578, -99.01914250009727], { icon: ico_unitec }).addTo(map).bindPopup('Unitec');
                const industrial = L.marker([19.5502755054604, -99.0211687043753], { icon: ico_industrial }).addTo(map).bindPopup('Industrial');
                const josefa = L.marker([19.546560376652867, -99.02278397780064], { icon: ico_josefa }).addTo(map).bindPopup('Josefa Ortíz	');
                const quinto = L.marker([19.5396424745568, -99.0257623772034], { icon: ico_quinto }).addTo(map).bindPopup('Quinto Sol');
                const azteca = L.marker([19.534824127431403, -99.02695087270375], { icon: ico_cdazteca }).addTo(map).bindPopup('Ciudad Azteca');
            });
        }
        geo_ecotodos(); 
        @php $i=1; @endphp
        async function unifiedInterval() {
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                    @php 
                    for($r=1; $r<=94;$r++){
                        @endphp
                        $('#{{$r}}').html('');
                        @php 
                    }
                    @endphp
                }
            });
            setInterval(await geo_ecotodos(), 10);
        }
        setInterval(unifiedInterval, 10000);
        </script>
@endsection
</x-app-layout>