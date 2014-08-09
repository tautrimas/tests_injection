<?php

namespace tests\Unit\Detector;

use App\Detector\LanguageDetector;

class LanguageDetectorTest extends \PHPUnit_Framework_TestCase
{
    public function getDetectLanguageCases()
    {
        $cases = array();

        $cases[] = array('iiiii', 'lt');

        return $cases;
    }

    /**
     * @dataProvider getDetectLanguageCases
     */
    public function testDetectLanguage($text, $expectedLanguage)
    {
        $detector = new LanguageDetector();
        $result = $detector->detectLanguage($text);
        $this->assertSame($expectedLanguage, $result);
    }
}
