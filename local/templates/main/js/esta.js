/**
 * @category	Esta
 * @link		http://estavid.ru
 * @revision	$Revision$
 * @date		$Date$
 */

'use strict';

/**
 * Esta namespace
 */
var esta = new function()
{
	/**
	 * Признак инициализации
	 *
	 * @var boolean
	 */
	var initialized = false;

	/**
	 * Инициализирует все функциональные части
	 *
	 * @return void
	 */
	this.init = function()
	{
		if (initialized) {
			return;
		}
		initialized = true;

		esta.app.init();
		esta.ui.init();
	};
};




/**
 * Приложение
 */
esta.app = new function()
{
	/**
	 * Инициализирует приложение
	 *
	 * @return void
	 */
	this.init = function()
	{
		//Инициализируем локаль
		this.locale.init();

		//Инициализируем функциональные блоки
		this.blocks.init();
	};
};




/**
 * Функциональные блоки приложения
 */
esta.app.blocks = new function()
{
	/**
	 * Ф-ии обратного вызова о готовности всех функциональных блоков
	 *
	 * @var array
	 */
	var initCallbacks = [];
	
	/**
	 * Зарезервированные названия блоков, которые нельзя переопределять
	 *
	 * @var object
	 */
	var reserved = {};
	
	/**
	 * Добавляет ф-ю обратного вызова о готовности всех блоков
	 *
	 * @param object callback Ф-я обратного вызова
	 * @param object context Контекст вызова ф-ии
	 * @return void
	 */
	this.onInit = function(callback, context)
	{
		initCallbacks.push({
			callback: callback,
			context: context = context || this
		});
	};
	
	/**
	 * Инициализирует функциональные блоки
	 *
	 * @return void
	 */
	this.init = function()
	{
		for (var key in this) {
			if (reserved[key]) {
				continue;
			}
			
			var blockConstructor = this[key];
			if (typeof blockConstructor == 'function') {
				var blockExists = blockConstructor.exists ? blockConstructor.exists() : true;
				if (blockExists) {
					this[key] = new blockConstructor();
				}
			}
		}
		
		for (var i = 0; i < initCallbacks.length; i++) {
			initCallbacks[i].callback.call(
				initCallbacks[i].context
			);
		};
	};
	
	//Заполняем зарезервированные названия блоков
	for (var key in this) {
		reserved[key] = true;
	}
};




/**
 * Локаль
 */
esta.app.locale = new function()
{
	/**
	 * Настройки локали
	 *
	 * @var object
	 */
	this.settings = {
		date: 'dd.mm.yy',
		time: 'hh:mm',
		dateTime: 'dd.mm.yy hh:mm',
		firstDay: 1,
		isRTL: false
	};
	
	/**
	 * Сообщения локали
	 *
	 * @var object
	 */
	this.messages = {
		monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
		dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		dayNamesMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
		close: 'Close',
		datePicker: {
			prev: '&larr;Previous',
			next: 'Next&rarr;',
			current: 'Today',
			showMonthAfterYear: false,
			weekHeader: 'Wk',
			yearSuffix: ''
		},
		timePicker: {
			timeOnlyTitle: 'Choose time',
			timeText: 'Time',
			hourText: 'Hours',
			minuteText: 'Minutes',
			secondText: 'Seconds',
			millisecText: 'Milliseconds',
			currentText: 'Now',
			ampm: true
		},
		alert: {
			title: 'System message',
			ok: 'Ok'
		}
	};
	
	/**
	 * Возвращает отформатированную строку
	 * Требуется jQuery UI datepicker.
	 *
	 * @param Date date Дата для форматирования
	 * @param String format Формат (по-умолчанию esta.app.locale.settings.date)
	 * @return String
	 */
	this.format = function(date, format)
	{
		format = format === undefined ? this.settings.date : format;
		
		return $.datepicker.formatDate(format, date);
	};
	
	/**
	 * Разбирает отформатированную строку
	 * Требуется jQuery UI datepicker.
	 *
	 * @param String date Отформатированная дата
	 * @param String format Формат (по-умолчанию esta.app.locale.settings.date)
	 * @return Date
	 */
	this.parse = function(date, format)
	{
		format = format === undefined ? this.settings.date : format;
		
		return $.datepicker.parseDate(format, date);
	};
	
	/**
	 * Инициализирует локаль
	 *
	 * @return void
	 */
	this.init = function()
	{
		if($.datepicker)
		{
			$.datepicker.regional[''] = {
				closeText: this.messages.close,
				prevText: this.messages.datePicker.prev,
				nextText: this.messages.datePicker.next,
				currentText: this.messages.datePicker.current,
				monthNames: this.messages.monthNames,
				monthNamesShort: this.messages.monthNamesShort,
				dayNames: this.messages.dayNames,
				dayNamesShort: this.messages.dayNamesShort,
				dayNamesMin: this.messages.dayNamesMin,
				weekHeader: this.messages.datePicker.weekHeader,
				dateFormat: this.settings.date,
				firstDay: this.settings.firstDay,
				isRTL: this.settings.isRTL,
				showMonthAfterYear: this.messages.datePicker.showMonthAfterYear,
				yearSuffix: this.messages.datePicker.yearSuffix
			};
			$.datepicker.setDefaults($.datepicker.regional['']);
		}
		
		if($.timepicker)
		{
			$.timepicker.regional[''] = {
				timeOnlyTitle: this.messages.timePicker.timeOnlyTitle,
				timeText: this.messages.timePicker.timeText,
				hourText: this.messages.timePicker.hourText,
				minuteText: this.messages.timePicker.minuteText,
				secondText: this.messages.timePicker.secondText,
				millisecText: this.messages.timePicker.millisecText,
				currentText: this.messages.timePicker.currentText,
				closeText: this.messages.close,
				ampm: this.messages.timePicker.ampm
			};
			$.timepicker.setDefaults($.timepicker.regional['']);
		}
	};
};




/**
 * User interface
 */
