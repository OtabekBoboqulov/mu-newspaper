<div class="fixed top-0 right-0 m-4 p-4 bg-green-500 text-white rounded-lg shadow-lg max-w-xs z-50">
    <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" stroke="currentColor"
             viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 11l3 3L22 4"></path>
        </svg>
        <div>
            <h3 class="font-bold text-lg">Success!</h3>
            <p>{{ session('success') }}</p>
        </div>
    </div>
</div>

<script type="text/javascript">
    setTimeout(function () {
        const alert = document.querySelector('.fixed');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 5000); // This will hide the alert after 5 seconds
</script>
