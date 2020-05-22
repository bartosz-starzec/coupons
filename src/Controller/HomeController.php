<?php
namespace App\Controller;

use App\Services\DiscountCodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
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
     * @Route("/", name="books_index")
     */
    public function index(): Response
    {
//        $codes = $this->discountCodeService->getCodes(1000, 10);
        $this->discountCodeService->saveCodeToFile([]);

        return $this->render('home.html.twig', [
            'codes' => [1]
        ]);
    }

}