esta.ui = new function()
{
	/**
	 * Ф-ии обратного вызова о готовности виджетов
	 *
	 * @var array
	 */
	var initCallbacks = [];
	
	/**
	 * Отображает всплывающий диалог с сообщением
	 *
	 * @param string messge Текст сообщения
	 * @param object config Конфигурация диалога
	 * @return void
	 */
	this.alert = function(message, config)
	{
		config = $.extend({
			appDriver: '',
			appType: 'info'
		}, config || {});
		
		var alertClass = 'esta-app-alert ' + config.appType;
		
		if (!config.appDriver) {
			if ($.fancybox) {
				config.appDriver = 'fancybox';
			} else if ($.dialog) {
				config.appDriver = 'dialog';
			}
		}
		
		switch (config.appDriver) {
			/* Fancybox driver */
			case 'fancybox':
				config = $.extend({
					title: esta.app.locale.messages.alert.title,
					wrapCSS: alertClass,
					helpers: {
						title: null
					},
					afterShow: function() {
						this.inner && this.inner.on('click', '.toolbar :input', function() {
							if ($(this).hasClass('ok')) {
								$.fancybox.close();
							}
						});
					}
				}, config);
				message =
					'<div class="title">' + config.title + '</div>' + 
					'<div class="message">' + message + '</div>' + 
					'<div class="toolbar"><button class="ok">' + esta.app.locale.messages.alert.ok + '</button></div>';
				
				$.fancybox(message, config);
				
				break;
			
			/* jQuery UI "dialog" driver */
			case 'dialog':
				config = $.extend({
					modal: true,
					dialogClass: alertClass,
					title: esta.app.locale.messages.alert.title,
					width: 500,
					buttons: {
						Ok: function() {
							$(this).dialog('close');
						}
					},
					open: function(event, ui) {
						esta.ui.init($(this).parents('.ui-dialog'));
					},
					close: function(event, ui) {
						dialog.dialog('destroy');
						dialog.remove();
						dialog = null;
					}
				}, config);
				
				if(config.width == 'auto')
					config.width = $(document).width() - 100;
				
				var dialog = $('<div class="dialog-message">' + message + '</div>').dialog(config);
				
				break;
		}
	};
	
	/**
	 * Добавляет ф-ю обратного вызова при инициализации UI
	 *
	 * @param object callback Ф-я обратного вызова
	 * @param object context Контекст вызова ф-ии
	 * @return void
	 */
	this.onInit = function(callback, context)
	{
		initCallbacks.push({
			callback: callback,
			context: context || this
		});
	};
	
	/**
	 * Инициализирует UI
	 *
	 * @param string selector Родительский элемент
	 * @return void
	 */
	this.init = function(selector)
	{
		if (selector === undefined) {
			selector = $('body');
		} else {
			selector = $(selector);
		}
		
		this.widgets.init(selector);
		
		for (var i = 0; i < initCallbacks.length; i++) {
			initCallbacks[i].callback.call(
				initCallbacks[i].context,
				selector
			);
		};
	}
};

/**
 * Виджеты
 */
