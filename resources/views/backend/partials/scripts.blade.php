<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<!-- JS Libraies -->
<script src="{{ asset('/assets/js/daterangepicker.js') }}"></script>
<!-- Template JS File -->

<script src="{{ asset('/assets/js/stisla.js') }}"></script>
<script src="{{ asset('/assets/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('/assets/js/scripts.js?v1') }}"></script>
<script src="{{ asset('/assets/js/custom.js') }}"></script>
<script src="{{ asset('/assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('assets/js/cleave.min.js') }}"></script>
<script src="{{ asset('assets/js/cleave-phone.us.js') }}"></script>
<script src="{{ asset('assets/js/forms-advanced-forms.js') }}"></script>


<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>

@stack('scripts')
<!-- Page Specific JS File -->
<script src="{{ asset('/assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('/assets/js/codemirror.js') }}"></script>
<script src="{{ asset('/assets/js/javascript.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.selectric.min.js') }}"></script>

{{--SSLCommerz--}}
<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
