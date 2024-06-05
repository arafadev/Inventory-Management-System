<!-- JAVASCRIPT -->
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>




<script src="{{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script>


@yield('js')


<script src="{{ asset('backend/assets/js/handlebars.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify.js/2.0.0/notify.min.js"></script>


<!-- App js -->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>

{{-- Toastr --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if (Session::has('msg'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('msg') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('msg') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('msg') }} ");  
                break;
            case 'error':
                toastr.error(" {{ Session::get('msg') }} ");
                break;
        }
    @endif
</script>
