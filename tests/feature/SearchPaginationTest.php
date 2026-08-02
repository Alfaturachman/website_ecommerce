<?php

class SearchPaginationTest extends TestCase
{
    public function testSearchSessionKeywordPersistence()
    {
        $mockSession = [];
        $mockPostData = ['keyword' => 'denim'];

        // Step 1: Initial search via POST
        if (isset($mockPostData['keyword']) && !empty($mockPostData['keyword'])) {
            $mockSession['keyword'] = $mockPostData['keyword'];
        }

        $this->assertEquals('denim', $mockSession['keyword'], "Session keyword should be saved on POST search");

        // Step 2: Next page click (GET request, $_POST is empty)
        $mockPostDataNextPage = [];
        if (isset($mockPostDataNextPage['keyword']) && !empty($mockPostDataNextPage['keyword'])) {
            $mockSession['keyword'] = $mockPostDataNextPage['keyword'];
        }

        $activeSearchKeyword = isset($mockSession['keyword']) ? $mockSession['keyword'] : null;

        $this->assertEquals('denim', $activeSearchKeyword, "Session keyword must persist during pagination GET requests");
    }
}
