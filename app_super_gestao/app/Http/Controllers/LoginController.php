<?php

    namespace App\Http\Controllers;

    use App\User;
    use Illuminate\Http\Request;

    class LoginController extends Controller
    {
        public function index(Request $request)
        {
            $erro = '';
            if ($request->get('erro') == 1) {
                $erro = 'Usuário ou senha incorretos';
            }
            if ($request->get('erro') == 2) {
                $erro = 'Necessário realizar login para ter acesswo a página';
            }
            return view('site.login', ['titulo' => 'login', 'erro' => $erro]);
        }

        public function autenticar(Request $request)
        {
//        regras de validação
            $regras = [
                'usuario' => 'email',
                'senha' => 'required'
            ];
//        mensagens de feedback de validação
            $feedback = [
                'usuario.email' => 'o campo usuário (email) é obrigatório',
                'email.required' => 'o campo senha é obrigatório'
            ];

            $request->validate($regras, $feedback);
            $email = $request->get('usuario');
            $password = $request->get('senha');

            //recuperamos os parâmetros do formulário


            //Iniciar o model User
            $user = new User();
            $usuario = $user->where('email', $email)
                ->where('password', $password)
                ->get()
                ->first();

            if (isset($usuario->name)) {
                session_start();
                $_SESSION['nome'] = $usuario->name;
                $_SESSION['email'] = $usuario->email;

                return redirect()->route('app.home');
            } else {
                return redirect()->route('site.login', ['erro' => 1]);
            }
        }

        public function sair()
        {
            session_destroy();
            return redirect()->route('site.index');
        }
    }
