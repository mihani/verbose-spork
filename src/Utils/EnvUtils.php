<?php

namespace App\Utils;

class EnvUtils
{
    public static function getEnv(string $envVarName, $defaultValue = false)
    {
        $value = getenv($envVarName);

        return $value !== false ? $value : $defaultValue;
    }
}
