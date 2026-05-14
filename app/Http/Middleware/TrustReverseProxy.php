<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TrustReverseProxy
{
    /**
     * Trust the local reverse-proxy chain so Laravel sees the original
     * client IP and HTTPS scheme when traffic comes through Cloudflare -> Caddy -> Nginx.
     */
    public function handle($request, Closure $next)
    {
        SymfonyRequest::setTrustedProxies(
            ['127.0.0.1', '::1', '172.16.0.0/12'],
            SymfonyRequest::HEADER_X_FORWARDED_ALL
        );

        return $next($request);
    }
}
