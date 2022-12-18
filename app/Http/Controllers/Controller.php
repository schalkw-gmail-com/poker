<?php

namespace App\Http\Controllers;

use App\Classes\Card;
use App\Classes\Hand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    /**
     * Accept a card through POST and create an object from it to return as json
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function testCard(Request $request): JsonResponse
    {
        $pre = __METHOD__ . ' : ';
        Log::debug($pre . 'bof');

        try {
            $request->validate([
                'card' => 'required'
            ]);

            $card = new Card($request->input('card'));

            $returnData['data']['name'] = $card->getName();
            $returnData['data']['rank'] = $card->getRank();
            $returnData['data']['suite'] = $card->getSuite();

            $responseCode = Response::HTTP_OK;
        } catch (\Exception $exception) {
            $returnData['error'] = $exception->getMessage();
            $responseCode = Response::HTTP_BAD_REQUEST;
        }
        return response()->json($returnData, $responseCode);
    }

    /**
     * Accept a card through POST and create an object from it to return as json
     *
     * @param Request $request
     * @return JsonResponse
     */
    function addCards(Request $request): JsonResponse
    {
        $pre = __METHOD__ . ' : ';
        Log::debug($pre . 'bof', func_get_args());
        $returnData = array();
        $responseCode = Response::HTTP_OK;

        Log::debug($pre . ' ssssssssss ' . print_r($request->toArray(), true));

        try {
            $cards = $request->input('card');
            $hand = new Hand();
            foreach ($cards as $card) {
                Log::debug($pre . ' ssssssssss ' . print_r($card, true));
                $hand->addCard($card);
            }
            $returnData['data']['hand'] = $hand->returnHand();
            $returnData['data']['evaluation'] = $hand->returnEvaluation();
        } catch (\Exception $exception) {
            $returnData['error'] = $exception->getMessage();
            $responseCode = Response::HTTP_BAD_REQUEST;
        }


        return response()->json($returnData, $responseCode);
    }
}
