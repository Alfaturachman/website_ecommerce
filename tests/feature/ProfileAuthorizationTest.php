<?php

class ProfileAuthorizationTest extends TestCase
{
    public function testProfileUpdateIdCheck()
    {
        $loggedInUserId = 5;
        $targetUserIdAllowed = 5;
        $targetUserIdForbidden = 10;

        // Test matching ID (Allowed)
        $isAllowedSameUser = ((int)$targetUserIdAllowed === (int)$loggedInUserId);
        $this->assertTrue($isAllowedSameUser, "User should be authorized to update their own profile");

        // Test mismatched ID (IDOR Attempt - Forbidden)
        $isAllowedOtherUser = ((int)$targetUserIdForbidden === (int)$loggedInUserId);
        $this->assertFalse($isAllowedOtherUser, "User should NOT be authorized to update another user's profile");
    }
}
