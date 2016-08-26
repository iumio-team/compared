
var request = '';

/**
 * Class Question
 * @param num
 * @constructor
 */
function Question(num)
{
    this.num = num;
    this.get = getQuestion;
    this.send = getReponse;
}

function getQuestion()
{
    request = $.ajax({
        url: 'MODULES/phoneadvisor/index.php?run=question&number=' + this.num,
        type: "POST",
        dataType: "JSON",
        success : function(_data){
           $(".question").append(_data["question"])
            var res = _data["response"];
            var type = _data['responseType'];
            if (type == "radio")
            {
                var temp = "<ul>";
               for (var i = 0; i < res.length; i++)
                {
                    console.log(res[i])
                    temp += "<li>" + res[i] + " &nbsp; <input type='checkbox' name='response'></li>";
                }

                temp += "</ul>";
                $(".response").append(temp);
            }

        }
    });
}


function getReponse(num, resp)
{
    request = $.ajax({
        url: 'MODULES/phoneadvisor/response/' + num,
        type: "POST",
        data : {"response": resp},
        dataType: "JSON",
        success : function(_data){
            console.log(_data);

        }
    });
}

$(document).ready(function()
{
    /******** START ADVISOR *************/

    $("#startPhoneAdvisor").modal('show');

    var n = $(".form_phoneadvisor").attr("data-question");
   var a = new Question(n);

    a.get(1);
    console.log(a.num);
})