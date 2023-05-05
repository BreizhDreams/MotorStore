<?php

namespace App\tests\Unit;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\SubCategory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{

    public function getEntity() {

        $category = new Category;
        $subCategory = new SubCategory;
        $brand = new Brand;

        return(new Product())
            ->setDesignation("EXO-390 CHICA II")
            ->setPrixTTC(99,99)
            ->setCategoryVO($category)
            ->setPhotoURL("exo-390-chica-ii.jpg")
            ->setBrandVO($brand)
            ->setSubCategoryVO($subCategory)
            ->setSlug("exo-390-chica-ii")
            ->setDetails("test")
            ->setIsBest(0);
    }
    
    public function assertHasErrors(Product $product, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($product);

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
    }
    
    public function testBlankDesignation(): void
    {
        $this->assertHasErrors($this->getEntity()->setDesignation('foo'));
        $this->assertHasErrors($this->getEntity()->setDesignation(''),1);
    }
    
    public function testPrixTTCisFloat(): void
    {
        $this->assertHasErrors($this->getEntity()->setPrixTTC(15.99));
        $this->assertHasErrors($this->getEntity()->setPrixTTC(1818181));
        $this->assertHasErrors($this->getEntity()->setPrixTTC(15));
        $this->assertHasErrors($this->getEntity()->setPrixTTC(floatval("15")));
    }
    
    public function testBlankPhotoUrl(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setPhotoURL(''),1);
    }

    public function testBlankSlug(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setSlug(''),1);
    }

    public function testBlankDetails(): void
    {
        $this->assertHasErrors($this->getEntity());
        $this->assertHasErrors($this->getEntity()->setDetails(''),1);
    }
}
