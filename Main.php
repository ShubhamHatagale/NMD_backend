<?php

require_once 'config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// require_once 'path_to_openai_lib/openai-php/OpenAI.php';

// use OpenAI\OpenAI;

// OpenAI::setApiKey('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');


class Main
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll($db_column)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $db_column");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Remove HTML tags from the fetched data
            foreach ($data as &$item) {
                foreach ($item as $key => &$value) {
                    $value = strip_tags($value);
                    $value = str_replace('&nbsp;', '', $value);

                }
            }
    
            return $data;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    

    public function getById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM blog WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Remove HTML tags from the fetched data
            foreach ($data as $key => &$value) {
                $value = strip_tags($value);
            }
    
            return $data;
        } catch (PDOException $e) {
            return false;
        }
    }


    public function getBy_where_condition($db_column,$where_condition)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $db_column $where_condition");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Remove HTML tags from the fetched data
            foreach ($data as &$item) {
                foreach ($item as $key => &$value) {
                    $value = strip_tags($value);
                    $value = str_replace('&nbsp;', '', $value);

                }
            }
    
            return $data;
        } catch (PDOException $e) {
            return false;
        }
    }


    // public function chatgpt($message)
    // {$response = OpenAI::complete([
    //     'model' => 'gpt-3.5-turbo',
    //     'prompt' => $message,
    //     'maxTokens' => 100,
    //     'temperature' => 0.6,
    //     'n' => 1,
    //     'stop' => null,
    // ]);

    // return $response['choices'][0]['text'];
    // }

    function chatgpt($message) {
        $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
        $data = array(
            'prompt' => $message,
            'max_tokens' => 100,
            'temperature' => 0.6,
            'n' => 1
        );
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer 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'
        );
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $json = json_decode($response, true);
        return $json['choices'][0]['text'];
    }
    
    
    
    
    

    // Add other CRUD methods: create(), update(), delete()
}
