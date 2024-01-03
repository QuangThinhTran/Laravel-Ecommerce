<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermRequest;
use App\Repository\Interface\IAttributeRepository;
use App\Repository\Interface\ITermRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TermController extends Controller
{
    protected ITermRepository $termRepository;
    protected IAttributeRepository $attributeRepository;

    public function __construct
    (
        ITermRepository $termRepository,
        IAttributeRepository $attributeRepository
    ) {
        $this->termRepository = $termRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Get View Create Term
     * @return  View | JsonResponse
     * */
    public function create(): View|JsonResponse
    {
        try {
            $terms = $this->termRepository->all();
            $attributes = $this->attributeRepository->all();

            return view('terms.list', compact('terms', 'attributes'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create Term
     * @param TermRequest $request
     * @return JsonResponse | RedirectResponse
     * */
    public function store(TermRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $input = $request->all();

            $this->termRepository->create($input);
            return back()->with('infor', 'Term created Successfully');
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Detail Term
     * @param Request $request
     * @return View
     * */
    public function detail(Request $request): View
    {
        $selectedAttributeIds = $request->input('attributes');
        $terms = [];
        foreach ($selectedAttributeIds as $selectedAttribute) {
            $terms[] = $this->termRepository->find($selectedAttribute);
        }
        return view('products.child-view', compact('terms'));
    }
}
