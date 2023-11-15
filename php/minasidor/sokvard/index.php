<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php $title = "Sök vård"; require_once "../../templates/header.php" ?>

<h1>Sök vård</h1>
<p>Du kommer få ett svar med er bokade tid på TODO(HUR KONTAKTAR VI PATIENT)</p>
<form action="hantera_bokning.php" method="post">
    <div class="my-2">
        <label class="form-label" for="kategori">
            Vad angår besöket?
        </label>
        <select class="form-select" name="kategori" id="kategori" required>
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
    <label class="form-label" for="anledning">
        Beskriv anledningen för besöket och eventuell symtom.
    </label>
    <textarea class="form-control" rows="3" name="anledning" id="anledning"></textarea>
    </div>
    <fieldset class="my-4">
        <legend>Övrigt</legend>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="off" name="videosamtal" id="videosamtal">
            <label class="form-check-label" for="videosamtal">
                Skulle ni vilja bemötas digital via videosamtal?
            </label>
        </div>
        <div class="my-2">
            <label class="form-label" for="tidspreferens">
                När föredrar ni att bli bokade?
            </label>
            <select class="form-select" name="tidspreferens" id="tidspreferens">
                <option value="" selected>Välj tid här...</option>
                <option value="formiddag">Förmiddag</option>
                <option value="eftermiddag">Eftermiddag</option>
            </select>
        </div>
    </fieldset>
    <button class="btn btn-primary mx-auto">Skicka förfrågan</button>
</form>

<?php require_once "../../templates/footer.php" ?>