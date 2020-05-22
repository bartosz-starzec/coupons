<?php
namespace App\Services;

use Symfony\Component\Filesystem\Filesystem;

class DiscountCodeService
{
    public function getCodes(int $numberOfCodes, int $codeLength)
    {
        $codes = [];
        for($i = 0; $i < 100000; $i++) {
            $codes[] = $this->generateRandomString(10);
        }

        return $codes;
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * @param array $codes
     */
    public function saveCodeToFile(array $codes)
    {
        $filesystem = new Filesystem();
        $filesystem->mkdir('logs', 0777);
//        $filesystem->chmod('/src', 0700, 0000, true);
        $filesystem->dumpFile('/src/logs/codes.txt', 'test');
    }
}
