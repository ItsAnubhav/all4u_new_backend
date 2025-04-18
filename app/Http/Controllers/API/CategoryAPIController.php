<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

/**
 * Class CategoryAPIController
 */
class CategoryAPIController extends AppBaseController
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Categories.
     * GET|HEAD /categories
     */
    public function index(Request $request): JsonResponse
    {
        $categories = $this->categoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    /**
     * Store a newly created Category in storage.
     * POST /categories
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $input = $request->all();

        $category = $this->categoryRepository->create($input);

        return $this->sendResponse($category->toArray(), 'Category saved successfully');
    }

    /**
     * Display the specified Category.
     * GET|HEAD /categories/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Category $category */
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            return $this->sendError('Category not found');
        }

        return $this->sendResponse($category->toArray(), 'Category retrieved successfully');
    }

    /**
     * Update the specified Category in storage.
     * PUT/PATCH /categories/{id}
     */
    public function update($id, UpdateCategoryRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Category $category */
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            return $this->sendError('Category not found');
        }

        $category = $this->categoryRepository->update($input, $id);

        return $this->sendResponse($category->toArray(), 'Category updated successfully');
    }

    /**
     * Remove the specified Category from storage.
     * DELETE /categories/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Category $category */
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            return $this->sendError('Category not found');
        }

        $category->delete();

        return $this->sendSuccess('Category deleted successfully');
    }
}