esta.ui.widgets = new function()
{
	/**
	 * Конструкторы виджетов
	 *
	 * @var object
	 */
	this.items = {};
	
	/**
	 * Создает стилизованное поле загрузки файла
	 *
	 * @param string|object selector Селектор узлов DOM
	 * @return void
	 */
	this.items['uploadpicker'] = function(selector)
	{
		$(selector).each(function() {
			var field = $(this);
			var required = field.is('[required]');
			var disabled = field.is('[disabled]');
			var placeholder = field.attr('placeholder');
			field
				.addClass('upload-field-overlay')
				.removeAttr('required')
				.css({
					cursor: 'pointer',
					fontSize: '200px',
					height: 'auto',
					opacity: 0,
					position: 'absolute',
					right: 0,
					top: '-0.5em',
					width: 'auto'
				})
				.wrap('<span class="widget-upload-field"/>')
			
			var wrapper = field.parent();
			wrapper
				.css({
					backgroundColor: 'transparent',
					display: 'block',
					overflow: 'hidden',
					position: 'relative'
				})
				.prepend('<input class="upload-field-value form-control" type="text"'
					+ (required ? ' required=""' : '')
					+ (disabled ? ' disabled=""' : '')
					+ (placeholder ? ' placeholder="' + placeholder + '"' : '')
					+ ' />');
			
			field.on({'change': function() {
					var values = [this.value.split(/[\/\\]/).pop()];
					if (this.files) {
						values = [];
						for (var i = 0; i < this.files.length; i++) {
							values.push(this.files[i].name);
						}
					}
					values.length ? wrapper.addClass('has-value') : wrapper.removeClass('has-value');
					wrapper.find('.upload-field-value').val(values.join(', '));
				}, 'keypress': function(event) {
					if (event.key == 'Backspace') {
						if (this.value) {
							event.preventDefault();
							this.value = '';
							$(this).trigger('change');
						}
					}
				}
			});
		});
	};
	
	/**
	 * Создает поле выбора даты
	 *
	 * @param string|object selector Селектор узлов DOM
	 * @return void
	 */
	this.items['datepicker'] = function(selector)
	{
		if (!$.datepicker) {
			return;
		}
		
		var defaults = esta.ui.widgets.items.datepicker.defaults;
		
		$(selector).each(function() {
			var element = $(this);
			
			element.datepicker($.extend(
				{},
				defaults,
				element.data('config') || {}
			));
			
			if (element.is(':input')) {
				element
					.keypress(function(event) {
						switch(event.keyCode)
						{
							case 13:
								//Если Enter нажимается при открытом календаре - убираем каленрарь и сабмитим форму
								if ($(this).datepicker('widget').css('display') != 'none') {
									event.stopPropagation();
									$(this).datepicker('hide');
									if (this.form) {
										$(this.form).trigger('submit');
									}
								}
								break;
						}
					})
					.after(
						'<span class="datepicker-icon" title="Выбрать дату"></span>'
					)
					.next('.datepicker-icon')
						.click(function() {
							$(this).prev('.datepicker').datepicker('show');
						});
			}
		});
	};
	
	this.items['datepicker'].defaults = {
		changeMonth: false,
		changeYear: false,
		minDate: new Date(1900, 1, 1),
		maxDate: ''
	};
	
	/**
	 * Создает поле выбора времени
	 *
	 * @param string|object selector Селектор узлов DOM
	 * @return void
	 */
	this.items['timepicker'] = function(selector)
	{
		if (!$.timepicker || !$.mask) {
			return;
		}
		
		$(selector)
			.timepicker()
			.mask('99:99');
	};
	
	/**
	 * Создает переключатель в виде закладок (табов)
	 * Примерный markup:
	 * <div class="widget tabpane">
	 * 	<ul class="tabs">
	 * 		<li><a class="fake" href="#tab-1">Tab 1</a></li>
	 * 		<li><a class="fake" href="#tab-2">Tab 2</a></li>
	 * 	</ul>
	 * 	<div class="panes">
	 * 		<div id="tab-1" class="pane">Content 1</div>
	 * 		<div id="tab-2" class="pane">Content 2</div>
	 * 	</div>
	 * </div>
	 *
	 * @param string|object selector Селектор узлов DOM
	 * @return void
	 */
	this.items['tabpane'] = function(selector)
	{
		var defaults = esta.ui.widgets.items.tabpane.defaults;
		
		$(selector).each(function() {
			//Виджет
			var tabPane = $(this);
			
			//Конфигурация
			var config = $.extend(
				{},
				defaults,
				tabPane.data('config') || {}
			);
			
			//Ищет контроллер закладки с заданным hash
			var findTabController = function(hash) {
				return tabPane.find(config.tabsSelector + ' a[href="' + hash + '"]');
			};
			
			//Активирует закладку с заданным hash
			var activateTab = function(hash, reason) {
				if (hash.substr(0, 1) != '#') {
					if (reason == 'click') {
						document.location.href = hash;
					}
					return;
				}
				var controller = findTabController(hash);
				var item = controller.closest('li').length ? controller.closest('li') : controller;
				item
					.addClass('active')
					.siblings().removeClass('active');
				
				tabPane.find(config.tabsSelector + ' a').each(function() {
					var href = $(this).attr('href');
					if (href.substr(0, 1) == '#') {
						var pane = tabPane.find(
							config.panesSelector + href
						);
						if (this === controller.get(0)) {
							pane
								.show()
								.trigger('widget.tabpane:show')
						} else {
							pane
								.hide()
								.trigger('widget.tabpane:hide');
						}
					}
				});
				
				//Если виджет в виджете, то нужно запустить цепочку переключений вверх по DOM
				if (!tabPane.is(':visible')) {
					tabPane.closest(config.panesSelector).trigger('widget.tabpane:activate');
				}
			};
			
			//Событие активации, позволяет управлять виджетом извне
			tabPane.on('widget.tabpane:activate', function(event) {
				var id = $(event.target).attr('id');
				if (id) {
					activateTab('#' + id, 'activate');
				}
			});
			
			//Класс закладок
			if (config.tabsClass) {
				tabPane.find(config.tabsSelector).addClass(config.tabsClass);
			}
			
			//Клики по закладкам
			tabPane.find(config.tabsSelector + ' a').click(function(event) {
				if (event.isPropagationStopped()) {
					return false;
				}
				event.stopPropagation();
				
				activateTab($(this).attr('href'), 'click');
				
				return false;
			});
			
			//Клики по родителям закладок
			if (config.tabsHandleParents) {
				tabPane.find(config.tabsSelector + ' a').parent().click(function(event) {
					$(this).find('a').trigger('click');
				});
			}
			
			//Класс панелей
			if (config.panesClass) {
				tabPane.find(config.panesSelector).addClass(config.panesClass);
			}
			
			//Заголовки панелей
			if (config.panesTitleAdd) {
				tabPane.find(config.tabsSelector + ' a').each(function() {
					var href = $(this).attr('href');
					if (href.substr(0, 1) == '#') {
						var pane = tabPane.find(
							config.panesSelector + href
						);
						$('<' + config.panesTitleTag + '/>')
							.addClass(config.panesTitleClass)
							.html($(this).html())
							.prependTo(pane);
					}
				});
			}
			
			//Активная по умолчанию закладка
			var activeTabLink = null;
			if (config.followHash) {
				activeTabLink = findTabController(document.location.hash);
			}
			if (!activeTabLink || !activeTabLink.length) {
				activeTabLink = tabPane.find(config.tabsSelector + ' a:first');
			}
			if (activeTabLink.length) {
				activateTab(activeTabLink.attr('href'), 'init');
			}
		});
	};
	
	this.items['tabpane'].defaults = {
		tabsSelector: '> .tabs',//Селектор закладок
		tabsClass: '',//Добавить класс для закладок
		tabsHandleParents: true,//Отслеживать клики по родителям ссылок в закладках
		panesSelector: '> .panes > .pane',//Селектор панелей
		panesClass: '',//Добавить класс в каждую панель
		panesTitleAdd: false,//Добавлять заголовок перед панелями
		panesTitleTag: 'h2',//Тег для заголовка панели
		panesTitleClass: 'pane-title',//Класс для заголовка панели
		followHash: true//Активировать закладку по hash в document.location
	};
	
	/**
	 * Accordion
	 * Markup:
	 * <a class="widget accordion" href="#blockID"[ rel="groupID"][ data-expanded-title="Hide block"]>Show block</a>
	 * <div id="blockID">Content</div>
	 *
	 * @param string|object selector Селектор узлов DOM
	 * @return void
	 */
	this.items['accordion'] = function(selector)
	{
		var toggleSlide = function(controller, mode) {
			var domElement = $(controller.attr('href'));
			
			if (mode === undefined) {
				mode = domElement.is(':visible');
			}
			
			if (!controller.data('collapsed-title')) {
				controller.data('collapsed-title', controller.html());
			}
			
			if (mode) {
				if(controller.data('expanded-title')) {
					controller.html(controller.data('collapsed-title'));
				}
				
				controller
					.removeClass('active')
					.trigger('widget.accordion:hide', [domElement]);
				
				domElement
					.slideUp('fast')
					.removeClass('active');
			} else {
				if(controller.data('expanded-title')) {
					controller.html(controller.data('expanded-title'));
				}
				
				controller
					.addClass('active')
					.trigger('widget.accordion:show', [domElement]);
				
				domElement
					.slideDown('fast')
					.addClass('active');
			}
			
			return !mode;
		};
		
		$(selector).each(function() {
			var link = $(this);
			var rel = link.attr('rel');
			var rememberState = link.data('remember-state');
			var cookieName = rememberState ? 'esta-app-ui-widget-accordion-state-' + link.attr('href').replace('#', '') : '';
			var cookieTime = 3600;
			var cookiePath = document.location.pathname;
			
			$(this).click(function() {
				if (rel) {
					$('.widget.accordion[rel="' + rel + '"]').each(function() {
						if (this !== link[0]) {
							esta.cookie.set(cookieName, toggleSlide($(this), true), cookieTime, cookiePath);
						}
					});
				}
				
				esta.cookie.set(cookieName, toggleSlide(link), cookieTime, cookiePath);
				
				return false;
			});
			
			if (
				rememberState
				&& esta.cookie.get(cookieName) == 'true'
			) {
				link.trigger('click');
			}
		});
	};
	
	/**
	 * Создает таблицу с thead, фиксирующимся при прокрутке документа в окне браузера
	 *
	 * @param string|object selector Селектор узлов DOM
	 * @return void
	 */
	this.items['fixedtable'] = function(selector)
	{
		$(selector).each(function() {
			var table = $(this);
			var thead = table.find('> thead').eq(0);
			var isFixed = null;
			
			var applyWidth = function(cell) {
				cell.find('> div').width(cell.width());
			};
			
			var onScroll = function() {
				var scrollTop = $(window).scrollTop();
				var offset = table.offset();
				
				if (
					scrollTop > offset.top
					&& scrollTop < offset.top + table.height() - thead.height()
				) {
					if(isFixed !== true) {
						isFixed = true;
						thead.css({'position': 'fixed'});
					}
				} else {
					if (isFixed !== false) {
						isFixed = false;
						thead.css({'position': 'absolute'});
					}
				}
			};
			
			table.css('position', 'relative');
			
			thead
				.width(thead.width())
				.height(thead.height());
			
			table.find('> thead > tr > *, > tbody > tr > *').wrapInner(
				$('<div>')
					.addClass('fixedtable-cell-wrapper')
					.css('min-height', '1px')
			);
			table.find('> thead > tr > *').each(function() {
				applyWidth($(this));
			});
			table.find('> tbody > tr:first > *').each(function() {
				applyWidth($(this));
			});
			
			var theadPlacheholder = thead
				.clone()
				.css('visibility', 'hidden');
			theadPlacheholder.insertAfter(thead);
			
			thead.css({'top': '0'});
			
			$(window).scroll(onScroll);
			onScroll();
		});
	};
	
	/**
	 * Создает таблицу с интерлейсом
	 *
	 * @param string|object selector Селектор узлов DOM
	 * @return void
	 */
	this.items['interlace'] = function(selector)
	{
		$(selector).find('tr:even').addClass('even'); 
		$(selector).find('tr:odd').addClass('odd'); 
	};
	
	/**
	 * Инициализирует виджеты
	 *
	 * @param string selector Родительский элемент
	 * @return void
	 */
	this.init = function(selector)
	{
		if (selector === undefined) {
			selector = $('body');
		} else {
			selector = $(selector);
		}
		
		$.each(this.items, function(name) {
			this.call(this, selector.find('.widget.' + name));
		});
	};
};




