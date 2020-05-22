<?php

namespace App\Controller;

use App\Form\Type\DiscountCodeType;
use App\Services\DiscountCodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscountCodesController extends AbstractController
{
    private const DISCOUNT_CODES_FILE_PATH = 'discountCodes/codes.txt';

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
    }

    /**
     * @Route("/", name="codes_index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(DiscountCodeType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $codes = $this->discountCodeService->generateCodes($data['numberOfCodes'], $data['lengthOfCode']);
            $this->discountCodeService->saveCodesToFile($codes, self::DISCOUNT_CODES_FILE_PATH);
            $file = $this->discountCodeService->getFileWithCodes(self::DISCOUNT_CODES_FILE_PATH);

            return $this->file($file);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
