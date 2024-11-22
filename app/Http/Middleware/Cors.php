<?php // /app/Http/Middleware/Cors.php
namespace App\Http\Middleware;
use Closure;

class Cors {
	public function handle($request, Closure $next) {
		$response = $next($request);
		$IlluminateResponse = 'Illuminate\Http\Response';
		$SymfonyResopnse = 'Symfony\Component\HttpFoundation\Response';
		$headers = ['Access-Control-Allow-Origin' => '*',
			'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, PATCH, DELETE',
			'Access-Control-Allow-Headers' => 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type,X-CSRF-TOKEN, Access-Control-Request-Method, Authorization , Access-Control-Request-Headers'];
		if ($response instanceof $IlluminateResponse) {
			foreach ($headers as $key => $value) {
				$response->header($key, $value);}
			return $response;
		}if ($response instanceof $SymfonyResopnse) {
			foreach ($headers as $key => $value) {
				$response->headers->set($key, $value);}
			return $response;}
		return $response;
	}
}