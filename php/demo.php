<?php

require 'token_generator.php';
require 'priaid_client.php';

class Demo
{
    private $config;
    private $diagnosisClient;

    function __construct()
    {
        $this->config = parse_ini_file("config.ini");
    }

    private function checkRequiredParameters()
    {
        $pass = true;

        if (!isset($this->config['username']))
        {
            $pass = false;
            print "You didn't set username in config.ini" ;
        }

        if (!isset($this->config['password']))
        {
            $pass = false;
            print "You didn't set password in config.ini" ;
        }

        if (!isset($this->config['authServiceUrl']))
        {
            $pass = false;
            print "You didn't set authServiceUrl in config.ini" ;
        }

        if (!isset($this->config['healthServiceUrl']))
        {
            $pass = false;
            print "You didn't set healthserviceUrl in config.ini" ;
        }

        return $pass;
    }
    public function tokensActivator() {
        if (!$this->checkRequiredParameters()) {
            die("parameter error tr again");
        }

        $tokenGenerator = new TokenGenerator($this->config['username'],$this->config['password'],$this->config['authServiceUrl']);
        $token = $tokenGenerator->loadToken();

        if (!isset($token))
            die("token not generated");
        $this->diagnosisClient = new DiagnosisClient($token, $this->config['healthServiceUrl'], 'en-gb');
    }
    public function bodyLocationsLoader() {
        $bodyLocations = $this->diagnosisClient->loadBodyLocations();
        if (!isset($bodyLocations))
            die("body locations empty");
        return $bodyLocations;
    }
    public function bodySubLocationsLoader($bodyLocationID) {
        $bodySublocations = $this->diagnosisClient->loadBodySublocations($bodyLocationID);
        if (!isset($bodySublocations))
            die("body sublocations empty");
        return $bodySublocations;
    }
    public function bodySymptomsLoader($bodySubLocationID, $selector)
    {
        $symptoms = $this->diagnosisClient->loadSublocationSymptoms($bodySubLocationID, $selector);
        if (!isset($symptoms))
            die("no symptoms error");
        if (count($symptoms) == 0)
            die("No symptoms for selected body sublocation");
        return $symptoms;
    }
    public function diagnosisLoader($symptoms, $selector, $yob) {
        $gender = "";
        if($selector == 'woman' || $selector == 'girl') {
            $gender = "female";
        } else {
            $gender = "male";
        }
        $diagnosis = $this->diagnosisClient->loadDiagnosis($symptoms, $gender, $yob);
        if (!isset($diagnosis))
            exit();
        print("<h3>Calculated diagnosis for (");
        for($i = 0; $i < count($symptoms); $i++) {
            print("$symptoms[$i], ");
        }
        print(")</h3>");
        return $diagnosis;
    }
    public function simulate($bl, $bsl, $symptoms, $selector, $yop)
    {
        $yop += 0;
        if (!$this->checkRequiredParameters())
            return;

        $tokenGenerator = new TokenGenerator($this->config['username'],$this->config['password'],$this->config['authServiceUrl']);
        $token = $tokenGenerator->loadToken();

        if (!isset($token))
            exit();

        $this->diagnosisClient = new DiagnosisClient($token, $this->config['healthServiceUrl'], 'en-gb');
//        print('<html><body>');
//        print('<h3>Body locations</h3>');
//        $bodyLocations = $this->diagnosisClient->loadBodyLocations();
//        if (!isset($bodyLocations))
//            exit();
//        $this->printSimpleObject($bodyLocations);
//
//        // get random body location
//        $locRandomIndex = rand(0, count($bodyLocations)-1);
//        $locRandomId = $bodyLocations[$locRandomIndex]['ID'];
//        $locRandomName = $bodyLocations[$locRandomIndex]['Name'];
//        $bodySublocations = $this->diagnosisClient->loadBodySublocations($locRandomId);
//        if (!isset($bodySublocations))
//            exit();
//        print("<h3>Body Subocations for $locRandomName($locRandomId)</h3>");
//        $this->printSimpleObject($bodySublocations);
//
//        // get random body sublocation
//        $sublocRandomIndex = rand(0, count($bodySublocations)-1);
//        $sublocRandomId = $bodySublocations[$sublocRandomIndex]['ID'];
//        $sublocRandomName = $bodySublocations[$sublocRandomIndex]['Name'];
//        $symptoms = $this->diagnosisClient->loadSublocationSymptoms($sublocRandomId,$selector);
//        print("<h3>Symptoms in body sublocation $sublocRandomName($sublocRandomId)</h3>");
//        if (!isset($symptoms))
//            exit();
//        if (count($symptoms) == 0)
//            die("No symptoms for selected body sublocation");
//
//        $this->printSimpleObject($symptoms);
//
//        // get diagnosis
//        $randomSymptomIndex = rand(0, count($symptoms)-1);
//        $randomSymptomId = $symptoms[$randomSymptomIndex]['ID'];
//        $randomSymptomName = $symptoms[$randomSymptomIndex]['Name'];
//        $selectedSymptoms = array($randomSymptomId);
        $gender = "";
        if($selector == "Women" || $selector = "Girl") {
            $gender = "male";
        } else {
            $gender = "female";
        }
        $diagnosis = $this->diagnosisClient->loadDiagnosis($symptoms, $gender, $yop);
        if (!isset($diagnosis))
            exit();
//        print("<h3>Calculated diagnosis for $randomSymptomName($randomSymptomId)</h3>");
        $this->printDiagnosis($diagnosis);

        // get specialisations
        $specialisations = $this->diagnosisClient->loadSpecialisations($symptoms, 'male', 1988);
        if (!isset($specialisations))
            exit();
//        print("<h3>Calculated specialisations for $randomSymptomName($randomSymptomId)</h3>");
        $this->printSpecialisations($specialisations);

        // get proposed symptoms
        $proposedSymptoms = $this->diagnosisClient->loadProposedSymptoms($symptoms, 'male', 1988);
        if (!isset($proposedSymptoms))
            exit();
//        print("<h3>Proposed symptoms for selected $randomSymptomName($randomSymptomId)</h3>");
        $this->printSimpleObject($proposedSymptoms);

        // get red flag text
//        $redFlagText = $this->diagnosisClient->loadRedFlag($randomSymptomId);
//        if (!isset($redFlagText))
//            exit();
//        print("<h3>Red flag text for selected $randomSymptomName($randomSymptomId)</h3>");
//        print($redFlagText);

        // get issue info
        reset($diagnosis);
        while (list($key, $val) = each($diagnosis)) {
            $this->loadIssueInfo($val['Issue']['ID']);
        }
    }

