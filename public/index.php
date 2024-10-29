<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require '../src/vendor/autoload.php';

$app = new \Slim\App;
$dbConfig = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'library'
];

$tokenStore = [];

function createToken() {
    $key = 'server_hack';
    $issuedAt = time();
    $expiry = $issuedAt + 3600;
    $payload = [
        'iss' => 'http://library.org',
        'aud' => 'http://library.com',
        'iat' => $issuedAt,
        'exp' => $expiry,
    ];
    return JWT::encode($payload, $key, 'HS256');
}

$app->post('/user/register', function (Request $request, Response $response) use ($dbConfig) {
    $inputData = json_decode($request->getBody());
    $username = $inputData->username;
    $password = $inputData->password;

    try {
        $dbConnection = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']}", $dbConfig['user'], $dbConfig['pass']);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $hashedPass = password_hash($password, PASSWORD_BCRYPT);
        $insertSQL = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $statement = $dbConnection->prepare($insertSQL);
        $statement->execute([':username' => $username, ':password' => $hashedPass]);
        $response->getBody()->write(json_encode(["status" => "success", "data" => null]));

    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "data" => ["title" => $error->getMessage()]]));
    }

    $dbConnection = null;
    return $response;
});

$app->post('/user/auth', function (Request $request, Response $response) use ($dbConfig) {
    $inputData = json_decode($request->getBody());
    $username = $inputData->username;
    $password = $inputData->password;

    try {
        $dbConnection = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']}", $dbConfig['user'], $dbConfig['pass']);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fetchSQL = "SELECT * FROM users WHERE username = :username";
        $statement = $dbConnection->prepare($fetchSQL);
        $statement->execute([':username' => $username]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $userRecord = $statement->fetch();

        if ($userRecord && password_verify($password, $userRecord['password'])) {
            $accessToken = createToken();
            storeTokenInMemory($accessToken);
            $response->getBody()->write(json_encode([
                "status" => "success",
                "access_token" => $accessToken,
                "data" => null
            ]));
        } else {
            $response->getBody()->write(json_encode(["status" => "fail", "data" => ["title" => "Authentication Failed"]]));
        }

    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "data" => ["title" => $error->getMessage()]]));
    }

    $dbConnection = null;
    return $response;
});

function storeTokenInMemory($token) {
    global $tokenStore;
    $tokenStore[$token] = ['used' => false];
}

function tokenMiddleware($request, $response, $next) {
    global $tokenStore;
    $inputData = json_decode($request->getBody(), true);

    if (!isset($inputData['token'])) {
        return $response->withStatus(401)->write(json_encode(["status" => "fail", "message" => "Token missing"]));
    }

    $token = $inputData['token'];
    $key = 'server_hack';

    try {
        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        if ($decoded->exp < time()) {
            return $response->withStatus(401)->write(json_encode(["status" => "fail", "message" => "Token expired"]));
        }

        if (isset($tokenStore[$token]) && $tokenStore[$token]['used']) {
            return $response->withStatus(401)->write(json_encode(["status" => "fail", "message" => "Token already used or invalid"]));
        }

    } catch (Exception $e) {
        return $response->withStatus(401)->write(json_encode(["status" => "fail", "message" => "Unauthorized"]));
    }

    return $next($request, $response);
}

function markTokenAsUsed($token) {
    global $tokenStore;
    if (isset($tokenStore[$token])) {
        $tokenStore[$token]['used'] = true;
    }
}

function respondWithToken(Response $response) {
    $newToken = createToken();
    storeTokenInMemory($newToken);
    return $response->withHeader('New-Access-Token', $newToken);
}

