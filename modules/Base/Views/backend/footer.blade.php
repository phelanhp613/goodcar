@php use Modules\Setting\Models\Website; @endphp
<footer class="footer py-3 border-top position-relative mt-auto" style="background: #f0f8ff38;">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                @php($siteName = cache('setting_website')[Website::WEBSITE_NAME]['value'] ?? getSetting(Website::WEBSITE_NAME))
                <script>document.write(new Date().getFullYear())</script> © {{ $siteName ?? env('APP_NAME') }}
            </div>
        </div>
    </div>
</footer>