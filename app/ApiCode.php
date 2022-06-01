<?php

namespace App;

class ApiCode
{
    public const SUCCESS = 200;
    public const SOMETHING_WENT_WRONG = 250;
    public const INVALID_CREDENTIALS = 251;
    public const VALIDATION_ERROR = 252;
    public const EMAIL_ALREADY_VERIFIED = 253;
    public const INVALID_EMAIL_VERIFICATION_URL = 254;
    public const INVALID_RESET_PASSWORD_TOKEN = 255;
    public const NOT_FOUND = 404;
    public const FORBIDDEN = 403;
    public const CONFLICT = 409;
    public const NETWORK_ERROR = 500;
    public const DISABLED_USER = "User Disabled";
}
