# poker
Poker Card Evaluator

I don't know poker, needed to study the principles

Looked for an online api that can evaluate the hand found https://www.pokerapi.dev/ but this is based on texas holdem 
that requires 5 tables cards and then the players 2 cards. This will require extra work to get going as you will be 
dealing with 7 cards , so which is the 5 the user actually entered etc

There for I went for a custom implementation

The basic idea is to analyse 5 cards received and determine the highest rank contained in the card set / hand.

At the centre of this is the card and the analysing of the hand. I like to be separate my applications / tools into 
defined areas, front end - handles the display and back end - handles the logic of the system. This allows you to 
have a API whereby you can plug any front into as needed. Returning standard out allows you to utlise the data as you 
want without needing to change the business /  core logic

Based on that principle the entry points of the system is located in /api. These routes will return json and the 
requesting code can then use it as required, be it a web interface or console application

Please note that for each of use I opted to include both the api and then the future "front end / access point", into 
the code repo.

I opted for Laravel as a base framework, as this is the base framework I work with on a daily basis, and I'm most 
used to it. I'm using a framework as this does help me with the scaffolding which saves time. It also provides 
structured point to start out from.

Global rule set for the evaluator:
1 - the tool only uses the standard 52 card deck during evaluation, minus the 2 joker cards. thus 50 in total

The Card
Identifiable traits:
suite - spade, diamond, hart, club (the image on the card) [S,D,H,C]
rank - number / value the card represents : king, queen, jack, 10,9,8,7,6,5,4,3,2, ace, joker
[K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR]

To be considered a valid card 
    1 - the suite needs to be in the lists of suites
    2 - the rank must be in the lists of ranks    

The Hand
Identifiable traits:
a hand is a collection of 5 non-identical cards (based on the global rule set)
the hand should receive 1 card a time to the total number of the allowed cards, this will give your the ability to
validate the cards as they come in and immediatly provide feedback as to if the card is valid. once the hand is full
it can be evaluated

To be considered a valid hand
    1 - must be 5 cards only
    2 - all cards must be valid
    3 - all cards must be unique

Evaluators
Once you have setup your hand, you need to be able to evaluate it. the evaluators each have different rules but is 
centered around the rank and suit.

Four of a kind: 4 cards of the same rank [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR] plus another card
Strait: 5 cards of sequential rank but not of the same suit [S9,S8,S7,S6,S5,S4]
Three of a kind: 3 cards of the same rank [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR] plus another two cards
Two pair: 2 cards of one rank [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR], 2 cards of another rank [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR], plus a card
Strait Flush: 5 cards of the same suite [S,D,H,C]  and all must be sequential


Future features
At this point I'm not sure what to add onto this in future, but will come back to this as I progress
1 - The sequencial algorithm must be refactored to a single functions that can be used every where. perhaps this can be
    a trait or a base class
2 - change up the entry system to facilitate the possiblity to only call the evaluate function on the a valid hand.
    currently this is being done on each evaluator which can be more effecient by prevent the system to get to this 
    point completely
3 - adapt the system to handle the joker [JKR] card
4 - the integer values of the ranks, should be moved to the Ranks enum for better logical reading, seeing that it is
    directly related to each rank

