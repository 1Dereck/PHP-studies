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
        $sql = 'INSERT INTO videos (url, titulo) VALUES (:url, :titulo)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':url', $video->getUrl(), PDO::PARAM_STR);
        $stmt->bindValue(':titulo', $video->getTitulo(), PDO::PARAM_STR);

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
        $sql = 'UPDATE videos SET url = :url , titulo = :titulo WHERE id = :id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':url', $video->getUrl(), PDO::PARAM_STR);
        $stmt->bindValue(':titulo', $video->getTitulo(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $video->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function all(): array
    {
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function (array $videoData) {
            $video = new Video($videoData['url'], $videoData['titulo']);
            $video->setId($videoData['id']);
            return $video;
        }, $videoList);
    }

    public function find(int $id): ?Video
    {
        $sql = 'SELECT * FROM videos WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $videoData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($videoData === false) {
            return null;
        }

        $video = new Video($videoData['url'], $videoData['titulo']);
        $video->setId($videoData['id']);
        return $video;
    }
}
