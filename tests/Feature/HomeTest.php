<?php

use Inertia\Testing\AssertableInertia as Assert;

test('home page shows the author name', function () {
    $this->get('/')
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('Home')
                ->where('author', 'Antoine Mertens')
        );
});
