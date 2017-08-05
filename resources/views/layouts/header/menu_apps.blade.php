<li class="dropdown notifications-menu menu-apps">
    <a href="#" class="dropdown-toggle gears" data-toggle="dropdown"><i class="fa fa-gears"></i></a>
    <ul class="dropdown-menu" style="background:#f3f3f3; border:1px solid #ccc;">
        <li class="header">Aplicaciones</li>
        <li style="padding: 1em">
            <div class="list-group">
                <a href="#" class="list-group-item disabled">
                    Facturación Colombia
                </a>
                @if(!is_null(env('DOMAIN_ADUANAS_CO')))
                    <a href="{{ route('redirect_to_app', 'ADUANAS_CO') }}" class="list-group-item redirect_app" target="_blank">
                        Aduanas Colombia
                    </a>
                @endif
            </div>
        </li>
        <form action="" method="post" target="_blank" id="formRedirectApp" style="display: none">
            <input type="text" name="id" value="{{ Auth::user()->id }}"><br>
            <input type="text" name="phantom_token"><br>
            <input type="submit" value="submit">
        </form>
    </ul>
</li>
<script>
    $('.redirect_app').click(function(event){
        $('.menu-apps .gears').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px;"></i>');
        event.preventDefault();
        var request = $.ajax({
            url: $(this).attr('href'),
            type: 'get',
            dataType: "json"
        });
        request.done(function(respon){
            $('#formRedirectApp').attr('action', respon.url);
            $('#formRedirectApp [name="phantom_token"]').val(respon.token);
            $('#formRedirectApp').submit();
            $('.menu-apps .gears').html('<i class="fa fa-gears"></i>');
        });
        request.fail(function(jqXHR, textStatus) {
            $('.menu-apps .gears').html('<i class="fa fa-gears"></i>');
            utilities.errorPetitAjax(jqXHR, textStatus);
            $('[type="submit"]').prop('disabled', false);
        });
    });
</script>