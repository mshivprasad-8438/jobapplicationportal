<?php
class ChatgptHelper extends CComponent {


    public static function getChat($conversation)
  {
    // Set the endpoint
    $url = "https://api.openai.com/v1/chat/completions";
 
    // Set the method
    $method = "POST";
    // $user=Yii::app()->user->getState("username");

    // GPT Prompt
    $prompt = "You are the AI model you should give answers to the querie  by keeping previous conversation in the context initally user name is Deekshitha .give ns to to last question in the conversation our conversation $conversation ";
 
    // Set the parameters
    $parameters = array(
      "model" => "gpt-3.5-turbo",
      "messages" => array(
        array("role" => "system", "content" => $prompt),
      )
    );
 
    // Get the Bearer Token
   
    // Set the Content Type
    $content_type = "application/json";
 
    $result = CurlHelper::curl($url, $method, $parameters, $authorization_token, [], $content_type);
    // return $result;
    return $result["choices"][0]["message"]["content"];
  }

}