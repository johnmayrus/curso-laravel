<?php

    namespace App\Http\Controllers;

    use App\Fornecedor;
    use Illuminate\Http\Request;

    class FornecedorController extends Controller
    {
        public function index()
        {
            return view('app.fornecedor.index');
        }

        public function listar(Request $request)
        {
            $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%' . $request->input('nome') . '%')
                ->where('site', 'like', '%' . $request->input('site') . '%')
                ->where('uf', 'like', '%' . $request->input('uf') . '%')
                ->where('email', 'like', '%' . $request->input('email') . '%')
                ->paginate(5);

            return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
        }

        public function adicionar(Request $request)
        {
            $msg = '';
            if ($request->input('_token') != '' && $request->input('id') == '') {
                $regras = [
                    'nome' => 'required|min:3|max:40',
                    'site' => 'required',
                    'uf' => 'required|min:2|max:2',
                    'email' => 'email'
                ];
                $feedback = [
                    'required' => 'O campo :attribute deve ser preenchido',
                    'nome.min' => 'O campo :attribute deve ter ne mínimo 3 carateris',
                    'nome.max' => 'O campo :attribute deve ter ne máximo 40 carateris',
                    'uf.min' => 'O campo :attribute deve ter ne mínimo 2 carateris',
                    'uf.max' => 'O campo :attribute deve ter ne máximo 2 carateris',
                    'email.email' => 'O campo e-mail não foi preenchido corretamente'
                ];
                $request->validate($regras, $feedback);

                $fornecedor = new Fornecedor();
                $fornecedor->create($request->all());

                $msg = 'Cadastro realizado com sucesso!';
            }
            if ($request->input('_token') != '' && $request->input('id') != '') {
                $fornecedor = Fornecedor::find($request->input('id'));
                $update = $fornecedor->update($request->all());
                if ($update) {
                    echo 'Atualização realizada com sucesso!';
                } else {
                    echo 'Erro ao atualizar!';
                }
                return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
            }
            return view('app.fornecedor.adicionar', ['msg' => $msg]);
        }

        public function editar($id, $msg = '')
        {
            $fornecedor = Fornecedor::find($id);

            return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
        }

        public function excluir($id)
        {
            Fornecedor::find($id)->delete();
            //Fornecedor::find($id)->forceDelete();

            return redirect()->route('app.fornecedor');
        }
    }