/**
 * Создает индикатор загрузки
 * Пример использования:
 * var loading = new esta.ui.loading('#content');
 * ...
 * loading.hide();
 * 
 * @param string|object selector Селектор элемента, у которого отображается индикатор
 * @return void
 */
esta.ui.loading = function(selector)
{
	if (esta.ui.loading.template === undefined) {
		esta.ui.loading.template = '<div class="loading-layer"></div>' +
			'<div class="loading-icon">' +
			$('#loading-estacator-template').html() +
			'</div>';
	}
	
	/**
	 * Показывает индикатор загрузки
	 *
	 * @return void
	 */
	this.show = function()
	{
		$(selector)
			.addClass('loading-estacator')
			.append(esta.ui.loading.template);
	};
	
	/**
	 * Скрывает индикатор загрузки
	 *
	 * @return void
	 */
	this.hide = function()
	{
		$(selector)
			.removeClass('loading-estacator')
			.find('> .loading-layer, > .loading-icon').remove();
	};
	
	selector = selector || 'body';
	
	this.show();
};




/**
 * Moveable DOM node with support animation, drag, touch wipe and mouse wheel
 * 
 * For mousewheel jQuery Mousewheel plugin required
 * For drag "jQuery UI Draggable" required
 * 
 * @param object config Config
 */
