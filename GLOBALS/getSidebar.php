<?php


function getSidebar($userType) {

    

    switch ($userType) {

        case 'Developer':

            echo'<div class="col-md-3" id="sidebar-wrapper-0">
                    <ul class="sidebar-nav">
                        <li class="sidebar-brand"><a href="index.php?action=home">Dashboard</a></li>
                        <li>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="resizeH" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >
                                        <div class="row">
                                            <div class="marginDiv">Projets</div> 
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                             <div class="hovered"><a href="index.php?action=addProject"> Ajouter </a></div>
                                             <br/>
                                             <div class="hovered"><a href="index.php?action=projectsList"> Liste des projets</a></div>
                                             <br/>
                                             <div class="hovered"><a href="index.php?action=ticketList"> Liste des tickets</a></div>
                                             <br/>
                                             <div class="hovered"><a href="index.php?action=myProject"> Vos projets </a></div>
                                             
                                        </div>
                                    </div>
                            </div>
                        </li>
                        <li>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="resizeH" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" >
                                        <div class="row">
                                            <div class="marginDiv">Client</div> 
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <div class="hovered"><a href="index.php?action=addUser&userType=Client"> Ajouter </a></div>
                                            <br/>
                                            <div class="hovered"><a href="index.php?action=clientsList">Liste des clients</a></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                        <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="resizeH" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" >
                                        <div class="row">
                                            <div class="marginDiv">Utilisateurs</div> 
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="hovered"><a href="index.php?action=addUser&userType=Administrator">Ajouter </a></div>
                                            <br/>
                                            <div class="hovered"><a href="index.php?action=userList">Liste des utilisateurs </a></div>
                                            </br>
                                            <div class="hovered"><a href="index.php?action=cUserProfile">Votre profil</a></div>
                                            <br/>
                                            <div class="hovered"><a href="index.php?action=cUserProfileMod">Modifier votre profil</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                         <li>
                        <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="resizeH" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" >
                                        <div class="row">
                                            <div class="marginDiv">Sociétés</div> 
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="hovered"><a href="index.php?action=addCompany">Ajouter </a></div>
                                            <br/>
                                            <div class="hovered"><a href="index.php?action=companyList">Liste des sociétés </a></div>
                                             <div class="hovered"><a href="index.php?action=currentUCL">Vos sociétés </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                        <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="resizeH" data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" >
                                        <div class="row">
                                            <div class="marginDiv">Contenus</div> 
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseFourth" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                          <div class="hovered"><a href="index.php?action=contentsList">Voir les contenus</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>';



            break;

        case 'SimpleUser':

            echo'<div class="col-md-3" id="sidebar-wrapper-0">
                    <ul class="sidebar-nav">
                        <li class="sidebar-brand"><a href="index.php?action=home">Dashboard</a></li>
                        <li>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="resizeH" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >
                                        <div class="row">
                                            <div class="marginDiv">Projets</div> 
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                             <div class="hovered"><a href="index.php?action=projectsList">Vos projets</a></div>
                                            <br/>
                                             <div class="hovered"><a href="index.php?action=myTicket"> Vos tickets </a></div>
                                        </div>
                                    </div>
                            </div>
                        </li>
                        
                        <li>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="resizeH" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" >
                                        <div class="row">
                                            <div class="marginDiv">Profil</div> 
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <div class="hovered"><a href="index.php?action=cUserProfile">Votre profil</a></div>
                                            <div class="hovered"><a href="index.php?action=cUserProfileMod">Modifier votre profil</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                         <li>
                             <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="resizeH" data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" >
                                        <div class="row">
                                            <div class="marginDiv">Sociétés</div> 
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseFourth" class="panel-collapse collapse">
                                        <div class="panel-body">
                                             <div class="hovered"><a href="index.php?action=currentUCL">Vos sociétés </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>';

            break;



    }

    

}

