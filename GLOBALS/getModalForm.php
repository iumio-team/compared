<?php


function getModalForm($action,$previous,$next,$parameterCompany,$parameterLoop,$parameterTitle){

    $url = 'index.php?action=';



    echo "<form class='addUserCompany'  method='POST' action='index.php'>
            <div data-backdrop='static' data-keyboard='false' class='modal modal2 fade' id='modal-error' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h4 class='modal-title' id='myModalLabel'>Société $parameterTitle </h4>
                        </div>
                        <div class='modal-body center-block text-center'>
                         <label>Selectionnez l'utilisateur que vous souhaitez associer</label>
                         <br/>
                         <br/>";

                        if(!empty($parameterLoop)){

                            echo "<select name='idU' placeholder='Utilisateur'>";

                      

                         for($i=0;$i<count($parameterLoop);$i++){

                             

                             echo "<option value='".$parameterLoop[$i][0]."'>".$parameterLoop[$i][1]." ".$parameterLoop[$i][2] ." : " .$parameterLoop[$i][3] . " </option>";

                             

                            }

                            

                            echo " 
                           </select>
                           </div>
                        <div class='modal-footer'>
                           <input type='hidden' name='action' value='addUserCompany' />
                           <input type='hidden' name='idC' value='$parameterCompany' />
                          <button type='button' class='btn btn-default' data-dismiss='modal'>$previous</button>
                          <button type='submit' class='btn btn-primary' >$next</button>
                        </div>
                      </div>";

                     }

                     else {

                       echo " <span class='animation2'>Désolé mais aucun utilisateur est disponible ! </span>";

                       echo " 
                           </select>
                           </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>$previous</button>
                        </div>
                      </div>
                    </div></div>";

                   }

                    echo "</form>";

    

}