<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Str;

class MyEloquentUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                Str::contains($this->firstCredentialKey($credentials), 'password'))) {
            return;
        }

        $query = $this->newModelQuery();
        $query->where('email', $credentials['email']);
        $query->orWhere('phone', $credentials['email']);

        return $query->first();
    }
}
