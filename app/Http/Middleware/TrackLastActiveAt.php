<?php 
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\User;
use Closure;

class TrackLastActiveAt
{
    public function handle(Request $request, Closure $next)
    {
        session_start();
        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user)
            {
                $user->last_active_at = now();
                
                $user->save();
            }
        }
        return $next($request);
    }
}
?>