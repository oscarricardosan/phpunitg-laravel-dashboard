<ol>
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
        Exec
        <kbd class="code">
            php artisan vendor:publish
        </kbd>
    </li>
    <li>
        In the classes of your app put in de cometdocs "@phpunitG TagName" <br>
        <div class="code">
            /**<br>
            * @phpunitG TagName<br>
            */<br>
            class ExampleTest extends TestCase{.....}
        </div>
    </li>
    <li>
        Back and on this page click in
        <button type="button" class="btn btn-box-tool" style="color: #354eb5;">
            <a href="{{ route('App.ScanTests', $appEntity) }}">
                <i class="fa fa-refresh"></i>
                Scan by tests
            </a>
        </button>
    </li>
</ol>