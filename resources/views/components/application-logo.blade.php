<img id="logo" src="{{ asset('images/BloggingPlatform.png') }}" {{ $attributes }} />

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logo = document.getElementById('logo');
        const theme = localStorage.getItem('color-theme');
        if (theme === 'dark') {
            logo.src = "{{ asset('images/BloggingPlatform-white.png') }}";
        } else {
            logo.src = "{{ asset('images/BloggingPlatform-black.png') }}";
        }
    });
</script>
