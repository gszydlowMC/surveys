<?php

use Illuminate\Support\Carbon;

if (!function_exists('boolean')) {
    function boolean($var, $default = false)
    {
        if (is_null($var)) {
            return $default;
        }

        $output = filter_var($var, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        return $output ?? $default;
    }
}

if (!function_exists('formattedFloat')) {
    /**
     * Konwertuje treść na format float
     *
     * @param $number
     * @param int $decimals
     * @param bool $endZeros
     *
     * @return float
     */
    function formattedFloat($number, $decimals = 2, $endZeros = false)
    {
        $number = round(
            (float)filter_var(
                str_replace([',', '&nbsp;'], ['.', ' '], $number),
                FILTER_SANITIZE_NUMBER_FLOAT,
                FILTER_FLAG_ALLOW_FRACTION
            ),
            $decimals
        );

        if (!$endZeros) {
            return $number;
        }

        return number_format($number, $decimals, '.', '');
    }
}

if (!function_exists('nextIfEmpty')) {
    function nextIfEmpty(...$columns)
    {
        foreach ($columns as $column) {
            if ((!is_array($column) && $column !== '' && $column != null && strtoupper($column) !== 'NULL') || (is_array($column) && !empty($column))) {
                return $column;
            }
        }

        return false;
    }
}

if (!function_exists('setColumnAsKey')) {
    function setColumnAsKey($rows, $column, $last = false)
    {
        $out = [];
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $row = (array)$row;
                if (is_array($column)) {
                    $b = [];
                    foreach ($column as $col) {
                        $b[] = $row[$col];
                    }
                    $out[implode("_", $b)][] = $row;
                } else {
                    if ($last) {
                        $out[$row[$column]] = $row;
                    } else {
                        $out[$row[$column]][] = $row;
                    }
                }
            }
        }

        return $out;
    }
}

if (!function_exists('__t')) {
    function __t($moduleKey, $textPl = null)
    {
        return \App\DB\Enum\LanguageEnum::translate('api_' . $moduleKey, $textPl);
    }
}

if (!function_exists('flash')) {
    function flash($message, $code = 200, $additionalData = [], $json = true)
    {
        $message = [
            'message' => [
                'type' => $code,
                'text' => $message
            ]
        ];

        if ($json) {
            return response()->json(array_merge($message, $additionalData), $code);
        }
        return array_merge($message, $additionalData);
    }
}

if (!function_exists('admin_flash')) {
    function admin_flash($message, $type = 'success', $additionalData = [])
    {
        $message = [
            'message' => [
                'type' => $type,
                'text' => $message
            ],
        ];

        if (request()->wantsJson() || request()->ajax()) {
            die(json_encode(array_merge($message, $additionalData)));
        }
        session($message);
    }
}

if (!function_exists('formatArrayToLabelAndValue')) {
    function formatArrayToLabelAndValue($array, $labelName = 'label', $valueName = 'value')
    {
        if (request()->select2) {
            $labelName = 'text';
            $valueName = 'id';
        }
        $out = [];
        foreach ($array as $value => $key) {
            $out[] = [
                $labelName => $key,
                $valueName => $value,
            ];
        }
        if (request()->select2) {
            $a = [];
            $a['results'] = $out;
            return $a;
        }
        return $out;
    }
}

if (!function_exists('getRealIp')) {
    /**
     * Zwraca rzeczywiste IP usera
     *
     * @return string
     */
    function getRealIp(): string
    {
        return $_SERVER['HTTP_X_REAL_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'localhost';
    }
}

if (!function_exists('fileUrlExists')) {
    function fileUrlExists($fileUrl): string
    {
        $file_headers = @get_headers($fileUrl);

        if ($file_headers[0] == 'HTTP/1.0 404 Not Found') {
            return false;
        } else if ($file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found') {
            return false;
        }
        return true;
    }
}
