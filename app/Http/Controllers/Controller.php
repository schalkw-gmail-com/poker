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
     * Test that the data passed to the endpoint is a valid card.
     *
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
     * Accept an array of cards through POST, validate the cards, produce a card hand and return the hand rank via json
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addCards(Request $request): JsonResponse
    {
        Log::debug(__METHOD__ . ' : ');

        $returnData = array();
        $responseCode = Response::HTTP_OK;

        try {
            $request->validate([
                'card' => 'required|array|size:5'
            ]);

            $cards = $request->input('card');
            $hand = new Hand();

            foreach ($cards as $card) {
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
