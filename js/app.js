'use strict';

function IndexController (settings) {

	onInit();

	function onInit () {
		renderBillingTable();
		renderBillingCard();
		addListenerInputChange();
		addListenerSelect();
		addListenerCheckboxSelectAll();
		addListenerOblastSelectAll();
	}

	function addListenerInputChange () {
        $(document).on('change', '.card .card-content .existing-row input[type=checkbox], .card .card-content select', function (e) {
        	renderBillingTable();
        	renderBillingCard();
		});
	}

	function addListenerSelect () {
        $(document).on('change', '.card .card-content select', function (e) {
        	var el = $(this).parents('.existing-row');
        	el.find('input[type=checkbox]').prop('checked', true);
        	renderBillingTable();
        	renderBillingCard();
		});
	}

	function addListenerCheckboxSelectAll () {
        $(document).on('change', '.card-header input[type=checkbox]', function (e) {
        	var checked = $(this).is(':checked');
        	var el = $(this).parents('.card');
        	el.find('.card-content input[type=checkbox]').prop('checked', checked);
        	setYears(el.find('.card-content .years'), checked);
		});
	}

	function addListenerOblastSelectAll () {
        $(document).on('change', '.oblast-group h4 input[type=checkbox]', function (e) {
        	var checked = $(this).is(':checked');
        	var el = $(this).parents('.oblast-group');
        	el.find('.oblast-group-content .existing-row input[type=checkbox]').prop('checked', checked);
        	setYears(el.find('.oblast-group-content .years'), checked);
		});
	}

	function setYears (years, checked) {
    	years.each(function (i, year) {
    		var select = $(year).find('select:last-child');
        	var options = select.find('option');
        	select.val(checked ? options[options.length - 1].value : options[0].value);
    	});
    	renderBillingTable();
    	renderBillingCard();
	}

	function renderBillingCard () {
		var values = getBillingValues();
		values.map(function (country) {
			$('.country-' + country.id + ' .card-header .right').text(
				country.total ? country.total + settings.currency.value : ''
			);
		});
	}

	function renderBillingTable () {
		var table = $('.billing-table');
		var values = getBillingValues();
		var total = calculateBillingTotal(values);

		table.html('');

		createBillingTableRow(table, settings.totalText, total + settings.currency.value);
		values.map(function (country) {
			if (country.total > 0) createBillingTableRow(table, country.title, country.total + settings.currency.value);
		});
	}

	function createBillingTableRow (table, name, value) {
		var tr = document.createElement('tr');
		var th = document.createElement('th');
		var td = document.createElement('td');

		$(th).text(name);
		$(td).text(value);
		$(tr).append(th);
		$(tr).append(td);
		table.append(tr);
	}

	function getBillingValues () {
		var results = [];
		$('.country').each(function (i, el) {
			var indicators = $(el).find('.existing-row input:checked');
			var country = {
				id: $(el).attr('data-id'),
				title: $(el).attr('data-title'),
				total: 0
			};
			indicators.each(function (i, indicator) {
				var years = $(indicator).parents('.existing-row').find('.years select');
				country.total += ($(years[1]).val() - $(years[0]).val() + 1) * settings.price.value;
			});
			results.push(country);
		});
		return results;
	}

	function calculateBilling () {
		var results = getBillingValues();
		results = results.map(function (country) {
			country.total = country.oblasts * country.indicators * (country.yearEnd - country.yearStart + 1) * settings.price.value;
			return country;
		});
		return results;
	}

	function calculateBillingTotal (results) {
		var total = 0;
		results.map(function (country) {
			total += country.total;
		});
		return total;
	}

}