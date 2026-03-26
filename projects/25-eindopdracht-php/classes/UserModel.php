<?php
class UserModel{
    private string $file;
    private SimpleXMLElement $resource;

    public function __construct(string $file){
        $this->file = $file;
        $this->resource = new SimpleXMLElement('./data/users.xml', 0, true);
    }

    public function verifyUser(string $username, string $password): bool{
        $xml = simplexml_load_file($this->file);
        foreach ($xml->user as $user){
            if ((string)$user->username === $username && (string)$user->password === $password){
                return true;
            }
        }
        return false;
    }

    public function addUserToXML(array $userCredentials): void{
        $newUser = $this->resource->addChild('user');
        $newUser->addChild('id', uniqid());
        $newUser->addChild('email', $userCredentials['email']);
        $newUser->addChild('username', $userCredentials['username']);
        $newUser->addChild('password', $userCredentials['password']);
        $this->resource->asXML($this->file);
    }

    public function getUserEmail(string $username): string|null{
        foreach ($this->resource->user as $user){
            if ((string)$user->username === $username){
                return (string)$user->email;
            }
        }
        return null;
    }
}
?>