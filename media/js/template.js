/*
 * JS for the template and common scripts 
 */

/*
 * switch on/off class "active" for an element
 */ 
function toggleActive(elem) {
	if($(elem).hasClass('active') == true) {
		$(elem).removeClass('active');
	} else {
		$(elem).addClass('active');
	}
}

/*
 * Open tab (bookmark)
 */
function openTab(tabId, elem) {	
	tabId = '#tab-'+tabId;	

	if($(tabId).hasClass('active') == false) {
		link = $(elem);
		linkWrapper = $(elem).parent();	
		menu = linkWrapper.parent();
		tabsWrapper = menu.parent();
		
		menu.children().removeClass('active');
		linkWrapper.addClass('active');
		
		tabsWrapper.find('.tab.active').stop().fadeOut(100, function() {
			$(this).removeClass('active');
			$(this).hide();
	
			$(tabId).stop().fadeIn(100, function() {
				$(this).addClass('active');
			});		
		});
	}	
}

/*
 * replace all checkboxes on a page with dependent link
 */
function customizeCheckboxes() {
	$('input[type="checkbox"]').each(function() {
		if($(this).attr('checked') == 'checked') {		
			var inputChecked = ' checked';
		} else {
			var inputChecked = '';
		}
		
		$(this).hide().before('<a href="javascript:void(0)" class="checkbox'+inputChecked+'" onclick="changeCheckboxValue(this)"></a>');		
	});
}

/*
 * change value for custimized checkbox
 */
function changeCheckboxValue(dependentLink) {
	var link = $(dependentLink);
	var checkbox = link.next('input[type="checkbox"]');
		
	if(checkbox.prop('checked')) {
		checkbox.prop('checked', false);
		link.removeClass('checked');
	} else {		
		checkbox.prop('checked', true);
		link.addClass('checked');		
	}
}

function customizeSelects() {
	$('select').each(function() {
		$(this).customSelect();
	})
}

function customizeDateFields() {
	$('.datepicker').each(function() {
		$(this).datepicker({ 
			dateFormat: 'dd.mm.yy',			
		});
	});
}

function homepageSearchDatepickers() {
	$('#search-form-date-checkin').datepicker('option', {
		defaultDate: 'd',
		minDate: 'd',		
		onClose: function() {
			var minOutDate = new Date(Date.parse($('#search-form-date-checkin').datepicker("getDate")) + 60*60*24*1000);
			$('#search-form-date-checkout').datepicker('option', 'minDate', minOutDate);
			homepageRecalculateDays();								
		}		
	});
	$('#search-form-date-checkout').datepicker('option', {		
		minDate: 'd+1',
		onClose: function() {
			homepageRecalculateDays();								
		}						
	});

	homepageRecalculateDays();
}

function homepageRecalculateDays() {
	var inDate = Date.parse($('#search-form-date-checkin').datepicker("getDate"));
	var outDate = Date.parse($('#search-form-date-checkout').datepicker("getDate"));						
	var sumDays = (outDate - inDate) / 1000 / 60 / 60 / 24;
		
	$('#search-form-sum-days .number').html(sumDays);
	$('#search-form-sum-days .word').html(declOfNum(sumDays, new Array('день', 'дня', 'дней')));	
}

function showInvisible(elem, invisibleElem) {
	invisibleElem.fadeIn(200).css({
		'z-index' : 6
	}).addClass('active-flying-element');
	elem.addClass('active-flying-element-button');
	createSubstrate();
}

function hideInvisible() {
	$('.active-flying-element').fadeOut('200');
	$('.active-flying-element-button').removeClass('active');
	$('.substrate').hide();
}

function createSubstrate() {
	var substrate = $('<div/>', {
		'class' : 'substrate',
		'click' : function() {
			hideInvisible();
		}
	}).appendTo('body');
}

function showRegisterForm() {
	$('#header-control-links .login-form').slideUp(function() {
		$('#header-control-links .register-form').slideDown();
	});
}

function showLoginForm() {
	$('#header-control-links .register-form').slideUp(function() {
		$('#header-control-links .login-form').slideDown();
	});
}

/*
 * Hotel search form (hotel items page) 
 */
function SearchFormShowValueFromInput(parent, titles) {
	var cnt = parseInt(parent.find('input').val());
	parent.find('.result').html(cnt + ' ' + declOfNum(cnt, titles));
}

$(function() {
	// vars
	switch(curLang) {
		case 'en_us':
			personsTitles = new Array('взрослый', 'взрослых', 'взрослых');
			childrenTitles = new Array('ребенок', 'детей', 'детей');		
			/*personsTitles = new Array('person', 'persons', 'persons');
			childrenTitles = new Array('child', 'children', 'children');*/
			break;
		case 'ru_ru':
		default:
			personsTitles = new Array('взрослый', 'взрослых', 'взрослых');
			childrenTitles = new Array('ребенок', 'детей', 'детей');
			break;							
	}		
	
	// initialize functions
	customizeCheckboxes();
	customizeSelects();
	customizeDateFields();
	homepageSearchDatepickers();
	SearchFormShowValueFromInput($('#search-form-parents'), personsTitles);
	SearchFormShowValueFromInput($('#search-form-children'), childrenTitles);	
	
	$('#search-form-parents .increase').click(function() {
		$('#search-form-parents input').val(parseInt($('#search-form-parents input').val()) + 1);
		SearchFormShowValueFromInput($('#search-form-parents'), personsTitles);	
	});
	$('#search-form-parents .decrease').click(function() {
		if($('#search-form-parents input').val() > 0) {
			$('#search-form-parents input').val(parseInt($('#search-form-parents input').val()) - 1);
			SearchFormShowValueFromInput($('#search-form-parents'), personsTitles);
		}	
	});	
	$('#search-form-children .increase').click(function() {
		$('#search-form-children input').val(parseInt($('#search-form-children input').val()) + 1);
		SearchFormShowValueFromInput($('#search-form-children'), childrenTitles);	
	});
	$('#search-form-children .decrease').click(function() {
		if($('#search-form-children input').val() > 0) {
			$('#search-form-children input').val(parseInt($('#search-form-children input').val()) - 1);
			SearchFormShowValueFromInput($('#search-form-children'), childrenTitles);
		}	
	});		
	
	$('#show-per-page-button .active').click(function() {
		var list = $(this).parent().find('ul');
		
		if(list.hasClass('opened') == true) {
			list.slideUp(200);
			list.removeClass('opened');
		} else {
			list.slideDown(200);
			list.addClass('opened');
		}
	});
	$('#show-per-page-button ul a').click(function() {
		$(this).parent().parent().slideUp(200).removeClass('opened');
	});
	
	$('#header-control-links > ul > li.parent').click(function() {
		if($(this).hasClass('active') == true) {
			//$(this).removeClass('active');
			//hideInvisible();
		} else {
			showInvisible($(this), $(this).find('.content'));
			$(this).addClass('active');
		}
	});
});
