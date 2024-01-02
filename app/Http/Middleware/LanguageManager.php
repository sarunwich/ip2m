<?php
  
namespace App\Http\Middleware;
  
use Closure;
use Illuminate\Http\Request;
// use App;
// use Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
  
class LanguageManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (session()->has('locale')) {
        //     App::setLocale(session()->get('locale'));
        //     // app()->setLocale(Session::get('locale'));
        //     // app()->setLocale(Session::get('locale'));
        // }
          
        $language=session('language');
        app()->setLocale($language);
        Log::info("Locale set to: " . $language . " (Selected language: " . $language . ")");
        return $next($request);
    }
}
