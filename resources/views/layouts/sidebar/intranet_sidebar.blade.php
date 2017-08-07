@inject('AppRepo', 'App\Interfaces\Repositories\General\AppRepositoryInterface')
<style>
    .selectSite .select2-selection{
        background: #ecf0f5;
    }
</style>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu selectSite">
            <li class="header" style="padding: 3px 3px 5px 3px;">
                <select class="select2 selectApps">
                    <option value="" selected disabled>Select Site</option>
                    @foreach($AppRepo->getAll()->sortBy('name') as $appSelect)
                        <option
                            value="{{ $appSelect->id }}" data-url="{{ $appSelect->url }}"
                            @if(isset($appEntity))
                                @if($appEntity->id == $appSelect->id)
                                    selected
                                @endif
                            @endif
                        >
                            {{ $appSelect->name }}
                        </option>
                    @endforeach
                </select>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="header">TAGS</li>
        </ul>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search tag...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu">
            @if(isset($appEntity))
                <li>
                    <a href="documentation/index.html">
                        <i class="fa fa-globe"></i> <span>All tags</span>
                    </a>
                </li>
                @foreach($appEntity->tags->sortBy('name') as $tag)
                    <li>
                        <a href="documentation/index.html">
                            <i class="fa fa-book"></i>
                            <span>{{ $tag->name }}</span>
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">{{ $tag->tests->count() }}</span>
                            </span>

                        </a>
                    </li>
                @endforeach
            @endif
            <li class="header">Setup</li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<script>
    $('.selectApps').change(function(){
        goShowApp($(this).val());
    });
    function goShowApp(appId){
        var url= "{{ route('App.Show', '?') }}".replace('?', appId);
        window.location.href= url;
    }
</script>