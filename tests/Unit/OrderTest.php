<?php

namespace App\tests\Unit;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class OrderTest extends KernelTestCase
{

    public function getEntity() {

        return(new Order())
            ->setTransporterName('La Poste')
            ->setTransporterPrice('9.99')
            ->setDelivry('Toto Foo<br/>0000000000<br/>Orange<br/>2 Avenue Pierre Marzin<br/>22300 Lannion<br/>FR')
            ->setReference('23042023_6445247b4545f');

    }
    
    public function assertHasErrors(Order $order, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($order);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }
        $this->assertCount($nbError ,$errors, implode(', ', $messages));

    }
    
    public function testTransporterNameIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setTransporterName('foo'));
        $this->assertHasErrors($this->getEntity()->setTransporterName('1818181'));
        $this->assertHasErrors($this->getEntity()->setTransporterName(''),1);
    }
    
    public function testBlankTransporterName(): void
    {
        $this->assertHasErrors($this->getEntity()->setTransporterName('foo'));
        $this->assertHasErrors($this->getEntity()->setTransporterName(''),1);
    }
    
    public function testTransporterPriceIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setTransporterPrice(15.99));
        $this->assertHasErrors($this->getEntity()->setTransporterPrice(1818181));
        $this->assertHasErrors($this->getEntity()->setTransporterPrice(15));
        $this->assertHasErrors($this->getEntity()->setTransporterPrice(floatval("15")));
    }
    
    public function testDelivryIsValid(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setDelivry(''),1);
    }
    
    public function testBlankDelivry(): void
    {
        $this->assertHasErrors($this->getEntity()->setDelivry('Toto Foo<br/>0000000000<br/>Orange<br/>2 Avenue Pierre Marzin<br/>22300 Lannion<br/>FR'));
        $this->assertHasErrors($this->getEntity()->setDelivry(''),1);
    }
    
    public function testReferenceIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setReference('23042023_6445247b4545f'));
        $this->assertHasErrors($this->getEntity()->setReference('23042023__6445247b4545f'),1);
        $this->assertHasErrors($this->getEntity()->setReference('230423_6445247b4545f'),1);
        $this->assertHasErrors($this->getEntity()->setReference('23042023_',1));
        $this->assertHasErrors($this->getEntity()->setReference(''),1);
    }
    
    public function testBlankReference(): void
    {
        $this->assertHasErrors($this->getEntity()->setReference('23042023_6445247b4545f'));
        $this->assertHasErrors($this->getEntity()->setReference(''),1);
    }



}
