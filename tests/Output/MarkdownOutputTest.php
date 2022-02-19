<?php

namespace Keruald\Reporting\Tests\Output;

use Keruald\Reporting\Output\MarkdownOutput;
use Keruald\Reporting\Report;

use Keruald\Reporting\Tests\WithSampleReport;
use PHPUnit\Framework\TestCase;

class MarkdownOutputTest extends TestCase {

    use WithSampleReport;

    ///
    /// Tests
    //

    /**
     * @dataProvider provideSampleReports
     */
    public function testRender (string $name, Report $report) : void {
        $actual = MarkdownOutput::for($report)->render();

        $expected = file_get_contents($this->getDataDir() . "/$name.md");

        $this->assertEquals($expected, $actual);
    }
}
