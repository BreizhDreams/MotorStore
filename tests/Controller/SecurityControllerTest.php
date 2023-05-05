<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    public function testSecurityPage () {
        $client = static::createClient();

        $client->request('GET','/login');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
    public function testNavbarSecurityPage () {
        $client = static::createClient();
        
        $client->request('GET','/');
        $this->assertSelectorTextContains('nav','Motor\'Store');
        
        $categoryVOs = ['Casque','Veste','Gants','Pantalon','Chaussures','Protections'];
        foreach ($categoryVOs as $categoryVO){            
            $this->assertSelectorTextContains('nav',$categoryVO);
        }
        
    }
    
    public function testDisplayLogin() {
        $client = static::createClient();
        
        $client->request('GET','/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorNotExists('.alert.alert-danger');
    }


    public function testLoginWithBadCredentials() {
        $client = static::createClient();
        $crawler = $client->request('GET','/login');
        $form = $crawler->selectButton('Connexion')->form([
            'email' => 'john@doe.fr',
            'password' => 'Btssio2017!',
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
        $client->followRedirect(); 
        $this->assertSelectorExists('.alert.alert-danger');
    }

    public function testSuccessfullLogin() {
        $client = static::createClient();
        $crawler = $client->request('GET','/login');
        $form = $crawler->selectButton('Connexion')->form([
            'email' => 'julesthivend@gmail.com',
            'password' => 'Btssio2017*',
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/');
    }
    
}