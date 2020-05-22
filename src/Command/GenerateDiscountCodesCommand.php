<?php


namespace App\Command;


use App\Services\DiscountCodeService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateDiscountCodesCommand extends Command
{
    protected static $defaultName = 'app:generateDiscountCodes';

    /**
     * @var DiscountCodeService
     */
    private DiscountCodeService $discountCodeService;

    /**
     * @param DiscountCodeService $discountCodeService
     */
    public function __construct(DiscountCodeService $discountCodeService)
    {
        $this->discountCodeService = $discountCodeService;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addOption(
                'numberOfCodes',
                null,
                InputOption::VALUE_REQUIRED,
                'Number of generated codes',
                100
            )
            ->addOption(
                'lengthOfCode',
                null,
                InputOption::VALUE_REQUIRED,
                'Length of code',
                10
            )
            ->addOption(
                'file',
                null,
                InputOption::VALUE_REQUIRED,
                'Path to file in which codes will be save',
                ''
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $codes = $this->discountCodeService->generateCodes(
            $input->getOption('numberOfCodes'),
            $input->getOption('lengthOfCode')
        );
        $this->discountCodeService->saveCodesToFile($codes, $input->getOption('file'));
        $output->write('Codes have been generated and save to ' . $input->getOption('file'));

        return 0;
    }

}
