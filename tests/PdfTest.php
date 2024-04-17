<?php

namespace App\Tests;

use App\Entity\Pdf;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class PdfTest extends TestCase
{
    public function testSetterPdf(): void
    {
        $pdf = new Pdf();

        $title = 'Test';
        $createdAt = new DateTimeImmutable('2021-01-01');

        $pdf->setTitle($title);
        $pdf->setCreatedAt($createdAt);

        $this->assertEquals($title, $pdf->getTitle());
        $this->assertEquals($createdAt, $pdf->getCreatedAt());
    }
}
