<?php
namespace TDD\Test;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; 

use PHPUnit\Framework\TestCase;
use TDD\Formatter;
use TDD\Receipt;

class ReceiptTest extends TestCase {
    public $Formatter;
// public function setUp() {
//     $this->Formatter = $this->getMockBuilder('TDD\Formatter')
//     ->setMethods(['currencyAmt'])
//     ->getMock();
//     $this->Formatter->expects($this->any())
//         ->method('currencyAmt')
//         ->with($this->anything());
// }

    // public function setUp() {
    //     $this->Receipt = new Receipt();
    // }

    // public function tearDown() {
    //     unset($this->Receipt);
    // }
/**
 * @dataProvider providesubtotal
 */
    public function testSubtotal($items, $expected) {
        $Receipt = new Receipt();
        $coupon = null;
        $output = $Receipt->subtotal($items, $coupon);
        $this->assertEquals(
            $expected,
            $output,
            "When summing the total should equal {$expected}"
        );
    }
    public function providesubTotal() {
        return [
            [[1,2,5,8], 16],
            [[-1,2,5,8], 14],
            [[1,2,8], 11],
        ];
    }
    public function testSubtotalAndCoupon() {
        $Receipt = new Receipt();
        $input = [0,2,5,8];
        $coupon = 0.20;
        $output = $Receipt->subtotal($input, $coupon);
        $this->assertEquals(
            12,
            $output,
            'When summing the total should equal 12'
        );
    }
    
    public function testSubtotalExecption() {
        $Receipt = new Receipt();
        $input = [0,2,5,8];
        $coupon = 1.20;
        $this->expectException('BadMethodCallException');
        $Receipt->subtotal($input, $coupon);
        
    }
    
    
    
    public function testTax() {
        $Receipt = new Receipt();
        $inputAmount = 10.00;
        $Receipt->tax = 0.10;
        $output = $Receipt->tax($inputAmount);
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
    //         ->setMethods(['tax', 'subtotal'])
    //         ->getMock();
    //     $Receipt->expects($this->once())
    //         ->method('subtotal')
    //         ->with($items, $coupon)
    //         ->will($this->returnValue(10.00));
    //         $Receipt->expects($this->once())
    //         ->method('tax')
    //         ->with(10.00)
    //         ->will($this->returnValue(1.00));
    //     $result = $Receipt->postTaxTotal([1,2,3,8], null);
    //     $this->assertEquals(11.00, $result);
    // }


    public function provideCurrencyAmt() {
        return [
            [1, 1.00, '1 should be transformed into 1.00'],
            [1.1, 1.10, '1.1 should be transformed into 1.10'],
            [1.11, 1.11, '1 .11should be transformed into 1.11'],
            [1.111, 1.11, '1.111 should be transformed into 1.11'],
        ];
    }
}