<?php

include_once("config.php");

$dbHandle = new SQLite3($databaseFileName);

function getEntryCount($keyword)
{
    global $dbHandle;

    $paramValue = "%" . $keyword . "%";

    $statement = $dbHandle->prepare("SELECT COUNT(*) FROM Entries WHERE Title LIKE :Keyword");
    $statement->bindParam(":Keyword", $paramValue, SQLITE3_TEXT);

    return $statement->execute()->fetchArray()[0];
}

function getEntries($keyword, $start, $end)
{
    global $dbHandle;

    $keywordValue = "%" . $keyword . "%";
    $countValue = $end - $start + 1;
    $skipValue = $start - 1;

    $statement = $dbHandle->prepare("SELECT * FROM Entries WHERE Title LIKE :Keyword LIMIT :Count OFFSET :Skip");
    $statement->bindParam(":Keyword", $keywordValue, SQLITE3_TEXT);
    $statement->bindParam(":Count", $countValue, SQLITE3_INTEGER);
    $statement->bindParam(":Skip", $skipValue, SQLITE3_INTEGER);

    return $statement->execute();
}

function getEntry($id)
{
    global $dbHandle;

    $statement = $dbHandle->prepare("SELECT * FROM Entries WHERE ID = :ID");
    $statement->bindParam(":ID", $id, SQLITE3_INTEGER);

    return $statement->execute()->fetchArray();
}