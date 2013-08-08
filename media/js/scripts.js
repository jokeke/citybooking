$(document).ready(function () {

    /** Регистрация пользователя **/
    $('#register-form-submit').click(function () {
        var email = $('#register-form-email').val();
        var password = $('#register-form-password').val();
        var firstname = $('#register-from-name').val();
        var city = $('#register-form-city').val();
        var phone = $('#register-form-phone').val();
        $.post(
            "/site/registration",
            {
                email: email,
                password: password,
                firstname: firstname,
                city: city,
                phone: phone
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data)
        {
            alert(data);
        }
        return false;
    });

    /** Оставляем комментрий **/
    $('#review-form-submit').click(function () {
        var name = $('#review-name').val();
        var from = $('#review-date-from').val();
        var to = $('#review-date-to').val();
        var number = $('#review-number').val();
        var email = $('#review-email').val();
        var service = $('#review-service').val();
        var clear = $('#review-clear').val();
        var pq = $('#review-price-quality').val();
        var location = $('#review-location').val();
        var breakfast = $('#review-breakfast').val();
        var review = $('#review-text').val();
        var hotel_id = $('#review-hotelid').val();
        var total = (parseInt(service) + parseInt(clear) + parseInt(location) + parseInt(pq) + parseInt(breakfast))/5;
        $.post(
            "/hotels/review",
            {
                name: name,
                from: from,
                to: to,
                number: number,
                email: email,
                service: service,
                clear: clear,
                pq: pq,
                location: location,
                breakfast: breakfast,
                review: review,
                hotel_id: hotel_id,
                total: total
            },
            onAjaxReviewSuccess
        );

        function onAjaxReviewSuccess(html)
        {
            $('.items-wrap').html(html);
        }
        return false;
    });

    sort = 'price';

    /** Ajax search Hotels **/
    $('#ajaxSubmitFormHotels').click(function () {
        ajaxSearch(sort);
        return false;

    });

    function ajaxSearch(order){
        //var order = 'hotels.stars DESC';
        var checkIn = $('#search-form-date-checkin').val();
        var checkOut = $('#search-form-date-checkout').val();
        var price_from = $('#price_from').val();
        var price_to = $('#price_to').val();
        var title = $('#hotel-name').val();
        var per_page = $('#show-per-page-button a').attr('limit');
        var start_row = (parseInt($('.pagination a.active').text()) - 1) * parseInt(per_page);

        //var stars = $('input[name="stars\\[\\]"]').val();
        var stars = [];
        $("input[name='stars[]']:checked").each(function ()
        {
            stars.push(parseInt($(this).val()));
        });
        // &stars%5B%5D=3&stars%5B%5D=4&stars%5B%5D=5
        stars = JSON.stringify(stars);

        var data = 'date_checkin=' + checkIn + '&checkout=' + checkOut + '&title=' + title + '&price_from=' + price_from + '&price_to=' + price_to + '&stars=' + stars + '&start_row=' + start_row + '&per_page=' + per_page + '&order=' + order;
        $.ajax({
            url: "/hotels/ajaxsearch",
            data: data,
            cache: false,
            success: function(html){
                $('.hotels-wrap').html(html);
                history.pushState({}, '', '/hotels/search?'+data)
            }
        });
    };

    /*** Cортировка по ценам, звездам, ретингу ***/
    /** Считаем клики **/
    $("div[class='sort'] a")
        .data('counter', 0)                            // Обнуляем счетчик
        .click(function() {
            var counter = $(this).data('counter');    // Получаем значение
            if (counter == 1)
            {
                $(this).data('counter', counter - 1);
            }
            else
            {
                $(this).data('counter', counter + 1);
            }
        });

    $('#hotelsAjaxSortByStars').click(function () {
        if ($(this).data('counter') == 1)
            sort = 'hotels.stars DESC';
        else
            sort = 'hotels.stars ASC';
        ajaxSearch(sort);
        return false;
    });
    $('#hotelsAjaxSortByPrice').click(function () {
        if ($(this).data('counter') == 1)
            sort = 'price DESC';
        else
            sort = 'price ASC';
        ajaxSearch(sort);
        return false;
    });
    $('#hotelsAjaxSortByRating').click(function () {
        if ($(this).data('counter') == 1)
            sort = 'rating DESC';
        else
            sort = 'rating ASC';
        ajaxSearch(sort);
        return false;
    });

    /** Ajax Room Price **/
    $('.next-date').click(function(){
        var room = $(this);
        ajaxRoomPrice(room);
        //alert(id);
        return false;
    });

    $('.prev-date').click(function(){
        var room = $(this);
        ajaxRoomPrice(room);
        //alert(id);
        return false;
    });

    function ajaxRoomPrice(room)
    {
        var type = room.attr('tag');
        var id = room.attr('roomId');
        var date = room.parent().find("span.item-date").text();
        var timestamp = Date.parse(date.replace(/(\d+)\.(\d+)\.(\d+)/, '$2/$1/$3')) / 1000;
        //var id = $(this).parent().find("span.item-id").text();
        $.post(
            "/hotels/ajaxrooms",
            {
                id: id,
                timestamp: timestamp,
                type: type
            },
            onAjaxReviewSuccess
        ).done(function(){
                if (type == 'next')
                {
                    var newDate = dateFormat(new Date((timestamp+86400)*1000), 'dd.mm.yyyy');
                }
                else if (type == 'prev')
                {
                    var newDate = dateFormat(new Date((timestamp-86400)*1000), 'dd.mm.yyyy');
                }
                else { return false; }

                room.parent().find("span.item-date").text(newDate);
                //alert(newDate);

            });

        function onAjaxReviewSuccess(html)
        {
            room.parent().parent().find(".item-price").html(html);
        }
    }

    /** Pagination Hotels **/
    $('body').on("click", '.pagination-item', function(event){
        var $page = $(this);
        $('.pagination-item').removeClass('active');
        $page.addClass('active');
        ajaxSearch(sort);

        return false;
    });
    /* Стрелочки */
    $('body').on("click", '.pagination a.next', function(event){
        $active = $('.pagination a.active');
        if ($active.next().hasClass('next')) {return false}
        $active.removeClass('active');
        $active.next().addClass('active');
        ajaxSearch(sort);

        return false;
    });

    $('body').on("click", '.pagination a.prev', function(event){
        $active = $('.pagination a.active');
        if ($active.prev().hasClass('prev')) {return false}
        $active.removeClass('active');
        $active.prev().addClass('active');
        ajaxSearch(sort);

        return false;
    });

    $('.page-limit').click(function(){
        var $this = $(this);
        var text = $this.text();
        var limit = $this.attr('limit');
        var max_row = $('#search-form-max-rows');
        var pages = Math.ceil(parseInt(max_row.val())/parseInt(limit));
        $('.page-limit-main').text(text).attr('limit', limit)
        var $pagination = $('.pagination');
        $pagination.html('');
        var aaa = $('<a/>')
            .addClass('prev')
            .attr('href', '#')
            .appendTo($pagination);
        for (var i = 1; i <= pages; i++) {
            var aaa = $('<a/>')
                .addClass('pagination-item')
                .attr('href', '#')
                .text(i)
                .appendTo($pagination);
        }
        var aaa = $('<a/>')
            .addClass('next')
            .attr('href', '#')
            .appendTo($pagination);
        if (pages == 1)
        {
            $('.pagination > a').hide();
        }
        $('.pagination-item').removeClass('active').filter(':first').addClass('active');
        ajaxSearch(sort);

       return false;
    });

    /** Add to favorites **/
    $('body').on("click", '.add-to-favorites', function(event){
        var $this = $(this);
        var id = $this.attr('hotelId');
        $.post(
            "/hotels/addtofavorites",
            {
            id: id
            },
            onAjaxFavoritesSuccess
        );

        function onAjaxFavoritesSuccess(html)
        {
            alert(html);
        }

        return false;

    });

    /** Delete favorites **/
    $('body').on("click", '.delete-hotel-favorite', function(event){
        var $this = $(this);
        var key = $this.attr('key');
        $.post(
            "/hotels/favorites",
            {
                key: key
            },
            onAjaxDeleteFavoritesSuccess
        );

        function onAjaxDeleteFavoritesSuccess(html)
        {
            alert(html);
            $this.parent().fadeOut();
        }

        return false;

    });

    /** Add To Booking Hotels **/
    $('.add-hotel-booking').click(function () {
        var $this = $(this);
        var id = $this.attr('roomId');
        var date = $this.parent().parent().find("span.item-date").text();
        var timestamp = Date.parse(date.replace(/(\d+)\.(\d+)\.(\d+)/, '$2/$1/$3')) / 1000;
        var i = $('.booking-item').length;
        $.post(
            "/hotels/addtobooking",
            {
                id: id,
                i: i,
                timestamp: timestamp
            },
            onAjaxAddToBookingSuccess
        );

        function onAjaxAddToBookingSuccess(html)
        {
            $('.booking-wrap').append(html);
            hotelsBookingSum();
        }

        return false;
    });

    /** SUM price booking hotels **/
    function hotelsBookingSum()
    {
        var total = 0;
        $.each($('.booking-price span'), function() {
            total += Number($(this).text());
        });
        $.each($('.booking-services:checked'), function() {
            total += Number($(this).attr('price'));
        });
        $("#total-price").html(total);
        $("input.total-price").val(total);

    }

    $('body').on("change", '.pay-type', function(event){
        var $this = $(this);
        var price = $this.attr('price');
        $this.parent().find('.booking-price span').text(price);
        $this.parent().find('input.booking-price').val(price);

        hotelsBookingSum();

        return false;
    });

    $(".booking-services").prev().click(function () {
        hotelsBookingSum();

        return false;
    });

    /** Hotel booking submit **/
    $("#submit-booking-form-hotel").click(function () {
        var data = $('form#booking-form-hotel').serialize();
        var i = $('.booking-item').length;
        $.post(
            "/hotels/booking",
            {
                data: data,
                i: i
            },
            onAjaxBookingSuccess
        );

        function onAjaxBookingSuccess(html)
        {
            $('.booking-wrap').append(html);
        }

        return false;

    });



    /** Ajax search Conference **/
    $('#ajaxSubmitFormConference').click(function () {
        var hotelId = $('#search-form-hotel-id').val();
        var stars = [];
        $("input[name='stars[]']:checked").each(function ()
        {
            stars.push(parseInt($(this).val()));
        });
        stars = JSON.stringify(stars);

        var data = 'hotelId=' + hotelId + '&stars=' + stars;
        $.ajax({
            url: "/conference/ajaxsearch",
            data: data,
            cache: false,
            success: function(html){
                $('.conference-content').html(html);
                history.pushState({}, '', '/conference/search?'+data)
            }
        });
        return false;
    });

    /** Ajax search Tour **/
    $('#tourTypeAll').click(function () {
        type = 0;
        ajaxSearchTour(type);
        return false;
    });

    $('#tourTypeCity').click(function () {
        type = '1';
        ajaxSearchTour(type);
        return false;
    });

    $('#tourTypeNotCity').click(function () {
        type = '2';
        ajaxSearchTour(type);
        return false;
    });

    $('#tourTypeOther').click(function () {
        type = '3';
        ajaxSearchTour(type);
        return false;
    });

    function ajaxSearchTour(type){
        var data = 'type=' + type;
        $.ajax({
            url: "/tours/ajaxsearch",
            data: data,
            cache: false,
            success: function(html){
                $('.tour-content').html(html);
                history.pushState({}, '', '/tours/search?'+data)
            }
        });
    };

});


