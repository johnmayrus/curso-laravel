<?php

    namespace App\Http\Middleware;

    use Closure;
    use App\logAcesso;

    class LogAcessoMiddleware
    {
        /**
         * Handle an incoming request.
         *
         * @param \Illuminate\Http\Request $request
         * @param \Closure $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            $ip = $request->server->get('REMOTE_ADDR');
            $rota = $request->getRequestUri();
            logAcesso::create(['log' => "IP $ip requisitou a rota $rota"]);

//            return $next($request);

            $resposta = $next($request);
            $resposta->setStatusCode(201,'o status da resposta e o texto da resposta foram modificados!!!');
            return $resposta;
        }
    }
