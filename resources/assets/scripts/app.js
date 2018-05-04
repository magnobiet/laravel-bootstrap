import './bootstrap';
import './plugins';
import {
	__
} from './localization';

$(document).ready(() => {

	function formValidate(target) {

		if (target.length && $.fn.validate) {

			$.validator.setDefaults({
				focusCleanup: true,
				errorElement: 'em',
				errorClass: 'has-error',
				validClass: 'has-success',
				highlight(element, errorClass, validClass) {
					$(element).parents('.form-group').addClass(errorClass).removeClass(validClass);
				},
				unhighlight(element, errorClass, validClass) {
					$(element).parents('.form-group').addClass(validClass).removeClass(errorClass);
				}
			});

			target.length > 1 ? target.each(() => $(this).validate()) : target.validate();

		}

	}

	function customCheckboxRadio(target) {

		if (target.length && $.fn.iCheck) {

			target.iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%'
			});

		}

	}

	function tableDestroyEntry(target) {

		if (target.length) {

			target.on('click', (event) => confirm(__('Do you really want to delete this record?')));

		}

	}

	function logoutButton(target) {

		if (target.length) {

			target.on('click', (event) => {

				event.preventDefault();
				$(target.data().logout).submit();

			});

		}
	}

	function markSearchedWord(target, options = {}) {

		const urlParams = new URLSearchParams(window.location.search);

		if (urlParams.has('search')) {

			const mark = new Mark(target);

			mark.unmark({
				done() {

					mark.mark(urlParams.get('search'), options);

				}
			});

		}

	}

	function jsonViewer(target) {

		if (target.length) {
			target.JSONView(target.html());
		}

	}

	function init() {

		formValidate($('form[data-validate]'));
		customCheckboxRadio($('input[type="checkbox"], input[type="radio"]'));

		tableDestroyEntry($('[data-destroy]'));
		logoutButton($('[data-logout]'));

		markSearchedWord(document.querySelectorAll('.content .box-body'));

		jsonViewer($('[data-json-viewer]'));

	}

	init();

});
