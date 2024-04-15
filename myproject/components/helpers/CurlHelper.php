<?php
class CurlHelper extends CComponent {

    public static function curl($url, $method, $parameters = [], $authorization_token = null, $headers = [], $content_type = 'application/x-www-form-urlencoded')
    {
      //For GET requests always make sure to not change the content_type from the default
      
      //Build the curl
      // echo ''. $url .''. $method .'';var_dump( $parameters) ;exit;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   
      // Format parameters based on content type
      if ($content_type === "application/x-www-form-urlencoded"){
        $parameters = http_build_query($parameters);
      }
      elseif ($content_type === "application/json"){
        $parameters = json_encode($parameters);
      }
   
      // Check for the method
      if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_POST, true);
      }
      else if ($method === 'DELETE' || $method === 'PUT') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
      }
      else if ($method === 'GET') {
        $url .= '?' . $parameters;
      }
   
      $headers[] = "Content-Type: {$content_type}";
   
      if ($authorization_token !== null) {
        $headers[] = "Authorization: Bearer {$authorization_token}";
      }
   
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $result = curl_exec($ch);
   
      // Convert to PHP array and return
      // echo $result;exit;
      return json_decode($result);
    }
}