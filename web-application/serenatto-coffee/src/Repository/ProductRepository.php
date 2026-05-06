<?php 

namespace Repository;

use Models\Produto;
use PDO;

class ProductRepository {

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados) {
        return new Produto
            (
                $dados['id'],
                $dados['tipo'],
                $dados['nome'],
                $dados['descricao'],
                $dados['preco'],
                $dados['imagem']
            );
    }

    public function opcoesCafe(): array {
        // ORDER BY por padrão define ordenação do menor para o maior
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $this->pdo->query($sql1);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $dadosCafe = array_map(function ($cafe){
            return $this->formarObjeto($cafe);
        }, $produtosCafe);

        return $dadosCafe;
    }

    public function opcoesAlmoco(): array {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $produtosAlmoco = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $dadosAlmoco = array_map(function($almoco){
            return $this->formarObjeto($almoco); 
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }

    public function buscarTodos() {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $dados);

        return $todosOsDados;
    }

    public function deletar(int $id) {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function salvar(Produto $produto) {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (:tipo, :nome, :descricao, :preco, :imagem)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':tipo', $produto->getTipo(), PDO::PARAM_STR);
        $statement->bindValue(':nome', $produto->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':descricao', $produto->getDescricao(), PDO::PARAM_STR);
        $statement->bindValue(':preco', $produto->getPreco(), PDO::PARAM_STR);
        $statement->bindValue(':imagem', $produto->getImagem(), PDO::PARAM_STR);
        $statement->execute();
    }
    public function buscar(int $id) {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->formarObjeto($dados);
    }

    public function atualizar(Produto $produto) {
        $sql = "UPDATE produtos SET tipo = :tipo, nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':tipo', $produto->getTipo(), PDO::PARAM_STR);
        $statement->bindValue(':nome', $produto->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':descricao', $produto->getDescricao(), PDO::PARAM_STR);
        $statement->bindValue(':preco', $produto->getPreco(), PDO::PARAM_STR);
        $statement->bindValue(':imagem', $produto->getImagem(), PDO::PARAM_STR);
        $statement->bindValue(':id', $produto->getId(), PDO::PARAM_INT);
        $statement->execute();
    }
}
