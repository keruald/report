<?php

namespace Keruald\Reporting\Tests;

use Keruald\Reporting\Report;
use Keruald\Reporting\ReportEntry;
use Keruald\Reporting\ReportSection;

trait WithSampleReport {

    public function getDataDir () : string {
        return __DIR__ . "/data";
    }

    public function provideSampleReports () : iterable {
        yield ["report", $this->buildSampleReport()];
        yield ["empty", new Report("Void report")];

        $report = $this->buildSampleReport();
        $report->properties = [];
        yield ["no_metadata", $report];

        $report = $this->buildSampleReport();
        $report->sections = [];
        yield ["only_metadata", $report];
    }

    public function buildSampleReport () : Report {
        $report = new Report("Sneakers");

        // Section 1
        $section = new ReportSection("Air Max");
        $section->entries = [
            new ReportEntry("Air Max 90", "One of the more icon color is the infrared."),
            new ReportEntry("Air Max 95", "Launched in 1995, designed by Sergio Lozano."),
            new ReportEntry("Air Max 97", <<<EOF
Well highlighted Air bubble.

Inspired by mountain bikes, while an urban legend quotes Japan bullet trains as inspiration.
EOF
),
        ];
        $report->push($section);

        // Section 2
        $section = new ReportSection("Other Nike Air");
        $section->entries = [
            new ReportEntry("Introduction", "Because there are other sneakers than Air Max."),
            new ReportEntry("Air Force 1", "« Air Force 1. Zéro fan, que des fanatiques. » -- LTA"),
        ];
        $report->push($section);

        // Section 3 — should be ignored as blank
        $section = new ReportSection("Not cool sneakers");
        // As all sneakers are cool, this is empty.
        $report->pushIfNotEmpty($section);

        // Section 4 — should be included even if blank
        $section = new ReportSection("👟");
        $report->push($section);

        // Metadata
        $report->properties = [
            "Date" => "9999-99-99",
            "Topic" => "Urban culture",
        ];

        return $report;
    }

}
