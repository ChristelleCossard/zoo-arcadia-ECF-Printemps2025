<?php

/*

Page 1:
LIMIT 0, 10
Page 2:
LIMIT 10, 10
Page 3:
LIMIT 20, 10
Page 4:
LIMIT 30, 10

param : page et limit
offest = (page - 1) * limit
Page 3
30     = (3 -1) * 10

*/


function getServices(PDO $pdo, int $limit = null, int $page = null ):array
{
    $sql = "SELECT * FROM services ORDER BY id DESC";
    if ($limit && !$page) {
        $sql .= " LIMIT :limit";
    }
    if ($page) {
        $sql .= " LIMIT :offset, :limit";
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
    }
    if ($page) {
        $offset = ($page -1) * $limit;
        $query->bindValue(":offset", $offset, PDO::PARAM_INT);
    }

    $query->execute();
    $services = $query->fetchAll(PDO::FETCH_ASSOC);

    return $services;
}

function getTotalService(PDO $pdo):int
{
    $sql = "SELECT COUNT(*) as total FROM services;";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

function getServiceById(PDO $pdo, int $id):array|bool
{
    $sql = "SELECT * FROM services WHERE id = :id";

    $query = $pdo->prepare($sql);
    
    $query->bindValue(":id", $id, PDO::PARAM_INT);


    $query->execute();
    $service = $query->fetch(PDO::FETCH_ASSOC);

    return $service;
}

function getServiceImage(string|null $image):string
{
    if ($image === null) {
        return _ASSETS_IMAGES_FOLDER_."default-zoo.jpg";
    } else {
        return _ARTICLES_IMAGES_FOLDER_.htmlentities($image);
    }
}

function saveService(PDO $pdo, string $nameservice, string $description, string|null $photoservice, int $id = null):bool 
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO services (nameservice, description, photoservice) "
        ."VALUES(:nameservice, :description, :photoservice)");
    } else {
        $query = $pdo->prepare("UPDATE `services` SET `nameservice` = :nameservice, "
        ."`description` = :description, "
        ."photoservice = :photoservice;");
        
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':nameservice', $nameservice, $pdo::PARAM_STR);
    $query->bindValue(':description', $description, $pdo::PARAM_STR);
    $query->bindValue(':photoservice',$photoservice, $pdo::PARAM_STR);
    
    return $query->execute();  
}

function deleteService(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM services WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}