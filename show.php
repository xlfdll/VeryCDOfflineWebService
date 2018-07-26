<?php
require_once("include/helpers/database.php");
require_once("include/helpers/value.php");

$id = intval($_GET["id"]);
$result = getEntry($id);
$title = $result["Title"];
?>

<?php
require_once("include/templates/header.php");
?>

    <h1><?= $result["Title"] ?></h1>
    <h6>
        <?= $result["Category"] ?> - <?= $result["SubCategory"] ?> | Published on <?= $result["PublishTime"] ?> |
        Updated on <?= $result["UpdateTime"] ?>
    </h6>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>
            <th>File Name</th>
            <th>Size</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $links = explode("\r\n", $result["Link"]);
        foreach ($links as $link) {
            if (!empty($link)) {
                // Need to use double '\' in pattern string
                preg_match("/ed2k:\\/\\/\\|file\\|(?<FileName>.+)\\|(?<FileSize>\d+)\\|/", $link, $matches);
                ?>
                <tr>
                    <td>
                        <input class="checkbox" name="linkCheckBox" type="checkbox" checked="checked"
                               value="<?= $link ?>"
                               onclick="checkSelectionStatus();">
                    </td>
                    <td>
                        <a href="<?= $link ?>"><?= urldecode($matches["FileName"]) ?></a>
                    </td>
                    <td>
                        <?= getHumanReadableSize($matches["FileSize"], 2); ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>

        <tfoot>
        <tr>
            <td>
                <input class="checkbox center-block" id="selectAllCheckBox" type="checkbox" checked="checked"
                       onclick="selectAllLinks(this.checked)">
            </td>
            <td>
                <button class="btn btn-xs btn-default" id="copyButton" type="button" onclick="copyLinks();">
                    <span class="fas fa-copy"> Copy
                </button>
                <span id="copyStatus">
            </td>
            <td>
                <span id="totalSize">
            </td>
        </tr>
        </tfoot>
    </table>

    <div class="container">
        <pre><?= $result["Description"] ?></pre>
    </div>

<?php
require_once("include/templates/footer.php");
?>