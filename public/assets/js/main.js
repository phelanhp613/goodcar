$(document).ready(function () {
	/***** Action Check all item in table *****/
	$(document).on('click', '.select-all', function () {
		var class_child = $(this).attr('id');
		if (class_child !== '') {
			var child = $('input.' + class_child);
			if (child.length > 0) {
				child.not(this).prop('checked', this.checked);
			}
				/*else {
					if (!$(this).hasClass('select-all-with-other-child')) {
						$('input.checkbox-item').not(this).prop('checked', this.checked);
					}
				}*/
		}
		else {
			$('input.checkbox-item').not(this).prop('checked', this.checked);
		}
	});
	$(window).scroll(function () {
		var header = $('.header-menu-desktop'),
			scroll = $(window).scrollTop();
		if (scroll >= 60) {
			header.addClass('sticky position-fixed top-0 start-0 end-0 container');
		}
		else {
			header.removeClass('sticky position-fixed top-0 start-0 end-0 container');
		}
	});
});

function getUrlParam(paramName) {
	const reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i');
	const match = window.location.search.match(reParam);
	return (match && match.length > 1) ? match[1] : '';
}

/*********** Elfinder *************/
function elfinderInit(routeConnector, locale, csrf, ckeditor = false) {
	let elfinder = $('#elfinder');
	if (ckeditor) {
		const funcNum = getUrlParam('CKEditorFuncNum');
		elfinder.elfinder({
			lang: locale,
			customData: {
				_token: csrf
			},
			uiOptions: {
				toolbar: [
					['home', 'back', 'forward', 'up', 'reload'],
					['mkdir', 'upload'],
					['undo', 'redo'],
					['copy', 'cut', 'paste', 'rm'],
					['rename', 'resize', 'chmod'],
					['selectall', 'selectnone', 'selectinvert'],
					['quicklook', 'info'],
					['fullscreen']
				],
			},
			width: '100%',
			height: '75%',
			mimeDetect: 'internal',
			url: routeConnector, //'{{ route("elfinder.connector") }}'
			getFileCallback: function (file) {
				if (funcNum) {
					window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
					window.close();
				}
			}
		});
	}
	else {
		elfinder.elfinder({
			lang: locale,
			customData: {
				_token: csrf
			},
			uiOptions: {
				toolbar: [
					['home', 'back', 'forward', 'up', 'reload'],
					['mkdir', 'upload'],
					['undo', 'redo'],
					['copy', 'cut', 'paste', 'rm'],
					['rename', 'resize', 'chmod'],
					['selectall', 'selectnone', 'selectinvert'],
					['quicklook', 'info'],
					['fullscreen']
				],
			},
			width: '100%',
			height: '75%',
			mimeDetect: 'internal',
			url: routeConnector,
		}).elfinder('instance');
	}
}

/*********** Elfinder Popup *************/
function openElfinder(routeConnector, csrf, currentWebsiteURL, btn = null) {
	if (btn === null){
		btn = $(".btn-elfinder");
	}
	btn.click(function (e) {
		$(this).addClass('el-add-text-current-input-group');
		const html = '<div id="elfinder-popup"></div>';
		const body = $('body');
		body.addClass('elfinder-backdrops')
		if (body.find("#elfinder-popup").length === 0) {
			body.append(html);
		}
		const elfinderID = $('#elfinder-popup');
		var elfinder = elfinderID.elfinder({
			url: routeConnector,
			customData: {
				_token: csrf
			},
			uiOptions: {
				toolbar: [
					['home', 'back', 'forward', 'up', 'reload'],
					['mkdir', 'upload'],
					['undo', 'redo'],
					['copy', 'cut', 'paste', 'rm'],
					['rename', 'resize', 'chmod'],
					['selectall', 'selectnone', 'selectinvert'],
					['info'],
					['fullscreen']
				],
			},
			commandsOptions: {
				getfile: {
					onlyPath: true,
					folders: false,
					multiple: false,
					oncomplete: 'destroy'
				},
				ui: 'uploadbutton'
			},
			mimeDetect: 'internal',
			handlers: {
				dblclick: function (event, elfinderInstance) {
					const fileInfo = elfinderInstance.file(event.data.file);
					if (fileInfo.mime !== "directory") {
						let btn = $(document).find('.el-add-text-current-input-group');
						let fileUrl = elfinderInstance.url(event.data.file);
						fileUrl = fileUrl.replace(currentWebsiteURL, '');
						console.log(fileUrl);
						//Add to gallery form
						var form = btn.parents('#gallery-form');
						if (form.length > 0) {
							var html = `<div class="image-item">
			                                <button type="button" href="javascript:" class="btn btn-outline-danger bg-white btn-remove rounded-circle">
			                                    <i class="fa fa-trash"></i>
			                                </button>
			                                <input type="hidden" value="${fileUrl}" name="images[]">
			                                <div class="ratio ratio-1x1">
			                                    <img src="${fileUrl}" alt="${fileUrl}" class="object-fit-cover w-100 h-100" width="150" height="150">
			                                </div>
			                            </div>`;
							form.find('.sub-images').append(html);
						} else {
							const inputGroup = btn.parents('.input-group');
							inputGroup.find('input').val(fileUrl);
							inputGroup.parents('.form-group').find('.main-image').html("<img src='" + fileUrl + "' alt='' loading='lazy' class='input-image-component-img'>");
						}
						elfinder.dialog('close');
						$(document).find('body').removeClass('elfinder-backdrops');
						btn.removeClass('el-add-text-current-input-group');
						return false;
					}
				},
				destroy: function (event, elfinderInstance) {
					elfinder.dialog('close');
				}
			}
		}).dialog({
			title: '',
			resizable: true,
			width: 1100,
			height: 800,
			modal: true
		});
	});

	$(document).on('click', '.ui-dialog-titlebar-close', function () {
		$(document).find('body').removeClass('elfinder-backdrops');
		btn.removeClass('el-add-text-current-input-group');
	})
}

