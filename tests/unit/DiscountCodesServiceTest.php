<?php
namespace App\Tests\unit;

use App\Services\DiscountCodeService;
use PHPUnit\Framework\TestCase;

class DiscountCodesServiceTest extends TestCase
{
    /**
     * @var DiscountCodeService
     */
    private DiscountCodeService $discountCouponService;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->discountCouponService = new DiscountCodeService();
        parent::__construct($name, $data, $dataName);
    }

    public function testGeneratedCodeLength(): void
    {
        $result = $this->discountCouponService->generateCodes(10, 10);

        $this->assertEquals( 10, strlen($result[0]));
    }

    public function testGeneratedCodesAmount(): void
    {
        $result = $this->discountCouponService->generateCodes(15, 10);

        $this->assertCount( 15, $result);
    }

    public function testIfGeneratedCodesAreUnique(): void
    {
        $codes = $this->discountCouponService->generateCodes(1000, 15);
        $result = $this->checkIfArrayHasDuplicates($codes);

        $this->assertFalse($result);
    }

    public function testIfGenerateCodesReturnsArray(): void
    {
        $result = $this->discountCouponService->generateCodes(1000, 15);

        $this->assertIsArray($result);
    }

    /**
     * @param $array
     * @return bool
     */
    private function checkIfArrayHasDuplicates($array): bool
    {
        return count($array) !== count(array_unique($array));
    }
}
