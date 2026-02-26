<?php

namespace Tests\Unit;

use Tests\TestCase;

class PriceCalculatorTest extends TestCase
{
    /** @test */
    public function calculates_rental_price_for_single_day()
    {
        $pricePerDay = 500000;
        $startDate = now();
        $endDate = now()->addDay();

        $totalDays = $endDate->diffInDays($startDate);
        $totalPrice = $totalDays * $pricePerDay;

        $this->assertEquals(500000, $totalPrice);
        $this->assertEquals(1, $totalDays);
    }

    /** @test */
    public function calculates_rental_price_for_multiple_days()
    {
        $pricePerDay = 500000;
        $startDate = now();
        $endDate = now()->addDays(5);

        $totalDays = $endDate->diffInDays($startDate);
        $totalPrice = $totalDays * $pricePerDay;

        $this->assertEquals(2500000, $totalPrice);
        $this->assertEquals(5, $totalDays);
    }

    /** @test */
    public function applies_discount_for_long_term_rental()
    {
        $pricePerDay = 500000;
        $days = 10;
        $basePrice = $pricePerDay * $days;

        // 10% discount for 7+ days
        $discount = $days >= 7 ? 0.10 : 0;
        $finalPrice = $basePrice * (1 - $discount);

        $this->assertEquals(4500000, $finalPrice);
    }

    /** @test */
    public function calculates_price_with_insurance()
    {
        $pricePerDay = 500000;
        $insurancePerDay = 50000;
        $days = 3;

        $rentalPrice = $pricePerDay * $days;
        $insurancePrice = $insurancePerDay * $days;
        $totalPrice = $rentalPrice + $insurancePrice;

        $this->assertEquals(1650000, $totalPrice);
    }
}
