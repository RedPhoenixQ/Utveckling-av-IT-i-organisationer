<?php require_once "../../scripts/auth/verify_logged_in.php" ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../../scripts/globals.php";
    require_once "../../scripts/erp.php";
    require_once "../../scripts/session.php";

    // Check that all needed keys are present
    $expexted_keys = array_flip(["salt", "category", "reason", "period", "preferred_time"]);
    $data = array_intersect_key($_POST, $expexted_keys); 
    if (count($data) == count($expexted_keys) && !empty($_POST["category"])) {

        // Handle checkboxes (they are not sent to server if unchecked)
        $is_revisit = isset($_POST["is_revisit"]);
        $wants_videocall = isset($_POST["wants_videocall"]);

        // Skapar koppling till ERPNEXT o hämtar tabell namn //
        $response = Erp::create(Doc::APPOINTMENT_REQUEST, array_merge($data, [
            "patient" => $_SESSION[Session::NAME],
            "is_revisit" => $is_revisit,
            "wants_videocall" => $wants_videocall,
        ]));
        
        // Verify that creation was successfull
        if ($response !== null && isset($response["data"])) {
            // Success, redirect to view of appointments
            header("Location: $base_url/minasidor/bokningar/");
            die();
        } else {
            $submit_error = "Ett fel uppstod, kunde inte skicka vårdförfrågan";
        }
    } else {
        $submit_error = "Ett fel uppstod, alla nödvändiga fält var inte ifyllda";
    }
}
?>

<?php $title = "Utvärdering av bemötande"; require_once "../header.php" ?>

<h1>Utvärdering av bemötande</h1>
<p>Fyll i formuläret nedan för att ge feedback på din vårdupplevelse hos oss! </p>

<?php if (isset($submit_error)) {
    echo "<p class='alert alert-danger'>$submit_error</p>";
} ?>

<!-- FRÅGA 1 -->
<form action="" method="post">
    <input type="hidden" name="salt" value="<?= $_POST["salt"] ?? uniqid() ?>">
    <fieldset class="contain-1">
        <legend>Allmänt</legend>
        <div class="contain-2">
            <label class="form-label" for="fraga1">Fick du möjlighet att ställa frågorna du önskade?</label>
            <label>
                Ja
                <input type="radio" id="1" name="fraga1" value="yes">
            </label>
            <label>
                Nej
                <input type="radio" id="2" name="fraga1" value="no">
            </label>
        </div>
        
        <!--FRÅGA 2-->
        <div class="contain-2"> 
            <label class="form-label" for="fraga2"> Var det enkelt att ta till sig informationen under vårdmötet? <label>
                Ja
                <input type="radio" id="3" name="fraga2" value="yes">
            </label>
            <label>
                Nej
                <input type="radio" id="4" name="fraga2" value="no">
            </label>
        </label>
    </div>
    
    <!-- FRÅGA 3  -->
    <div class="contain-2">  
        <label class="form-label" for="fraga3"> Är du nöjd med det sätt du kan komma i kontakt med vårdcentralen? </label> 
        <select class="form-select" name="fraga3" id="fraga3" required>
            <option value="" disabled selected>Välj en kategori</option>

             <?php 
             
             $categories = [
                "Kontankt" => [
                    "Mycket missnöjd",
                    "Något missnöjd",
                    "Varken nöjd eller missnöjd",
                    "Ganska nöjd",
                    "Mycket nöjd"
                    ]
                ];
                
                foreach ($categories as $category => $options) {
                    echo "<optgroup label='$category'>";
                    
                    foreach ($options as $option) {
                        echo "<option value='$option'>$option</option>";
                    }
                    
                    echo "</optgroup>";
                }
                
                ?>
                </select>
            </div>
            
             <!-- FRÅGA 4 -->
            <div class="contain-2" >  
                <label class="form-label" for="fraga4"> Fick du besöka vårdcentralen inom en rimlig tid? </label> 
                <label>
                     Ja
                     <input type="radio" id="5" name="fraga4" value="yes">
                    </label>
                    <label>
                        Nej
                        <input type="radio" id="6" name="fraga4" value="no">
                    </label>
                </div>
                
                <!-- FRÅGA 5 -->
                <div class="contain-2">  
                    <label class="form-label" for="fraga5"> Var väntan i väntrummet längre än 20 min? </label> 
                    <label>
                        Ja
                        <input type="radio" id="7"name="fraga5" value="yes">
                    </label>
                    <label>
                        Nej
                        <input type="radio" id="8" name="fraga5" value="no">
                    </label>
                </div>
            </fieldset>
            
            <br>
            <!-- FRÅGA 6 -->
            <fieldset class="contain-1">
                <legend>Information och kunskap</legend>
                <div class="contain-2">
                    <label class="form-label" for="fraga6">
                        Fick du tillräckligt med information om din behandling och eventuella
                        bieffekter?
                    </label>
                    <textarea class="form-control" rows="1" name="fraga6" id="fraga6"></textarea>
                </div>
                 <!-- FRRÅGA 7 -->
                <div class="contain-2">
                    <label class="form-label" for="fraga7">
                        Förklarade läkaren/sjuksköterskan/annan vårdpersonal behandlingen på ett
                        sätt som du förstod?
                    </label>
                    <label>
                        Ja
                        <input type="radio" name="fraga7" value="yes">
                    </label>
                    <label>
                        Nej
                        <input type="radio" name="fraga7" value="no">
                    </label>
                </div>

                <!-- FRÅGA 8 -->
                <div class="contain-2">
                    <label class="form-label" for="fraga8">
                        Om du ställde frågor till vårdpersonalen fick du svar som du förstod?
                    </label>
                    <label>
                        Ja
                        <input type="radio" name="fraga8" value="yes">
                    </label>
                    <label>
                         Nej
                         <input type="radio" name="fraga8" value="no">
                        </label>
                    </div>

                    <!-- FRÅGA 9 -->
                <div class="contain-2">
                    <label class="form-label" for="fraga9">
                        Blev du informerade om ett kommande världsförlopp?
                    </label>
                    <label>
                        Ja
                        <input type="radio" name="fraga9" value="yes">
                    </label>
                    <label>
                        Nej
                        <input type="radio" name="fraga9" value="no">
                    </label>
                </div>

                <br>
        <!-- FRÅGA 10 -->   
            <fieldset class="contain-1">
                <legend>Respekt och bemötande</legend>
                <div class="contain-2">
                    <label class="form-label" for="fraga10">
                         Kände du dig bemött av vårdpersonalen med respekt och värdighet?
                        </label>
                        <select class="form-select" name="fraga10" id="fraga10">
                            <option value="" disabled selected>Välj en kategori</option>
                            <?php
                            
                            $svar = [
                                "Instämmer inte alls",
                                "Instämmer inte helt",
                                "Varken instämmer eller instämmer inte",
                                "Instämmer delvis",
                                "Instämmer i hög grad",
                            ];
                            foreach ($svar as $svaret) {
                                echo "<option value='$svaret'>$svaret</option>";
                            } 
                            ?>
                            </select>
                        </div>

        <!-- FRÅGA 11 -->
        <div class="contain-2">
            <label class="form-label" for="fraga11">
            Bemötte vårdpersonalen dig med medkänsla och omsorg?
            </label>
            <select class="form-select" name="fraga11" id="fraga11">
                <option value="" disabled selected>Välj en kategori</option>
                
                <?php
                foreach ($svar as $svaret) {
                    echo "<option value='$svaret'>$svaret</option>";
                } 
                ?>
                </select>
            </div>

