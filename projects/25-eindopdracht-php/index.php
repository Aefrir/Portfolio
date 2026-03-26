<?php
	session_start();
	$now = date('c');
    setcookie('lastVisit',$now, time()+31556926, '/');

	require_once 'vendor/autoload.php';

	$loader = new \Twig\Loader\FilesystemLoader('./templates');
	$twig = new \Twig\Environment($loader, []);
	$userModel = new UserModel('data/users.xml');
	$articleModel = new ArticleModel('data/article.xml', 'data/comments.xml');
	$commentModel = new CommentModel('data/comments.xml', $userModel);

	$articleController = new ArticleController($articleModel, $commentModel, $twig);
	$controller = new Controller($userModel, $twig, $articleController);

	if(isset($_POST['login'])){$controller->login(); exit;}
	elseif(isset($_POST['register'])){$controller->addUser(); exit;}
	elseif(isset($_POST['postArticle'])){$articleController->addArticle(); exit;}
	elseif(isset($_POST['updateArticle'])){$articleController->updateArticle(); exit;}
	elseif(isset($_POST['post-comment'])){$articleController->addComment(); exit;}
	elseif(isset($_POST['editArticle'])){
		$articleID = $_POST['article_id'];
		$articleController->editArticlePage($articleID);
		exit;
	}
	elseif(isset($_POST['deleteArticle'])){
		$slug = $_POST['deleteArticleSlug'];
		$category = $_POST['deleteArticleCategory'];
		$articleID = $_POST['article_id'];
		$articleModel->deleteArticle($slug, $category, $articleID);
		header('Location: ./home');
		exit;
	}
	elseif(isset($_POST['commentDelete'])){
		$slug = $_POST['deleteArticleSlug'];
		$category = $_POST['deleteArticleCategory'];
		$commentID = $_POST['commentID'];
		$deleteReason = $_POST['deleteReason'];
		$commentModel->deleteComment($commentID, $deleteReason);
		$articleController->renderArticle($category, $slug);
		exit;
	}
	elseif(isset($_GET['category']) && ($_GET['page'] ?? '') === 'articles'){
		$sort = $_GET['sort'] ?? 'new-old';
		$category = $_GET['category'] ?? 'all';
		$searchQuery = $_GET['search'] ?? '';
		$searchBy = $_GET['searchBy'] ?? [];
		$articleController->articleCatalog($category, $sort, $searchQuery, $searchBy);
		exit;
	}

	$page = $_GET['page'] ?? 'home';
	$routes = [
		'home' => [$articleController, 'home'],
		'articles' => [$articleController, 'articleCatalog'],
		'create-article' => [$articleController, 'createArticlePage'],
		'login' => [$controller,'loginPage'],
		'register' => [$controller,'registerPage'],
		'logout' => [$controller, 'logout'],
		'article' => [$articleController, 'article'],
	];

	if(isset($routes[$page])){
		[$controllerObj, $method] = $routes[$page];
		if ($page === 'article'){
			$category = $_GET['category'] ?? null;
			$slug = $_GET['slug'] ?? null;
			if ($category && $slug){
				$articleController->renderArticle($category, $slug);
				exit;
			}
		} 
		else{
			$controllerObj->$method();
			exit;
		}
	}
	
?>