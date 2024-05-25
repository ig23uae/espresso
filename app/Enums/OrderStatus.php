<?php
namespace App\Enums;

enum OrderStatus: string
{
    case Create = 'create';
    case Processing = 'processing';
    case Ready = 'ready';
    case Saved = 'saved';
    case Done = 'done';
}