esta.ui.moveable = function(config)
{
	config = $.extend({
		domNode: '',//DOM selector or jQuery object
		animated: true,//Enable animation
		draggable: true,//Enable drag
		touchable: esta.ua.isTouchable(),//Enable touch
		wheelable: true,//Enable mouse wheel
		axis: '',//[x|y|<empty>]
		position: {//node position
			x: 0,
			y: 0
		},
		wheelStep: {
			x: 100,
			y: 100
		},
		wheelConnectDomNode: null,//Selector or jQuery object to connect mouse wheel handler
		wheelConnectToParent: true,//Connect mouse wheel handler to parenr DOM node (if wheelConnectDomNode is not defined)
		cssProperties: {//CSS property for apply position (if not 3d transform used)
			x: 'left',//[left|margin-left|...]
			y: 'top'//[top|margin-top|...]
		},
		cssPosition: 'relative',//CSS position for container [relative|absolute|<empty>]
		animation: {
			timingFunction: 'linear',//http://www.w3.org/TR/css3-transitions/#transition-timing-function
			duration: 400,//Milliseconds
			delay: 0//Milliseconds
		},
		moveDetectionRatio: 1.5,//Axis move detection ratio
		useTransition: esta.utils.css.supportTransition(),
		useTransition3dTransform: esta.ua.isTouchable() && esta.utils.css.support3dTransform(),
		onMoveStart: null,
		onMove: null,
		onMoveStop: null,
		onWheelRotate: null,
		onChangePosition: null
	}, config || {});
	
	if (config.touchable) {
		config.draggable = false;
	}

	switch (config.axis) {
		case 'x':
			config.cssProperties.y = '';
			break;

		case 'y':
			config.cssProperties.x = '';
			break;
	}
	
	config.domNode = $(config.domNode);
	var instance = this;
	
	/**
	 * Return config
	 *
	 * @return object
	 */
	this.getConfig = function()
	{
		return config;
	};
	
	/**
	 * Enable animation
	 *
	 * @return void
	 */
	this.enableAnimation = function()
	{
		config.animated = true;
		
		var transition = config.animation.duration + 'ms ' + config.animation.timingFunction + ' ' + config.animation.delay + 'ms';
		if(config.useTransition3dTransform) {
			esta.utils.css.crossSet(config.domNode, {
				'transitionTransform': transition
			});
		} else if (config.useTransition) {
			var transitions = [];
			for (var key in config.cssProperties) {
				if (config.cssProperties[key]) {
					transitions.push(config.cssProperties[key] + ' ' + transition);
				}
			}
			esta.utils.css.crossSet(config.domNode, {
				'transition': transitions.join(',')
			});
		}
	};
	
	/**
	 * Disable animation
	 *
	 * @return void
	 */
	this.disableAnimation = function()
	{
		config.animated = false;
		
		if(config.useTransition3dTransform) {
			esta.utils.css.crossSet(config.domNode, {
				'transitionTransform': '0ms linear'//Important or Android built-in browser
			});
		} else if (config.useTransition) {
			esta.utils.css.crossSet(config.domNode, {
				'transition': 'none 0ms'
			});
		}
	};
	
	/**
	 * Return position
	 *
	 * @return object
	 */
	this.getPosition = function()
	{
		return config.position;
	};
	
	/**
	 * Set position
	 *
	 * @param object|null position New position {x: n, y: n}
	 * @return void
	 */
	this.setPosition = function(position)
	{
		if (position) {
			config.position = position;
		}

		if (config.useTransition3dTransform) {
			esta.utils.css.crossSet(config.domNode, {
				'transform': 'translate3d(' + config.position.x + 'px, ' + config.position.y + 'px, 0px)'
			});
		} else {
			var cssParams = {};
			for (var key in config.cssProperties) {
				if (config.cssProperties[key]) {
					cssParams[config.cssProperties[key]] = config.position[key] + 'px';
				}
			}
			
			if (config.useTransition) {
				config.domNode.css(cssParams);
			} else if (config.animated) {
				config.domNode
					.stop()
					.animate(cssParams, config.animation.duration);
			} else {
				config.domNode.css(cssParams);
			}
		}
		
		if (config.onChangePosition) {
			config.onChangePosition.call(this, config.position);
		}
	};
	
	/**
	 * Set drag handler if supported
	 *
	 */
	if (config.draggable && config.domNode.draggable) {
		var dragStartPosition = {};
		var resetLeft = config.useTransition3dTransform || config.cssProperties.x != 'left';
		var resetTop = config.useTransition3dTransform || config.cssProperties.y!= 'top';
		
		config.domNode.draggable({
			axis: config.axis,
			start: function(event, ui) {
				instance.disableAnimation();
				
				dragStartPosition = {x: 0, y: 0};
				if (resetLeft) {
					dragStartPosition.x = config.position.x;
				}
				if (resetTop) {
					dragStartPosition.y = config.position.y;
				}
				if (config.onMoveStart) {
					config.onMoveStart.call(instance, event);
				}
			},
			drag: function(event, ui) {
				var dragPosition = {x: dragStartPosition.x + ui.position.left, y: dragStartPosition.y + ui.position.top};
				
				var handlerResult = config.onMove ? config.onMove.call(instance, event, dragPosition) : true;
				if (handlerResult !== false) {
					instance.setPosition(dragPosition);
				}

				ui.position.left = resetLeft ? 0 : dragPosition.x;
				ui.position.top = resetTop ? 0 : dragPosition.y;
			},
			stop: function(event, ui) {
				instance.enableAnimation();
				
				if (config.onMoveStop) {
					config.onMoveStop.call(instance, event);
				}
			}
		});
	};
	
	/**
	 * Set touch handler if supported
	 *
	 */
	if (config.touchable) {
		var touchStartData = {};
		config.domNode.bind('touchstart', function(event) {
			if (event.originalEvent) {
				event = event.originalEvent;
			}
			instance.disableAnimation();
			
			touchStartData.page = {x: 0, y: 0};
			touchStartData.position = config.position;
			if (event.changedTouches && event.changedTouches.length) {
				var touch = event.changedTouches[0];
				touchStartData.page.x = touch.pageX;
				touchStartData.page.y = touch.pageY;
			};
			
			if (config.onMoveStart) {
				config.onMoveStart.call(instance, event);
			}
		});
		
		config.domNode.bind('touchmove', function(event) {
			if (event.originalEvent) {
				event = event.originalEvent;
			}

			var touchPosition = {x: 0, y: 0};
			var deltaX = 0;
			var deltaY = 0;
			var ratio = {x: 0, y: 0};
			if (event.changedTouches && event.changedTouches.length) {
				var touch = event.changedTouches[0];
				
				if (config.axis != 'y') {
					deltaX = touch.pageX - touchStartData.page.x;
					touchPosition.x = touchStartData.position.x + deltaX;
					ratio.x = Math.abs(deltaX) / Math.max(Math.abs(deltaY), 0.001);
				}
				
				if (config.axis != 'x') {
					deltaY = touch.pageY - touchStartData.page.y;
					touchPosition.y = touchStartData.position.y + deltaY;
					ratio.y = Math.abs(deltaY) / Math.max(Math.abs(deltaX), 0.001);
				}
			};
			
			if (!config.axis || ratio[config.axis] > config.moveDetectionRatio) {
				event.preventDefault();
			}

			if (deltaX != 0 || deltaY != 0) {
				var handlerResult = config.onMove ? config.onMove.call(instance, event, touchPosition) : true;
				if (handlerResult !== false) {
					instance.setPosition(touchPosition);
				}
			}
		});
		
		config.domNode.bind('touchend', function(event) {
			if (event.originalEvent) {
				event = event.originalEvent;
			}

			instance.enableAnimation();
			
			if (config.onMoveStop) {
				config.onMoveStop.call(instance, event);
			}
		});
	};
	
	/**
	 * Set mouse wheel handler if supported
	 *
	 */
	if (config.wheelable && config.domNode.mousewheel) {
		var onMouseWheel = function(event, delta) {
			var position = instance.getPosition();
			
			if (config.axis != 'y') {
				position.x += delta * config.wheelStep.x;
			}
			if (config.axis != 'x') {
				position.y += delta * config.wheelStep.y;
			}

			var handlerResult = false;
			if (config.onWheelRotate) {
				handlerResult = config.onWheelRotate.call(instance, event, delta, position);
			}
			if (position.x !== null && position.y !== null) {
				instance.setPosition(position);
			}

			return handlerResult;
		};

		config.wheelConnectDomNode ? $(config.wheelConnectDomNode).mousewheel(onMouseWheel) : (
			config.wheelConnectToParent ? config.domNode.parent().mousewheel(onMouseWheel) : config.domNode.mousewheel(onMouseWheel)
		);
	};
	
	/**
	 * Initialization
	 *
	 */
	if (config.useTransition3dTransform) {
		esta.utils.css.crossSet(config.domNode, {
			'transform': 'translate3d(' + config.position.x + 'px, ' + config.position.y + 'px, 0px)'
		});
	}
	if (config.cssPosition) {
		config.domNode.css({
			'position': config.cssPosition
		});
	}
	this.setPosition();
	if (config.animated) {
		this.enableAnimation();
	}
};




/**
 * Работа с историей браузера
 * 
 * @param string callback Имя ф-ии обратного вызова, вызываемой при переходах по истории
 * @param object data Данные текущей страницы
 */
