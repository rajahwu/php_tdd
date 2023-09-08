<?php
namespace TDD\Test;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; 

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {
    // public function setUp() {
    //     $this->Receipt = new Receipt();
    // }

    // public function tearDown() {
    //     unset($this->Receipt);
    // }
/**
 * @dataProvider provideTotal
 */
    public function testTotal($items, $expected) {
        $Receipt = new Receipt();
        $coupon = null;
        $output = $Receipt->total($items, $coupon);
        $this->assertEquals(
            $expected,
            $output,
            "When summing the total should equal {$expected}"
        );
    }
    public function provideTotal() {
        return [
            [[1,2,5,8], 16],
            [[-1,2,5,8], 14],
            [[1,2,8], 11],
        ];
    }
    public function testTotalAndCoupon() {
        $Receipt = new Receipt();
        $input = [0,2,5,8];
        $coupon = 0.20;
        $output = $Receipt->total($input, $coupon);
        $this->assertEquals(
            12,
            $output,
            'When summing the total should equal 12'
        );
    }
    
    
    public function testTax() {
        $Receipt = new Receipt();
        $inputAmount = 10.00;
        $taxInput = 0.10;
        $output = $Receipt->tax($inputAmount, $taxInput);
        $this->assertEquals(
            1.00,
            $output,
            "The tax calculation should equal 1.00"
        );
    }
    
    // public function testPostTaxTotal() {
    //     $items = [1,2,5,8];
    //     $tax = 0.20;
    //     $coupon = null;
    //     $Receipt = $this->getMockBuilder('TDD\Receipt')
    //         ->setMethods(['tax', 'total'])
    //         ->getMock();
    //     $Receipt->expects($this->once())
    //         ->method('total')
    //         ->with($items, $coupon)
    //         ->will($this->returnValue(10.00));
    //         $Receipt->expects($this->once())
    //         ->method('tax')
    //         ->with(10.00, $tax)
    //         ->will($this->returnValue(1.00));
    //     $result = $Receipt->postTaxTotal([1,2,3,8], 0.20, null);
    //     $this->assertEquals(11.00, $result);
    // }
}