<?php

namespace App\Enums;

enum PaymentStatusEnum
{
    public const string CREATED = 'CREATED';
    public const string SUCCEEDED = 'SUCCEEDED';
    public const string FAILED = 'FAILED';
}
