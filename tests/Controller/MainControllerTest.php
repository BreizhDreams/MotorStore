<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MainControllerTest extends WebTestCase
{
    public function testMainPage () {
        $client = static::createClient();

        $client->request('GET','/');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
    public function testNavbarMainPage () {
        $client = static::createClient();
        
        $client->request('GET','/');
        $this->assertSelectorTextContains('nav','Motor\'Store');
        
        $categoryVOs = ['Casque','Veste','Gants','Pantalon','Chaussures','Protections'];
        foreach ($categoryVOs as $categoryVO){            
            $this->assertSelectorTextContains('nav',$categoryVO);
        }
        
    }

/*     public function testPageIsRestricted () {
        $client = static::createClient();
    
        $client->request('GET','/');
    
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }
    
    public function testRedirectToLogin () {
        $client = static::createClient();
    
        $client->request('GET','/');
        $this->assertResponseRedirects('/login');
    } */
}