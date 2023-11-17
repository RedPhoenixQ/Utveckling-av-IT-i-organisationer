<?php require_once "../../scripts/auth/verify_logged_in.php" ?>

<?php
if (empty(array_diff_key(["category", "reason", "period", "revisit", "videocall", "timepreference"], $_POST))) {
    // Handle submit
}
?>

<?php $title = "Sök vård"; require_once "../header.php" ?>

<h1>Sök vård</h1>
<p>Fyll i formuläret nedan för att skicak en vårdförfrågan. När er vårdförfrågan har hanterats skickas en notis till er.</p>
<form action="" method="post">
    <div class="my-2">
        <label class="form-label" for="category">
            Vad angår besöket?
        </label>
        <select class="form-select" name="category" id="category" required>
            <option selected>Välj en kategori</option>
            <?php 
            $categories = [
                "Vårdkategori" => [
                    "Allmänläkare",
                    "Dietist",
                    "Kurator",
                    "Psykiatriker",
                    "Fysioterapeut",
                    "Tandläkare",
                    "Dermatolog",
                    "Ögonläkare",
                    "Öron-näsa-hals-specialist",
                    "Gynekolog"
                ],
                "Övrig vård" => [
                    "Vaccination"
                ],
            ];
            foreach ($categories as $category => $options) {
                echo "<optgroup label='$category'>";
                foreach ($options as $option) {
                    echo "<option value='$option'>$option</option>";
                }
                echo "</optgroup>";
            }
            ?>
        <select>
    </div>
    <div class="my-2">
        <label class="form-label" for="reason">
            Beskriv anledningen för besöket och eventuell symtom.
        </label>
        <textarea class="form-control" rows="5" name="reason" id="reason"></textarea>
    </div>
    <fieldset class="my-4">
        <legend>Om relevant</legend>
        <label class="form-label" for="period">
            Hur länge har ni upplevt besväret?
        </label>
        <select class="form-select" name="period" id="period">
            <option value="" selected></option>
            <?php
            $peridoer = [
                "Mindre än en dag",
                "Ca 24 timmar",
                "Ca 48 timmar",
                "Ca 3-6 dagar",
                "Ca 1 vecka",
                "Ca 2 veckor",
                "Ca 1 månad",
                "Ca 2 månader",
                "Ca 3 måndaer",
                "Ca 6 månader",
                "Ca 1 år",
                "Längre än ett år",
            ];
            foreach ($peridoer as $period) {
                echo "<option value='$period'>$period</option>";
            } 
            ?>
        </select>
    </fieldset>
    <fieldset class="my-4">
        <legend>Övrigt</legend>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="revisit" id="revisit">
            <label class="form-check-label" for="revisit">
                Är detta ett återbesök?
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="videocall" id="videocall">
            <label class="form-check-label" for="videocall">
                Skulle ni vilja bemötas digital via videosamtal?
            </label>
        </div>
        <div class="my-2">
            <label class="form-label" for="timepreference">
                När föredrar ni att bli bokade?
            </label>
            <select class="form-select" name="timepreference" id="timepreference">
                <option value="" selected>Välj tid här...</option>
                <option value="formiddag">Förmiddag</option>
                <option value="eftermiddag">Eftermiddag</option>
            </select>
        </div>
    </fieldset>
    <button class="btn btn-primary mx-auto">Skicka förfrågan</button>
</form>

<?php require_once "../footer.php" ?>