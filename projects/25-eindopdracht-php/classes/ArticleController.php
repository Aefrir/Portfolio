<?php
    class ArticleController extends Controller{
        private articleModel $articleModel;
        private commentModel $commentModel;
        private $twig;

        public function __construct(articleModel $articleModel, commentModel $commentModel, $twig){
            $this->articleModel = $articleModel;
            $this->commentModel = $commentModel;
            $this->twig = $twig;

            $lastVisit = $_COOKIE['lastVisit'] ?? null;
            $username = $_SESSION['username'] ?? null;
            $this->twig->addGlobal('lastVisit', $lastVisit);
            $this->twig->addGlobal('username', $username);
        }

        public function home(): void{
            $articlesFromXML = $this->articleModel->getArticlesFromXML();
            $commentsFromXML = $this->commentModel->getCommentsFromXML();
            $articleData = $this->articleModel->sortArticles($articlesFromXML);
            $commentsData = $this->articleModel->sortArticles($commentsFromXML);
            echo $this->twig->render('home.html', [
                'articles' => $articleData,
                'comments' => $commentsData,
            ]);
        }

        public function articleCatalog(string $category = '', string $sort = 'new-old', string $searchQuery = '', array $searchBy = []): void{
            $articlesFromXML = $this->articleModel->getArticlesFromXML();

            // SearchBy = search by author, title and/or content
            if($searchQuery !== '' && !empty($searchBy)){
                $filteredArticles = array_filter($articlesFromXML, function($article) use ($searchQuery, $searchBy){
                    foreach ($searchBy as $checkBoxField){
                        if ($article[$checkBoxField] && str_contains(strtolower($article[$checkBoxField]), strtolower($searchQuery))){
                            return true;
                        }
                    }
                    return false;
                });
            }
            else{
                $filteredArticles = $articlesFromXML;
            }
            
            if ($category !== '' && $category !== 'All'){
                $filteredArticles = array_filter($filteredArticles, function($article) use ($category){
                    return isset($article['category']) && $article['category'] === $category;
                });
            }
            $articleData = $this->articleModel->sortArticles($filteredArticles, $sort);

            // Pagination
            if (isset($_GET["pageNumber"])) { 
                $pn = $_GET["pageNumber"]; 
            } 
            else { 
                $pn = 1; 
            }; 

            $limit = 10;
            $articleCount = count($articleData);
            $totalPageNumbers = ceil($articleCount / $limit);
            $pagination = '';
            $pn = max(1, (int)$pn);
            $offset = ($pn - 1) * $limit;
            $articleData = array_slice($articleData, $offset, $limit);

            for ($i=1; $i<=$totalPageNumbers; $i++){
                $queryParameters = [
                    'searchBy' => $searchBy,
                    'search' => $searchQuery,
                    'sort' => $sort,
                    'category' => $category,
                    'pageNumber' => $i
                ];

                if ($i==$pn){
                    $pagination .= "<li class='active button'><a class='page-number' href='articles?".http_build_query($queryParameters)."'>$i</a></li>";
                }            
                else{
                    $pagination .= "<li class='button'><a class='page-number' href='articles?".http_build_query($queryParameters)."'>$i</a></li>";
                }
            };

            echo $this->twig->render('articleCatalog.html', [
                'articles' => $articleData,
                'totalArticles' => $articleCount,
                'category' => $category,
                'sort' => $sort,
                'searchBy' => $searchBy,
                'search' => $searchQuery,
                'pagination' => $pagination,
            ]);
        }

        public function createArticlePage(array $errors = []): void{
            $this->requireLogin();
            echo $this->twig->render('createArticle.html', [
                'errors' => $errors
            ]);
        }

        public function renderArticle(string $category, string $slug, array $errors = []): void{
            $commentData = $this->commentModel->getCommentsFromXML();
            $articles = $this->articleModel->getArticlesFromXML();
            $articleFound = null;

            foreach($articles as $article){
                if ($article['titleslug'] === $slug && strtolower($article['categoryslug']) === strtolower($category)) {
                    $articleFound = $article;
                    break;
                }
            }
            
            if($articleFound){
                echo $this->twig->render('article.html', [
                    'comments' => $commentData,
                    'article' => $articleFound,
                    'errors' => $errors
                ]);
            }
        }
        
        public function editArticlePage(string $articleID, array $errors = []): void{
            $article = $this->articleModel->getArticleByID($articleID);
            echo $this->twig->render('createArticle.html', [
                'article' => $article,
                'errors' => $errors,
                'editMode' => true
            ]);
        }

        public function updateArticle(): void{
            $articleContent = [];
            $articleContent['id'] = $_POST['article_id'];
            $articleContent['title'] = $_POST['title'];
            $articleContent['category'] = $_POST['category'];
            $articleContent['text'] = $_POST['articleText'];
            $articleContent['excerpt'] = mb_substr($articleContent['text'], 0, 200);

            if(isset($_FILES['articleImage']) && $_FILES['articleImage']['error'] === UPLOAD_ERR_OK){
                $file = $_FILES['articleImage'];
                $uploadDir = 'uploads/';
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $articleContent['fileName'] = uniqid() . '.' . $extension;
                move_uploaded_file($file['tmp_name'], $uploadDir . $articleContent['fileName']);
            }
            else{
                $articleContent['fileName'] = $_POST['existingImage'];
            }
            $this->articleModel->updateArticleInXML($articleContent);
            $this->home();
            exit;
        }

        public function addArticle(): void{
            $articleContent = [];
            $articleContent['username'] = $_SESSION['username'] ?? null;
            $articleContent['email'] = '';
            $articleContent['date'] = date('c');
            $errors = [];

            if(!empty($_POST['title'])){
                $articleContent['title'] = $_POST['title'];
            }
            else{
                $errors[] = 'Title is required';
            }
            
            if(isset($_FILES['articleImage']) && $_FILES['articleImage']['error'] === UPLOAD_ERR_OK){
                $file = $_FILES['articleImage'];
                $uploadDir = 'uploads/';
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $articleContent['fileName'] = uniqid() . '.' . $extension;
                move_uploaded_file($file['tmp_name'], $uploadDir . $articleContent['fileName']);
            }
            else{
                $articleContent['fileName'] = 'not-found.png';
            }
            if(isset($_POST['category'])) {
                $articleContent['category'] = $_POST['category'];
            }
            else{
                $errors[] = 'No category selected';
            }
            if(!empty($_POST['articleText'])){
                $articleContent['text'] = $_POST['articleText'];
                $articleContent['excerpt'] = mb_substr($articleContent['text'], 0, 200);
            }
            else{
                $errors[] = 'Article cannot be empty';
            }

            if(empty($errors)){
                if(!empty($this->filterContent($articleContent['title'])) || !empty($this->filterContent($articleContent['text']))){
                    $errors[] = 'Article contains inappropriate content.';
                    $this->createArticlePage($errors);
                    exit;
                }
                $this->articleModel->addArticleToXML($articleContent);
                // $this->home();
                header('Location: ./home');
            }
            else{
                $this->createArticlePage($errors);
            }
        }

        // Comments
        public function addComment(): void{
            $commentContent = [
                'article_id' => $_POST['article_id'],
                'parent_id' => $_POST['parent_id'],
                'username' => $_SESSION['username'] ?? 'Guest',
                'date' => date('c')
            ];

            $category = $_POST['category'];
            $slug = $_POST['slug'];

            $errors = [];

            if(!empty($_POST['comment'])){
                $commentContent['text'] = $_POST['comment'];
                $commentContent['excerpt'] = mb_substr($commentContent['text'], 0, 100);
            }
            else{
                $errors[] = 'You cannot post an empty comment.';
            }

            if(empty($errors)){
                if (!empty($this->filterContent($commentContent['text']))){
                    $errors[] = 'Comment contains inappropriate content.';
                }

                $this->commentModel->addCommentToXML($commentContent);
                $this->commentModel->sendEmailToAuthor($commentContent, $commentContent['article_id']);
                $this->renderArticle($category, $slug);
            }
            else{
                $this->renderArticle($category, $slug, $errors);
            }
        }
        
        public function filterContent(string $content): bool{
            $NSFL = [67, 'kys', 'skibidi', 'retard', 'cancer', 'fuck', 'ching chong', 'roblox', 'cunt', 'fag'];
            foreach($NSFL as $word){
                if(preg_match("/$word/", $content)){
                    return true;
                }
            }
            return false;
        }
    }
?>