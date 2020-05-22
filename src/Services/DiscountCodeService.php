<?php
namespace App\Services;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class DiscountCodeService
{
    private const CODE_AVAILABLE_CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @param int $numberOfCodes
     * @param int $codeLength
     * @return array
     */
    public function generateCodes(int $numberOfCodes, int $codeLength): array
    {
        $codes = [];
        for($i = 0; $i < $numberOfCodes; $i++) {
            $codes[] = $this->generateDiscountCode($codeLength);
        }

        return $codes;
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateDiscountCode(int $length): string
    {
        $code = '';
        $codeCharacters = self::CODE_AVAILABLE_CHARACTERS;
        $charactersLength = strlen($codeCharacters);
        for ($i = 0; $i < $length; $i++) {
            $code .= $codeCharacters[rand(0, $charactersLength - 1)];
        }

        return $code;
    }

    /**
     * @param array $codes
     * @param string $pathToFile
     */
    public function saveCodesToFile(array $codes, string $pathToFile): void
    {
        $filesystem = new Filesystem();
        $content = $this->prepareCodesForSave($codes);

        $filesystem->dumpFile($pathToFile, $content);
    }

    /**
     * @param string $pathToFile
     * @return File
     */
    public function getFileWithCodes(string $pathToFile): File
    {
        return new File($pathToFile);
    }

    /**
     * @param array $codes
     * @return string
     */
    private function prepareCodesForSave(array $codes): string
    {
        return implode(',', $codes);
    }
}
