<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SettingService extends Service
{
    public readonly Model $model;

    protected array $with = ['country', 'user'];

    /**
     * Class constructor.
     *
     * Initializes a new instance of the class and assigns a new instance of the Setting model to the $model property.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Setting();
    }

    /**
     * Retrieves the settings based on the given parameters.
     *
     * @param  Request|null  $request The request object to be used for additional conditions in the query. Defaults to null.
     * @param  array|null  $fields An array of fields to be selected in the query. Defaults to null.
     * @param  array|null  $relations An array of relations to eager load in the query. Defaults to null.
     * @param  array  $where An array of additional where conditions to be applied in the query. Defaults to an empty array.
     * @param  int  $paginate The number of items to be displayed per page. Defaults to 20.
     * @return LengthAwarePaginator|Collection|null The paginated items or a collection of settings or null if pagination is omitted.
     */
    public function settings(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = [], int $paginate = 20): LengthAwarePaginator|Collection|null
    {
        $builder = $this->settingBuilder($request, $fields, $relations, $where);
        if ($paginate > 0) {
            return $builder->paginate($paginate);
        }

        return $builder->get();
    }

    /**
     * Retrieves and returns the first instance of a Setting based on the given parameters.
     *
     * @return Setting|null The first instance of a Setting, or null if no matches found.
     */
    public function setting(Setting $setting): ?Setting
    {
        return $setting->fresh();
    }

    /**
     * Builds and returns a query builder instance based on the given parameters.
     *
     * @param  Request|null  $request The request object to be used for additional conditions in the query. Defaults to null.
     * @param  array|null  $fields An array of fields to be selected in the query. Defaults to null.
     * @param  array|null  $relations An array of relations to eager load in the query. Defaults to null.
     * @param  array  $where An array of additional where conditions to be applied in the query. Defaults to an empty array.
     * @return Builder The query builder instance.
     */
    public function settingBuilder(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = []): Builder
    {
        if ($relations !== null) {
            $this->with = array_merge($this->with, $relations);
        }

        return $this->builder($fields, $where);
    }

    /**
     * Create a new setting.
     *
     * Creates and saves a new setting using the provided validated data.
     *
     * @param  array  $validated The validated data for the new setting.
     * @return Setting The newly created setting.
     */
    public function create(array $validated): Setting
    {
        return $this->model->create($validated);
    }

    /**
     * Updates a Setting entity.
     *
     * Throws an exception if $validated is empty.
     *
     * Begins a database transaction and updates the $setting entity with the provided $validated data.
     * If the update is successful, commits the transaction. Otherwise, rolls back the transaction and aborts with an error message.
     *
     * @param  Setting  $setting The Setting entity to update.
     * @param  array  $validated The validated data to update the $setting entity with.
     * @return Setting|null The updated Setting entity, or null if the update fails.
     *
     * @throws Throwable
     */
    public function update(Setting $setting, array $validated): ?Setting
    {
        abort_if(empty($validated), Response::HTTP_UNPROCESSABLE_ENTITY, trans('settings.validation.empty_entity'));
        try {
            DB::transaction(fn () => $setting->update($validated));
        } catch (Throwable $e) {
            abort($e->getMessage());
        }

        return $setting->fresh();
    }

    /**
     * Deletes the given Setting object from the database.
     *
     * @param  Setting|null  $setting The Setting object to delete.
     */
    public function delete(?Setting $setting = null): void
    {
        abort_if(! $setting, Response::HTTP_UNPROCESSABLE_ENTITY, 'Invalid Setting instance provided.');
        $setting->delete();
    }
}
