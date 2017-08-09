<ol style="line-height: 2em;">
    <li>Go to your app</li>
    <li>
        Exec
        <kbd class="code">
            composer require --dev oscarricardosan/phpunitg_laravel
        </kbd>
    </li>
    <li>
        Put in the .env
        <kbd class="code">
            PHPUNITG_TOKEN={{$appEntity->token}}
        </kbd>
    </li>
    <li>
        Add the service provider to your config/app.php file:
        <kbd class="code">
            \Oscarricardosan\PhpunitgLaravel\OscarricardosanPhpunitgServiceProvider::class
        </kbd>
    </li>
    <li>
        In the tests you want to scan put in the cometdocs  "@phpunitG TagName" <br>
        <div class="code">
            /**<br>
            * @phpunitG Tag name<br>
            */<br>
            class ExampleTest extends TestCase{...My code...}
        </div>
    </li>
    <li>
        In the methods you want to scan put in the cometdocs "@test" <br>
        <div class="code">
            /**<br>
            * @test<br>
            */<br>
            public function is_index_working(){...My code...}
        </div>
    </li>
    <li>
        Back and on this page click in
        <a type="button" class="btn btn-box-tool scanByTests" style="color: #354eb5;" href="{{ route('App.ScanTests', $appEntity) }}">
            <i class="fa fa-refresh"></i>
            <span class="text">Scan by tests</span>
        </a>
    </li>
</ol>