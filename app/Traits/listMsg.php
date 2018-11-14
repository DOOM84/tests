<?php


namespace App\Traits;


trait listMsg
{

    public function getMsg($cntAnsw, $result)
    {
        /*$var1 = 'A';
        $var2 = 'B';
        $var3 = 'C';
        $var4 = 'D';

        for ($i = 1; $i < 5; $i++) {

            $varToEcho = "var$i"; // will become var1, var2, var3 and so on

            echo $$varToEcho;

        }*/

        $wrong5 = [
            'Don\'t get upset.',
            'Next time lucky.',
            'Calm down.',
            'Take it easy.',
            'Don\'t get mad!',
            'Cool it.',
            'Pull yourself together!',
            'Let us hope for the best.',
            'Everything will be all right.',
            'Things happen.',
            'What a pity!',
            'It leaves much to be desired.',
        ];

        $wrong18 = [
            'Don’t take it to heart.',
            'Don’t get upset about it.',
            'Next time lucky.',
            'I appreciate your difficulties.',
            'What\'s done is done.',
        ];

        $right3 = [
            'On the right track.',
            'Yes, sure',
            'You are right.',
            'Not bad',
        ];

        $right4 = [
            'What a good chance!',
            'Exactly so.',
        ];

        $right5 = [
            'This way',
            'Right you are',
            'That\'s true.',
            'That\'s it.',
            'That\'s cold.',
            'You have a case.',
            'Cinch',
            'Cert',
            'Sure thing',
            'Cool',
            'I\'m very glad',
            'On the nose',
            'It is in the bag',
            'What a good chance!',
            'Most likely.',
        ];

        $right7 = [ // 1 wrong
            'That\'s right.',
        ];

        $right10 = [
            'Very nice',
            'I can\'t believe it!',
            'It is as good as done.',
            'You make me mad.',
            'Very well.',
        ];

        $right18 = [
            'That\'s the way to do it',
        ];

        $right20 = [
            'That\'s the way to do it',
        ];

        $right49 = [ // 5 wrong or 9 wrong
            'Well done!',
            'Very well',
        ];


        if ($cntAnsw == 49) {
            if ($result >= $cntAnsw - 9 && $result <= $cntAnsw - 5) {
                $varToEcho = "right$cntAnsw";
                $toEcho = $$varToEcho[array_rand($$varToEcho)];

                return $toEcho;
            }
        }
        if ($cntAnsw == 7) {
            if ($result >= $cntAnsw - 1) {
                $varToEcho = "right$cntAnsw";
                $toEcho = $$varToEcho[array_rand($$varToEcho)];

                return $toEcho;
            }
        }

        if ($cntAnsw == $result) {
            $varToEcho = "right$cntAnsw";
            $toEcho = $$varToEcho[array_rand($$varToEcho)];
            return $toEcho;

        } else {
            if ($cntAnsw == 5 || $cntAnsw == 18) {
                if ($result == 0) {
                    $varToEcho = "wrong$cntAnsw";
                    $toEcho = $$varToEcho[array_rand($$varToEcho)];
                    return $toEcho;
                }
            }

        }
    }


}