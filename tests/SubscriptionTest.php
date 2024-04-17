<?php

namespace App\Tests;

use App\Entity\Subscription;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function testSetterSubscription(): void
    {
        $subscription = new Subscription();

        $title = 'Test';
        $description = 'Test description';
        $pdfLimit = 10;
        $price = 10.0;
        $media = 'Test media';

        $subscription->setTitle($title);
        $subscription->setDescription($description);
        $subscription->setPdfLimit($pdfLimit);
        $subscription->setPrice($price);
        $subscription->setMedia($media);

        $this->assertEquals($title, $subscription->getTitle());
        $this->assertEquals($description, $subscription->getDescription());
        $this->assertEquals($pdfLimit, $subscription->getPdfLimit());
        $this->assertEquals($price, $subscription->getPrice());
        $this->assertEquals($media, $subscription->getMedia());
    }
}
