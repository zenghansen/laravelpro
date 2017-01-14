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
            ['id' => 1, 'name' => 'admin/jg/user', 'text' => '员工管理'],
            ['id' => 2, 'name' => 'admin/jg/customer', 'text' => '客户管理'],
        ),
        '2' => array(
            ['id' => 2, 'name' => 'admin/jg/customer', 'text' => 'item2'],
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

        view()->share('roleId', $auth->user()->roleId); //share the urlId to select nav

        view()->share('nav', json_encode($this->roleMods[$auth->user()->roleId], true)); //share the urlId to select nav

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
            $user = $this->auth->user();

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
