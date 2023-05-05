<?php

namespace App\tests\Unit;

use App\Entity\Brand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class BrandTest extends KernelTestCase
{

    public function getEntity() {

        return(new Brand())
            ->setName('Dainese')
            ->setSlug('dainese');

    }
    
    public function assertHasErrors(Brand $brand, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($brand);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }
        $this->assertCount($nbError ,$errors, implode(', ', $messages));

    }
    
    public function testDesignationIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setName('foo'));
        $this->assertHasErrors($this->getEntity()->setName('1818181'));
        $this->assertHasErrors($this->getEntity()->setName(''),1);
    }
    
    public function testBlankDesignation(): void
    {
        $this->assertHasErrors($this->getEntity()->setName('foo'));
        $this->assertHasErrors($this->getEntity()->setName(''),1);
    }
    
    public function testSlugIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setSlug('foo'));
        $this->assertHasErrors($this->getEntity()->setSlug('1818181'));
        $this->assertHasErrors($this->getEntity()->setSlug(''),1);
    }
    
    public function testBlankSlug(): void
    {
        $this->assertHasErrors($this->getEntity()->setSlug('foo'));
        $this->assertHasErrors($this->getEntity()->setSlug(''),1);
    }

}
