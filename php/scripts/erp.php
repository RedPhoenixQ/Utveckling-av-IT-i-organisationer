<?php
class Erp
{
    // WARN: Very insecure
    private const API_KEY = "124785e69495ab9:dab98cd889fd670";
    public const BASE_URL = "http://193.93.250.83";
    private const RESOURCE_URL = self::BASE_URL . "/api/resource/";
    private const METHOD_URL = self::BASE_URL . "/api/method/";

    public const ORDER_ASC = "ASC";
    public const ORDER_DESC = "DESC";

    private string $doctype;
    private ?string $name = null;
    private array $filters;
    private array $or_filters;
    private string $order_by;
    public array $fields;
    public int $limit_page_length;
    public int $limit_start;

    static function method(string $method, array $data): ?array {
        $ch = self::start_json_req(self::METHOD_URL . $method);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        return self::finish_json_req($ch);
    }

    public function __construct(string $doctype)
    {
        $this->doctype = $doctype;
    }

    private function generate_url()
    {
        $url = $this->resource_url($this->doctype, $this->name);
        $query = [];
        foreach (["fields", "filters", "or_filters", "order_by", "limit_page_length", "limit_start"] as $member) {
            if (!empty($this->{$member})) {
                if (gettype($this->{$member}) == "array") {
                    $query[$member] = json_encode($this->{$member});
                } else {
                    $query[$member] = $this->{$member};
                }
            }
        }
        if (!empty($query)) {
            $url .= "?" . http_build_query($query);
        }
        return $url;
    }

    private static function resource_url(string $doctype, ?string $name = null) {
        $url = self::RESOURCE_URL . rawurlencode($doctype);
        if ($name !== null) {
            $url .= "/". rawurlencode($name);
        }
        return $url;
    }

    private static function start_json_req(string $url)
    {
        try {
            $ch = curl_init($url);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: token ' . self::API_KEY,
        ]);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    private static function finish_json_req($ch): ?array
    {
        $response = curl_exec($ch);
        if ($response === false) {
            if (curl_errno($ch) !== 0) {
                $output = ["error" => curl_error($ch)];
            }
        } else {
            $output = json_decode($response, true);
        }
        if ($output === null) {
            $output = ["error" => "JSON parse error", "response" => $response];
        }
        curl_close($ch);
        return $output;
    }

    public function add_filter(array $filter)
    {
        $this->filters[] = $filter;
    }

    public function add_or_filter(array $filter)
    {
        $this->or_filters[] = $filter;
    }

    public function order_by(string $field, string $order = self::ORDER_ASC) {
        $this->order_by = "$field $order";
    }

    public function list(): ?array
    {
        $ch = $this->start_json_req($this->generate_url());
        return $this->finish_json_req($ch);
    }

    public static function read(string $doctype, string $name): ?array
    {
        $ch = self::start_json_req(self::resource_url($doctype, $name));
        return self::finish_json_req($ch);
    }

    public static function create(string $doctype, array $data): ?array
    {
        $ch = self::start_json_req(self::resource_url($doctype));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        return self::finish_json_req($ch);
    }
    
    public static function update(string $doctype, string $name, array $data): ?array
    {
        $ch = self::start_json_req(self::resource_url($doctype, $name));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        return self::finish_json_req($ch);
    }


    public static function delete(string $doctype, string $name): ?array 
    {
        $ch = self::start_json_req(self::resource_url($doctype, $name));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"DELETE");
        return self::finish_json_req($ch);
    }
}

class Doc {
    public const USER = "user";
    public const PATIENT = "Patient";
    public const PATIENT_APPOINTMENT = "Patient Appointment";
    public const PATIENT_ENCOUNTER = "Patient Encounter";
    public const LAB_TEST = "Lab Test";
    public const CLINICAL_PROCEDURE = "Clinical Procedure";
    public const PATIENT_NOTIFICATOIN = "Gr3 Notification";
    public const PATIENT_MEDICAL_RECORD= "Patient Medical Record";
    public const VITAL_SIGNS = "Vital Signs";
    public const THERAPY_SESSION = "Therapy Session";
    public const APPOINTMENT_REQUEST = "Gr3 Appointment Request";
    public const PATIENT_APPOINTMENT_EVALUATION = "Gr3 Patient Appointment Evaluation";
    public const MEDICATION_REQUEST = "Medication Request";
    public const LONG_TERM_MEDICATION = "Gr3 Long Term Medication";
    public const LONG_TERM_MEDICATION_RENEW_REQUEST = "Gr3 Long Term Medication Renew Request";
}

class Method {
    public const UNSEEN_NOTIFICATIONS = "unseen_notifications";
    public const PATIENT_APPOINTMENT_UPDATE_STATUS = "healthcare.healthcare.doctype.patient_appointment.patient_appointment.update_status";
}
?>