<?php

it('a basic test case', function() {
    $response = $this->get('/');

    $response->assertStatus(200);
});
