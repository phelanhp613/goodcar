/*********** Datetime Picker *************/
//VIETNAM CALENDAR
$.fn.datetimepicker.dates['vi'] = {
	days: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ nhật"],
	daysShort: ["CNhật", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy", "CNhật"],
	daysMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7", "CN"],
	months: [
		"Tháng một",
		"Tháng hai",
		"Tháng ba",
		"Tháng tư",
		"Tháng năm",
		"Tháng sáu",
		"Tháng bảy",
		"Tháng tám",
		"Tháng chín",
		"Tháng mười",
		"Tháng mười một",
		"Tháng mười hai"
	],
	monthsShort: [
		"Th. 1",
		"Th. 2",
		"Th. 3",
		"Th. 4",
		"Th. 5",
		"Th. 6",
		"Th. 7",
		"Th. 8",
		"Th. 9",
		"Th. 10",
		"Th. 11",
		"Th. 12"
	],
	today: "Hôm nay",
	meridiem: ['SA', 'CH']
};

var lang = $('html').attr('lang');
$('input.datetime').datetimepicker({
	format: 'dd-mm-yyyy hh:ii', //'dd-mm-yyyy HH:ii P'
	fontAwesome: true,
	autoclose: true,
	todayHighlight: true,
	todayBtn: true,
	language: lang,
	//VN Calendar
	// showMeridian: true
});
$('input.date').datetimepicker({
	format: 'dd-mm-yyyy',
	fontAwesome: true,
	autoclose: true,
	todayHighlight: true,
	startView: 2, // 0: hour current, 1: time in date current, 2: date
                  // in month current, 3: month in year current, 4 year
                  // in decade current
	minView: 2,
	todayBtn: true,
	language: lang,
});
$('input.time').datetimepicker({
	format: 'hh:ii',
	fontAwesome: true,
	autoclose: true,
	startView: 1,
	language: lang,
});
$('input.month').datetimepicker({
	format: 'mm-yyyy',
	fontAwesome: true,
	autoclose: true,
	startView: 3,
	minView: 3,
	language: lang,
});
$('input.year').datetimepicker({
	format: 'yyyy',
	fontAwesome: true,
	autoclose: true,
	startView: 4,
	minView: 4,
	language: lang,
});
/***********************************************************************/