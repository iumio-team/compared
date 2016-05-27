/**
 * Created by rafina on 11/03/16.
 */
    var s = {
        check: function () {
            $.ajax({
                type: "POST",
                url: "Wui.php?run=Service&argument=Comparator",
                success: function (_data) {
                    if (_data != 1)
                        location.reload();
                }
            });
        }
    }

window.setInterval(s.check, 2000);