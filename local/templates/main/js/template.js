'use strict';

/**
 * Общий функционал шаблона
 */
esta.app.blocks.common = function()
{
	/**
	 * Признак первичной инициализации (при загрузке документа)
	 *
	 * @var boolean
	 */
	var firstInit = true;

	/**
	 * Параметры viewport
	 *
	 * @var object
	 */
	var viewport = {
		width: 0,
		height: 0,
		size: '',
		sizeChanged: false
	};

	/**
	 * Обработчик изменения размеров окна браузера
	 *
	 * @return void
	 */
	var onWindowResize = function()
	{
		viewport.width = $(window).width();
		viewport.height = $(window).height();

		var prevSize = viewport.size;

		//Check breakpoints
		if (viewport.width <= 660) {
			viewport.size = 's';
		} else if (viewport.width <= 960) {
			viewport.size = 'm';
		} else {
			viewport.size = 'l';
		}

		viewport.sizeChanged = viewport.size != prevSize;
	};

	/**
	 * Возвращает параметры viewport
	 *
	 * @return object
	 */
	this.getViewport = function()
	{
		return viewport;
	};

	/**
	 * Инициализирует UI в заданном элементе DOM
	 *
	 * @param jQuery domElement DOM element
	 * @return void
	 */
	this.initDOM = function(domElement)
	{

        (function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)

		//Заставляем selectivizr заново обработать DOM при повторных инициализациях
		if (!firstInit && typeof Selectivizr != 'undefined') {
			Selectivizr.init();
		}

		// Показываем/скрываем пароль в полях форм
		domElement.find('.form .glyphicon-eye-open, .form .glyphicon-eye-close').click(function() {
			var icon = $(this);
			var field = icon.closest('.form-group').find('input');

			if (!icon.data('show-title')) {
				icon.data('show-title', icon.attr('title') || '');
			}

			if (icon.hasClass('glyphicon-eye-open')){
				field.attr('type', 'text');
				icon
					.removeClass('glyphicon-eye-open')
					.addClass('glyphicon-eye-close')
					.attr('title', icon.data('hide-title'));
			} else {
				field.attr('type', 'password');
				icon
					.removeClass('glyphicon-eye-close')
					.addClass('glyphicon-eye-open')
					.attr('title', icon.data('show-title'));
			}

			return false;
		});

		//маска на телефон
		try {
			domElement.find('input[type="tel"]').mask(
				"+7 (999) 999-99-99"
			);
		}
		catch (e) {
			console.log(e);
		}

		firstInit = false;
	};


	//Обработчик ресайза окна
	$(window).resize(onWindowResize);
	onWindowResize();

	//Обработчик инициализиации UI
	esta.ui.onInit(this.initDOM, this);
};



/**
 * Блок шаблона "Карта объектов "
 */
esta.app.blocks.map = function()
{
    var placeMarks = $(".js-placemark");
        ymaps.ready(function () {
            var myMap = new ymaps.Map('bigmap', {
                    center: [61.69607760308009,96.36315571388933],
                    zoom: 3,
                    controls: ['zoomControl', 'typeSelector',  'fullscreenControl']
                }, {
                    searchControlProvider: 'yandex#search'
                })
              ;
            $(placeMarks).each(function() {
                var placeName = $(this).attr("data-name");
                var placeX = $(this).attr("data-coord-x");
                var placeY = $(this).attr("data-coord-y");
                myMap.geoObjects
                    .add(new ymaps.Placemark([placeX,placeY], {
                    balloonContent: placeName
                }, {
                    iconLayout: 'default#image',
                    // Своё изображение иконки метки.
                    iconImageHref: '/local/templates/main/images/general/baloon.png',
                    // Размеры метки.
                    iconImageSize: [27, 34],
                    // Смещение левого верхнего угла иконки относительно
                    // её "ножки" (точки привязки).
                    iconImageOffset: [-3, -42]
                }))
            });



        });
};