    private function loadIssueInfo($issueId)
    {
        $issueInfo = $this->diagnosisClient->loadIssueInfo($issueId);
        if (!isset($issueInfo))
            exit();
        $issueName = $issueInfo['Name'];
        print("<div class='jumbotron'>\n");
        print("<h1 class='display-4'>Info for $issueName</h1>\n<br>");
        echo "<p>","\n","<b>Name:</b>\t",$issueName;
        echo "<p>","\n","<b>Professional Name:</b>\t",$issueInfo['ProfName'], "</p>";
        echo "<p>","\n","<b>Synonyms:</b>\t",$issueInfo['Synonyms'], "</p>";
        echo "<p>","\n","<b>Short Description:</b>\t",$issueInfo['DescriptionShort'], "</p>";
        echo "<p>","\n","<b>Description:</b>\t",$issueInfo['Description'], "</p>";
        echo "<p>","\n","<b>Medical Condition:</b>\t",$issueInfo['MedicalCondition'], "</p>";
        echo "<p>","\n","<b>Treatment Description:</b>\t",$issueInfo['TreatmentDescription'], "</p>";
        echo "<p>","\n","<b>Possible symptoms:</b>\t",$issueInfo['PossibleSymptoms'], "</p>";
        print("</div>\n");
    }

    public function printDiagnosis($object)
    {
        print("<div class='jumbotron'>\n");
        print("<h1 class='display-4'>Diagnosis</h1><br><hr>");
        array_map(function ($issue) {
            echo "<pre><b>", "\n", $issue['Issue']['Name']," (", $issue['Issue']['Accuracy'],"%)\n", "</b></pre>";
            echo "<p class='lead'>Specialisations</p><pre> -> ";
            array_map(function ($spec)
            {
              echo $spec['Name'],"(",$spec['ID'],")", "\t";
            }, $issue['Specialisation']);
            echo "\n</pre>";
            echo "<hr>";
        }, $object);
        print "</div>" ;
    }

    public function printSpecialisations($object)
    {
        print "<div class='jumbotron'>" ;
//        print "<b>ID\tName</b>";
        print("<h1 class='display-4'> Specialisations </h1><br><pre>");
        array_map(function ($specialisation) {
            echo "\n\t", $specialisation['Name']," (", $specialisation['Accuracy'],"%)";
        }, $object);
        print "</pre></div>" ;
    }

    public function printSimpleObject($object)
    {
        print "<div class='jumbotron'>";
        print("<h1 class='display-4'>Symptoms</h1><br><pre>");
//        print "<b>ID\tName</b>";
        array_map(function ($var) {
            echo "\n", "\t", $var['Name'];
        }, $object);
        print "</pre></div>" ;
    }

    public function printBodyLocations($object) {
        array_map(function ($var) {
            echo "<div class=\"form-check form-check-inline\">";
            echo "<input class=\"form-check-input\" type=\"radio\" name=\"bl\" id=\"bl{$var['ID']}\" value=\"{$var['ID']}\" required>";
            echo "<label class=\"form-check-label\" for=\"bl{$var['ID']}\">{$var['Name']}</label>";
            echo "</div>";
            echo "<br>";
        }, $object);
    }
    public function printSubBodyLocations($object) {
        array_map(function ($var) {
            echo "<div class=\"form-check form-check-inline\">";
            echo "<input class=\"form-check-input\" type=\"radio\" name=\"bsl\" id=\"bl{$var['ID']}\" value=\"{$var['ID']}\" required>";
            echo "<label class=\"form-check-label\" for=\"bl{$var['ID']}\">{$var['Name']}</label>";
            echo "</div>";
            echo "<br>";
        }, $object);
    }
    public function printSymptoms($object) {
        array_map(function ($var) {
            echo "<div class=\"form-check\">";
            echo "<input class=\"form-check-input\" type=\"radio\" name=\"symptoms[]\" value=\"{$var['ID']}\" id=\"symp{$var['ID']}\" required >";
            echo "<label class=\"form-check-label\" for=\"symp{$var['ID']}\">{$var['Name']}</label>";
            echo "</div>";
        }, $object);
    }
}



?>
