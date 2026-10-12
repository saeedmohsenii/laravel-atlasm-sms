<?php

declare(strict_types=1);

namespace Atlasm\Sms\Exceptions;

use InvalidArgumentException;

/**
 * تنظیمات پکیج (WSDL، نام کاربری، رمز عبور، شماره فرستنده) کامل یا معتبر نیست.
 */
class ConfigurationException extends InvalidArgumentException
{
}
