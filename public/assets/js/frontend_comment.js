$(document).ready(function () {
	$(document).on('click', '.btn-show-more-reply', function () {
		$(this).parents('.comment-children').find('.comment-child').removeClass('d-none');
		$(this).remove();
	});

	$(document).on("click", ".btn-comment-see-more", function (e) {
		e.preventDefault();
		const btnMore = $(this);
		const url = $(this).attr('href');
		$.ajax({
			url: url,
			method: "GET"
		}).done(function (response) {
			$(document).find('.comment-list').append($(response).find('.comment-list').html());
			const newBtnMoreHref = $(response).find('.btn-comment-see-more').attr('href');
			if (newBtnMoreHref === 'javascript:') {
				btnMore.hide();
			}
			btnMore.attr('href', $(response).find('.btn-comment-see-more').attr('href'))
		});
	});

	$(document).on("submit", ".form-comment", function (e) {
		e.preventDefault();
		const data = $(this).serialize();
		const url = $(this).attr('action');
		$.ajax({
			url: url,
			data: data,
			method: "POST"
		}).done(function (response) {
			$(document).find('#comment-component-body').html($(response).find('#comment-component-body').html());
		});
	});

	$(document).on('click', '.btn-reply', function () {
		const parentComment = $(this).parents('.comment-part').find('.comment-parent');
		const url = $(this).data('url');
		$.ajax({
			url: url,
			method: "GET"
		}).done(function (response) {
			parentComment.find(".form-reply-space").html(response);
		});
	});

	$(document).on('submit', '.form-reply', function (e) {
		e.preventDefault();
		const commentChildren = $(this).parents('.comment-part').find('.comment-children');
		const form = $(this);
		const data = $(this).serialize();
		const url = $(this).attr('action');
		$.ajax({
			url: url,
			data: data,
			method: "POST"
		}).done(function (response) {
			commentChildren.prepend(response);
			form.remove();
		});
	});
});