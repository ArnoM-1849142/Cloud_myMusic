<script>

var access_token = null;
var refresh_token = null;
@isset($accessToken)
    access_token = {!! json_encode($accessToken) !!};
    localStorage.setItem("access_token", access_token);
@endisset

@isset($refreshToken)
    refresh_token = {!! json_encode($refreshToken) !!};
    localStorage.setItem("refresh_token", refresh_token);
@endisset

window.location.replace("/");

</script>