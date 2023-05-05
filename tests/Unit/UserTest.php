<?php

namespace App\tests\Unit;

use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{

    public function getEntity() {

        return(new User())
            ->setEmail('toto@foo.com')
            ->setPassword('Btssio2017!')
            ->setLastName('Toto')
            ->setFirstName('Foo')
            ->setAddress('Avenue des Champs Elysées')
            ->setZipCode('22300')
            ->setCity('Paris')
            ->setTelNumber('0123456789');
    }
    
    public function assertHasErrors(User $user, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($user);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }
        $this->assertCount($nbError ,$errors, implode(', ', $messages));

    }
    
    public function testBlankEmail(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setEmail(''),1);
    }

    public function testPassword(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setPassword('Btssio2017'),1);
        $this->assertHasErrors($this->getEntity()->setPassword('btssio2017!'),1);
        $this->assertHasErrors($this->getEntity()->setPassword('BTSSIO2017!'),1);
        $this->assertHasErrors($this->getEntity()->setPassword('201720182019!'),1);
        $this->assertHasErrors($this->getEntity()->setPassword('BtsSioLeDantec!'),1);
        $this->assertHasErrors($this->getEntity()->setPassword('foo'),1);
        $this->assertHasErrors($this->getEntity()->setPassword('Btssio2017!Btssio2017!Btssio2017!Btssio2017!Btssio2017!Btssio2017!Btssio2017!Btssio2017!Btssio2017!Btssio2017!'),1);
    }

    public function testBlankPassword(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setPassword(''),1);
    }

    public function testBlankLastName(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setLastName(''),1);
    }

    public function testBlankFirstName(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setFirstName(''),1);
    }

    public function testBlankAddress(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setAddress(''),1);
    }

    public function testZipCode(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setZipCode('91500'));
        $this->assertHasErrors($this->getEntity()->setZipCode('99999'),1);
        $this->assertHasErrors($this->getEntity()->setZipCode('223001'),1);
    }

    public function testBlankZipCode(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setZipCode(''),1);
    }


    public function testBlankCity(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setCity(''),1);
    }

    
    public function testPhoneNumber(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setTelNumber('+33606060606'));
        $this->assertHasErrors($this->getEntity()->setTelNumber('+336test0606'),1);
        $this->assertHasErrors($this->getEntity()->setTelNumber('069906990699'),1);
    }

    public function testBlankTelNumber(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setTelNumber(''),1);
    }
    
}