esta.history = function(callback, data)
{
	/**
	 * Формирует history state
	 *
	 * @param object data State data
	 * @return object
	 */
	var buildState = function(data)
	{
		var state = {
			data: data instanceof Object ? data : {}
		};
		
		if (state.data.title === undefined) {
			state.data.title = document.title;
		}

		state.generatedByEstaHistory = true;
		state.handledBy = callback;
		
		return state;
	};
	
	/**
	 * Добавляет обработчик браузерного события
	 *
	 * @return void
	 */
	var addListener = function()
	{
		if (window.addEventListener) {
			window.addEventListener('popstate', function(event) {
				//Пропускаем события, созданные не через esta.history (например, Chrome такие генерирует)
				if (!(event.state instanceof Object)
					|| event.state.generatedByEstaHistory === undefined
				) {
					return;
				}

				if (event.state.data !== undefined
					&& event.state.data.title !== undefined
				) {
					document.title = event.state.data.title;
				}

				//Дергаем ф-ии обратного вызова только для своих хозяев
				if (event.state.handledBy && event.state.handledBy == callback) {
					(new Function(
						'url, data',
						event.state.handledBy + '(url, data);'
					))(
						document.location.href,
						event.state.data
					);
				}
			}, false);
		}
	};
	
	/**
	 * Возвращает текущий пункт истории
	 *
	 * @return object
	 */
	this.current = function()
	{
		return history.state;
	};
	
	/**
	 * Обновляет текущий пункт истории
	 *
	 * @param string url URL
	 * @param object data Данные
	 * @return void
	 */
	this.replace = function(url, data)
	{
		if (history.replaceState) {
			var state = buildState(data);
			
			history.replaceState(state, state.data.title, esta.utils.url.getFull(url));
		}
	};
	
	/**
	 * Добавляет новый пункт в историю
	 *
	 * @param string url URL
	 * @param object data Данные
	 * @return void
	 */
	this.push = function(url, data)
	{
		if (history.pushState) {
			var state = buildState(data);
			
			history.pushState(state, state.data.title, esta.utils.url.getFull(url));
		}
	};
	



	/**
	 * Инициализия
	 */
	this.replace(document.location.href, data);
	
	addListener();
};

/**
 * Позволяет получить singleton instance esta.history
 *
 * @param string callback Имя ф-ии обратного вызова, вызываемой при переходах
 * @param object data Данные текущей страницы
 * 
 * @return esta.history
 */
esta.history.getInstance = function(callback, data)
{
	if (this.instances === undefined) {
		this.instances = {};
	}

	if (this.instances[callback] === undefined) {
		this.instances[callback] = new esta.history(callback, data);
	}

	return this.instances[callback];
};




/**
 * Утилиты для работы с Cookie
 */
esta.cookie = {
	/**
	 * Set cookie
	 *
	 * @param string name Cookie name
	 * @param string value Cookie value
	 * @param string time Lifetime
	 * @param string path
	 * @return void
	 */
	set: function(name, value, time, path)
	{
		var time = time === undefined ? 0 : time;
		var path = path === undefined ? '/' : path;
		
		var expires = new Date();
		time = expires.getTime() + time * 1000;
		expires.setTime(time);
		
		document.cookie = name + '=' + value + '; expires=' + expires.toGMTString() + '; path=' + path;
	},
	
	/**
	 * Get cookie
	 *
	 * @param string name Cookie name
	 * @return string Cookie value
	 */
	get: function(name)
	{
		var cookie = ' ' + document.cookie;
		var search = ' ' + name + '=';
		var setStr = null;
		var offset = 0;
		var end = 0;
		if (cookie.length > 0) {
			offset = cookie.indexOf(search);
			if (offset != -1) {
				offset += search.length;
				end = cookie.indexOf(';', offset);
				if (end == -1) {
					end = cookie.length;
				}
				setStr = unescape(cookie.substring(offset, end));
			}
		}
		
		return setStr;
	}
};




/**
 * User-agent пользователя
 */
esta.ua = new function()
{
	/**
	 * User agent - iPad
	 *
	 * @var boolean
	 */
	this.isIPad = /iPad/.test(navigator.userAgent);
	
	/**
	 * User agent - iPhone
	 *
	 * @var boolean
	 */
	this.isIPhone = /iPhone/.test(navigator.userAgent);

	/**
	 * User agent - iPod
	 *
	 * @var boolean
	 */
	this.isIPod = /iPod/.test(navigator.userAgent);

	/**
	 * User agent - iOS
	 *
	 * @var boolean
	 */
	this.isIOS = this.isIPad || this.isIPhone || this.isIPod;
	
	/**
	 * User agent - Android
	 *
	 * @var boolean
	 */
	this.isAndroid = /Android/.test(navigator.userAgent);
	
	/**
	 * User agent работает на WebKit
	 *
	 * @var boolean
	 */
	this.isWebKit = /WebKit/.test(navigator.userAgent);
	
	/**
	 * User agent поддерживает тоuch интерфейс
	 *
	 * @var boolean
	 */
	this.isTouchable = function()
	{
		var result = (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch);
		this.isTouchable = function() {
			return result;
		};
		return result;
	};
};




/**
 * Утилиты
 */
