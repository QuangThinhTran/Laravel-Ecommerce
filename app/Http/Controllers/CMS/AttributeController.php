<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Repository\Interface\IAttributeRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AttributeController extends Controller
{
    protected IAttributeRepository $attributeRepository;

    public function __construct
    (
        IAttributeRepository $attributeRepository
    ) {
        $this->attributeRepository = $attributeRepository;
    }

    public function create()
    {
        try {
            $attributes = $this->attributeRepository->index();

            return view('attributes.list', compact('attributes'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(AttributeRequest $request)
    {
        try {
            $input = $request->all();

            $attributes = $this->attributeRepository->create($input);
            if (empty($attributes)) {
                return back()->with('infor', 'Create Failed');
            }
            return back()->with('infor', 'Attribute created Successfully');
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

//    public function detail($id)
//    {
//        try {
//            $input = $request->all();
//
//            $attributes = $this->attributeRepository->create($input);
//            if (empty($attributes)) {
//                return back()->with('infor', 'Create Failed');
//            }
//            return back()->with('infor', 'Attribute created Successfully');
//        } catch (\Exception $e) {
//            return response()->json([
//                'result' => false,
//                'message' => $e->getMessage(),
//            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
//        }
//    }
}