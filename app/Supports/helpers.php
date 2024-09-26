<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Log\Logger;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('auth_user')) {
    function auth_user($guard = 'web')
    {
        if (!auth($guard)->check()) {
            return null;
        }

        return auth($guard)->user();
    }
}

if (!function_exists('is_valid_mobile_number')) {
    function is_valid_mobile_number($input)
    {
        return preg_match('/^01[3-9]\d{8}$/', strval($input));
    }
}

if (!function_exists('debug_log')) {
    function debug_log($msg, $context = [], $level = 'info')
    {
        /**
         * @var $logger Logger
         */
        $logger = app(Logger::class);

        if (config('logging.enable')) {
            if (!is_array($context)) {
                $context = [];
            }

            $logger->write($level, $msg, $context);
        }
    }
}

if (!function_exists('to_array')) {
    function to_array($data)
    {
        if ($data instanceof Collection) {
            return $data->toArray();
        }

        if ($data instanceof Model || $data instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            return $data->toArray();
        }

        if (is_object($data)) {
            return (array)$data;
        }

        return $data;
    }
}

if (!function_exists('trans_table_column')) {
    function trans_table_column($column)
    {
        if (!is_array($column) && !is_object($column)) return $column;

        $locale = strtolower(app()->getLocale() ?? 'en');
        return data_get($column, $locale, null) ?? data_get($column, 'en');
    }
}

if (!function_exists('get_enums')) {
    function get_enums($enumClass, $flipArray = true)
    {
        $reflector = new \ReflectionClass($enumClass);
        $enums = $reflector->getConstants();
        return $flipArray ? array_flip($enums) : $enums;
    }
}

if (!function_exists('user_has_role')) {
    function user_has_role($role)
    {
        if (auth_user() == null) {
            return false;
        }

        $roles = auth_user()->roles ?? [];
        return in_array($role, $roles);
    }
}

if (!function_exists('has_permission')) {
    function has_permission($routeName): bool
    {
        $permission = new \App\Services\PermissionService();
        return $permission->check($routeName);
    }
}

if (!function_exists('save_error_log')) {
    function save_error_log(\Exception $e) {
        if (env('APP_ENV') == 'local') {
            throw $e;
        } else {
            \Illuminate\Support\Facades\Log::error($e->getMessage(), [$e->getFile(), $e->getLine()]);
        }

    }
}

if (!function_exists('is_valid_mobile_number')) {
    function is_valid_mobile_number($input)
    {
        return preg_match('/^01[3-9]\d{8}$/', strval($input));
    }
}

if (!function_exists('show_date')) {
    function show_date($date)
    {
        if (!$date instanceof \Illuminate\Support\Carbon) {
            $date = \Illuminate\Support\Carbon::parse($date);
        }

        return $date->format('d M, Y');
    }
}

if (!function_exists('api_error')) {
    function api_error(array $error, $code, $exception = null)
    {
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $error = [];
            $validationError = $exception->errors();
            foreach ($validationError as $key => $item) {
                $error[] = [
                    'message' => $item[0],
                    'fieldName' => $key,
                ];
            }

        }
        return response()->json([
            'success' => false,
            'code' => $code,
            'data' => [],
            'error' => $error,
        ]);
    }
}

if (!function_exists('api_res')) {
    function api_res(array $data, $code)
    {
        return response()->json([
            'success' => true,
            'code' => $code,
            'data' => $data,
            'error' => [],
        ]);
    }
}

if (!function_exists('decimal_point')) {
    function decimal_point($number, $point = 2)
    {
        return (float) number_format((float)$number, $point, '.', '');
    }
}

if (!function_exists('to_hash_id')) {
    function to_hash_id( ?int $id): ?string
    {
        if (empty($id)) {
            return null;
        }

        $hashId = new Hashids\Hashids(config('app.name'), 10);
        return $hashId->encode($id);
    }
}

if (!function_exists('get_id_from_hash')) {
    function get_id_from_hash($hash): ?int
    {
        if (empty($hash)) {
            return null;
        }

        $hashId = new Hashids\Hashids(config('app.name'), 10);
        return $hashId->decode($hash)[0] ?? 0;
    }
}

if (!function_exists('is_json')) {
    function is_json($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}

if (!function_exists('is_superuser')) {
    function is_superuser(): bool
    {
        $user = auth()->user();
        if (!$user) {
            return false;
        }

        return  $user->is_superuser;
    }
}
