$(function () {
	$('#tglAwal').datetimepicker({
		pickTime: false,
		defaultDate: moment(),
		minDate: moment('01-01-2015', 'DD-MM-YYYY'),
		maxDate: moment()
	});
	$('#tglAkhir').datetimepicker({
		pickTime: false,
		defaultDate: moment(),
		minDate: moment('01-01-2015', 'DD-MM-YYYY'),
		maxDate: moment()
	});
	$('#tglAwal').on("dp.change", function (e) {
		$('#tglAkhir').data("DateTimePicker").setMinDate(e.date);
	});
	$('#tglAkhir').on("dp.change", function (e) {
		$('#tglAwal').data("DateTimePicker").setMaxDate(e.date);
	});
});