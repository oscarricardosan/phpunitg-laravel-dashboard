<?php

namespace App\Http\Controllers\General;


use App\ApiClients\ExternalAppClient;
use App\Entities\General\AppEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppRequest;
use App\Interfaces\Repositories\General\AppRepositoryInterface;
use App\Maps\General\StoreAppMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    /**
     * @var AppRepositoryInterface
     */
    protected $appRepository;

    public function __construct(
        AppRepositoryInterface $appRepository
    )
    {
        $this->appRepository = $appRepository;
    }

    public function store(StoreAppRequest $request)
    {
        try{
            $storeAppMap= new StoreAppMap($request->all());
            $this->appRepository->store($storeAppMap);

        }catch (\Exception $exception){
            return response()->json([
                'success'=> false,
                'message'=> $exception->getMessage(),
            ], 422);
        }

        return response()->json([
            'success'=> true,
            'message'=> "Successfully created '{$storeAppMap->name}' app.",
            'redirect_to'=> route('App.Show', $this->appRepository->getEntity()),
        ]);
    }

    public function show(AppEntity $appEntity)
    {
        return view('app.show', [
            'appEntity'=> $appEntity
        ]);
    }

    public function scanTests(AppEntity $appEntity, Request $request)
    {
        try{
            $appEntity->getRepo()
                ->cleanAppTables()
                ->storeTestsOfExternalApp();
            return redirect(route('App.Show', $appEntity));
            }catch (\Exception $exception){
            return response()->json([
                '0'=> [$exception->getMessage()]
            ],  422);
        }
    }
}