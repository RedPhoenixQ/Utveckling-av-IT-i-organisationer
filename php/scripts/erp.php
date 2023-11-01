<?php 
class Erp {
    // WARN: Very insecure
    static private $api_key =  "124785e69495ab9:e327c50d47bb5dd";
    static private $base_url = "http://193.93.250.83/"; 

    private static function start_json_req(string $path) {
        try {
        $ch = curl_init(self::$base_url . $path);
        } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        //  ----------  Här sätter ni era login-data ------------------ //
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json', 
            'Accept: application/json',
            'Authorization: token ' . self::$api_key,
        ]);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }
    static private function finish_json_req($ch): ?Object {
        $response = curl_exec($ch);
        $response = json_decode($response);

        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        echo $error;
        curl_close($ch);
        return $response;
    }

    static public function GET(string $path): ?Object {
        $ch = self::start_json_req($path);
        return self::finish_json_req($ch);
    }
}
?>