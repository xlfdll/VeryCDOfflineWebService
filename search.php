<?php
require_once("include/helpers/database.php");

include_once("include/helpers/config.php");

$descDisplayLength = 250;
$keyword = strip_tags($_GET["keyword"]);

$resultCount = getEntryCount($keyword);
$totalPages = ceil(floatval($resultCount) / $itemsPerPage);

if ($resultCount > 0) {
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $start = ($page - 1) * $itemsPerPage + 1;
    $end = $page * $itemsPerPage;

    if ($end > $resultCount) {
        $end = $resultCount;
    }

    $result = getEntries($keyword, $start, $end);
} else {
    $page = 0;
    $start = 0;
    $end = 0;
}

$title = "Search (" . $resultCount . " item(s))";
?>

<?php
require_once("include/templates/header.php");
?>

    <h2>Found <?= $resultCount ?> item(s). Showing <?= $start ?> - <?= $end ?>:</h2>

    <div class="list-group">
        <?php
        $row = $result->fetchArray();
        while ($row) {
            ?>
            <div class="card my-3">
                <h5 class="card-header">
                    <a href="<?= "show.php?id=" . $row["ID"] ?>">
                        <?= $row["Title"] ?>
                    </a>
                </h5>
                <div class="card-body">
                    <?php
                    if (strlen($row["Description"]) > $descDisplayLength) {
                        echo mb_substr(htmlspecialchars_decode($row["Description"]), 0, $descDisplayLength) . "...";
                    } else {
                        echo htmlspecialchars_decode($row["Description"]);
                    }
                    ?>
                </div>
                <div class="card-footer">
                    <?= $row["Category"] ?> - <?= $row["SubCategory"] ?> | Published
                    on <?= $row["PublishTime"] ?>
                </div>
            </div>
            <?php
            $row = $result->fetchArray();
        }
        ?>
    </div>

    <div class="row">
        <div class="col-auto">
            <nav aria-label="Search page navigation - Previous page">
                <ul class="pagination">
                    <?php
                    if ($page > 1) {
                        ?>
                        <li class="page-item">
                            <span class="page-link">
                                <a href="<?= "search.php?keyword=" . $keyword . "&page=" . ($page - 1) ?>">Previous</a>
                            </span>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <div class="col-lg text-center">
            <form action="search.php" method="get">
                <input name="keyword" type="hidden" value="<?= $keyword ?>">
                <?php
                if ($resultCount > 0) {
                    ?>
                    <input name="page" type="number" min="1" max="<?= $totalPages ?>"
                           value="<?= $page ?>" maxlength="3">
                    <?php
                } else {
                    ?>
                    <input name="page" type="number" value="0" maxlength="3" disabled>
                    <?php
                }
                ?>
                <span>/ <?= $totalPages ?></span>
                <?php
                if ($resultCount > 0) {
                    ?>
                    <button class="btn btn-sm btn-default" type="submit">
                        <span class="fas fa-angle-right"> Go
                    </button>
                    <?php
                } else {
                    ?>
                    <button class="btn btn-sm btn-default" type="submit" disabled>
                        <span class="fas fa-angle-right"> Go
                    </button>
                    <?php
                }
                ?>
            </form>
        </div>
        <div class="col-auto">
            <nav aria-label="Search page navigation - Next page">
                <ul class="pagination">
                    <?php
                    if ($page < $totalPages) {
                        ?>
                        <li class="page-item">
                            <span class="page-link">
                                <a href="<?= "search.php?keyword=" . $keyword . "&page=" . ($page + 1) ?>">Next</a>
                            </span>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>

<?php
require_once("include/templates/footer.php");
?>