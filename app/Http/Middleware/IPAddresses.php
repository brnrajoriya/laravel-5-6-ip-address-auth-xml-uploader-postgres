<?php

namespace App\Http\Middleware;

use Closure;
use App\AccessIp;
use Auth;

class IPAddresses
{

    /**
     * List of valid IPs.
     *
     * @var array
     */
    protected $ips;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct() {
        $ads = AccessIp::all();
        foreach ($ads as $key => $value) {
            $this->ips[] = $value->address;
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(!Auth::check() || !Auth::user()->is_admin) {
            foreach ($request->getClientIps() as $ip) {
                if (! $this->isValidIp($ip)) {
                    return redirect('/')->with('status', 'You don\'t have access for this section.');
                }
            }
        }
        return $next($request);
    }

    /**
     * Check if the given IP is valid.
     *
     * @param $ip
     * @return bool
     */
    protected function isValidIp($ip) {
        return in_array($ip, $this->ips);
    }
}
