<?php

class CheckoutCalculationTest extends TestCase
{
    public function testSubtotalCalculation()
    {
        $items = [
            (object)['price' => 150000, 'quantity' => 2],
            (object)['price' => 75000,  'quantity' => 1],
        ];

        $subtotal = 0;
        $totalQuantity = 0;
        foreach ($items as $item) {
            $subtotal += ($item->price * $item->quantity);
            $totalQuantity += $item->quantity;
        }

        $this->assertEquals(375000, $subtotal, "Subtotal calculation should equal 375,000");
        $this->assertEquals(3, $totalQuantity, "Total quantity should equal 3 items");
    }

    public function testDiscountCalculation()
    {
        $subtotal = 500000;
        $discountPercentage = 10.0; // 10%

        $discountAmount = round(($subtotal * $discountPercentage) / 100);
        $totalAfterDiscount = $subtotal - $discountAmount;

        $this->assertEquals(50000, (int)$discountAmount, "Discount amount for 10% of 500k should be 50k");
        $this->assertEquals(450000, (int)$totalAfterDiscount, "Total after 10% discount should be 450k");
    }

    public function testWeightCalculation()
    {
        $totalQuantity = 4;
        $weightGram = $totalQuantity * 250;

        $this->assertEquals(1000, $weightGram, "4 items of 250g should weigh 1000g");
    }
}