esta.utils = {
	/**
	 * Наследует один класс от другого
	 *
	 * @param object child Потомок
	 * @param object parent Родитель
	 * @param object overrides Перезаписываемые св-ва и методы
	 * @return object Потомок
	 */
	extend: function(child, parent, overrides)
	{
		if (typeof parent == 'object') {
			overrides = parent;
			parent = child;
			child = function() {
				child.superclass.constructor.apply(this, arguments)
			};
		}
		
		var f = function(){};
		f.prototype = parent.prototype;
		child.prototype = new f();
		child.prototype.constructor = child;
		child.superclass = parent.prototype;
		
		this.override(child, overrides);
		
		return child;
	},
	
	/**
	 * Перезаписывает св-ва и методы класса
	 *
	 * @param object clss Перезаписываемый класс
	 * @param object parent Родитель
	 * @param object overrides Перезаписываемые св-ва и методы
	 * @return void
	 */
	override: function(clss, overrides)
	{
		this.apply(clss.prototype, overrides);
	},
	
	/**
	 * Расширяет сво-ва одного объекта другим
	 *
	 * @param object object Расширяемый объект
	 * @param object overrides Перезаписываемые св-ва
	 * @return void
	 */
	apply: function(object, overrides)
	{
		overrides = overrides || {};
		var primitiveObject = {};
		for (var i in overrides) {
			if (typeof primitiveObject[i] == 'undefined' || primitiveObject[i] != overrides[i]) {
				object[i] = overrides[i];
			}
		}
	},
	
	/**
	 * Возвращает уникальный ID
	 *
	 * @return integer|string
	 */
	getId: function(prefix)
	{
		return prefix + (new Date().getTime()) + Math.floor(999 * Math.random());
	},
	
	/**
	 * Заменяет в шаблоне конструкции {name} на значения из объекта с данными
	 * Пример:
	 * esta.utils.parse('<a href="{url}">{title}</a>', {url: 'http://my.server/', title: 'My link'});
	 * 
	 * @param string template Шаблон
	 * @param object data Данные
	 * @param string def Значение по умолчанию
	 * @return string
	 */
	parse: function(template, data, def)
	{
		def = def || '';
		return template.replace(/{([^}]*)}/gm, function() {
			return arguments.length > 1 ? data[arguments[1]] : '';
		});
	},
	
	/**
	 * Возвращает текст в атрибуте href гиперссылки, чтоящий после #
	 * Учитывает баг IE, который выдает полный URL для атрибута href
	 *
	 * @param object|string link Элемент-ссылка
	 * @return string
	 */
	getHashWord: function(link)
	{
		return $(link).attr('href').replace(/^.*#/, '#');
	},
	
	/**
	 * Отправляет форму через iframe, имитируя AJAX
	 * Пример:
	 * var form = $('#my-form');
	 * esta.utils.submitViaIframe(form, function(response) {
	 *     form.html(response);
	 * });
	 * @param jQuery|string|DOMElement form Форма
	 * @param function callback Ф-я обратного вызова
	 * @param mixed scope Контекст ф-и обратного вызова
	 * @return void
	 */
	submitViaIframe: function(form, callback, scope) {
		form = $(form).get(0);
		if (!form) {
			return;
		}
		
		if (!form.targetDefined) {
			form.target = 'e' + Math.ceil(999999999 * Math.random());
			form.targetDefined = true;
		}
		
		if (!form.targetIframe) {
			form.targetIframe = $(
				'<iframe/>'
			).attr({
				name: form.target,
				id: form.target,
				src: 'javascript:;'
			}).css({
				display: 'none',
				width: 0,
				height: 0
			}).insertAfter(
				form
			).on('load', function() {
				callback && callback.call(
					scope,
					$(this).contents().find('body').html()
				);
			});
		}
		
		form.submit();
	},
	
	/**
	 * Предзагрузчик изображений с поддержкой jQuery deferred
	 * Пример:
	 * $.when(
	 *     esta.utils.preloadImage(src1),
	 *     esta.utils.preloadImage([src2, src3])
	 * ).done(function()
	 * {
	 *     //Images are preloaded
	 * });
	 * 
	 * @param string|array|jQuery sources Адрес(а) изображений
	 * @return object
	 */
	preloadImage: function(sources)
	{
		if (sources instanceof jQuery) {
			var urls = [];
			sources.each(function() {
				if ($(this).is('img')) {
					urls.push($(this).attr('src'));
				} else if ($(this).is('a')) {
					urls.push($(this).attr('href'));
				}
			});
			return this.preloadImage(urls);
		}
		
		if (!(sources instanceof Array)) {
			sources = [sources];
		}
		
		var defer = $.Deferred();
		var images = {};
		var totalCount = 0;
		for (var i = 0; i < sources.length; i++) {
			var url = sources[i];
			var id = 'id' + url.replace(/[^A-z0-9]/g, '');
			if (images[id] === undefined) {
				images[id] = {
					image: new Image(),
					url: url
				};
				totalCount++;
			}
		}
		var loadedCount = 0;
		for (var id in images) {
			images[id].image.onload = function() {
				if (++loadedCount >= totalCount) {
					defer.resolve();
				}
			};
			images[id].image.src = images[id].url;
		}
		
		return defer.promise();
	},
	
	/**
	 * Склоняет существительное с числительным
	 *
	 * @param integer number Число
	 * @param array cases Варианты существительного в разных падежах и числах (nominativ, genetiv, plural). Пример: ['комментарий', 'комментария', 'комментариев']
	 * @param boolean incNum Добавить само число в результат (по умолчанию true)
	 * @return string
	 */
	getNumEnding: function(number, cases, incNum)
	{
		var numberMod = number % 100;
		incNum = incNum === undefined ? true : incNum;
		var result = '';
		
		if (numberMod >= 11 && numberMod <= 19) {
			result = cases[2];
		} else {
			numberMod = numberMod % 10;
			switch (numberMod) {
				case 1:
					result = cases[0];
					break;
				case 2:
				case 3:
				case 4:
					result = cases[1];
					break;
				default:
					result = cases[2];
			}
		}
		
		return incNum ? number + ' ' + result : result;
	},
	
	/**
	 * Форматирует число
	 *
	 * @param mixed number Число
	 * @param integer decimals Кол-во знаков после запятой (по умолчанию 0)
	 * @param string decPoint Разделитель целой и дробной части (по умолчанию '.')
	 * @param string thousandsSep Разделитель сотен (по умолчанию '`')
	 * @return string
	 */
	numberFormat: function(number, decimals, decPoint, thousandsSep)
	{
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousandsSep === 'undefined') ? '`' : thousandsSep,
			dec = (typeof decPoint === 'undefined') ? '.' : decPoint,
			s = '',
			toFixedFix = function(n, prec) {
				var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
		
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		
		return s.join(dec);
	},
	
	/**
	 * Транслирует объект в строку
	 *
	 * @param object data Данные
	 * @param integer level Глубина
	 * @return string
	 */
	toString: function(data)
	{
		if (arguments[1] === undefined || this.toStringObjectsLimit === undefined) {
			this.toStringObjectsLimit = 999;
		}
		this.toStringObjectsLimit--;
		var level = arguments[1] || 0;
		
		if (this.toStringObjectsLimit < 0) {
			return '(...too much...)';
		}

		if(level > 99) {
			return '(...too deep...)';
		}

		var strings = [];
		var specialType = '';
		if (data instanceof Array) {
			specialType = '(Array)';
			for (var i = 0; i < data.length; i++) {
				strings.push('[' + i + '] => ' + this.toString(data[i], 1 + level));
				if (this.toStringObjectsLimit < 0) {
					break;
				}
			}
		} else if(data instanceof Function) {
			specialType = '(Function)';
			for (var i in data) {
				strings.push('[' + i + '] => ' + this.toString(data[i], 1 + level));
				if (this.toStringObjectsLimit < 0) {
					break;
				}
			}
		} else if(data instanceof Object) {
			for (var i in data) {
				strings.push('[' + i + '] => ' + this.toString(data[i], 1 + level));
				if (this.toStringObjectsLimit < 0) {
					break;
				}
			}
		} else {
			strings = data;
		}
		
		var complexValue = strings instanceof Array;
		var padding = '';
		if (complexValue) {
			for (var i = 0; i < 2 * level; i++) {
				padding += ' ';
			}
		}
		
		return specialType + (complexValue ? '\n' + padding : '') + (complexValue ? strings.join('\n' + padding) : String(strings));
	}
};




