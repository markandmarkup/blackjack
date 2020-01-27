<?php

require 'functions.php';

$no_of_players = 3;

// deck building
$suits = [" of Spades &#9828", " of Hearts &#9825", " of Clubs &#9831", " of Diamonds &#9826"];
$deck = [];
$card = [];
$player_cards = [];
$player_score = [];

foreach ($suits as $suit) {
    $card = ['Value' => 1, 'Suit' => $suit, 'Name' => 'Ace'];
    $deck[] = $card;
    for ($j = 2; $j < 11; $j++) {
        $card = ['Value' => $j, 'Suit' => $suit, 'Name' => $j];
        $deck[] = $card;
    }
    $card = ['Value' => 10, 'Suit' => $suit, 'Name' => 'Jack'];
    $deck[] = $card;
    $card = ['Value' => 10, 'Suit' => $suit, 'Name' => 'Queen'];
    $deck[] = $card;
    $card = ['Value' => 10, 'Suit' => $suit, 'Name' => 'King'];
    $deck[] = $card;
}

//shuffle, draw and calculate scores
shuffle($deck);
$deck_pointer = 0;

for ($i = 0; $i < ($no_of_players + 1); $i++) {
    $player_cards[] = [$deck[$deck_pointer], $deck[$deck_pointer + 1]];
    $player_score[] = scoreCalc($player_cards[$i]);
    $deck_pointer += 2;
}

foreach ($player_cards as $player => $cards) {
    while ($player_score[$player] < 16) {
        $player_cards[$player] [] = $deck[$deck_pointer];
        $deck_pointer++;
        $player_score[$player] = scoreCalc($player_cards[$player]);
    }
}

//display hands and scores - Dealer always the last in the array
foreach ($player_cards as $player => $cards) {
    $player_num = $player + 1;
    if ($player == $no_of_players) {
        echo '<b>~~ Dealer ~~</b>';
        echo '<br />';
    } else {
        echo "<b>~~ Player $player_num ~~</b>";
        echo '<br />';
    }
    foreach ($cards as $card) {
        echo $card['Name'] . $card['Suit'];
        echo '<br />';
    }
    echo "<b>Score: $player_score[$player]";
    if ($player_score[$player] > 21) {
        echo ' - BUST!';
    }
    echo '</b><br />';
    echo '<br />';
}

//winners score sentence construction
$valid_scores = [];
foreach ($player_score as $score) {
    if ($score < 22) {
        $valid_scores[] = $score;
    }
}

$winner = array_keys($player_score, max($valid_scores));
if (count($winner) == 1) {
    if ($winner[0] == $no_of_players) {
        echo '<h3>Dealer wins!</h3>';
    } else {
        $index_correct = $winner[0] + 1;
        echo "<h3>Player $index_correct wins!</h3>";
    }
} elseif (count($winner) > 1) {
    echo '<h3>';
    for ($i = count($winner); $i > 0; $i--) {
        $index_correct = $i - 1;
        if ($winner[$index_correct] == $no_of_players) {
            echo 'The Dealer';
        } else {
            $player_num = $winner[$index_correct] + 1;
            echo "Player $player_num";
        }
        if ($i > 2) {
            echo ', ';
        } elseif ($i == 2) {
            echo ' and ';
        } else {
            echo ' win!</h3>';
        }
    }
}

//echo '<pre>';
//var_dump($deck_pointer);
//var_dump($deck);
//echo '</pre>';
