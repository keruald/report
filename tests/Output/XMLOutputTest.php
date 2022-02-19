<?php

namespace Keruald\Reporting\Tests\Output;


use Keruald\Reporting\Output\XMLOutput;
use Keruald\Reporting\Report;

use Keruald\Reporting\Tests\WithSampleReport;
use PHPUnit\Framework\TestCase;

class XMLOutputTest extends TestCase {

    use WithSampleReport;

    ///
    /// Tests
    //

    /**
     * @dataProvider provideSampleReports
     */
    public function testRender (string $name, Report $report) : void {
        $actual = XMLOutput::for($report)->render();

        $expected = file_get_contents($this->getDataDir() . "/$name.xml");

        $this->assertEquals($expected, $actual);
    }

}
