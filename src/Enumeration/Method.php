<?php

namespace Technodrive\Core\Enumeration;

/**
 *
 */
enum Method: string
{
    case METHOD_OPTIONS = 'OPTIONS';
    case METHOD_GET = 'GET';
    case METHOD_HEAD = 'HEAD';
    case METHOD_POST = 'POST';
    case METHOD_PUT = 'PUT';
    case METHOD_DELETE = 'DELETE';
    case METHOD_TRACE = 'TRACE';
    case METHOD_CONNECT = 'CONNECT';
    case METHOD_PATCH = 'PATCH';
    case METHOD_PROPFIND = 'PROPFIND';
}
