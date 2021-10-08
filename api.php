<?php
include_once("includes/config.php");

/*Headers med inställningar för din REST webbtjänst*/

//Gör att webbtjänsten går att komma åt från alla domäner (asterisk * betyder alla)
header('Access-Control-Allow-Origin: *');

//Talar om att webbtjänsten skickar data i JSON-format
header('Content-Type: application/json');

//Vilka metoder som webbtjänsten accepterar, som standard tillåts bara GET.
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');

//Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//Läser in vilken metod som skickats och lagrar i en variabel
$method = $_SERVER['REQUEST_METHOD'];

//Om en parameter av id finns i urlen lagras det i en variabel
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$course = new course();

// a case for reading out the posts in the api
switch ($method) {
    case 'GET':
        //Skickar en "HTTP response status code"
        http_response_code(200); //Ok - The request has succeeded

        $response = $course->getCourses();

        if (count($response) == 0) {
            $response = array("message" => "There is nothing to get yet");
        }
        break;

        // a case for making new post to the api
    case 'POST':
        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        $data = json_decode(file_get_contents("php://input"));

        if ($course->addCourse($data->kurskod, $data->kursnamn, $data->progression, $data->kursplan)) {
            $response = array("message" => "Created");

            http_response_code(201);
        } else {
            $response = array("message" => "server error");
            http_response_code(500);
        }

        // case 'POST':
        //     //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        //     $data = json_decode(file_get_contents("php://input"));

        //     if($data->kurskod =="" || $data->kursnamn == "" || $data->progression =="" || $data->kursplan ==""){
        //         $response = array("message" => "All fields need to be filled");

        //         http_response_code(400);
        //     } else{
        //         if ($course->addCourse($data->kurskod, $data->kursnamn, $data->progression, $data->kursplan)) {
        //             $response = array("message" => "Created");

        //             http_response_code(201);
        //         } else {
        //             $response = array("message" => "server error");
        //             http_response_code(500);
        //         }

        //     }

        break;

        // A case for updating the api
    case 'PUT':
        //Om inget id är med skickat, skicka felmeddelande
        if (!isset($id)) {
            http_response_code(510); //Bad Request - The server could not understand the request due to invalid syntax.
            $response = array("message" => "No id is sent");
            //Om id är skickad   
        } else {
            $data = json_decode(file_get_contents("php://input"));

            // obbs, dont put $=data->id I was stuck on this for six hours thanks to that
            if($course->updateCourse($id, $data->kurskod, $data->kursnamn, $data->progression, $data->kursplan)) {
                http_response_code(200);
                $response = array("message" => "Post with id=$id is updated");
            } else {
                http_response_code(503);
                $response = array("message" => "Post with id=$id was not updated");
            }
        }
        break;
// a case for deleting from the api
    case 'DELETE':
        if (!isset($id)) {
            http_response_code(400);
            $response = array("message" => "No id is sent");
        } else {

            
            if ($course->deleteCourse($id)){
                http_response_code(200);
                $response = array("message" => "Post with id=$id is deleted");
            }else{
                http_response_code(503);
                $response = array("message" => "Post with id=$id was not deleted");
            }

        }
        break;
}

//Skickar svar tillbaka till avsändaren
echo json_encode($response);
