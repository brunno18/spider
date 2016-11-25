<?php

namespace Spider\Modules\Dashboard\Controllers;

use Phalcon\Http\Response;
use Phalcon\Http\Request;

use Spider\Modules\Dashboard\Forms\ItemForm;
use Spider\Models\Item;
use Spider\Models\Category;

class ItemController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->section_title = "Catalogo";
    }
    
    public function createAction($idCategory)
    {   
        $response = new Response();
        $response->setHeader("Content-Type", "application/json");
        
        if ($idCategory) {
            $category = Category::findFirst($idCategory);
            if ($category) {
                $form = new ItemForm;
                $item = new Item();
                
                $data = $this->request->getPost();
                if ($form->isValid($data, $item)) {
                    $item->category = $category;
                    
                    if ($item->save()) {
                        $response->setStatusCode(200, "Ok");
                        $response->setJsonContent(
                            array(
                                "item" => array(
                                    "id" => $item->idItem,
                                    "name" => $item->name,
                                    "description" => $item->description,
                                    "amount" => $item->amount,
                                    "price" => $item->price,
                                    "category" => array(
                                        "id" => $item->category->idCategory,
                                        "name" => $item->category->name,
                                        "description" => $item->category->description
                                    )
                                )
                            )
                        );
                    }
                    else {
                        $response->setStatusCode(409, "Conflict");

                        $messages = array();
                        foreach ($item->getMessages() as $message) {
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
            }
            else {
                $response->setStatusCode(404, "Not Found");    
                $response->setJsonContent(
                    array(
                        "error" => array(
                            "code"    => 404,
                            "message" => "Não foi possível encontrar a categoria informada. Atualize a página",
                            "title"   => "Not Found"
                        )
                    )
                );
            }
        }
        else {
            $response->setStatusCode(400, "Bad Request");    
            $response->setJsonContent(
                array(
                    "error" => array(
                        "code"    => 400,
                        "message" => "Informe uma categoria para poder cadastrar um item.",
                        "title"   => "Bad Request"
                    )
                )
            );
        }
        
        $response->send();
    }
    
    public function editAction($id)
    {
        $response = new Response();
        $response->setHeader("Content-Type", "application/json");
        
        $item = Item::findFirst($id);
        if ($item) {
            $response->setStatusCode(200, "OK");
            $response->setJsonContent(
                array(
                    "item" => [
                        "id" => $item->idItem,
                        "name" => $item->name,
                        "price" => $item->price,
                        "amount" => $item->amount,
                        "description" => $item->description,
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
        
        
        $item = Item::findFirst($id);
        if (empty($item)) {
            $response->setStatusCode(404, "Not Found");    
            $response->setJsonContent(
                array(
                    "error" => array(
                        "code"    => 404,
                        "message" => "Item não encontrado.",
                        "title"   => "Not Found"
                    )
                )
            );
        }
        else {
            $form = new ItemForm;
            
            $data = $this->request->getPost();
            if (!$form->isValid($data, $item)) {
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
                if ($item->update()) {
                    $response->setStatusCode(200, "OK");
                    $response->setJsonContent(
                        array(
                            "item" => [
                                "id" => $item->idItem,
                                "name" => $item->name,
                                "price" => $item->price,
                                "amount" => $item->amount,
                                "description" => $item->description,
                            ]
                        )
                    );
                }
                else {
                    $messages = array();
                    foreach ($item->getMessages() as $message) {
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
        
        $item = Item::findFirst($id);
        
        if (empty($item)) {
            $response->setStatusCode(404, "Not Found");    
            $response->setJsonContent(
                array(
                    "error" => array(
                        "code"    => 404,
                        "message" => "Não foi possível encontrar o item informado. Atualize a página.",
                        "title"   => "Not Found"
                    )
                )
            );
        }
        else {
            $this->db->begin();
            
            if ($item->delete()) {
                $this->db->commit();

                $response->setStatusCode(200, "Ok");
                $response->setJsonContent(
                    array(
                        "item" => [
                            "id" => $item->idItem,
                            "name" => $item->name,
                            "price" => $item->price,
                            "amount" => $item->amount,
                            "description" => $item->description,
                        ]
                    )
                );
            }
            else {
                $this->db->rollback();
                $messages = array();
                foreach ($item->getMessages() as $message) {
                    array_push($messages, $message->getMessage());
                }
                
                $response->setStatusCode(400, "Bad Request");
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
        }
        
        $response->send();
    }
    
    public function searchAction($idCategory)
    {
        $this->view->disable();
        
        $columns = array('idItem', 'name', 'amount', 'price');
        $query = Item::query();
        $query->columns($columns);
        
        $whereCategory = "idCategory = $idCategory";
        $where = "";
        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
        {
            $filter = new \Phalcon\Filter();
            $search = $filter->sanitize($_GET['sSearch'], "string");
            for ( $i=0 ; $i<count($columns) ; $i++ )
            {
                $where .= $columns[$i] . " LIKE '%". $search ."%' OR ";
            }
            $where = substr_replace( $where, "", -3 );
        }

        $order = "";
        if ( isset( $_GET['iSortCol_0'] ) )
        {
            for ( $i=0 ; $i< $_GET['iSortingCols']; $i++ )
            {
                if ( $_GET[ 'bSortable_' . $_GET['iSortCol_'.$i] ] == "true" )
                {
                    $order .= $columns[ $_GET['iSortCol_'.$i] ] . " " . $_GET['sSortDir_'.$i] .", ";
                }
            }
            $order = substr_replace( $order, "", -2 );
        }
        
        $limit = array("", "");
        if ( isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != -1 )
        {
            $limit = array($_GET['iDisplayLength'], $_GET['iDisplayStart']);
        }
        
        if (empty($where)) {
            $where = "true";
        }
        
        $query->where($whereCategory);
        $query->andWhere($where);
        $query->orderBy($order);
        $query->limit($limit[0], $limit[1]);
        $data = $query->execute();
        
        $category = Category::findFirst("idCategory = $idCategory");
        
        $iTotalRecords = $category->countItems();
        $iTotalDisplayRecords = $category->countItems(array("conditions" => $where));
        
        $json = array(
            "sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $iTotalRecords,
            "iTotalDisplayRecords" => $iTotalDisplayRecords,
            "aaData" => array()
        );
        
        
        foreach ($data as $item) {
            $row = array();
            
            $row['id'] = $item->idItem;
            $row['name'] = $item->name;
            $row['amount'] = $item->amount;
            $row['price'] = $item->price;
            
            $json['aaData'][] = $row;
        }
        
        echo json_encode($json);
    }
}