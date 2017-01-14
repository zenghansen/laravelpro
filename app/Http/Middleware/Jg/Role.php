<?php

namespace App\Http\Middleware\Jg;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * @var array
     * role mods
     */
    protected $roleMods = array(
        '1' => array(
            ['id' => 1, 'name' => 'admin/jg/user'],
            ['id' => 2, 'name' => 'admin/jg/customer'],
        ),
        '2' => array(
            ['id' => 2, 'name' => 'admin/jg/customer'],
        ),
    );

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            $user = Auth::user();

            $roleMods = $this->roleMods[$user->roleId];

            foreach ($roleMods as $v) {
                if (strpos($request->path(), $v['name']) !== false) {

                    view()->share('urlId', $v['id']); //share the urlId to select nav

                    return $next($request);
                }
            }
        }
        return response('Unauthorized.', 401);

    }
}
