<tr data-method-id="{{ $method->id }}"
    class="tr_test
    @if(is_null($method->execution)) active
    @elseif($method->execution->success) success
    @else danger
    @endif
    "
>
    <td>
        <input type="checkbox" class="testSelect" value="{{ $method->id }}">
    </td>
    <td class="testName">
        <i class="fa fa-question-circle" aria-hidden="true" style="color: gray"></i>
        <i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i>
        <i class="fa fa-times-circle" aria-hidden="true" style="color: #ec1010"></i>
        {{ $test->sortNameClass }}::{{ $method->name }}<br>
        <small class="label label-info">
            {{ $test->class }}
        </small>
    </td>
    <td>
        <div class="form-control result col-xs-12 col-md-12 col-sm-12">
            @if(!is_null($method->execution))
                {!!  $method->execution->html_message !!}
            @endif
        </div>
        <div style="text-align: right">
            <button class="btn btn-link seePhpunitResponse" style="margin-right: 2em;" title="Run Test"
               data-toggle="modal" data-target="#phpunitResponse" type="button"
            >
                <i class="fa fa-external-link" aria-hidden="true"></i>See response in modal</span>
            </button>
            <button class="btn btn-link runTest" style="text-decoration: underline" href="#" title="Run Test" type="button">
                <i class="fa fa-cog"></i> <span class="text">Run test</span>
            </button>
        </div>
    </td>
</tr>