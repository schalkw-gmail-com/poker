# Poker - Hand and Card Evaluator

## Background:
I don't know poker, so I needed to study the principles and concepts. Rather interesting rules I must say.

Looked for an online api that can evaluate the hand found https://www.pokerapi.dev/ but this is based on texas holdem 
that requires 5 table cards and then the players have 2 cards each. This will require extra work to get going as 
you will be dealing with 7 cards, so which is the 5 the user actually entered etc.

There for I went for a custom implementation.

## Description:
The basic idea is to analyse 5 cards received and determine the highest rank contained in the card set / hand.

At the centre of this is the card and the analysing of the hand. I like to be separate my applications / tools into 
defined areas:
    front end - handles the display  
    back end - handles the logic of the system. 

This allows you to have an API that is frontend agnostic whereby you can plug any 
display method (website, mobile, android ...) into it as needed. Returning standard outputs allows you to utilise the 
data as you want without needing to change the business / core logic.

Based on that principle the entry points of the system is located in /api. These routes will return json and the 
requesting code can then use it as required, be it a web interface or console application.

Please note that for ease of use I opted to include both the api and then the future "front end / access points", into 
the same code repo. Else you will have various repos to contend with at the same time.

I opted for Laravel as a base framework, as this is the base framework I work with on a daily basis, and I'm most 
familiar to it. I'm using a framework as this does help me with the scaffolding, which saves time. It also provides 
structured point to start out from.

## My thought process:

I divided the work in the following order:

#### card entity:
be able to create a valid card and determine the suite and rank

#### the evaluators: 
each evaluator was done separately in order to have a working piece of software before going to the 
next item. I did not pick the suite validators beforehand but, decided on the go as I worked to the required number
of 5.

#### the api: 
now that I have a working base, I can create the api, which will allow you to add cards to the hand
and then evaluate the hand

## Unit tests:

Both the card entity and the evaluators are accompanied by unit tests. As this is the base of the system it required 
that the code be tested to ensure that it does its job as expected. During development the need of the class might
change and then the tests are changed as needed. The tests can be run in the terminal using

```php 
php8.1 vendor/bin/phpunit --testdox
```

## Requirements:
    PHP8.1
    composer (php package manager)

## Setup instructions:
1 - clone the repo to your local machine

2 - run composer install from within the folder you cloned the repo into

3 - unit tests :
```php
    php8.1 vendor/bin/phpunit --testdox
```
4 - start the server: 
```php
php8.1 artisan serve
```
5 - Use Postman or CURL to access the end points

api/test/card - allows you to submit a card via POST to the service, and it returns either the card details
or an error of invalid card. 

#### Examples:
```curl
curl http://127.0.0.1:8000/api/test/card -X POST -d "card=value1"
```
Returns a json error as this is not a valid card: {"error":"This is not a valid card"}

```curl
curl http://127.0.0.1:8000/api/test/card -X POST -d "card=D4"
```
Returns a json array {"data":{"name":"D5","rank":"Five","suite":"Diamonds"}}

```curl
curl http://127.0.0.1:8000/api/test/card -X POST -d "ee=D4"
```
Returns a json error {"error":"The card field is required."}}

api/card/add - allows you to submit an array of cards via POST to the service, and return the hand details and the
evaluation if it has one.

#### Examples:
```curl
curl http://127.0.0.1:8000/api/card/add -X POST -d "card[]=D4" -d "card[]=H4" -d "card[]=S4" -d "card[]=C4" -d "card[]=C6"
```
Returns a json error string with the hand details

```curl
curl http://127.0.0.1:8000/api/test/card -X POST -d "card=value1"
```
Returns a json error as you need to pass in an array of cards


## Rules and definitions:

### Global rule:  
the tool only uses the standard 52 card deck during evaluation, minus the 2 
joker cards. thus 50 in total

## The Card:

#### Identifiable traits:
suite - spade, diamond, hart, club (the image on the card) [S,D,H,C]

rank - number / value the card represents : 
king, queen, jack, 10,9,8,7,6,5,4,3,2, ace, joker 
[K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR]

To be considered a valid card:

    1 - the suite needs to be in the lists of suites
    2 - the rank must be in the lists of ranks    

## The Hand:

#### Identifiable traits:
a hand is a collection of 5 non-identical cards (based on the global rule set)
the hand should receive 1 card a time to the total number of the allowed cards, 
this will give you the ability to validate the cards as they come in and
immediately provide feedback as to if the card is valid or not. once the hand 
is full it can be evaluated

To be considered a valid hand: 

    1 - must be 5 cards only
    2 - all cards must be valid
    3 - all cards must be unique

## Evaluators:

Once you have set up your hand, you need to be able to evaluate it. 
the evaluators each have different rules but is 
centered around the rank and suit.

#### Four of a kind: 
4 cards of the same rank [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR] plus another card

#### Strait: 
5 cards of sequential rank but not of the same suit [S9,S8,S7,S6,S5,S4]

#### Three of a kind: 
3 cards of the same rank [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR] plus another two cards

#### Two pair: 
2 cards of one rank [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR], 2 cards of another 
    rank [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR], plus a card

#### Strait Flush: 
5 cards of the same suite [S,D,H,C]  and all must be sequential

## Future features:

1 - Clean up - I need to clean up the code, add proper log message etc

2 - The sequential algorithm must be refactored into a single function that can 
    be used everywhere. perhaps this can be a trait or a base class. 
    This will eliminate duplicated code in the evaluators.

3 - change up the entry system to facilitate the possibility to only call the 
    evaluate function on a valid hand. Currently, this is being done on each 
    evaluator which can be more efficient by preventing the system to get to this 
    point completely

3 - adapt the system to handle the joker [JKR] card

4 - the integer values of the ranks, should be moved to the Ranks enum for 
    better logical reading, seeing that it is directly related to each rank
