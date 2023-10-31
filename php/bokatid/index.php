<?php $title = "Mina Sidor"; require_once "../templates/header.php" ?>

<main class="container-sm">
    <h1>Boka tid</h1>
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
                    "Värk och skador" => [
                        "Mage", 
                        "Ögon", 
                        "Huvud",
                    ],
                    "Kontroller" => [
                        "Hälsokontroll",
                        "Blodprov"
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
        </fieldset>
        <button class="btn btn-primary mx-auto">Boka tid</button>
    </form>
</main>

<?php require_once "../templates/footer.php" ?>