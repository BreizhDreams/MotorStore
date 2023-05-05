<?php

namespace App\tests\Unit;

use App\Entity\OrderDetails;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class OrderDetailsTest extends KernelTestCase
{

    public function getEntity() {

        return(new OrderDetails())
            ->setProduct('EXO-R1 AIR Fabio Monster Replica')
            ->setQuantity(3)
            ->setPrice(529.90)
            ->setTotal(1589.7);
    }
    
    public function assertHasErrors(OrderDetails $orderDetails, int $nbError = 0){
        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($orderDetails);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }
        $this->assertCount($nbError ,$errors, implode(', ', $messages));

    }
    
    public function testDesignationIsValid(): void
    {
        $this->assertHasErrors($this->getEntity()->setProduct('foo'));
        $this->assertHasErrors($this->getEntity()->setProduct('1818181'));
        $this->assertHasErrors($this->getEntity()->setProduct(''),1);
    }
    
    public function testBlankDesignation(): void
    {
        $this->assertHasErrors($this->getEntity()->setProduct('foo'));
        $this->assertHasErrors($this->getEntity()->setProduct(''),1);
    }

    public function testQuantityIsInt(): void
    {
        $this->assertHasErrors($this->getEntity()->setQuantity(1));
        $this->assertHasErrors($this->getEntity()->setQuantity(5));
        $this->assertHasErrors($this->getEntity()->setQuantity(15));
        $this->assertHasErrors($this->getEntity()->setQuantity(intval(1.5)));
    }

    public function testPriceIsFloat(): void
    {
        $this->assertHasErrors($this->getEntity()->setPrice(15.99));
        $this->assertHasErrors($this->getEntity()->setPrice(1818181));
        $this->assertHasErrors($this->getEntity()->setPrice(15));
        $this->assertHasErrors($this->getEntity()->setPrice(floatval("15")));
    }

    public function testTotalIsFloat(): void
    {
        $this->assertHasErrors($this->getEntity()->setTotal(15.99));
        $this->assertHasErrors($this->getEntity()->setTotal(1818181));
        $this->assertHasErrors($this->getEntity()->setTotal(15));
        $this->assertHasErrors($this->getEntity()->setTotal(floatval("15")));
    }

}
