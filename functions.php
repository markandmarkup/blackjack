<?php

/**
 * Calculates the sum of an array of cards, adding 10 for an ace if possible without going bust
 * @param array $cards
 * @return int
 */
function scoreCalc (array $cards) : int {
        $cardvalues = array_column($cards, 'Value');
        $score = array_sum($cardvalues);
        if (in_array(1, $cardvalues, true)) {
            if (($score + 10) < 22) {
                $score += 10;
            }
        }
        return $score;
}