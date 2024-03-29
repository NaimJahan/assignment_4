<?php
function calculateCollatz($start) {
    $sequence = array($start);

    while ($start != 1) {
        if ($start % 2 == 0) {
            $start = $start / 2;
        } else {
            $start = 3 * $start + 1;
        }
        $sequence[] = $start;
    }

    return $sequence;
}

function collatzSequenceInRange($begin, $end) {
    $sequences = array();

    for ($i = $begin; $i <= $end; $i++) {
        $seq = array();
        $num = $i;

        while ($num != 1) {
            $seq[] = $num;
            if ($num % 2 == 0) {
                $num = $num / 2;
            } else {
                $num = 3 * $num + 1;
            }
        }
        $seq[] = 1;
        $sequences[] = array(
            'number' => $i,
            'highest_number' => max($seq),
            'iteration' => count($seq) - 1
        );
    }

    return $sequences;
}
?>
