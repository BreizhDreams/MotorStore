<?php

namespace App\tests\Unit;

use App\Entity\SubCategory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class SubCategoryTest extends KernelTestCase
{

    public function getEntity() {

        return(new SubCategory())
            ->setDesignation('Casque Intégrale')
            ->setDescription('Le meilleur casque pour protéger ta tête')
            ->setSlug('casque-integrale');

    }
    
    public function assertHasErrors(SubCategory $subCategory, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($subCategory);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }
        $this->assertCount($nbError ,$errors, implode(', ', $messages));

    }
    
    public function testDesignationIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setDesignation('foo'));
        $this->assertHasErrors($this->getEntity()->setDesignation('1818181'));
        $this->assertHasErrors($this->getEntity()->setDesignation(''),1);
    }
    
    public function testBlankDesignation(): void
    {
        $this->assertHasErrors($this->getEntity()->setDesignation('foo'));
        $this->assertHasErrors($this->getEntity()->setDesignation(''),1);
    }
    
    public function testDescriptionIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription('foo'));
        $this->assertHasErrors($this->getEntity()->setDescription('1818181'));
        $this->assertHasErrors($this->getEntity()->setDescription(''),1);
    }
    
    public function testBlankDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription('foo'));
        $this->assertHasErrors($this->getEntity()->setDescription(''),1);
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
