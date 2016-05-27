<?php


function getHeader($lastName,$firstName){

    echo"<header class='header'>
           <nav class='navbar navbar-fixed-top' >
                <div class='logo pull-left'>LOGO UNFLUX</div>
                <div class='headerText pull-right'> 
                    <div class='pull-left name'>Hello $lastName  $firstName !</div>
                    <div class='pull-right buttonModified' ><a href='index.php?action=logout'>Se deconnecter</a></div>    
                </div>
             </nav>
        </header>";

    

}