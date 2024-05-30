<?php

namespace App\Http\Controllers\API\V1\Mzrt\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\CategoryRequest;
use App\Http\Resources\Mzrt\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @group Mozart
 *
 * @subgroup Categories
 *
 * This class is responsible for handling the actions related to categories.
 */
class CategoryController extends Controller
{
    public function __construct(public CategoryService $categoryService)
    {
        $this->authorizeResource($this->categoryService->model);
    }

    /**
     * Retrieves a collection of categories.
     *
     * @param  Request  $request The HTTP request object.
     * @return AnonymousResourceCollection The collection of categories.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return CategoryResource::collection($this->categoryService->categories($request));
    }

    /**
     * Retrieves a collection of categories.
     *
     * @param  Request  $request The HTTP request object.
     * @return AnonymousResourceCollection The collection of categories.
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny');
        return CategoryResource::collection($this->categoryService->categories(request: $request, relations: ['courses', 'children'], paginate: 0));
    }

    /**
     * Fetches and returns the resource representation of a specific Category.
     *
     * @param  Category  $category The Category object to fetch and display.
     * @return Response The HTTP response containing the resource representation of the Category.
     */
    public function show(Category $category)
    {
        return response()->ok(CategoryResource::make($this->categoryService->category($category)));
    }

    public function store(CategoryRequest $request)
    {
        return response()->created($this->categoryService->create($request->validated()));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        return response()->ok(CategoryResource::make($this->categoryService->update($category, $request->validated())));
    }

    /**
     * Deletes a specific Category.
     *
     * @param  Category  $category The Category object to delete.
     * @return Response The HTTP response with no content.
     */
    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return response()->noContent();
    }
}
