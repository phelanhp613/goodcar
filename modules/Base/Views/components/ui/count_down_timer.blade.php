<div class="d-block d-md-flex align-items-center justify-content-end mb-2 text-center count-down-timer" data-date="{{ $date->date }}" id="count-down-timer">
    <div class="fw-semibold text-white fs-5 mb-2 mb-md-0 me-0 me-md-2 timing-box-date">
        <span>{{ trans('Kết thúc sau') . ' ' }}</span>
        <span class="date">{{ $date->d }}</span>
        <span>{{ ' '. trans('day') }}</span>
    </div>
    <div class="text-primary timing-clock d-flex align-items-center justify-content-center justify-content-md-start">
        <div class="timing-box timing-box-hour">
            <span class="bg-white fw-semibold d-block hour">{{ sprintf("%02d", $date->h) }}</span>
        </div>
        <div class="px-1 text-white">:</div>
        <div class="timing-box timing-box-minute">
            <span class="bg-white fw-semibold d-block minute">{{ sprintf("%02d", $date->i) }}</span>
        </div>
        <div class="px-1 text-white">:</div>
        <div class="timing-box timing-box-second">
            <span class="bg-white fw-semibold d-block second">{{ sprintf("%02d", $date->s) }}</span>
        </div>
    </div>
</div>
@push('js')
    <script>
		$(document).ready(function () {
			function makeTimer() {
				const flashSales = $('.count-down-timer');

				$.each(flashSales, function (i, item) {
					const flashSale = $(item);
					let endTime = new Date(flashSale.data('date').replace(/-/g, "/"));
					endTime = (Date.parse(endTime) / 1000);

					let now = new Date();
					now = (Date.parse(now) / 1000);

					const timeLeft = endTime - now;

					let days = Math.floor(timeLeft / 86400);
					let hours = Math.floor((timeLeft - (days * 86400)) / 3600);
					let minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
					let seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

					if (hours < "10") {
						hours = "0" + hours;
					}
					if (minutes < "10") {
						minutes = "0" + minutes;
					}
					if (seconds < "10") {
						seconds = "0" + seconds;
					}

					flashSale.find('.timing-box-date span.date').html(days);
					flashSale.find('.timing-box-hour span.hour').html(hours);
					flashSale.find('.timing-box-minute span.minute').html(minutes);
					flashSale.find('.timing-box-second span.second').html(seconds);
				});
			}

			setInterval(function () {
				makeTimer();
			}, 1000);
		})
    </script>
@endpush