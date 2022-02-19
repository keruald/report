<?php

namespace Keruald\Reporting\Tests\Output;

use Keruald\Reporting\Output\HTMLOutput;
use Keruald\Reporting\Report;

use Keruald\Reporting\Tests\WithSampleReport;
use PHPUnit\Framework\TestCase;

class HTMLOutputTest extends TestCase {

    use WithSampleReport;

    ///
    /// Tests
    //

    /**
     * @dataProvider provideSampleReports
     */
    public function testRender (string $name, Report $report) : void {
        $actual = HTMLOutput::for($report)->render();

        $expected = file_get_contents($this->getDataDir() . "/$name.html");

        $this->assertEquals($expected, $actual);
    }

}
