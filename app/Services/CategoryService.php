<?php

namespace App\Services;

use App\Exceptions\InvalidUploadException;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CategoryService extends Service
{
    public readonly Model $model;

    protected array $with = [];

    /**
     * Class constructor.
     *
     * Initializes a new instance of the class and assigns a new instance of the Category model to the $model property.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Category();
    }

    /**
     * Retrieves the categories based on the given parameters.
     *
     * @param Request|null $request The request object to be used for additional conditions in the query. Defaults to null.
     * @param array|null $fields An array of fields to be selected in the query. Defaults to null.
     * @param array|null $relations An array of relations to eager load in the query. Defaults to null.
     * @param array $where An array of additional where conditions to be applied in the query. Defaults to an empty array.
     * @param int $paginate The number of items to be displayed per page. Defaults to 20.
     * @return LengthAwarePaginator|Collection|null The paginated items or a collection of categories or null if pagination is omitted.
     */
    public function categories(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = [], int $paginate = 20): LengthAwarePaginator|Collection|null
    {
        $builder = $this->categoryBuilder($request, $fields, $relations, $where);
        if ($paginate > 0) {
            return $builder->paginate($paginate);
        }
        return $builder->get();
    }

    /**
     * Retrieves and returns the first instance of a Category based on the given parameters.
     *
     * @return Category|null The first instance of a Category, or null if no matches found.
     */
    public function category(Category $category): ?Category
    {
        return $category->fresh();
    }

    /**
     * Builds and returns a query builder instance based on the given parameters.
     *
     * @param Request|null $request The request object to be used for additional conditions in the query. Defaults to null.
     * @param array|null $fields An array of fields to be selected in the query. Defaults to null.
     * @param array|null $relations An array of relations to eager load in the query. Defaults to null.
     * @param array $where An array of additional where conditions to be applied in the query. Defaults to an empty array.
     * @return Builder The query builder instance.
     */
    public function categoryBuilder(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = []): Builder
    {
        if ($relations !== null) {
            $this->with = array_merge($this->with, $relations);
        }
        if ((bool)$request->parents === true) {
            $where['category_id'] = null;
        }

        return $this->builder($fields, $where);
    }

    /**
     * Create a new category.
     *
     * Creates and saves a new category using the provided validated data.
     *
     * @param array $data
     * @return Category The newly created category.
     * @throws InvalidUploadException
     */
    public function create(array $data): Category
    {
        if (!empty($data['image']) && preg_match('/^data:image\/(\w+);base64,/', $data['image'])) {
            $data['image'] = "categories/" . prepareUpload($data['image'], 'categories');
        }
        return $this->model->create($data);
    }

    /**
     * Updates a Category entity.
     *
     * Throws an exception if $validated is empty.
     *
     * Begins a database transaction and updates the $category entity with the provided $validated data.
     * If the update is successful, commits the transaction. Otherwise, rolls back the transaction and aborts with an error message.
     *
     * @param Category $category The Category entity to update.
     * @param array $data
     * @return Category|null The updated Category entity, or null if the update fails.
     *
     */
    public function update(Category $category, array $data): ?Category
    {
        abort_if(empty($data), Response::HTTP_UNPROCESSABLE_ENTITY, trans('general.empty_entity'));
        try {
            if (!empty($data['image']) && preg_match('/^data:image\/(\w+);base64,/', $data['image'])) {
                $data['image'] = "categories/" . prepareUpload($data['image'], 'categories');
            }
            if($data['category_id'] === 'null') $data['category_id'] = null;
            DB::transaction(fn() => $category->update($data));
        } catch (Throwable $e) {
            info($e->getMessage());
            abort(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }

        return $category->fresh();
    }

    /**
     * Deletes the given Category object from the database.
     *
     * @param Category|null $category The Category object to delete.
     */
    public function delete(?Category $category = null): void
    {
        abort_if(!$category, Response::HTTP_UNPROCESSABLE_ENTITY, 'Invalid Category instance provided.');
        $category->delete();
    }
}
