<?php

namespace Spider\Modules\Dashboard\Controllers;

use Phalcon\Http\Response;
use Phalcon\Http\Request;

use Spider\Modules\Dashboard\Forms\CategoryForm;
use Spider\Models\Category;

class CategoryController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->section_title = "Catalogo";
    }
    
    /**
     * Creates a new product
     */
    public function createAction()
    {
        $response = new Response();
        $response->setHeader("Content-Type", "application/json");
        
        $form = new CategoryForm;
        $category = new Category();
        
        $data = $this->request->getPost();
        if ($form->isValid($data, $category)) {
            
            if ($category->save()) {
                $response->setStatusCode(200, "Ok");
                $response->setJsonContent(
                    array(
                        "category" => array(
                            "id" => $category->id,
                            "name" => $category->name,
                            "description" => $category->description
                        )
                    )
                );
            }
            else {
                $response->setStatusCode(409, "Conflict");
                
                $messages = array();
                foreach ($category->getMessages() as $message) {
                    array_push($messages, $message->getMessage());
                }
                
                $response->setJsonContent(
                    array(
                        "error" => array(
                            "code"   => 409,
                            "message" => $messages,
                            "title" => "Conflict"
                        )
                    )
                );
            }
        }
        else {
            $response->setStatusCode(400, "Bad Request");
            
            $messages = array();
            foreach ($form->getMessages() as $message) {
                array_push($messages, $message->getMessage());
            }
            
            $response->setJsonContent(
                array(
                    "error" => array(
                        "code"   => 400,
                        "message" => $messages,
                        "title" => "Bad Request"
                    )
                )
            );
        }
        
        $response->send();
    }
    
    public function searchAction()
    {   
        $response = new Response();
        $response->setHeader("Content-Type", "application/json");
        
       
        $categories = Category::find();

        $data = array();
        foreach($categories as $category) {
            array_push($data, array(
                "id" => $category->id,
                "name" => $category->name,
                "description" => $category->description
            ));
        }

        $response->setStatusCode(200, "OK");
        $response->setJsonContent(
            array(
                "categories" => $data
            )
        );
        
        $response->send();
    }
    
    public function editAction($id)
    {
        $response = new Response();
        $response->setHeader("Content-Type", "application/json");
        
        $category = Category::findFirst($id);
        if ($category) {
            $response->setStatusCode(200, "OK");
            $response->setJsonContent(
                array(
                    "category" => [
                        "id" => $category->id,
                        "name" => $category->name,
                        "description" => $category->description,
                    ]
                )
            );
        }
        else {
            $response->setStatusCode(204, "No Content");
        }
        
        $response->send();
    }
    
    public function saveAction()
    {
        $response = new Response();
        $response->setHeader("Content-Type", "application/json");
        
        $id = $this->request->getPost("id", "int");
        
        
        $category = Category::findFirst($id);
        if (empty($category)) {
            $response->setStatusCode(404, "Not Found");    
            $response->setJsonContent(
                array(
                    "error" => array(
                        "code"    => 404,
                        "message" => "Categoria não encontrada.",
                        "title"   => "Not Found"
                    )
                )
            );
        }
        else {
            $form = new CategoryForm;
            
            $data = $this->request->getPost();
            
            if (!$form->isValid($data, $category)) {
                $messages = array();
                foreach ($form->getMessages() as $message) {
                    array_push($messages, $message->getMessage());
                }
                
                $response->setStatusCode(409, "Conflict");
                $response->setJsonContent(
                    array(
                        "error" => array(
                            "code"   => 409,
                            "message" => $messages,
                            "title" => "Conflict"
                        )
                    )
                );
            }
            else {
                if ($category->update()) {
                    $response->setStatusCode(200, "OK");
                    $response->setJsonContent(
                        array(
                            "category" => array(
                                "id" => $category->id,
                                "name" => $category->name,
                                "description" => $category->description
                            )
                        )
                    );
                }
                else {
                    $messages = array();
                    foreach ($category->getMessages() as $message) {
                        array_push($messages, $message->getMessage());
                    }
                    
                    $response->setStatusCode(409, "Conflict");
                    $response->setJsonContent(
                        array(
                            "error" => array(
                                "code"   => 409,
                                "message" => $messages,
                                "title" => "Conflict"
                            )
                        )
                    );
                }
            }
        }
        
        $response->send();
    }
    
    public function deleteAction($id)
    {
        $response = new Response();
        $response->setHeader("Content-Type", "application/json");
        
        $category = Category::findFirst($id);
        if (empty($category)) {
            $response->setStatusCode(404, "Not Found");    
            $response->setJsonContent(
                array(
                    "error" => array(
                        "code"    => 404,
                        "message" => "Não foi possível encontrar a categoria informada",
                        "title"   => "Not Found"
                    )
                )
            );
        }
        else {
            if ($category->delete()) {
                $response->setStatusCode(200, "Ok");
                $response->setJsonContent(
                    array(
                        "category" => array(
                            "id" => $category->id,
                            "name" => $category->name,
                            "description" => $category->description
                        )
                    )
                );
            }
            else {
                $messages = array();
                foreach ($category->getMessages() as $message) {
                    array_push($messages, $message->getMessage());
                }
                
                $response->setStatusCode(409, "Conflict");
                $response->setJsonContent(
                    array(
                        "error" => array(
                            "code"   => 409,
                            "message" => $messages,
                            "title" => "Conflict"
                        )
                    )
                );
            }
        }
        
        $response->send();
    }
}