<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class E2eTest extends PantherTestCase
{
    public function testMyApp(): void
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]); // Your app is automatically started using the built-in web server
        $client->request('GET', '/tag/');

        // Use any PHPUnit assertion, including the ones provided by Symfony
        $this->assertPageTitleContains('Tag index'); //title page html
        $this->assertSelectorTextContains('body', 'vel optio provident'); //est ce qu'on retrouve ça sur la page
    }

    public function testCanCreateNewTag(): void
    {
        $tag = 'foo bar baz';
        $client = static::createPantherClient(['browser' => static::FIREFOX]); // Your app is automatically started using the built-in web server
        $client->request('GET', '/tag/new');

        //Remplir le formulaire
        $client->submitForm('Save', [
            'tag[name]' => $tag,
        ]);
        $client->request('GET', '/tag/');

        // Use any PHPUnit assertion, including the ones provided by Symfony
        $this->assertPageTitleContains('Tag index'); //title page html
        $this->assertSelectorTextContains('body', $tag); //est ce qu'on retrouve ça sur la page
    }

    public function testCanClickNewTag(): void
    {
        $tag = 'youhou la famille';
        $client = static::createPantherClient(['browser' => static::FIREFOX]); // Your app is automatically started using the built-in web server
        $client->request('GET', '/tag');

        //CLiquer sur le lien New Tag
        $client->clickLink('Create new');

        //Remplir le formulaire
        $client->submitForm('Save', [
            'tag[name]' => $tag,
            'tag[posts][]' => [1,2],
        ]);
        $client->request('GET', '/tag/');

        // Use any PHPUnit assertion, including the ones provided by Symfony
        $this->assertPageTitleContains('Tag index'); //title page html
        $this->assertSelectorTextContains('body', $tag); //est ce qu'on retrouve ça sur la page
    }
}