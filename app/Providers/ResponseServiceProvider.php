<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as StatusCode;

/**
 * Class ResponseServiceProvider
 *
 * The ResponseServiceProvider class is responsible for registering and bootstrapping services related to the response handling in the application.
 * It extends the ServiceProvider class, which is the base class for all service providers in Laravel.
 */
class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->enhancementResponseMethods();
    }

    /**
     * Enhances the Response class with additional methods.
     */
    protected function enhancementResponseMethods(): void
    {
        Response::macro(
            'ok',
            fn ($data = [], $additional = []) => Response::json((! empty($data) ? ['data' => $data] : []) + $additional, StatusCode::HTTP_OK)
        );

        Response::macro(
            'created',
            fn ($data = [], $additional = []) => Response::json((! empty($data) ? ['data' => $data] : []) + $additional, StatusCode::HTTP_CREATED)
        );

        Response::macro(
            'noContent',
            fn ($data = []) => Response::json([], StatusCode::HTTP_NO_CONTENT)
        );

        Response::macro(
            'badRequest',
            fn ($message = 'Validation Failure.', $errors = []) => Response::json(['message' => $message, 'errors' => count($errors)], StatusCode::HTTP_BAD_REQUEST)
        );

        Response::macro(
            'unauthorized',
            fn ($message = 'User unauthorized.', $errors = []) => Response::json(['message' => $message, 'errors' => count($errors)], StatusCode::HTTP_UNAUTHORIZED)
        );

        Response::macro(
            'forbidden',
            fn ($message = 'Access denied.', $errors = []) => Response::json(['message' => $message, 'errors' => count($errors)], StatusCode::HTTP_FORBIDDEN)
        );

        Response::macro(
            'notFound',
            fn ($message = 'Resource not found.', $errors = []) => Response::json(['message' => $message, 'errors' => count($errors)], StatusCode::HTTP_NOT_FOUND)
        );

        Response::macro(
            'internalServerError',
            fn ($message = 'Internal Server Error.', $errors = []) => Response::json(['message' => $message, 'errors' => count($errors)], StatusCode::HTTP_INTERNAL_SERVER_ERROR)
        );
    }
}
