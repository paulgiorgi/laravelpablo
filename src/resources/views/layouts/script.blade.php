<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery.loading.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>

{{-- CSFR TOKEN --}}
<script>
jQuery(document).ready(function() {
$('[data-bs-toggle="tooltip"]').tooltip();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function (xhr) {
        $("body").loading();
    }
});
$(document).ajaxStop(function () {
    $("body").loading('stop');
});
</script>
