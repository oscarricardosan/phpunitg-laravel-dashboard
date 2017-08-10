<?php


namespace App\Http\Controllers\General;


use App\ApiClients\ExternalAppClient;
use App\Entities\General\MethodEntity;
use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\General\Method_executionRepositoryInterface;

class MethodController extends Controller
{
    /**
     * @var Method_executionRepositoryInterface
     */
    protected $method_executionRepository;

    public function __construct(Method_executionRepositoryInterface $method_executionRepository)
    {
        $this->method_executionRepository = $method_executionRepository;
    }


    public function run(MethodEntity $methodEntity)
    {
        try{
            $phpunitResult= $methodEntity->getRepo()
                ->deleteRecordsOfRelationship('executions')
                ->runInPhpunit();

            $method_execution= $this->method_executionRepository
                ->setMethodEntity($methodEntity)
                ->storeExternalResponse($phpunitResult)
                ->getEntity();
        }catch (\Exception $exception){
            return response()->json([
            '0'=> [$exception->getMessage()]
            ],  422);
        }

        return response()->json([
            'success'=> $method_execution->success,
            'message'=> $method_execution->html_message,
        ]);
    }
}