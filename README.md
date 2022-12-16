# poker
Poker Card Evaluator

I don't know poker, needed to study the principles
Looked for an online api that can evaluate the hand found https://www.pokerapi.dev/ but this is based on texas holdem that requires 5 tables cards and then the players 2 cards. This will require extra work to get going as you will be dealing with 7 cards , so which is the 5 the user actually entered etc

There for I went for a custom implementation

The basic idea is to analyse 5 cards received and determine the highest rank contained in the card set / hand.

At the centre of this is the card and the analysing of the hand. I like to be able separate my applications / tools into defined areas, front end - handles the display and back end - handles the logic of the system. This allows you to have a API whereby you can plug any front into as needed. Returning standard out allows you to utlise the data as you want with out needing to change the business /  core logic

Based on that principle the entry points of the system is located in /api. These routes will return json and the requesting code can then use it as required, be it a web interface or console application

For ease of use 
