<?php
    use MySql\DataMapper\Repository;
    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;

    require_once dirname(__DIR__) . '/vendor/autoload.php';

    $loader = new FilesystemLoader(__DIR__ . '/template');
    $twig = new Environment($loader);
    $repo = new Repository();

    $searchID = $_POST['searchID'];
    $searchValue = $_POST['value'];
    $deleteID = $_POST['delID'];
    $addName = $_POST['addName'];
    $addAge = $_POST['addAge'];

    $friends = "";
    if (isset($_POST['searchIDButton']))
    {
        $friends = $repo->findById($searchID);
    }

    if (isset($_POST['searchValueButton']))
    {
        if (is_int((int)$searchValue) && (int)$searchValue !== 0) {
            $searchValue = (int)$searchValue;
        }
        $friends = $repo->findByValue($searchValue);
    }

    if (isset($_POST['delIDButton']))
    {
        $repo->delHuman($deleteID);
    }

    if (isset($_POST['addButton']))
    {
        $repo->addHuman($addName, $addAge);
    }

    try {
        echo $twig->render('tableFriends.twig', [
            'friends' => $repo,
            'searchData' => $friends,
        ]);
    } catch (Exception $exception) {
        die ('ERROR: ' . $exception->getMessage());
    }



