<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class censorItBridgeController extends Controller
{

    public function getCensoredText(Request $request){

        Log::info("func getCensoredText is executed");
    
        $text = $request->text;

        switch ($_GET['method']) {
            case "censor":
                $censoredText = censorItBridgeController::callcensorSwearingSoap($text);
                break;
    
            case "censor_replace":
                $replacement = $request->replacement;
                $censoredText = censorItBridgeController::callreplaceSwearingSoap($text, $replacement);
                break;
    
            case "replace_word_for_word":
                $word = $request->input;
                $newWord = $request->replacement;
                $censoredText = censorItBridgeController::callreplaceWordForWordSoap($text, $word, $newWord);
                break;
        }
    
        $body = array("text" => $censoredText);
        return response()->json($body);
    }



    static function callcensorSwearingSoap($text){

        $client = new SoapClient("http://localhost:5043/censorIt.asmx");
        //Log::info(implode("|",$client->__getFunctions()));
        //Log::info(implode("|",$client->__getTypes()));

        $censorSwearing = new censorSwearing($text);

        $response = $client->__soapCall("censorSwearing", array($censorSwearing));

        return $response->censorSwearingResult;
    }

    static function callreplaceSwearingSoap($text, $replacement){

        $client = new SoapClient("http://localhost:5043/censorIt.asmx");
        //Log::info(implode("|",$client->__getFunctions()));
        //Log::info(implode("|",$client->__getTypes()));

        $replaceSwearing = new replaceSwearing($text, $replacement);

        $response = $client->__soapCall("replaceSwearing", array($replaceSwearing));

        return $response->replaceSwearingResult;
    }

    static function callreplaceWordForWordSoap($text, $word, $newWord){

        $client = new SoapClient("http://localhost:5043/censorIt.asmx");
        //Log::info(implode("|",$client->__getFunctions()));
        //Log::info(implode("|",$client->__getTypes()));

        $replaceWordForWord = new replaceWordForWord($text, $word, $newWord);

        $response = $client->__soapCall("replaceWordForWord", array($replaceWordForWord));

        return $response->replaceWordForWordResult;
    }
}

class censorSwearing
{

    public function __construct($text)
    {
        $this->text = $text;
    }

}

class replaceSwearing
{

    public function __construct($text, $replacement)
    {
        $this->text = $text;
        $this->replacement = $replacement;
    }

}

class replaceWordForWord
{

    public function __construct($text, $word, $newWord)
    {
        $this->text = $text;
        $this->word = $word;
        $this->newWord = $newWord;
    }

}


