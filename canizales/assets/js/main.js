(function () {
	'use strict';

	/* Sombra de la cabecera al hacer scroll */
	var onScroll = function () {
		document.body.classList.toggle('is-scrolled', window.scrollY > 24);
	};
	onScroll();
	window.addEventListener('scroll', onScroll, { passive: true });

	/* Aparición progresiva de títulos, columnas y tarjetas */
	var selector = [
		'.sitio-main h2',
		'.sitio-main .wp-block-columns > .wp-block-column',
		'.sitio-main .wp-block-post-template > li',
		'.sitio-main .cita__texto',
		'.llamado h2'
	].join(',');
	var items = Array.prototype.filter.call(document.querySelectorAll(selector), function (el) {
		return !el.closest('.is-style-faro, .is-style-cifras, .is-style-cabecera');
	});

	if ('IntersectionObserver' in window) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					io.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.06 });

		items.forEach(function (el) {
			var siblings = el.parentElement ? el.parentElement.children : [];
			var index = Array.prototype.indexOf.call(siblings, el);
			el.style.setProperty('--d', Math.max(0, Math.min(index, 5)));
			el.classList.add('reveal');
			io.observe(el);
		});
	}

	/* Validación del formulario de contacto */
	var form = document.querySelector('[data-form]');
	if (form) {
		form.addEventListener('submit', function (e) {
			var firstInvalid = null;
			form.querySelectorAll('[required]').forEach(function (input) {
				var field = input.closest('.field');
				var valid = input.type === 'checkbox' ? input.checked : input.checkValidity() && input.value.trim() !== '';
				if (field) {
					field.classList.toggle('is-invalid', !valid);
				}
				input.setAttribute('aria-invalid', valid ? 'false' : 'true');
				if (!valid && !firstInvalid) {
					firstInvalid = input;
				}
			});
			if (firstInvalid) {
				e.preventDefault();
				firstInvalid.focus();
				return;
			}
			var submit = form.querySelector('[type="submit"]');
			if (submit) {
				submit.disabled = true;
				submit.setAttribute('aria-busy', 'true');
			}
		});
		form.addEventListener('input', function (e) {
			var field = e.target.closest('.field');
			if (field && field.classList.contains('is-invalid')) {
				var ok = e.target.type === 'checkbox' ? e.target.checked : e.target.checkValidity();
				field.classList.toggle('is-invalid', !ok);
			}
		});
	}
})();
