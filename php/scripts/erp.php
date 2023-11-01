<?php
class Erp {
    // WARN: Very insecure
    private const API_KEY =  "124785e69495ab9:e327c50d47bb5dd";
    private const BASE_URL = "http://193.93.250.83/api/resource/";

    private string $doctype;
    private string $name;
    private array $filters;
    public array $fields;
    public int $limit_page_length;
    public int $limit_start;

    public function __construct(string $doctype) {
        $this->doctype = $doctype;
    }

    private function generate_url() {
        $url = self::BASE_URL . $this->doctype;
        if (!empty($this->name)) {
            $url .= "/". rawurlencode($this->name);
        }
        $query = [];
        foreach (["fields", "filters", "limit_page_length", "limit_start"] as $member) {
            if (!empty($this->{$member})) {
                $query[$member] = json_encode($this->{$member});
            }
        }
        if (!empty($query)) {
            $url .= "?" . http_build_query($query);
        }
        return $url;
    }

    private function start_json_req() {
        try {
        $ch = curl_init($this->generate_url());
        } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        //  ----------  Här sätter ni era login-data ------------------ //
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json', 
            'Accept: application/json',
            'Authorization: token ' . self::API_KEY,
        ]);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }
    private function finish_json_req($ch): ?object {
        $response = curl_exec($ch);
        $response = json_decode($response);

        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        echo $error;
        curl_close($ch);
        return $response;
    }

    public function add_filter(array $filter) {
        $this->filters[] = $filter;
    }

    public function list(): ?object {
        $ch = self::start_json_req();
        return self::finish_json_req($ch);
    }

    public function read(string $name): ?object {
        $this->name = $name;
        $ch = self::start_json_req();
        return self::finish_json_req($ch);
    }
}
?>