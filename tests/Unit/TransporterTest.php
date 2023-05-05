<?php

namespace App\tests\Unit;

use App\Entity\Transporter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TransporterTest extends KernelTestCase
{

    public function getEntity() {

        return(new Transporter())
            ->setName('La Poste')
            ->setDescription('foo')
            ->setPrice(9.99);

    }
    
    public function assertHasErrors(Transporter $transporter, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($transporter);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }
        $this->assertCount($nbError ,$errors, implode(', ', $messages));

    }
    
    public function testNameIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setName('foo'));
        $this->assertHasErrors($this->getEntity()->setName('1818181'));
    }
    
    public function testBlankName(): void
    {
        $this->assertHasErrors($this->getEntity()->setName('foo'));
        $this->assertHasErrors($this->getEntity()->setName(''),1);
    }
    
    public function testPriceIsFloat(): void
    {
        $this->assertHasErrors($this->getEntity()->setPrice(15.99));
        $this->assertHasErrors($this->getEntity()->setPrice(1818181));
        $this->assertHasErrors($this->getEntity()->setPrice(15));
        $this->assertHasErrors($this->getEntity()->setPrice(floatval("15")));
    }

    public function testDescriptionIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setName('foo'));
        $this->assertHasErrors($this->getEntity()->setName('1818181'));
    }
    
    public function testBlankDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setName('foo'));
        $this->assertHasErrors($this->getEntity()->setName(''),1);
    }

}
