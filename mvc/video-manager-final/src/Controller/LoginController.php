<?php

namespace Src\Controller;

use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Controller\Controller;
use Src\Database\Conexao;
use Src\Helper\FlashMessageTrait;


class LoginController implements Controller
{
    use FlashMessageTrait;

    private PDO $pdo;
    
    public function __construct()
    {
        $this->pdo = Conexao::getConexao();
    }
    
    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $email = filter_var($parsedBody['email'] ?? null, FILTER_VALIDATE_EMAIL);
        $password = filter_var($parsedBody['password'] ?? null);
        
        // Verifica se email já existe no banco de dados
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $correctPassword = password_verify($password, $userData['password'] ?? '');

        if ($correctPassword) {
            if (password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
                $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
                $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
                $statement->bindValue(2, $userData['id']);
                $statement->execute();
            }

            $_SESSION['logado'] = true;
            return new Response(302, ['Location' => '/']);
        } else {
            $this->addErrorMessage('Email ou senha incorretos');
            return new Response(302, ['Location' => '/login']);
        }
    }
}
