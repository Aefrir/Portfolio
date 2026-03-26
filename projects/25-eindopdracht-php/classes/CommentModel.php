<?php
    class CommentModel{
        private string $file;
        private userModel $userModel;
        private SimpleXMLElement $resource;

        public function __construct(string $file, userModel $userModel){
            $this->userModel = $userModel;
            $this->file = $file;
            $xmlString = file_get_contents($this->file);
            $xmlString = str_replace('&nbsp;', ' ', $xmlString);
            $this->resource = new SimpleXMLElement($xmlString);
        }

        public function addCommenttoXML(array $commentData): void{
            $ip = $_SERVER['REMOTE_ADDR'];
            $newComment = $this->resource->addChild('comment');
            $newComment->addChild('article_id', htmlspecialchars($commentData['article_id']));
            $newComment->addChild('id', uniqid());
            $newComment->addChild('parent_id', htmlspecialchars($commentData['parent_id'] ?? 0));
            $newComment->addChild('ip', $ip);
            $newComment->addChild('username', htmlspecialchars($commentData['username']));
            $newComment->addChild('date', htmlspecialchars($commentData['date']));
            $newComment->addChild('text', $commentData['text']);
            $newComment->addChild('excerpt', $commentData['excerpt']);
            $this->resource->asXML($this->file);
        }

        public function sendEmailToAuthor(array $commentContent, string $articleID): void{
            $articleData = simplexml_load_file('data/article.xml');
            foreach($articleData->article as $article){
                if((string)$article->id === (string)$articleID){
                    $authorUsername = (string)$article->author;
                }
            }
            $authorEmail = $this->userModel->getUserEmail($authorUsername);
            $subject = 'Comment received on your article.';
            $text = "{$commentContent['username']} commented on your article: {$commentContent['text']}";
            $html = "<p><strong>{$commentContent['username']}</strong> commented on your article:</p> <p>{$commentContent['text']}</p>";;
            MailHelper::sendMail($authorEmail, $subject, $text, $html);
        }
        
        public function getCommentsFromXML(): array{
            $comments = [];
            foreach($this->resource->comment as $comment){
                $comments[] = [
                    'article_id' => (string)$comment->article_id,
                    'id' => (string)$comment->id,
                    'parent_id' => (string)$comment->parent_id,
                    'ip' => (string)$comment->ip,
                    'username' => (string)$comment->username,
                    'date' => (string)$comment->date,
                    'text' => (string)$comment->text,
                    'excerpt' => (string)$comment->excerpt,
                ];
            }
            arsort($comments);
            return $comments;
        }

        public function deleteComment(string $commentID, string $deleteReason): bool{
            foreach ($this->resource->comment as $comment){
                if ((string)$comment->id === $commentID){
                    $comment->username = '[deleted]';
                    $comment->text = '<p>This comment has been removed because of '.$deleteReason.'</p>';
                    $this->resource->asXML($this->file);
                    return true;
                }
            }
            return false;
        }
    }
?>