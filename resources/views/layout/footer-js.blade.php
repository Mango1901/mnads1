<!-- Bootstrap core JavaScript-->
<script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/javascripts/application.js')}}" type="text/javascript" charset="utf-8" async defer></script>
<!-- Core plugin JavaScript-->
<script src="{{asset('public/frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('public/frontend/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/chart.js/Chart.min.js')}}"></script>
<!-- Page level custom scripts -->
<script src="{{asset('public/frontend/js/demo/chart-area-demo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script type="text/javascript">
    $(function () {
        $('#loader').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
        $(window).on('load', function(){
            setTimeout(removeLoader, 200); //wait for page load PLUS 0.5 seconds.
        });
        function removeLoader(){
            $( "#loadingDiv" ).fadeOut(300, function() {
                // fadeOut complete. Remove the loading div
                $( "#loadingDiv" ).remove(); //makes page more lightweight
            });
        }
    });
</script>


