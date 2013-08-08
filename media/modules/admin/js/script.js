jQuery(document).ready(function ($) {

    /* Работа с изображениями */

    /* Добавление фотографии */
    $('#addimage').click(function () {
        var model = $(this).attr('model_name');
        i = $('#diplomas .row-fluid').length;
        $('#images').append('<div class="row-fluid control-group"><input style="width: 245px; display: none;" type="text" name="'+model+'[images][]" value=""/><input name="'+model+'[image_upl][]" id="'+model+'_image_upl[]" type="file"></div>');
        return false;
    });

    /* Удаление фотографии */
    $(function () {
        $(".deleteImage").click(function () {
            var commentContainer = $(this).parent();
            var parentInput = $(this).parent();
            var path = $(this).parent().find('input').val();

            $.ajax({
                type: "POST",
                url: "/admin/ajax/deleteimage",
                data: 'path=' + path,
                cache: false,
                success: function () {
                    commentContainer.animate({ opacity: "hide" }, "slow");
                    parentInput.find('input').val("");
                }

            });

            return false;
        });
    });
    /* Работа с изображениями - END*/


    /*** Работа с услугами ***/
    /* Добавить сервис */
    $('#addService').click(function () {
        i = $('#diplomas .row-fluid').length;
        $('.services').append('<div class="row-fluid control-group">' +
            '<div class="span7">' +
            '<input style="width: 90%; display:none;" type="text" name="serviceId[]" id="serviceId"><input style="width: 90%;" type="text" name="serviceDescription[]" id="serviceDescription"></div>' +
            '<div class="span3">' +
            '<input style="width: 100%; display: none;" type="text" value="1" name="serviceFree[]" id="serviceFree"><a class="free btn btn-success btn-small" id="yw7">Бесплатно</a></div>' +
            '<div class="span1">' +
            '<input style="width: 100%;display: none ;" class="price" type="text" value="0" name="servicePrice[]" id="servicePrice"></div>' +
            '</div>');
        return false;
    });

    /* Удаляем Сервис */
    $('.deleteService').click(function () {
        var type = $(this).attr('tag');
        var serviceContainer = $(this).parent().parent();
        var id = $(this).parent().parent().find('.id').val();
        $.ajax({
            type: "POST",
            url: "/admin/ajax/deleteservice",
            data: 'id=' + id+'&type='+type,
            cache: false,
            success: function () {
                serviceContainer.animate({ opacity: "hide" }, "slow");
                //parentInput.find('input').val("");
            }

        });
        return false;
    });

    /* Платно/Бесплатно */
    $('.free').live('click', function () {
        $(this).toggleClass(function () {
            if ($(this).is('.btn-success')) {
                $(this).removeClass("btn-success");
                $(this).text("Платно");
                $(this).parent().parent().find('.price').fadeIn(200);
                $(this).parent().find('input').val("0");
                return 'btn-warning';
            } else {
                $(this).removeClass("btn-warning");
                $(this).text("Бесплатно");
                $(this).parent().parent().find('.price').fadeOut(200);
                $(this).parent().find('input').val("1");
                return 'btn-success';
            }
        });
    })
    /*** Работа с услугами - END ***/


    /*** Работа с ценами ***/
    /* Добавить цену комнаты */
    $('#addPriceRoom').click(function () {
        i = $('.prices-block').length;
        $('.prices').append('<div class="prices-block">'+
                '<div class="row-fluid control-group">'+
                '<div class="span1">'+
                '<a class="deletePrice btn btn-inverse btn-small" tag="HotelPrices" id="yw1">Удалить</a>'+
                '<input style="width: 90%; display:none;" class="id" type="text" value="" name="priceId[]" id="priceId"></div>'+
                '<div class="span3">'+
                '<div class="input-prepend">'+
                '<span class="add-on"><i class="icon-calendar"></i></span>'+
                '<input style="height:20px;" id="from'+i+'" type="text" value="" name="from[]" class="span6 hasDatepicker">'+
                '</div>'+
                '</div>'+
                '<div class="span3">'+
                '<div class="input-prepend">'+
                '<span class="add-on"><i class="icon-calendar"></i></span>'+
                '<input style="height:20px;" id="to'+i+'" type="text" value="" name="to[]" class="span6 hasDatepicker">' +
                '</div>'+
                '</div>'+
                '<div class="span2">'+
                '<input style="width: 90%; display:block;" type="text" value="" name="priceSeason[]" id="priceSeason"></div>'+
                '<div class="span1">'+
                '<input style="width: 90%; display:block;" type="text" value="" name="pricePrice[]" id="pricePrice"></div>'+
                '</div>'+
                '</div>');
        return false;
    });

    /*** КОНФЕРЕНЦ-ЗАЛЫ ***/

    /* Добавить цену конференц-зала */
    $('#addPriceConference').click(function () {
        $('.prices').append('<div class = "row-fluid control-group">'+
            '<div class = "span2">'+
            '<a class = "deletePrice btn btn-inverse btn-small" tag = "ConferencePrices" id = "yw4">Удалить</a>'+
            '<input style = "width: 90%; display:none;" class = "id" type = "text" value = "" name = "priceId[]">'+
            '</div>'+
            '<div class = "span3">'+
            '<div class = "input-prepend">'+
            '<span class = "add-on"><i class = "icon-time"></i></span>'+
            '<input id = "from" class = "span3" type = "text" value = "" name = "hours[]">'+
            '</div>'+
            '</div>'+
            '<div class = "span3">'+
            '<input id = "from" class = "span4" type = "text" value = "" name = "price[]">'+
            '</div>'+
            '</div>');
        return false;
    });

    /* Добавить тип конференц-зала */
    $('#addTypeConference').live("click",function(){
        i = $('.conferencetype-block').length;
        $.ajax({
            url: "/admin/ajax/addtypeconference",
            data: 'i='+i,
            cache: false,
            success: function(html){
                $('.types').append(html);
            }
        });
    });

    /* Удаляем тип */
    $('.deleteType').click(function () {
        var serviceContainer = $(this).parent().parent();
        var id = $(this).parent().parent().find('.id').val();
        $.ajax({
            type: "POST",
            url: "/admin/ajax/deletetypeconference",
            data: 'id=' + id,
            cache: false,
            success: function () {
                serviceContainer.animate({ opacity: "hide" }, "slow");
                //parentInput.find('input').val("");
            }

        });
        return false;
    });

    /*** КОНФЕРЕНЦ-ЗАЛЫ - END ***/




    /*
    $('#addPrice').click(function(){
        i = $('.diplomas .row').length;
        $('.prices-block').filter(':last').clone().appendTo('.prices').find('input').each(function () {
            if ( $(this).hasClass("hasDatepicker") )
                this.id = this.id+i;
            //alert('asss')
            i++;

            $(this).val('');
        });

        return false;
    });
    */

    /** Календарь к каждому инпуту **/
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '&#x3c;Пред',
        nextText: 'След&#x3e;',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
            'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
            'Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['ru']);

    $('.hasDatepicker').live('click', function () {
        $(this).removeClass('hasDatepicker').datepicker({
            changeMonth:true,
            changeYear:true,
            showAnim:'fold',
            showButtonPanel:true,
            //autoSize:true,
            dateFormat: 'dd.mm.yy',
            yearRange: '2010:2020'
        },$.datepicker.regional["uk"]).focus();
    });

    /* Удаляем цену */
    $('.deletePrice').click(function () {
        var type = $(this).attr('tag');
        var serviceContainer = $(this).parent().parent();
        var id = $(this).parent().parent().find('.id').val();
        $.ajax({
            type: "POST",
            url: "/admin/ajax/deleteprice",
            data: 'id=' + id+'&type='+type,
            cache: false,
            success: function () {
                serviceContainer.animate({ opacity: "hide" }, "slow");
                //parentInput.find('input').val("");
            }

        });
        return false;
    });
    /*** Работа с ценами - END ***/

    /*** Работа с экскурсиями ***/
    /* Добавления расписания экскурсии */
    $('#addtimetable').live("click",function(){
        i = $('.timetable-block').length;
        $.ajax({
            url: "/admin/ajax/addtimetabletour",
            data: 'i='+i,
            cache: false,
            success: function(html){
                $('.timetable').append(html);
            }
        });
    });
    /* Удаление расписания экскурсии */
    $('.deleteTimeTable').click(function () {
        var timeTableContainer = $(this).parent().parent();
        var id = $(this).parent().parent().find('.id').val();
        $.ajax({
            type: "POST",
            url: "/admin/ajax/deletetimetable",
            data: 'id=' + id,
            cache: false,
            success: function () {
                timeTableContainer.animate({ opacity: "hide" }, "slow");
                //parentInput.find('input').val("");
            }

        });
        return false;
    });

    /*** Работа с экскурсиями - END ***/

});