$(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    var action = $(this).attr('href');
    var lang = $('html').attr('lang');
    var title = (lang === 'en') ? "Are you sure?" : "Are you sure?";
    var text = (lang === 'en') ? "You won't be able to revert this!" : "You won't be able to revert this!";

    swal({
        title: title,
        text: text,
        icon: "warning",
        buttons: ['Cancel', 'Delete'],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            window.location.replace(action);
        }
    });
});


function textareaContentComponent(countContent, ckeditorBrowserURL) {
	countContent = parseInt(countContent);
	const tabNameInput = $('#tab-name-input');
	const btnAddSection = $('#btn_add_section');

	tabNameInput.on('keyup', function () {
		btnAddSection.prop('disabled', !($(this).val().trim().length > 0));
	});

	btnAddSection.on('click', function () {
		const tabNameID = countContent + '-tab';
		let tabLink =
			`<li class="dd-item tab-item d-flex gap-1 align-items-center mb-3 w-100" data-id="${tabNameID}">
                <a href="javascript:" role="button" class="btn m-0 d-inline-block dd-handle cursor-pointer border">
                    <i class="fas fa-arrows-up-down-left-right fs-7"></i>
                    <input type="hidden" name="content[sort][]" class="form-control mb-3" placeholder="Label" value="${tabNameID}">
                </a>
                <span
                     class="btn btn-outline-primary rounded-0 position-relative py-2 px-4 w-100 tab-link-${tabNameID}"
                     data-bs-toggle="pill"
                     data-bs-target="#tab-${tabNameID}"
                     role="tab"
                     aria-controls="${tabNameID}"
                     aria-selected="true"
                >
                    <span class="fw-semibold text-truncate text-truncate-1">${tabNameInput.val()}</span>
                    <span href="javascript:" class="btn-remove-tab position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><i class="fas fa-times"></i></span>
                </span>
            </li>`
			/*`<div class="tab-item" role="presentation">
                <button class="btn btn-outline-primary rounded-0 position-relative py-2 px-4 tab-link-${tabNameID}" data-bs-toggle="pill" data-bs-target="#tab-${tabNameID}" type="button" role="tab" aria-controls="${tabNameID}" aria-selected="true">
                    <span class="fw-semibold text-capitalize">${tabNameInput.val()}</span>
                    <span href="javascript:" class="btn-remove-tab position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><i class="fas fa-times"></i></span>
                </button>
            </div>`;*/

		let tabContent =
			`<div class="tab-pane fade" id="tab-${tabNameID}" role="tabpanel" aria-labelledby="${tabNameID}" tabindex="0">
                <div class="p-3 border">
                    <div class="form-group">
                        <input type="text" name="content[${tabNameID}][label]" class="form-control mb-3" placeholder="Label" value="${tabNameInput.val()}">
                        <input type="hidden" name="content[${tabNameID}][label_hidden]" value="${tabNameInput.val()}">
                    </div>
                    <div class="form-group mb-0">
                        <textarea class="form-control content-box" name="content[${tabNameID}][content]" id="content-${tabNameID}"></textarea>
                    </div>
                </div>
            </div>`;

		$('#tab-links').append(tabLink);
		$('#tab-content').append(tabContent);

		$(document).find(`.tab-link-${tabNameID}`).click();

		renderCkEditor(`content-${tabNameID}`, ckeditorBrowserURL, 400);
		tabNameInput.val('');
		btnAddSection.prop('disabled', true);

		countContent++;
	});
}

function renderCkEditor(selector, ckeditorBrowserURL, height = 200) {
	CKEDITOR.replace(selector, {
		filebrowserBrowseUrl: ckeditorBrowserURL,
		height: height,
		extraAllowedContent: '*(*)',
		allowedContent: true,
		removePlugins: 'iframe',
		toolbar: [
			['Font', 'FontSize', 'Format', 'RemoveFormat'],
			['TextColor', 'BGColor'],
			['Bold', 'Italic', 'Underline', 'Strike'],
			['JustifyLeft', 'JustifyRight', 'JustifyCenter', 'JustifyBlock'],
			['NumberedList', 'BulletedList'],
			['Outdent', 'Indent', 'Blockquote'],
			['Table', 'HorizontalRule', 'SpecialChar'],
			['Link', 'Unlink', 'Image'],
			['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
			['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll'],
			['Source', 'Maximize']
		]
	});
}