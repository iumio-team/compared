

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    $("#toStart, #float_menu").each(function () {
        $(this).bind('click', function (e) {
            e.preventDefault();
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();

            var output = (day < 10 ? '0' : '') + day + '/' +
                    (month < 10 ? '0' : '') + month + '/' +
                    d.getFullYear();
            var now = new Date(Date.now());
            var min = now.getMinutes();
            var ho =  now.getHours();
            var hours = (ho < 10 ? '0' : '')+ho + ":" +  (min < 10 ? '0' : '')+min ;
            var name1 = $('#form_compared').find("span.sm1").text();
            var name2 = $('#form_compared').find("span.sm2").text();
            if (localStorage.getItem("lastCompared") === null) {
                localStorage.setItem("lastCompared", $("#form_compared").find(".ftsm").val() + "|" + $("#form_compared").find(".sdsm").val() + "|" + output + "|" + hours + "|" + name1 + "|" + name2);
            }
            else {
                localStorage.setItem("lastCompared", $("#form_compared").find(".ftsm").val() + "|" + $("#form_compared").find(".sdsm").val() + "|" + output + "|" + hours + "|" + name1 + "|" + name2);
            }
            $('#form_compared').submit();

        });
    });
});