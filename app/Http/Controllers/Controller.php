<?php

namespace App\Http\Controllers;

use App\Classes\Card;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class Controller extends BaseController
{
   // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Accept a card through POST and create a object from it to return
     *
     * @param Request $request
     * @return JsonResponse
     */
    function testCard(Request $request): JsonResponse
    {
        $pre = __METHOD__ . ' : ';
        Log::debug($pre . 'bof', func_get_args());

        try{
            $card = new Card($request->input('card'));
            $returnData['data']['name'] =  $card->getName();
            $returnData['data']['rank'] =  $card->getRank();
            $returnData['data']['suite'] =  $card->getSuite();
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $exception) {
            $returnData['error'] = $exception->getMessage();
            $responseCode = Response::HTTP_BAD_REQUEST;
        }
        return response()->json($returnData, $responseCode);

    }
}
