<?php
    class ArticleModel{

        // private string $file;
        // private SimpleXMLElement $resource;

        // public function __construct(string $file){
        //     $this->file = $file;
        //     $xmlString = file_get_contents($this->file);
        //     $xmlString = str_replace('&nbsp;', ' ', $xmlString);
        //     $this->resource = new SimpleXMLElement($xmlString);
        // }

        private string $articleXML;
        private string $commentXML;
        private SimpleXMLElement $articleData;
        private SimpleXMLElement $commentData;
        

        public function __construct(string $articleXML, string $commentXML){
            $this->articleXML = $articleXML;
            $articleData = file_get_contents($this->articleXML);
            $articleData = str_replace('&nbsp;', ' ', $articleData);
            $this->articleData = new SimpleXMLElement($articleData);

            $this->commentXML = $commentXML;
            $commentData = file_get_contents($this->commentXML);
            $commentData = str_replace('&nbsp;', ' ', $commentData);
            $this->commentData = new SimpleXMLElement($commentData);
        }

        public function getArticlesFromXML(): array{
            $articles = [];

            foreach($this->articleData->article as $article){
                $articles[] = [
                    'id' => (string)$article->id,
                    'title' => (string)$article->title,
                    'titleslug' => strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', (string)$article->title)),
                    'categoryslug' => strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', (string)$article->category)),
                    'author' => (string)$article->author,
                    'date' => (string)$article->date,
                    'category' => (string)$article->category,
                    'image' => (string)$article->image,
                    'text' => (string)$article->text,
                    'excerpt' => (string)$article->excerpt
                ];
            }
            return $articles;
        }  

        public function addArticleToXML(array $articleXML): void{
            $newArticle = $this->articleData->addChild('article');
            $newArticle->addChild('id', uniqid());
            $newArticle->addChild('title', $articleXML['title']);
            $newArticle->addChild('author', $articleXML['username']);
            $newArticle->addChild('date', $articleXML['date']);
            $newArticle->addChild('category', $articleXML['category']);
            $newArticle->addChild('image', $articleXML['fileName']);
            $newArticle->addChild('text', $articleXML['text']);
            $newArticle->addChild('excerpt', $articleXML['excerpt']);
            $this->articleData->asXML($this->articleXML);
        }

        public function deleteArticle(string $slug, string $category, string $articleID): bool{
            for($i = 0; $i < count($this->articleData->article); $i++){
                $titleSlug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', (string)$this->articleData->article[$i]->title));
                $categorySlug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', (string)$this->articleData->article[$i]->category));

                if ($titleSlug === $slug && $categorySlug === $category){
                    for ($x = count($this->commentData->comment) - 1; $x >= 0; $x--) {
                        $articleIDFromXML = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '', (string)$this->commentData->comment[$x]->article_id));
                        if($articleIDFromXML === $articleID){
                            unset($this->commentData->comment[$x]);
                            $this->commentData->asXML($this->commentXML);
                        }
                    }
                    unset($this->articleData->article[$i]);
                    $this->articleData->asXML($this->articleXML);
                    return true;
                }
            }
            return false;
        }

        public function getArticleByID(string $id): ?array{
            foreach ($this->articleData->article as $article){
                if ((string)$article->id === $id){
                    return [
                        'id' => (string)$article->id,
                        'title' => (string)$article->title,
                        'titleslug' => strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', (string)$article->title)),
                        'categoryslug' => strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', (string)$article->category)),
                        'author' => (string)$article->author,
                        'date' => (string)$article->date,
                        'category' => (string)$article->category,
                        'image' => (string)$article->image,
                        'text' => (string)$article->text,
                        'excerpt' => (string)$article->excerpt
                    ];
                }
            }
            return null;
        }

        public function updateArticleInXML(array $articleXML): bool{
            foreach ($this->articleData->article as $article) {
                if ((string)$article->id === $articleXML['id']){
                    $article->title = $articleXML['title'];
                    $article->category = $articleXML['category'];
                    $article->image = $articleXML['fileName'];
                    $article->text = $articleXML['text'];
                    $article->excerpt = $articleXML['excerpt'];
                    $this->articleData->asXML($this->articleXML);
                    return true;
                }
            }
            return false;
        }

        public function sortArticles(array $articles, string $sort = 'new-old'): array{
            usort($articles, function ($a, $b) use ($sort){
                switch ($sort) {
                    case 'old-new':
                        return strtotime($a['date']) <=> strtotime($b['date']);
                    case 'new-old':
                        return strtotime($b['date']) <=> strtotime($a['date']);
                    case 'a-z':
                        return strtolower($a['author']) <=> strtolower($b['author']);
                    case 'z-a':
                        return strtolower($b['author']) <=> strtolower($a['author']);
                    default:
                        return 0;
                }
            });
            return $articles;
        }
    }
?>