$app->post('/authors', function (Request $request, Response $response) {
    $data = json_decode($request->getBody(), true);
    $authorName = $data['name'];

    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $insertSQL = "INSERT INTO authors (name) VALUES (:name)";
        $statement = $dbConnection->prepare($insertSQL);
        $statement->execute([':name' => $authorName]);
        markTokenAsUsed($data['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Author created successfully", "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error creating author: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->get('/authors/get', function (Request $request, Response $response) {
    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $querySQL = "SELECT * FROM authors";
        $statement = $dbConnection->query($querySQL);
        $authors = $statement->fetchAll(PDO::FETCH_ASSOC);
        markTokenAsUsed($request->getParsedBody()['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Authors retrieved successfully", "data" => $authors, "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error retrieving authors: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->put('/authors/update/{id}', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody(), true);
    $authorId = $args['id'];
    $authorName = $data['name'];

    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $updateSQL = "UPDATE authors SET name = :name WHERE authorid = :id";
        $statement = $dbConnection->prepare($updateSQL);
        $statement->execute([':name' => $authorName, ':id' => $authorId]);
        markTokenAsUsed($data['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Author updated successfully", "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error updating author: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->delete('/authors/delete/{id}', function (Request $request, Response $response, array $args) {
    $authorId = $args['id'];

    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $deleteSQL = "DELETE FROM authors WHERE authorid = :id";
        $statement = $dbConnection->prepare($deleteSQL);
        $statement->execute([':id' => $authorId]);
        markTokenAsUsed($request->getParsedBody()['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Author deleted successfully", "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error deleting author: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->post('/books', function (Request $request, Response $response) {
    $data = json_decode($request->getBody(), true);
    $bookTitle = $data['title'];
    $authorId = $data['author_id'];

    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $insertSQL = "INSERT INTO books (title, authorid) VALUES (:title, :authorid)";
        $statement = $dbConnection->prepare($insertSQL);
        $statement->execute([':title' => $bookTitle, ':authorid' => $authorId]);
        markTokenAsUsed($data['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Book created successfully", "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error creating book: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->get('/books/get', function (Request $request, Response $response) {
    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $querySQL = "SELECT * FROM books";
        $statement = $dbConnection->query($querySQL);
        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
        markTokenAsUsed($request->getParsedBody()['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Books retrieved successfully", "data" => $books, "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error retrieving books: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->put('/books/update/{id}', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody(), true);
    $bookId = $args['id'];
    $bookTitle = $data['title'];
    $authorId = $data['author_id'];

    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $updateSQL = "UPDATE books SET title = :title, authorid = :authorid WHERE bookid = :id";
        $statement = $dbConnection->prepare($updateSQL);
        $statement->execute([':title' => $bookTitle, ':authorid' => $authorId, ':id' => $bookId]);
        markTokenAsUsed($data['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Book updated successfully", "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error updating book: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->delete('/books/delete/{id}', function (Request $request, Response $response, array $args) {
    $bookId = $args['id'];

    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $deleteSQL = "DELETE FROM books WHERE bookid = :id";
        $statement = $dbConnection->prepare($deleteSQL);
        $statement->execute([':id' => $bookId]);
        markTokenAsUsed($request->getParsedBody()['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Book deleted successfully", "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error deleting book: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->post('/books_authors', function (Request $request, Response $response) {
    $data = json_decode($request->getBody(), true);
    $bookId = $data['book_id'];
    $authorId = $data['author_id'];

    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $insertSQL = "INSERT INTO books_authors (bookid, authorid) VALUES (:bookid, :authorid)";
        $statement = $dbConnection->prepare($insertSQL);
        $statement->execute([':bookid' => $bookId, ':authorid' => $authorId]);
        markTokenAsUsed($data['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Book-Author relation created successfully", "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error creating relation: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->get('/books_authors/get', function (Request $request, Response $response) {
    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $querySQL = "SELECT * FROM books_authors";
        $statement = $dbConnection->query($querySQL);
        $relations = $statement->fetchAll(PDO::FETCH_ASSOC);
        markTokenAsUsed($request->getParsedBody()['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Relations retrieved successfully", "data" => $relations, "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error retrieving relations: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->delete('/books_authors/delete/{id}', function (Request $request, Response $response, array $args) {
    $relationId = $args['id'];

    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=library", "root", "");
        $deleteSQL = "DELETE FROM books_authors WHERE id = :id";
        $statement = $dbConnection->prepare($deleteSQL);
        $statement->execute([':id' => $relationId]);
        markTokenAsUsed($request->getParsedBody()['token']);
        $response = respondWithToken($response);
        $response->getBody()->write(json_encode(["status" => "success", "message" => "Relation deleted successfully", "access_token" => $response->getHeader('New-Access-Token')[0]]));
    } catch (PDOException $error) {
        $response->getBody()->write(json_encode(["status" => "fail", "message" => "Error deleting relation: " . $error->getMessage()]));
    }
    return $response;
})->add('tokenMiddleware');

$app->run();
