<?php

namespace Gabrielmoura\LaravelUtalk\middleware;

use Closure;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class RestrictIPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @throws InvalidArgumentException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientIp = $request->ip();
        $allowedIPs = $this->getIp();

        foreach ($allowedIPs as $allowedIpRange) {
            if ($this->ipInCidrRange($clientIp, $allowedIpRange)) {
                return $next($request);
            }
        }

        abort(403, 'Acesso não autorizado. Somente IPs locais ou definidos.');
    }

    /**
     * @description Get the allowed IPs.
     * @return array
     */
    private function getIp(): array
    {
        $localIPs = ['127.0.0.1/8', '192.168.0.1/16', '10.0.0.1/24'];
        $ipsUtalk = [
            '40.88.132.66/32',
            '52.188.209.245/32',
            '52.188.209.200/32',
            '40.88.5.13/32',
            '13.82.149.8/32',
            '20.121.215.166/32',
            '52.191.24.158/32',
        ];

        return array_merge($localIPs, $ipsUtalk);
    }

    /**
     * @description  Check if an IP is in a CIDR range.
     * @param string $ip IP to check in IPV4 format.
     * @param string $cidr IP in CIDR format.
     * @return bool
     */
    private function ipInCidrRange(string $ip, string $cidr): bool
    {
        [$subnet, $mask] = explode('/', $cidr);

        // Verificar se o IP e a máscara são válidos
        if (! $subnet || ! $mask) {
            throw new InvalidArgumentException('Formato CIDR inválido');
        }

        $ipDecimal = ip2long($ip);
        $subnetDecimal = ip2long($subnet);

        // Verificar se as conversões de IP foram bem-sucedidas
        if ($ipDecimal === false || $subnetDecimal === false) {
            throw new InvalidArgumentException('Endereço IP ou CIDR inválido');
        }

        $maskDecimal = -1 << (32 - (int) $mask);

        $subnetStart = $subnetDecimal & $maskDecimal;
        $subnetEnd = $subnetStart + ~$maskDecimal;

        return ($ipDecimal >= $subnetStart) && ($ipDecimal <= $subnetEnd);
    }
}
