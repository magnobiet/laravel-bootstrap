import 'jquery-slimscroll';
import 'icheck/icheck';

$(() => {

	const inputForm = $('input');

	if (inputForm.length) {

		inputForm.iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%'
		});

	}

	const logout = $('[data-logout]');

	if (logout.length) {

		logout.on('click', (event) => {

			event.preventDefault();
			$(logout.data().logout).submit();

		});

	}

});
