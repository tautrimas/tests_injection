<?php

namespace App\Detector;

class LanguageDetector
{
    /**
     * @param $text
     * @return mixed
     */
    public function detectLanguage($text)
    {
        $languagesStatistics = array(
            'en' => array(
                'e' => 12.02,
                't' => 9.1,
                'a' => 8.12,
                'o' => 7.68,
                'i' => 7.31,
            ),
            'lt' => array(
                'i' => 15.25,
                'a' => 10.43,
                's' => 9.34,
                't' => 6.74,
                'e' => 5.55,
            ),
        );

        $charStatsRaw = count_chars($text, 1);
        $charStats = array();
        foreach ($charStatsRaw as $code => $count) {
            $charStats[chr($code)] = $count;
        }

        $languageScores = array();

        foreach ($languagesStatistics as $language => $languageStatistics) {
            $intersection = array_intersect_key($charStats, $languageStatistics);
            ksort($intersection);
            ksort($languageStatistics);
            $dotProduct = array_sum(
                array_map(
                    function ($a, $b) {
                        return $a * $b;
                    },
                    $intersection,
                    $languageStatistics
                )
            );

            $sqr = function ($a) {
                return $a * $a;
            };

            $lengthSubject = sqrt(array_sum(array_map($sqr, $intersection)));
            $lengthTarget = sqrt(array_sum(array_map($sqr, $languageStatistics)));
            $languageScores[$language] = $dotProduct / ($lengthSubject * $lengthTarget);
        }

        arsort($languageScores);
        $matchedLanguage = array_keys($languageScores)[0];

        return $matchedLanguage;
    }
}
