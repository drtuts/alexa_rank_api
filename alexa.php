<?php

  Class Alexa_Api{

    private $output;

    public function __construct( $url )
    {
  
        $custom_url = $url;
        $url = "http://data.alexa.com/data?cli=10&url=$custom_url";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);

        $this->output = simplexml_load_string($contents);

        curl_close($ch);

    }

    public function GetGlobalRank()
    {

        $popularity = json_decode( json_encode( $this->output->SD->POPULARITY ), TRUE );

        $popularity_info = $popularity['@attributes'];

        return $popularity_info;

    }

    public function GetCountryRank()
    {
        $country = json_decode( json_encode( $this->output->SD->COUNTRY ), TRUE );

        $country_info = $country['@attributes'];

        return $country_info;

    }
  }

  $obj = new Alexa_Api('drtuts.com');
  $global = $obj->GetGlobalRank();
  $country = $obj->GetCountryRank();

  echo 'Url : ' .$global['URL'].'<br />';
  echo 'Rank : ' .$global['TEXT'].'<br />';

  echo '<br/><br/>';

  echo ' Country name:' .$country['NAME']. '<br />';
  echo ' Country Rank:' .$country['RANK']. '<br />';

