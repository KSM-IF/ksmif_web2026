<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            // role => 'superAdmin', 'koor', 'hrdd', 'normies'
            $periode = now()->month >= 10 ? now()->year : now()->year - 1;  
            $usr = Auth::user()
                        ->load(['members' => fn($q) => $q->where('period', '>=', $periode)
                                                         ->orderByDesc('period')]);
            $member = $usr->members->first();
            
            $role = !$member ? 'normies' : match(true) {
                $member->division == 'BPH'                              => 'superAdmin',
                in_array($member->role, ['Koor', 'WaKoor'])             => 'koor',
                $member->role == 'Anggota' && $member->division == 'HRDD' => 'hrdd',
                default                                                 => 'normies',
            };

            View::share('auth', $role);          
            $request->merge(['auth' => $role]);  
            $request->merge(['active_periode' => $periode]);

            if($request->input('auth') == 'normies'){
                if($request->path() != 'dashboard/editMember/user/by') return response()->view("errors.403", [], 403);
                else {
                    if($request->input('id') != $usr->id) return response()->view("errors.403", [], 403);
                }
            }else if($request->input('auth') == 'koor'){
                if($request->path() == 'dashboard/database') return response()->view("errors.403", [], 403);
            }else if($request->input('auth') == 'hrdd'){
                if($request->path() == 'dashboard/database') return response()->view("errors.403", [], 403);
                else if($request->path() == 'dashboard/newMember') return response()->view("errors.403", [], 403);
                else if($request->path() == 'dashboard/editMember') return response()->view("errors.403", [], 403);    
                else if($request->path() == 'dashboard/editMember/new') return response()->view("errors.403", [], 403);

                if($request->path() == 'dashboard/editMember/user/by'){
                    if($request->input('id') != $usr->id) return response()->view("errors.403", [], 403);
                }
            }
            
            return $next($request);
        }else return response()->view("errors.403", [], 403);
    }
}