<!-- FRÅGA 12  -->
        <div class="contain-2">
            <label class="form-label" for="fraga12">
            Fick du träffa den läkare som du vill träffa?
            </label>
            <label>
            Ja
            <input type="radio" name="fraga12" value="yes">
        </label>
        <label>
            Nej
            <input type="radio" name="fraga12" value="no">
        </label>
    </div>
</fieldset>

    <br>
<!-- FRÅGA 13 -->
    <fieldset class="contain-1">
        <legend>Delaktighet i beslut</legend>
        <div class="contain-2">
            <label class="form-label" for="fraga13"> Under vårmötet, kände du att läkaren/sjuksköterskan eller annan
             vårdpersonal lyssnade på din beskrivning av din ohälsa? </label>
             <select class="form-select" name="fraga13" id="fraga13">
                <option value="" disabled selected>Välj en kategori</option>
                <?php
                foreach ($svar as $svaret) {
                    echo "<option value='$svaret'>$svaret</option>";
                } 
                ?>
                </select>
            </div>

             <!-- FRÅGA 14 -->
             <div class="contain-2">
                <label class="form-label" for="fraga14">Under vårmötet, kände du att läkaren/sjuksköterskan eller annan
                    vårdpersonal lyssnade på dina önskemål om vård och behandling?  </label>
                    <select class="form-select" name="fraga14" id="fraga14">
                        <option value="" disabled selected>Välj en kategori</option>
                        <?php
                        foreach ($svar as $svaret) {
                            echo "<option value='$svaret'>$svaret</option>";
                        } 
                        ?>
                        </select>
                    </div>

                 <!-- FRÅGA 15 -->
                <div class="contain-2">
                    <label class="form-label" for="fraga15">Under vårmötet, kände du att läkaren/sjuksköterskan eller annan
                        vårdpersonal inkluderade dig i planeringen av din vård och behandling?  </label>
                        <select class="form-select" name="fraga15" id="fraga15">
                            <option value="" disabled selected>Välj en kategori</option>
                            
                            <?php
                            foreach ($svar as $svaret) {
                                echo "<option value='$svaret'>$svaret</option>";
                            } 
                            ?>
                            </select>
                        </div>
                    </fieldset>
                    <br>

    <button class="btn btn-primary mx-auto">Skicka förfrågan</button>
</form>

<?php require_once "../footer.php" ?>