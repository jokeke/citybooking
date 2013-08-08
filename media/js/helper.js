function declOfNum(number, titles) {  
	var cases = [2, 0, 1, 1, 1, 2];  
	return titles[(number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5]];  
}  

$(function() {
	/* 
	 * Russian (UTF-8) initialisation for the jQuery UI date picker plugin.
	 * Written by Andrew Stromnov (stromnov@gmail.com).		
	 */
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
    	yearSuffix: ''
    };
	$.datepicker.setDefaults($.datepicker.regional['ru']);	
	
	/*
	 * add event for inputs with type 'number'
	 */	
	$('input.number-only').keyup(function() {
		$(this).val($(this).val().replace (/\D/, ''));
	});		
})

