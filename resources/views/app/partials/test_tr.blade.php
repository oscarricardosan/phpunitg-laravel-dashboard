<tr>
    <td class="word-break">
        <a href="{{ route('Tag.Show', $tag) }}">
            <small class="label label-info">
                {{ $tag->name }}
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </small>
        </a>
        <br>
        {{ $test->class }}<br>
        <small style="color: #777;">
            {!! $test->path !!}
        </small>
    </td>
    <td class="word-break">
        <ol style="padding-left: 10px;">
            @foreach($test->methods as $method)
                <li>{{ $method->name }}</li>
            @endforeach
        </ol>
    </td>
</tr>