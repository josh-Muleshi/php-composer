<?php
require_once 'vendor/autoload.php';
use App\{
    Button,
    Checkbox,
    Cookie,
    Form,
    Input,
    Radio,
    Select,
    Session,
    Textarea
};

Session::start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Session::set('name', $_POST['name']);
    Session::set('email', $_POST['email']);
    Session::set('comments', $_POST['comments']);
    Session::set('country', $_POST['country']);
    Session::set('newsletter', isset($_POST['newsletter']) ? 'Yes' : 'No');
    Session::set('gender', $_POST['gender']);

    Cookie::set('username', $_POST['name'], 3600);

    if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
        $uploadDirectory = 'uploads';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }
        move_uploaded_file($_FILES['document']['tmp_name'], $uploadDirectory . '/' . $_FILES['document']['name']);
    }

    header('Location: resume.php');
    exit;
}

$name = Session::get('name', '');
$email = Session::get('email', '');
$comments = Session::get('comments', '');
$country = Session::get('country', '');
$newsletter = Session::get('newsletter', '');
$gender = Session::get('gender', '');

$username = Cookie::get('username', 'M/Mme');

$form = new Form('index.php', 'POST');
$form->addElement(new Input('text', 'name', $name, ['placeholder' => 'Nom']));
$form->addElement(new Input('email', 'email', $email, ['placeholder' => 'Email']));
$form->addElement(new Textarea('comments', $comments, ['placeholder' => 'Commentaires']));

$countries = ['cd' => 'rdc', 'us' => 'USA', 'uk' => 'UK'];
$form->addElement(new Select('country', $countries, ['value' => $country]));

$form->addElement(new Checkbox('newsletter', 'yes', $newsletter === 'Yes', ['label' => 'S\'abonner à la newsletter']));

$genders = ['male' => 'Homme', 'female' => 'Femme', 'other' => 'Autre'];
foreach ($genders as $value => $label) {
    $form->addElement(new Radio('gender', $value, $gender === $value, ['label' => $label]));
}

$form->addElement(new Input('file', 'document'));
$form->addElement(new Button('submit', 'Soumettre'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact Avancé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Formulaire de Contact</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?home.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php?show.php">Show</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container" style="padding-top: 100px">
        <div class="bg-light p-5 rounded">
            <h1>Bienvenue, <?php echo htmlspecialchars($username); ?>!</h1>
            <?php echo $form->render(); ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>