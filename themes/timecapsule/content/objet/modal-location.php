<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: modal-location.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: La nouvelle application de bouteille à la mer 
   =
   =  INTERVENTION:
   =
   =    * 04/05/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
?>
<div id="positionModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel" key="modal-position-title">Modifier votre position</h3>
                <button type="button" class="close-btn-pre" data-bs-dismiss="modal" >✖</button>
            </div>
            <div class="modal-body">
            <p class="p-0 m-0 card-title-desc" key="modal-location-navigator" >Ceci est votre position exacte et courante, selon les informations fournies par votre adresse IP public.</p>
            
            <div class="p-0 m-0 row">
                <div class="d-flex justify-content-center">
                    <div class="p-0 m-0">
                        <h3 class="p-0 m-0"><i class="bx bx-street-view"></i></h3>
                    </div>
                    <div class="p-0 m-0">
                        <h3 class="p-0 m-0" id="posNavigator"> 000.0000° N, 000.0000° E / ... / ... </h3>
                    </div>
                    <button type="button" id="btLocationNavigatorReset" class="buttons-change p-2 btn header-item waves-effect">
                        <div class="d-flex justify-content-center">
                        <div class="p-0 m-0">
                        <h3 class="p-0 m-0"><i class="bx bx-reset"></i></h3>
                        </div>
                    </button>
                </div>
            </div>

            <div class="p-0 m-0 row">
                <div class="d-flex justify-content-center">
                    <div class="p-0 m-0">
                        <h3 class="p-0 m-0"><i class="bx bx-street-view"></i></h3>
                    </div>
                    <div class="p-0 m-0">
                        <h3 class="p-0 m-0" id="posCurrent">000.0000° N, 000.0000° E / ... / ...</h3>
                    </div>
                    <button type="button" id="btLocationCurrenReset" class="buttons-change p-2 btn header-item waves-effect">
                        <div class="d-flex justify-content-center">
                        <div class="p-0 m-0">
                        <h3 class="p-0 m-0"><i class="bx bx-reset"></i></h3>
                        </div>
                    </button>
                </div>
            </div>

            <p class="p-0 m-0 card-title-desc" key="modal-location-current" >Modifier votre position actuelle en choisissant parmi les options suivantes : <code>Latitude</code>,<code>Longitude</code>, <code>Position</code>, ou <code>Planète</code>.</p>
            <div class="p-0 m-0 row">
            <div class="d-flex justify-content-around text-center">
                <button type="button" id="btLocationLatitude" class="buttons-change p-2 btn header-item waves-effect">
                    <h3 class="my-1" id="locationLatitude">[ 000.0000° N ]</h3>
                </button>
                <button type="button" id="btLocationLongitude" class="buttons-change p-2 btn header-item waves-effect">
                    <h3 class="my-1" id="locationLongitude">[ 000.0000° E ]</h3>
                </button>
                <button type="button" id="btLocationPays" class="buttons-change p-2 btn header-item waves-effect">
                    <h3 class="my-1" id="locationPays">[ ... ]</h3>
                </button>
                <button type="button" id="btLocationPlanet" class="buttons-change p-2 btn header-item waves-effect">
                    <h3 class="my-1" id="locationPlanet">[ ... ]</h3>
                </button>
                </div>
            </div>
            <div id="modifLocationLatitude" class="my-3" style="display:none">
                <form action="" method="" onsubmit="modifLatitude(); return false;">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="card-title-desc" key="modal-location-latitude">Vous pouvez ajuster la <code>Latitude</code> selon vos besoins.</p>
                        </div>
                        <div> 
                            <a id="updateCoordLatitude" href="#" class="btn btn-light waves-effect waves-light" key="modal-update-latitude"><i class="p-1 mdi mdi-earth-arrow-right"></i>Trouver la position</a>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="d-flex justify-content-around">
                            <div class="text-center input-wrapper" style="position: relative;"> 
                                <div class="hover-text top-text-latitude-sign"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchSign(this,event,'latitude')" 
                                    onwheel="adjustOnScroll(event, this,'sign','latitude')"
                                    maxLength="1"
                                    id="sign_latitude_input" name="sign" autocomplete="off" value="+">
                                <div class="hover-text bottom-text-latitude-sign"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;"> 
                                <div class="hover-text top-text-latitude-1"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event, 'latitude',2,7,1)" 
                                    onwheel="adjustOnScroll(event, this,'code','latitude')"
                                    maxLength="1"
                                    id="code_latitude_input_1" name="code1" autocomplete="off" value="0" data-max="1">
                                <div class="hover-text bottom-text-latitude-1"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-latitude-2"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'latitude',3,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','latitude')"
                                    maxLength="1"
                                    id="code_latitude_input_2" name="code2" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-latitude-2"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-latitude-3"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'latitude',4,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','latitude')"
                                    maxLength="1"
                                    id="code_latitude_input_3" name="code3" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-latitude-3"> 0 </div>
                            </div>
                            <div class="col-1">
                            <div class="">
                                <h2 class="my-1" id=""> . </h2>
                            </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-latitude-4"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'latitude',5,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','latitude')"
                                    maxLength="1"
                                    id="code_latitude_input_4" name="code4" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-latitude-4"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-latitude-5"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'latitude',6,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','latitude')"
                                    maxLength="1"
                                    id="code_latitude_input_5" name="code5" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-latitude-5"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-latitude-6"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'latitude',7,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','latitude')"
                                    maxLength="1"
                                    id="code_latitude_input_6" name="code6" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-latitude-6"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-latitude-7"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'latitude',8,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','latitude')"
                                    maxLength="1"
                                    id="code_latitude_input_7" name="code7" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-latitude-7"> 0 </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id="modifLocationLongitude" class="my-3" style="display:none">
                <form action="" method="" onsubmit="modifLongitude(); return false;">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="card-title-desc" key="modal-location-longitude">Vous pouvez ajuster la <code>Longitude</code> selon vos besoins.</p>
                    </div>
                    <div>
                        <a id="updateCoordLongitude" href="#" class="btn btn-light waves-effect waves-light" key="modal-update-longitude"><i class="p-1 mdi mdi-earth-arrow-right"></i>Trouver la position</a>
                    </div>    
                </div>   
                    <div class="row text-center">
                        <div class="d-flex justify-content-around">
                            <div class="text-center input-wrapper" style="position: relative;"> 
                                <div class="hover-text top-text-longitude-sign"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchSign(this,event,'longitude')" 
                                    onwheel="adjustOnScroll(event, this,'sign','longitude')"
                                    maxLength="1"
                                    id="sign_longitude_input" name="sign" autocomplete="off" value="+">
                                <div class="hover-text bottom-text-longitude-sign"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;"> 
                                <div class="hover-text top-text-longitude-1"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event, 'longitude',2,7,1)" 
                                    onwheel="adjustOnScroll(event, this,'code','longitude')"
                                    maxLength="1"
                                    id="code_longitude_input_1" name="code1" autocomplete="off" value="0" data-max="1">
                                <div class="hover-text bottom-text-longitude-1"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-longitude-2"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'longitude',3,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','longitude')"
                                    maxLength="1"
                                    id="code_longitude_input_2" name="code2" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-longitude-2"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-longitude-3"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'longitude',4,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','longitude')"
                                    maxLength="1"
                                    id="code_longitude_input_3" name="code3" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-longitude-3"> 0 </div>
                            </div>
                            <div class="col-1">
                            <div class="">
                                <h2 class="my-1" id=""> . </h2>
                            </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-longitude-4"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'longitude',5,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','longitude')"
                                    maxLength="1"
                                    id="code_longitude_input_4" name="code4" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-longitude-4"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-longitude-5"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'longitude',6,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','longitude')"
                                    maxLength="1"
                                    id="code_longitude_input_5" name="code5" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-longitude-5"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-longitude-6"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'longitude',7,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','longitude')"
                                    maxLength="1"
                                    id="code_longitude_input_6" name="code6" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-longitude-6"> 0 </div>
                            </div>
                            <div class="text-center input-wrapper" style="position: relative;">
                                <div class="hover-text top-text-longitude-7"> 0 </div>
                                <input type="text"
                                    class="form-control form-control-lg text-center h2-like"
                                    onkeyup="touchCode(this, event,'longitude',8,7,9)"
                                    onwheel="adjustOnScroll(event, this,'code','longitude')"
                                    maxLength="1"
                                    id="code_longitude_input_7" name="code7" autocomplete="off" value="0" data-max="9">
                                <div class="hover-text bottom-text-longitude-7"> 0 </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id="modifLocationPays" class="my-3" style="display:none">
                <p class="card-title-desc" key="modal-location-pays">Vous pouvez rechercher une <code>Position</code> selon vos besoins.</p>
                <div class="auto-search-wrapper loupe">
                    <input
                        type="text"
                        autocomplete="off"
                        id="search"
                        class="full-width"
                        placeholder="Rechercher une position"
                    />
                    </div>
                    <hr>
                    <div id="map" class="modal-body leaflet-map"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="buttons-position btn btn-light header-item btn waves-effect waves-light" id="btLocationModify"><h4 key="modal-apply">Appliquer les changements</h4></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->