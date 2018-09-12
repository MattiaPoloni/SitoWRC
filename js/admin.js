$(document).ready(function () {
    $("input[name=giornoGara]").on('input', function () {
        var input = $(this);
        var val = input.val();
        var reg = new RegExp('^\\d{4}\\-(0?[1-9]|1[012])\\-(0?[1-9]|[12][0-9]|3[01])$');
        var res = reg.test(val);
        if (res) {
            input.removeClass("invalid");
            document.getElementById("applicaModificheGara").disabled = false;
        }
        else {
            input.addClass("invalid");
            document.getElementById("applicaModificheGara").disabled = true;
        }
    });
    $('#titolo').on('input', function () {
        var input = $(this);
        var val = input.val();
        var res = val.length < 150;
        if (res) {
            input.removeClass("invalid");
            document.getElementById("inserisciNews").disabled = false;
        }
        else {
            input.addClass("invalid");
            document.getElementById("inserisciNews").disabled = true;
        }
    });
    $('#descrizione').on('input', function () {
        var input = $(this);
        var val = input.val();
        var res = val.length < 500;
        if (res) {
            input.removeClass("invalid");
            document.getElementById("inserisciNews").disabled = false;
        }
        else {
            input.addClass("invalid");
            document.getElementById("inserisciNews").disabled = true;
        }
    });
    $('#indirizzo').on('input', function () {
        var input = $(this);
        var val = input.val();
        var expression = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
        var regex = new RegExp(expression);
        var res = regex.test(val);
        if (res) {
            input.removeClass("invalid");
            document.getElementById("inserisciNews").disabled = false;
        }
        else {
            input.addClass("invalid");
            document.getElementById("inserisciNews").disabled = true;
        }
    });
    $('#data').on('input', function () {
        var input = $(this);
        var val = input.val();
        var reg = new RegExp('^\\d{4}\\-(0?[1-9]|1[012])\\-(0?[1-9]|[12][0-9]|3[01])$');
        var res = reg.test(val);
        if (res) {
            input.removeClass("invalid");
            document.getElementById("inserisciNews").disabled = false;
        }
        else {
            input.addClass("invalid");
            document.getElementById("inserisciNews").disabled = true;
        }
    });

    var url = window.location.href.split("?");
    if (url[1] == "azione=inserimentoRisultati") {
        $('#ins').addClass("active");
    } else if (url[1] == "azione=modificaGare") {
        $('#mod').addClass("active");
    } else if (url[1] == "azione=inserimentoNews") {
        $('#insN').addClass("active");
    }

    $('[name^="p"]').change(function () {
        checkSelects();
    });
	
	
	function checkSelects() {
    var $elements = $('[name^="p"]');

    $elements.removeClass('invalid');

    $elements.each(function () {
        var selectedValue = this.value;

        $elements
            .not(this)
            .filter(function () {
                console.log([this.value, selectedValue]);
                return this.value == selectedValue && selectedValue != 99 && this.value!=99;
            })
            .addClass('invalid');
    });
}
    var btt = $("#tornaSu");

// nascono il bottone al caricamento della pagina
    btt.hide();

// intercetto lo scroll di pagina
    $(window).scroll(function () {
        // se lo scroll supera i 300 pixel dal margine superiore mostro il bottone (se nascosto)
        if ($(window).scrollTop() > 70) {
            if (btt.is(":hidden")) btt.show();
            // in caso contrario lo nascondo (se visibile)
        } else
            if (btt.is(":visible")) btt.hide();
    });

// gestisco il click sul bottone
    btt.click(function () {
        // torno ad inizio pagina con movenza fluida
        $("html,body").animate({scrollTop: 0}, 500, function () {
        });
    });
});