/**
 * Утилиты для работы с CSS
 */
esta.utils.css =
{
	/**
	 * Тестирует стиль
	 *
	 * @param array checks Тесты
	 * @param object callback Функция проверки
	 * @return boolean
	 */
	test: function(checks, callback)
	{
		var success = false;
		for (var key = 0; key < checks.length; key++) {
			var check = checks[key];
			var div = document.createElement('div');
			div.style.cssText = check.style;
			
			document.body.appendChild(div);
			success = callback(div, check, key);
			document.body.removeChild(div);
			
			if (success) {
				break;
			}
		}
		
		return success;
	},
	
	/**
	 * User agent поддерживает 2d transform
	 *
	 * @return boolean
	 */
	supportTransform: function()
	{
		var result = (
			typeof document.body.style.transform != 'undefined' ||
			typeof document.body.style.webkitTransform != 'undefined' ||
			typeof document.body.style.mozTransform != 'undefined' ||
			typeof document.body.style.msTransform != 'undefined' ||
			typeof document.body.style.oTransform != 'undefined'
		);
		this.supportTransform = function() {
			return result;
		};
		return result;
	},
	
	/**
	 * User agent поддерживает 3d transform
	 *
	 * @return boolean
	 */
	support3dTransform: function()
	{
		var result = this.test([
				{
					'style': 'transform: translate3d(0, 0, 0)',
					'property': 'transform'
				}, {
					'style': 'transform: -moz-translate3d(0, 0, 0)',
					'property': 'transform'
				}, {
					'style': 'transform: -ms-translate3d(0, 0, 0)',
					'property': 'transform'
				}, {
					'style': 'transform: -o-translate3d(0, 0, 0)',
					'property': 'transform'
				}, {
					'style': 'transform: -webkit-translate3d(0, 0, 0)',
					'property': 'transform'
				}, {
					'style': '-moz-transform: translate3d(0, 0, 0)',
					'property': 'MozTransform'
				}, {
					'style': '-ms-transform: translate3d(0, 0, 0)',
					'property': 'MSTransform'
				}, {
					'style': '-o-transform: translate3d(0, 0, 0)',
					'property': 'OTransform'
				}, {
					'style': '-webkit-transform: translate3d(0, 0, 0)',
					'property': 'webkitTransform'
				}
			], function(node, check) {
				return node.style[check.property] ? true : false;
			}
		);
		
		this.support3dTransform = function()
		{
			return result;
		};
		return result;
	},
	
	/**
	 * User agent поддерживает transitions
	 *
	 * @return boolean
	 */
	supportTransition: function()
	{
		var result = (
			typeof document.body.style.transition != 'undefined' ||
			typeof document.body.style.webkitTransition != 'undefined' ||
			typeof document.body.style.mozTransition != 'undefined' ||
			typeof document.body.style.msTransition != 'undefined' ||
			typeof document.body.style.oTransition != 'undefined'
		);
		this.supportTransition = function() {
			return result;
		};
		return result;
	},

	/**
	 * CSS3 crossbrowser property setter
	 *
	 * @param domElement element DOM element
	 * @param object config CSS properties
	 * @return void
	 */
	crossSet: function(element, config) {
		element = $(element);
		config = config || {};
		
		var applyCommon = function(key, value, prefixedValue) {
			var map = {};
			map['-moz-' + key] = (prefixedValue ? '-moz-' : '') + value;
			map['-ms-' + key] = (prefixedValue ? '-ms-' : '') + value;
			map['-o-' + key] = (prefixedValue ? '-o-' : '') + value;
			map['-webkit-' + key] = (prefixedValue ? '-webkit-' : '') + value;
			map[key] = value;
			
			var str = [];
			for (var key in map) {
				str.push(key + ': ' + map[key]);
			}
			
			element.css(map);
		};
		
		$.each(config, function(key) {
			switch (key) {
				case 'transformTranslate3d':
					applyCommon('transform', 'translate3d(' + this.x + ', ' + this.y + ', ' + this.z + ')');
					break;
				case 'transitionTransform':
					applyCommon('transition', 'transform ' + this, true);
					break;
				default:
					applyCommon(key, this);
					break;
			}
		});
		
		return this;
	}
};




/**
 * Утилиты для работы с URL
 */
esta.utils.url =
{
	/**
	 * Возвращает полный URL текущей страницы, включая домен и протокольный префикс
	 *
	 * @param string path Pathname
	 * @return string
	 */
	getFull: function(path)
	{
		return path.search('//') == -1 ?
			document.location.protocol + '//' + document.location.host + path
		:
			path;
	},
	
	/**
	 * Разбирает URL на части
	 *
	 * @param string url URL
	 * @return object {protocol, host, port, pathname, query, hash}
	 */
	parse: function(url)
	{
		var result = {
			protocol: '',
			host: '',
			port: '',
			pathname: '',
			query: '',
			hash: ''
		}
		
		//Get protocol
		url = url.split('://');
		if (url.length > 1) {
			result.protocol = url.shift();
			url[0] = '//' + url[0];
		}
		url = url.join('://');
		
		//Get host
		url = url.split('//');
		if (url.length > 1) {
			url.shift();
			url = url.join('//').split('/');
			result.host = url.shift();
			url = '/' + url.join('/');
		} else {
			url = url.join('//');
		}
		
		//Get port
		result.host = result.host.split(':');
		if (result.host.length > 1) {
			result.port = result.host.pop();
		}
		result.host = result.host.join(':');
		
		//Get hash
		url = url.split('#');
		if (url.length > 1) {
			result.hash = url.pop();
		}
		url = url.join('#');
		
		//Get query
		url = url.split('?');
		if (url.length > 1) {
			result.query = url.pop();
		}
		url = url.join('?');
		
		//Get path
		result.pathname = url;
		
		return result;
	}
};