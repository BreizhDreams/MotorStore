<?php

namespace App\tests\Unit;

use App\Entity\Header;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class HeaderTest extends KernelTestCase
{

    public function getEntity() {

        return(new Header())
            ->setTitle('Nos Produits')
            ->setBtnTitle('Découvrir')
            ->setContent('Découvrir tous notre catalogue de produits')
            ->setBtnUrl('/products')
            ->setImageUrl('motorcycle.jpg');
    }
    
    public function assertHasErrors(Header $header, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($header);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }
        $this->assertCount($nbError ,$errors, implode(', ', $messages));

    }
    
    public function testDesignationIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setTitle('foo'));
        $this->assertHasErrors($this->getEntity()->setTitle('1818181'));
        $this->assertHasErrors($this->getEntity()->setTitle(''),1);
    }
    
    public function testBlankDesignation(): void
    {
        $this->assertHasErrors($this->getEntity()->setTitle('foo'));
        $this->assertHasErrors($this->getEntity()->setTitle(''),1);
    }
    
    public function testBtnTitleIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setBtnTitle('foo'));
        $this->assertHasErrors($this->getEntity()->setBtnTitle('1818181'));
        $this->assertHasErrors($this->getEntity()->setBtnTitle(''),1);
    }
    
    public function testBlankBtnTitle(): void
    {
        $this->assertHasErrors($this->getEntity()->setBtnTitle('foo'));
        $this->assertHasErrors($this->getEntity()->setBtnTitle(''),1);
    }

    public function testContentIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setContent('foo'));
        $this->assertHasErrors($this->getEntity()->setContent('1818181'));
        $this->assertHasErrors($this->getEntity()->setContent(''),1);
    }
    
    public function testBlankContent(): void
    {
        $this->assertHasErrors($this->getEntity()->setContent('foo'));
        $this->assertHasErrors($this->getEntity()->setContent(''),1);
    }
    
    public function testBtnUrlIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setBtnUrl('/foo'));
        $this->assertHasErrors($this->getEntity()->setBtnUrl('/foo/faa'));
        $this->assertHasErrors($this->getEntity()->setBtnUrl('foo/faa'),1);
        $this->assertHasErrors($this->getEntity()->setBtnUrl(''),1);
    }
    
    public function testBlankBtnUrl(): void
    {
        $this->assertHasErrors($this->getEntity()->setBtnUrl('/foo'));
        $this->assertHasErrors($this->getEntity()->setBtnUrl(''),1);
    }
    
    public function testImageUrlIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setImageUrl('foo.jpg'));
        $this->assertHasErrors($this->getEntity()->setImageUrl('foo.jpeg'));
        $this->assertHasErrors($this->getEntity()->setImageUrl('foo.png'));
        $this->assertHasErrors($this->getEntity()->setImageUrl('foo.gif'));
        $this->assertHasErrors($this->getEntity()->setImageUrl('foo.psd'),1);
        $this->assertHasErrors($this->getEntity()->setImageUrl(''),1);
    }
    
    public function testBlankImageUrl(): void
    {
        $this->assertHasErrors($this->getEntity()->setImageUrl('foo.jpg'));
        $this->assertHasErrors($this->getEntity()->setImageUrl(''),1);
    }

}
