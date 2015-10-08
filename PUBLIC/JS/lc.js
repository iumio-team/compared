/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
var ls = localStorage.getItem('lastCompared');
        if (ls === null) {
$('#comparedUser').html("<a class='text-center link' href='Wui.php?run=show&argument=viewStartCompared' >Vous n'avez fait aucune comparaison ! <br> Faites-en une en cliquant ici ...");
}
else {

spliterArray = ls.split('|');
        $('#comparedUser').html("<a class='text-center link' href=Wui.php?run=compared&sm1="+spliterArray[0]+"&sm2="+spliterArray[1]+"> Le "+spliterArray[2]+" à "+spliterArray[3]+"  <br> "+spliterArray[4]+"<br> contre <br> "+spliterArray[5]+" </a>");

} });