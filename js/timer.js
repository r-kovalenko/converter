var hour_el, min_el, sec_el, msec_el,
	hour, min, sec, msec, msectd_el,
	start_button, stop_button, reset_button, check_button,
	interval = 50,
	interval_id = null,
	current_time = null,
	start_time = null,
	stop_time = null;

function init() {
	hour_el = document.getElementById('hours');
	min_el = document.getElementById('minutes');
	sec_el = document.getElementById('seconds');
	msec_el = document.getElementById('miliseconds');
	msectd_el = document.getElementById('miliseconds_twodot');

	start_button = document.getElementById('start');
	stop_button = document.getElementById('stop');
	reset_button = document.getElementById('reset');
	check_button = document.getElementById('checkbox-label');

	start_button.disabled = false;
	stop_button.disabled = true;
	reset_button.disabled = true;
}

function start() {
	if (stop_time) {
		start_time = new Date(new Date().valueOf() - (stop_time - start_time));
		stop_time = null;
	} else {
		start_time = new Date();
	}
	interval_id = setInterval(timer_run, interval);
	start_button.disabled = true;
	stop_button.disabled = false;
	reset_button.disabled = false;
}

function stop() {
	if (!stop_time) {
		stop_time = new Date();
	}
	clearInterval(interval_id);
	interval_id = null;
	start_button.disabled = false;
	stop_button.disabled = true;
	reset_button.disabled = false;
}


function change_checkbox() {
	check_button.checked = (check_button.checked) ? false : true;
	checkbox();
}

function checkbox() {
	if (check_button.checked) {
		msec_el.style.display = 'block'
		msectd_el.style.display = 'block';
		document.getElementById('timer').style.fontSize = '130px';
	} else {
		msec_el.style.display = 'none';
		msectd_el.style.display = 'none';
		document.getElementById('timer').style.fontSize = '190px';
	}
}

function reset() {
	time_print(new Date(0));
	stop_time = null;
	clearInterval(interval_id);
	interval_id = null;
	start_button.disabled = false;
	stop_button.disabled = true;
	reset_button.disabled = true;
}

function timer_run() {
	current_time = new Date();
	time_print(new Date(current_time - start_time));
}

function time_print(time) {
	hour = format_number(time.getUTCHours(), '00');
	min = format_number(time.getUTCMinutes(), '00');
	sec = format_number(time.getUTCSeconds(), '00');
	msec = format_number(time.getUTCMilliseconds(), '000');
	hour_el.innerHTML = hour;
	min_el.innerHTML = min;
	sec_el.innerHTML = sec;
	msec_el.innerHTML = msec;
}

function format_number(num, mask) {
	var result;
	num = Math.floor(num);
	result = mask.substring(0, mask.length - num.toString().length) + num;
	return result;
}

function register(e) {
	if (!e) e = window.event;
	var k = e.keyCode;
	if (k == 32) {
		if (interval_id) {
			stop();
		} else {
			start();
		}
	}
	if (k == 82) reset();
	if (k == 27) reset();
}
document.onkeydown = register;