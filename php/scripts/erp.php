<?php
class Erp
{
    // WARN: Very insecure
    private const API_KEY = "124785e69495ab9:dab98cd889fd670";
    private const BASE_URL = "http://193.93.250.83/api/resource/";

    private string $doctype;
    private string $name;
    private array $filters;
    public array $fields;
    public int $limit_page_length;
    public int $limit_start;

    public function __construct(string $doctype)
    {
        $this->doctype = $doctype;
    }

    private function generate_url()
    {
        $url = self::BASE_URL . rawurlencode($this->doctype);
        if (!empty($this->name)) {
            $url .= "/" . rawurlencode($this->name);
        }
        $query = [];
        foreach (["fields", "filters", "limit_page_length", "limit_start"] as $member) {
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

    private function start_json_req()
    {
        try {
            $ch = curl_init($this->generate_url());
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

    private function finish_json_req($ch): ?array
    {
        $response = curl_exec($ch);
        if ($response === false) {
            if (curl_errno($ch) !== 0) {
                $response = ["error" => curl_error($ch)];
            }
        } else {
            $response = json_decode($response, true);
        }
        curl_close($ch);
        return $response;
    }

    public function add_filter(array $filter)
    {
        $this->filters[] = $filter;
    }

    public function list(): ?array
    {
        $ch = $this->start_json_req();
        return $this->finish_json_req($ch);
    }

    public function read(string $name): ?array
    {
        $this->name = $name;
        $ch = $this->start_json_req();
        return $this->finish_json_req($ch);
    }

    public function create(array $data): ?array
    {
        $ch = $this->start_json_req();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        return $this->finish_json_req($ch);
    }
    
    public function update(string $name, array $data): ?array
    {
        $this->name = $name;
        $ch = $this->start_json_req();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        return $this->finish_json_req($ch);
    }


    public function delete(string $name): ?array 
    {
        $this->name = $name;
        $ch = $this->start_json_req();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"DELETE");
        return $this->finish_json_req($ch);
    }
}
?>