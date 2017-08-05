<?php

namespace App\Http\Controllers\General;


use App\Entities\General\AppEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppRequest;
use App\Interfaces\Repositories\General\AppRepositoryInterface;
use App\Maps\General\StoreAppMap;

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
}