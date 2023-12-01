<?php require_once "../../../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../../../scripts/globals.php" ?>
<?php require_once "../../../../scripts/erp.php" ?>
<?php require_once "../../../../scripts/session.php" ?>

<?php
$general = [
    "could_ask_questions" => "Fick du möjlighet att ställa frågorna du önskade?",
    "easy_to_understand_information" => "Var det enkelt att ta till sig informationen under vårdmötet?",
    "satisfied_with_communication" => "Är du nöjd med det sätt du kan komma i kontakt med vårdcentralen?",
    "visit_within_reasonable_time" => "Fick du besöka vårdcentralen inom en rimlig tid?",
    "wait_longer_than_20" => "Var väntan i väntrummet längre än 20 min?",
];
$information = [
    "enough_information_about_treatment_and_side_effects" => "Fick du tillräckligt med information om din behandling och eventuella bieffekter?",
    "understandable_anwsers_to_questions_asked" => "Om du ställde frågor till vårdpersonalen fick du svar som du förstod?",
    "understood_treatment_explanation" => "Förklarade läkaren/sjuksköterskan/annan vårdpersonal behandlingen på ett sätt som du förstod?",
    "informed_of_environment" => "Blev du informerade om ett kommande världsförlopp?",
];
$questiongroups = [
    "Allmänt om ditt besök på vårdcentralen" => $general,
    "Information och kunskap" => $information,
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $all_form_data = array_merge($general, $information, ["other_comments" => null]);
    $data = array_intersect_key($_POST, $all_form_data);
    if (count($data) <= count($all_form_data)) {
        $new = Erp::create(Doc::PATIENT_APPOINTMENT_EVALUATION, array_merge($data, [
            "patient" => $_SESSION[Session::NAME],
            "encounter" => $_GET["name"],
        ]));

        if (is_array($new)) {
            header("Location: $base_url/minasidor/journal/Patient%20Encounter/?" . http_build_query($_GET));
            die();
        }
    }
}
?>

<?php $title = "Utvärdering - Patient Encounter"; require_once "../../../header.php" ?>

<form action="" method="post">
    <div class="d-flex flex-column flex-md-row gap-4">
        <?php foreach ($questiongroups as $caption => $questions): ?>
            <fieldset class="col">
                <legend><?= $caption ?></legend>
                <?php foreach ($questions as $name => $question): ?>
                    <div class="my-4">
                        <label class="form-label" for="<?= $name ?>"><?= $question ?></label>
                        <select class="form-select" name="<?= $name ?>" id="<?= $name ?>">
                            <option value="Inget svar" selected>Inget svar</option>
                            <option value="Ja">Ja</option>
                            <option value="Nej">Nej</option>
                        </select>
                    </div>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
    </div>
    <div class="mb-4">
        <label class="form-label" for="other_comments">Är det något från de ovannämnda frågorna som du specifikt vill utveckla? (max 500 ord)</label>
        <textarea class="form-control" name="other_comments" id="other_comments" cols="30" rows="10" maxlength="500"></textarea>
    </div>
    <button class="btn btn-primary">Skicka</button>
</form>

<?php require_once "../../../footer.php" ?>