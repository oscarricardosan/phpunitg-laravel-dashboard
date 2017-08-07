<tr>
    <td>
        <small class="label label-info">
            {{ $tag->name }}
        </small> <br>
        {{ $test->class }}<br>
        <small style="color: #777;">
            {!! $test->path !!}
        </small>
    </td>
    <td>
        <ol style="padding-left: 10px;">
            @foreach($test->methods as $method)
                <li>{{ $method->name }}</li>
            @endforeach
        </ol>
    </td>
</tr>