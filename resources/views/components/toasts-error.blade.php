<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToastError" class="toast hide show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="true" data-bs-delay="5000">

        <div class="toast-body">
            {{ $slot }}

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('liveToastError');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
</script>
