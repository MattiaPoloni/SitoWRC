$(document).ready(function() {
        $("input[name=giornoGara]").on('input', function() {
            var input = $(this);
            var val = input.val();
            var reg = new RegExp('^\\d{4}\\-(0?[1-9]|1[012])\\-(0?[1-9]|[12][0-9]|3[01])$');
            var res = reg.test(val);
            if(res) {
                input.removeClass("invalid");
                document.getElementById("applicaModificheGara").disabled = false;
            }
            else {
                input.addClass("invalid");
                document.getElementById("applicaModificheGara").disabled = true;}
        });
    $('#descrizione').on('input', function() {
        var input = $(this);
        var val = input.val();
        var res = val.length<500;
        if(res) {
            input.removeClass("invalid");
            document.getElementById("inserisciNews").disabled = false;
        }
        else {
            input.addClass("invalid");
            document.getElementById("inserisciNews").disabled = true;}
    });
    $('#indirizzo').on('input', function() {
        var input = $(this);
        var val = input.val();
        var expression = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
        var regex = new RegExp(expression);
        var res = regex.test(val);
        if(res) {
            input.removeClass("invalid");
            document.getElementById("inserisciNews").disabled = false;
        }
        else {
            input.addClass("invalid");
            document.getElementById("inserisciNews").disabled = true;}
    });
    $('#data').on('input', function() {
        var input = $(this);
        var val = input.val();
        var reg = new RegExp('^\\d{4}\\-(0?[1-9]|1[012])\\-(0?[1-9]|[12][0-9]|3[01])$');
        var res = reg.test(val);
        if(res) {
            input.removeClass("invalid");
            document.getElementById("inserisciNews").disabled = false;
        }
        else {
            input.addClass("invalid");
            document.getElementById("inserisciNews").disabled = true;}
    });
$("select").change(function () {
        checkSelects();
     }); 
    });


function checkSelects() 
{
        var $elements = $('select');
    
        
            $elements.removeClass('invalid')
document.getElementById("inserisciRisultati").disabled = false;
            $elements.each(function () {
                var selectedValue = this.value;

                $elements
                    .not(this)
                    .filter(function() {
                        console.log([this.value, selectedValue]);
                        return this.value == selectedValue;
                    })
                    .addClass('invalid');
document.getElementById("inserisciRisultati").disabled = false;
            });
}
/*function checkSelects() 
{ 
    var errorElements = []; var values = [];

    $("select").each(function () {
        if ($.inArray($(this).val(), values) !== -1) {
            errorElements.push($(this).attr('value'));
        } else {
            values.push($(this).val());
        }
    });
    if (errorElements.length === 0) {
        $("select").each(function () {
            $(this).removeClass('invalid');
document.getElementById("inserisciGare").disabled = false;}
        });
    } else {
        $("select").each(function () {
            if ($.inArray($(this).attr('id'), errorElements) !== -1) {
                $(this).addClass('invalid');
document.getElementById("inserisciGare").disabled = true;}
            } else {
                $(this).removeClass('invalid');
document.getElementById("inserisciGare").disabled = false;}
            }
        });
    }
}*/
