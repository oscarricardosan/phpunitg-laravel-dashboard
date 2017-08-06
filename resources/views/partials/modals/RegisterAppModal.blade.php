<style>
    .directory_line{
        border-bottom: 1px solid #cccccc;
    }
    #foldersToScan>li{
        padding-top: 0.5em;
        padding-right: 0;
        padding-left: 0;
    }
</style>
<div id="register_app" class="modal fade " tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('App.Store') }}" method="POST" id="registerApp">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Register App</h4>
                </div>
                <div class="modal-body"> <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="control-label">App name:</label>
                            <input name="name" class="form-control">
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label" style="margin: 0">App url:</label>
                            <p class="help-block" style="margin: 0">
                                This is the local url of your app. Example: http://miapp.app/.
                            </p>
                            <input name="url" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script id="newFolderToScannTpl" type="text/template">
    <li class="col-sm-12">
        <div class="col-sm-12" style="padding: 0px !important;">
            <a href="#" class="pull-right removeLine" style="color: darkred;">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </a>
            <div class="directory_line" contenteditable="true">app/</div>
        </div>
    </li>
</script>
<script>
    $(document).ready(function(){
        $('.addFolderToScan').click(function(event){
            event.preventDefault();
            if($('#foldersToScan>li').length > 5){
                alert('Maximun 5 folders');
                return false;
            }
            $('#foldersToScan').append(
                $('#newFolderToScannTpl').renderTpl()
            );
        });
        $('form#registerApp').submit(function(event){
            event.preventDefault();
            var form= $(this);
            var data= $(this).serializeArray();
            var request = $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: data,
                dataType: "json"
            });
            request.done(function(respon){
                alert(respon.message);
                if(respon.success){
                    window.location.href= respon.redirect_to;
                }
            });
            request.fail(function(jqXHR, textStatus) {
                utilities.errorPetitAjax(jqXHR, textStatus);
            });
        });
        $(document).on("click", ".removeLine", function(event){
            event.preventDefault();
           $(this).closest('li').remove();
        });
    });
</script>