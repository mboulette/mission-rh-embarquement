$(function() {

	if ($('#form_news').length > 0) {

		$('#date_publication_group').daterangepicker({
			"showDropdowns": true,
			"timePicker": true,
			"timePicker24Hour": true,
			"timePickerIncrement": 5,
			"ranges": {
				"7 jours": [
					moment().set('minute', 0),
					moment().set('minute', 0).add(7, 'days')
				],
				"30 jours": [
					moment().set('minute', 0),
					moment().set('minute', 0).add(30, 'days')
				]
			},
			"locale": {
				"direction": "ltr",
				"format": "YYYY-MM-DD HH:mm",
				"separator": " à ",
				"applyLabel": "Appliquer",
				"cancelLabel": "Annuler",
				"fromLabel": "De",
				"toLabel": "À",
				"customRangeLabel": "Personalisé",
				"daysOfWeek": ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
				"monthNames": [
					"Janvier", "Février", "Mars", "Avril",
					"Mai", "Juin", "Juillet", "Août",
					"Septembre", "Octobre", "Novembre", "Décembre"
				],
				"firstDay": 1
			},
			"showCustomRangeLabel": false,
			"alwaysShowCalendars": true,
			"startDate": $('#date_publication').val(),
			"endDate": $('#date_end').val(),
			"applyClass": "btn-warning"
		}, function(start, end, label) {
		 
			$('#date_publication').val(start.format('YYYY-MM-DD HH:mm'));
			$('#date_end').val(end.format('YYYY-MM-DD HH:mm'));

		});


	}



	if ($('#form_events').length > 0) {

		$('#date_inscription_group').daterangepicker({
			"showDropdowns": true,
			"timePicker": true,
			"timePicker24Hour": true,
			"timePickerIncrement": 15,
			"ranges": {
				"7 jours": [
					moment().set('minute', 0),
					moment().set('minute', 0).add(7, 'days')
				],
				"30 jours": [
					moment().set('minute', 0),
					moment().set('minute', 0).add(30, 'days')
				]
			},
			"locale": {
				"direction": "ltr",
				"format": "YYYY-MM-DD HH:mm",
				"separator": " à ",
				"applyLabel": "Appliquer",
				"cancelLabel": "Annuler",
				"fromLabel": "De",
				"toLabel": "À",
				"customRangeLabel": "Personalisé",
				"daysOfWeek": ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
				"monthNames": [
					"Janvier", "Février", "Mars", "Avril",
					"Mai", "Juin", "Juillet", "Août",
					"Septembre", "Octobre", "Novembre", "Décembre"
				],
				"firstDay": 1
			},
			"showCustomRangeLabel": false,
			"alwaysShowCalendars": true,
			"startDate": $('#inscription_begin').val(),
			"endDate": $('#inscription_end').val(),
			"applyClass": "btn-warning"
		}, function(start, end, label) {
		 
			$('#inscription_begin').val(start.format('YYYY-MM-DD HH:mm'));
			$('#inscription_end').val(end.format('YYYY-MM-DD HH:mm'));

		});


		$('#date_event_picker').daterangepicker({
			"showDropdowns": true,
			"singleDatePicker": true,
			"timePicker": true,
			"timePicker24Hour": true,
			"timePickerIncrement": 15,
			"locale": {
				"direction": "ltr",
				"format": "YYYY-MM-DD HH:mm",
				"separator": " à ",
				"applyLabel": "Appliquer",
				"cancelLabel": "Annuler",
				"fromLabel": "De",
				"toLabel": "À",
				"customRangeLabel": "Personalisé",
				"daysOfWeek": ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
				"monthNames": [
					"Janvier", "Février", "Mars", "Avril",
					"Mai", "Juin", "Juillet", "Août",
					"Septembre", "Octobre", "Novembre", "Décembre"
				],
				"firstDay": 1
			},
			"showCustomRangeLabel": false,
			"alwaysShowCalendars": true,
			"startDate": $('#date_event').val(),
			"applyClass": "btn-warning"
		}, function(start, end, label) {
		 
			$('#date_event').val(start.format('YYYY-MM-DD HH:mm'));

		});


	}


	if ($('#form_profile').length > 0) {

		$('#birthday_picker').daterangepicker({
			"showDropdowns": true,
			"singleDatePicker": true,
			"locale": {
				"direction": "ltr",
				"format": "YYYY-MM-DD",
				"separator": " à ",
				"applyLabel": "Appliquer",
				"cancelLabel": "Annuler",
				"fromLabel": "De",
				"toLabel": "À",
				"customRangeLabel": "Personalisé",
				"daysOfWeek": ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
				"monthNames": [
					"Janvier", "Février", "Mars", "Avril",
					"Mai", "Juin", "Juillet", "Août",
					"Septembre", "Octobre", "Novembre", "Décembre"
				],
				"firstDay": 1
			},
			"showCustomRangeLabel": false,
			"alwaysShowCalendars": true,
			"startDate": $('#birthday').val(),
			"applyClass": "btn-warning"
		}, function(start, end, label) {
		 
			$('#birthday').val(start.format('YYYY-MM-DD'));

		});

	}

});