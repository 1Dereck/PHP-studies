<?php

namespace Src\Repository;

use Src\Models\Video;
use PDO;

class VideoRepository
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add(Video $video): bool
    {
        $sql = 'INSERT INTO videos (url, titulo, imagem_path) VALUES (:url, :titulo, :imagem_path)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':url', $video->getUrl(), PDO::PARAM_STR);
        $stmt->bindValue(':titulo', $video->getTitulo(), PDO::PARAM_STR);
        $stmt->bindValue(':imagem_path', $video->getFilePath(), PDO::PARAM_STR);

        $resultado = $stmt->execute();
        $id = $this->pdo->lastInsertId();

        $video->setId(intval($id));

        return $resultado;
    }

    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update(Video $video): bool
    {
        $updateImagemSql = '';
        if ($video->getFilePath() !== null) {
            $updateImagemSql = ', imagem_path = :imagem_path';
        }

        $sql = "UPDATE videos SET url = :url, titulo = :titulo $updateImagemSql WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':url', $video->getUrl(), PDO::PARAM_STR);
        $stmt->bindValue(':titulo', $video->getTitulo(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $video->getId(), PDO::PARAM_INT);

        if ($video->getFilePath() !== null) {
            $stmt->bindValue(':imagem_path', $video->getFilePath(), PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

    public function all(): array
    {
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            $this->hydrateVideo(...),
            $videoList
        );
    }

    public function find(int $id)
    {
        $sql = 'SELECT * FROM videos WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydrateVideo($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['titulo']);
        $video->setId($videoData['id']);

        if ($videoData['imagem_path'] !== null) {
            $video->setFilePath($videoData['imagem_path']);
        }

        return $video;
    }
}
