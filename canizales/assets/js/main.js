(function () {
	'use strict';

	var root = document.documentElement;
	var header = document.querySelector('[data-header]');
	var toggle = document.querySelector('[data-nav-toggle]');
	var nav = document.querySelector('[data-nav]');

	/* Cabecera al hacer scroll */
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 24);
		};
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* Menú móvil */
	if (toggle && nav) {
		var setOpen = function (open) {
			root.classList.toggle('nav-open', open);
			document.body.classList.toggle('nav-open', open);
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		};
		toggle.addEventListener('click', function () {
			setOpen(toggle.getAttribute('aria-expanded') !== 'true');
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
				setOpen(false);
				toggle.focus();
			}
		});
		nav.addEventListener('click', function (e) {
			if (e.target.closest('a')) {
				setOpen(false);
			}
		});
		window.matchMedia('(min-width: 1080px)').addEventListener('change', function (mq) {
			if (mq.matches) {
				setOpen(false);
			}
		});
	}

	/* Aparición progresiva */
	var reveals = document.querySelectorAll('.reveal');
	if ('IntersectionObserver' in window) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					io.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
		reveals.forEach(function (el, i) {
			if (!el.style.getPropertyValue('--d')) {
				var siblings = el.parentElement ? el.parentElement.querySelectorAll(':scope > .reveal') : [];
				var index = Array.prototype.indexOf.call(siblings, el);
				el.style.setProperty('--d', Math.max(0, Math.min(index, 5)));
			}
			io.observe(el);
		});
	} else {
		reveals.forEach(function (el) { el.classList.add('is-visible'); });
	}

	/* Video con carga diferida */
	document.querySelectorAll('[data-video]').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var wrap = document.createElement('div');
			wrap.className = 'video-embed';
			var iframe = document.createElement('iframe');
			iframe.src = btn.getAttribute('data-video');
			iframe.title = btn.getAttribute('aria-label') || 'Video';
			iframe.allow = 'autoplay; fullscreen; picture-in-picture';
			iframe.allowFullscreen = true;
			wrap.appendChild(iframe);
			btn.replaceWith(wrap);
		});
	});

	/* Validación del formulario */
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
