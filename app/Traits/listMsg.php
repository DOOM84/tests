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
            'Не расстраивайтесь.',
            'Всякое бывает.',
            'Next time lucky.',
            'В следующий раз повезёт.',
            'Calm down.',
            'Успокойтесь',
            'Take it easy.',
            'Не принимайте близко к сердцу.',
            'Don\'t get mad!',
            'Не раздражайтесь!',
            'Cool it.',
            'Остынь. / Не кипятись.',
            'Pull yourself together!',
            'Возьми себя в руки!',
            'Let us hope for the best.',
            'Будем надеяться на лучшее.',
            'Everything will be all right.',
            'Все будет хорошо.',
            'Things happen.',
            'Всякое случается.',
            'What a pity!',
            'Как жаль!',
            'It leaves much to be desired.',
            'Оставляет желать лучшего.',
        ];

        $wrong18 = [
            'Don’t take it to heart.',
            'He принимай это близко к сердцу.',
            'Don’t get upset about it.',
            'He расстраивайся из-за этого.',
            'Next time lucky.',
            'В следующий раз повезет.',
            'I appreciate your difficulties.',
            'Я понимаю Ваши трудности',
            'What\'s done is done.',
            'Ничего уже не поделаешь.',
        ];

        $right3 = [
            'On the right track.',
            'На верном пути.',
            'Yes, sure',
            'Да, конечно',
            'You are right.',
            'Вы правы',
            'Not bad',
            'Неплохо',
        ];

        $right4 = [
            'Какая удача!',
            'What a good chance!',
            'Exactly so.',
            'Именно так.',
        ];

        $right5 = [
            'This way',
            'Вот так.',
            'Right you are',
            'Правильно',
            'That\'s true.',
            'Верно.',
            'That\'s it.',
            'Точно, вот именно.',
            'That\'s cold.',
            'You have a case.',
            'Cinch',
            'Верняк',
            'Cert',
            'Sure thing',
            'Cool',
            'Клево, классно.',
            'I\'m very glad',
            'Я очень рад',
            'On the nose',
            'В точку',
            'It is in the bag',
            'Дело в шляпе',
            'Какая удача!',
            'What a good chance!',
            'Most likely.',
            'Наиболее вероятно.',
        ];

        $right7 = [ // 1 wrong
            'That\'s right.',
            'Это точно',
        ];

        $right10 = [
            'Very nice',
            'Очень приятно',
            'I can\'t believe it!',
            'Невероятно!',
            'It is as good as done.',
            'Можно сказать, мы это сделали.',
            'You make me mad.',
            'Ты сводишь меня с ума',
            'Very well.',
            'Очень хорошо.',
        ];

        $right18 = [
            'That\'s the way to do it',
            'Вот так это делается.',
        ];

        $right20 = [
            'That\'s the way to do it',
            'Вот так это делается.',
        ];

        $right49 = [ // 5 wrong or 9 wrong
            'Well done!',
            'Хорошая работа',
            'Very well',
            'Очень хорошо',
        ];


        if ($cntAnsw == 49) {
            if ($result >= $cntAnsw - 9 && $result <= $cntAnsw - 5) {
                $varToEcho = "right$cntAnsw";
                $toEcho = $$varToEcho [array_rand($$varToEcho)];

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