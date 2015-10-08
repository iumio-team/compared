<?php


function getModal($action,$previous,$next){

    $url = "index.php?action=";



    echo '<div data-backdrop="static" data-keyboard="false" class="modal fade modal1" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                          ...
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">'.$previous.'</button>
                          <a href="'.$url.''.$action.'" type="button" class="btn btn-primary" >'.$next.'</a>
                        </div>
                      </div>
                    </div>
                </div>';

    

}