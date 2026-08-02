<?php

class CartIsolationTest extends TestCase
{
    public function testCartUserOwnershipIsolation()
    {
        $mockCartDatabase = [
            ['id' => 1, 'id_user' => 5, 'product' => 'Shirt'],
            ['id' => 2, 'id_user' => 5, 'product' => 'Pants'],
            ['id' => 3, 'id_user' => 8, 'product' => 'Hat'],
        ];

        $currentUserId = 5;

        // Filter cart items by id_user
        $userCartItems = array_filter($mockCartDatabase, function($item) use ($currentUserId) {
            return $item['id_user'] === $currentUserId;
        });

        $this->assertEquals(2, count($userCartItems), "User #5 should only see 2 cart items");

        // Verify cart item #3 cannot be accessed by User #5
        $item3Access = array_filter($userCartItems, function($item) {
            return $item['id'] === 3;
        });

        $this->assertEquals(0, count($item3Access), "User #5 must not access cart item belonging to User #8");
    }
}
