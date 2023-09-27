<?php

namespace App\Services\Users;

use App\Models\Users\Address;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 *
 */
class AddressService
{
    /**
     * @param Address $address
     * @return Address|null
     */
    public function getById(Address $address): ?Address
    {
        return Address::find($address->id);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Collection|null
     */
    public function getByUser(Request $request, User $user): ?Collection
    {
        return Address::where(['user_id' => $user->id])->get();
    }

    /**
     * @param array $data
     * @param User $user
     * @return Address
     */
    public function create(array $data, User $user): Address
    {
        $zipCode = justNumbers($data['zip_code']);
        return Address::create([
            'user_id' => $user->id,
            'country_id' => $data['country_id'],
            'name' => $data['name'] ?? null,
            'zip_code' => $zipCode,
            'address' => $data['address'],
            'number' => $data['number'],
            'complement' => $data['complement'] ?? null,
            'district' => $data['district'],
            'city' => $data['city'],
            'state' => $data['state'],
        ]);
    }

    /**
     * @param array $data
     * @param Address $address
     * @param User $user
     * @return Address
     */
    public function update(array $data, Address $address, User $user): Address
    {
        $oldAddress = $address;
        $zipCode = justNumbers($data['zip_code']);
        $address->update([
            'user_id' => $user->id,
            'country_id' => $data['country_id'],
            'name' => $data['name'] ?? null,
            'zip_code' => $zipCode,
            'address' => $data['address'],
            'number' => $data['number'],
            'complement' => $data['complement'] ?? null,
            'district' => $data['district'],
            'city' => $data['city'],
            'state' => $data['state'],
        ]);
        return $this->getById($oldAddress);
    }

    /**
     * @param Request $request
     * @return EloquentCollection|array
     */
    public function all(Request $request): EloquentCollection|array
    {
        return Address::with(['user'])->get();
    }
}
