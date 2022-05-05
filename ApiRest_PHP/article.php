<?php
  // Se connecter à la base de données
  include("connection.php");
  $request_method = $_SERVER["REQUEST_METHOD"];
  
  function getArticles()
  {
    global $conn;
    $query = "SELECT * FROM article";
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }
  
  function getArticle($id=0)
  {
    global $conn;
    $query = "SELECT * FROM article";
    if($id != 0)
    {
      $query .= " WHERE id=".$id." LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }
  
  function AddArticle()
  {
    global $conn;
    $title = $_POST["title"];
    $description = $_POST["description"];
    $published = $_POST["published"];
    echo $query="INSERT INTO article(title, description, published) VALUES('".$title."', '".$description."', '".$published."')";
    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'Produit ajoute avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'ERREUR!.'. mysqli_error($conn)
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }
  
  function updateArticle($id)
  {
    global $conn;
    $_PUT = array(); //tableau qui va contenir les données reçues
    parse_str(file_get_contents('php://input'), $_PUT);
    $title = $_PUT["title"];
    $description = $_PUT["description"];
    $published = $_PUT["published"];
    //construire la requête SQL
    $query="UPDATE article SET title='".$title."', description='".$description."', published='".$published."' WHERE id=".$id;
    
    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'Produit mis a jour avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'Echec de la mise a jour de produit. '. mysqli_error($conn)
      );
      
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
  }
  
  function deleteArticle($id)
  {
    global $conn;
    $query = "DELETE FROM article WHERE id=".$id;
    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'Produit supprime avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'La suppression du produit a echoue. '. mysqli_error($conn)
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }
  
  switch($request_method)
  {
    case 'GET':
      if(!empty($_GET["id"]))
      {
        // Récupérer un seul article
        $id = intval($_GET["id"]);
        getArticle($id);
      }
      else
      {
        // Récupérer tous les articles
        getArticles();
      }
      break;
    default:
      // Requête invalide
      header("HTTP/1.0 405 Method Not Allowed");
      break;
      
      case 'POST':
        // Ajouter un produit
        AddArticle();
        break;
      
      case 'PUT':
        // Modifier un produit
        $id = intval($_GET["id"]);
        updateArticle($id);
        break;
      
        case 'DELETE':
          // Supprimer un produit
          $id = intval($_GET["id"]);
          deleteArticle($id);
          break;
  }
?>