/**
 * Проверяет наличие блока "Карта объектов"
 *
 * @return boolean
 */
esta.app.blocks.map.exists = function()
{
	return $('.map').length > 0;
};


/**
 * Блок шаблона "Всплывающая форма"
 */
esta.app.blocks.popupFormSend = function () {

    //Обработчик отправки формы
    $(document).on('submit', '.js-popup-form', function (e) {
        $(this).find(':input[type="submit"]').prop('disabled', true);
        var $form = $(this);
        var $formId = $form.closest(".js-popup-form-container").attr("data-id");
        $.post(
            $(this).attr('action'),
            $(this).serialize(),
            function (reponse) {
                $form.closest(".js-popup-form-container").replaceWith(
                    $(reponse).find('.js-popup-form-container[data-id="'+$formId+'"]')
                );
            }
        );
        e.stopImmediatePropagation();
        return false;
    });
};
esta.app.blocks.popupFormSend.exists = function()
{
    return $('.js-popup-form').length > 0;
};


/**
 * Блок шаблона "Ссылка, открывающая форму во всплывающем окне"
 */
esta.app.blocks.popupForm = function()
{
	var showModal = function(link) {
		var id = link.data('modal-id');
		var modal = id ? $('#' + id) : null;

		if (modal === null) {
			return false;
		}
		modal = modal.find('.modal');

		if(!modal.data('modal-ready')) {
			modal.data('modal-ready', true);

			esta.ui.init(modal);

			//Обработчик отправки формы
			modal.on('submit', 'form', function() {
				$(this).find(':input[type="submit"]').prop('disabled', true);

				var loading = new esta.ui.loading(this);

				$.post(
					$(this).attr('action'),
					$(this).serialize(),
					function(reponse) {
						loading.hide();

						modal.find('.modal-body').replaceWith(
							$(reponse).find('.modal-body')
						);
						modal.find('.has-error:first :input:first').focus();

						esta.ui.init(modal);
					}
				);

				return false;
			});

			//Интеграция с HTML5-валидацией
			modal.on('click', 'form :input[type="submit"]', function() {
				$(this).closest('form').addClass('invalid');
			});

			//Закрытие по кнопке
			modal.on('click', '.btn-close', function() {
				modal.modal('hide');
			});
		}

		modal.modal({
			//backdrop: 'static'
		});

		return true;
	};

	var loadModal = function(link, callback) {
		var loading = new esta.ui.loading('body');

		$.get(
			link.data('href'),
			function(response) {
				loading.hide();

				var id = link.data('modal-id');
				if (!id) {
					id = esta.utils.getId('id');
					link.data('modal-id', id);
				}

				response = $('<div/>')
					.attr('id', id)
					.html(response);

				if (response.find('.modal').length == 0) {
					response.wrapInner(
						'<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">' +
						'	<div class="modal-dialog modal-md">' +
						'		<div class="modal-content">' +
						'			<div class="modal-body">' +
						'			</div>' +
						'		</div>' +
						'	</div>' +
						'</div>'
					);
				}

				response.appendTo('body');

				callback();
			}
		);
	};

	/**
	 * Инициализирует UI в заданном элементе DOM
	 *
	 * @param jQuery domElement DOM element
	 * @return void
	 */
	this.initDOM = function(domElement)
	{
		domElement.find('a.popup-form').each(function() {
			var link = $(this);

			link
				//Заменяем href, чтобы такие ссылки не открывались через контекстное меню "Открыть в новом окне"
				.data('href', link.attr('href'))
				.attr('href', 'javascript:;')
				//По click загружаем форму
				.click(function() {
					if (!showModal(link)) {
						loadModal(link, function() {
							showModal(link);
						});
					}

					return false;
				});
		});
	};

	//Обработчик инициализиации UI
	esta.ui.onInit(this.initDOM, this);
};




/* Инициализация после готовности DOM */
$(function() {
	esta.init();
});