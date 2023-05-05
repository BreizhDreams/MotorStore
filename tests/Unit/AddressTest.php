<?php

namespace App\tests\Unit;

use App\Entity\Address;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AddressTest extends KernelTestCase
{

    public function getEntity() {

        $user = new User();

        return(new Address())
            ->setUserVO($user)
            ->setName('Adresse 1')
            ->setFirstName('toto')
            ->setLastName('tutu')
            ->setCompany('')
            ->setAddress('foo')
            ->setPostalCode('22300')
            ->setCity('Lannion')
            ->setCountry('FR')
            ->setPhone('0606060606');

    }
    
    public function assertHasErrors(Address $address, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($address);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }
        $this->assertCount($nbError ,$errors, implode(', ', $messages));

    }

    public function testBlankAddressName(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setName(''),1);
    }

    public function testBlankFirstName(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setFirstName(''),1);
    }

    public function testBlankLastName(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setLastName(''),1);
    }

    public function testBlankAddress(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setAddress(''),1);
    }

    public function testBlankPostalCode(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setPostalCode(''),1);
    }

    public function testPostalCode(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setPostalCode('91500'));
        $this->assertHasErrors($this->getEntity()->setPostalCode('99999'),1);
        $this->assertHasErrors($this->getEntity()->setPostalCode('223001'),1);

    }

    public function testBlankCity(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setCity(''),1);
    }

    public function testBlankCountry(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setCountry(''),1);
    }

    public function testBlankPhone(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setPhone(''),1);
    }

    public function testPhoneNumber(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setPhone('+33606060606'));
        $this->assertHasErrors($this->getEntity()->setPhone('+336test0606'),1);
        $this->assertHasErrors($this->getEntity()->setPhone('069906990699'),1);
    }

}
