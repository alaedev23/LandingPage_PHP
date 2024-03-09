<?php

class UserController extends Controller
{

    private $user;

    public function __construct(Contact $param = null)
    {
        parent::__construct();
        $this->user = (is_null($param)) ? new User("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "") : $param;
    }

    function login()
    {
        $lang = "es";

        if (isset($_POST["submit"])) {
            $frmUsername = $this->sanitize($_POST["username"]);
            $frmPassword = $this->sanitize($_POST["password"]);

            if (! filter_var($frmUsername, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "El email no es correcto";
            }
            if (strlen($frmPassword) == 0) {
                $errors["password"] = "Introduce contraseña";
            }

            $this->user = new User("", $frmUsername, $frmPassword, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

            if (! isset($errors)) {
                $mContacte = new UserModel();
                $returnedUser = $mContacte->read($this->user);

                if ($returnedUser !== null) {
                    $mContacte->updateDate($this->user->getEmail());

                    $_SESSION["logued_user"] = $returnedUser;

                    header("Location: index.php");
                    exit();
                } else {
                    $missatge = "No existen dichas credenciales";
                }
            }
        }

        LoginView::show($lang, $errors, $missatge);
    }

    function showForm()
    {
        RegisterView::show("es", $errors, $missatge);
    }

    function register()
    {
        $lang = "es";

        if ((isset($_POST["submit"]))) {

            $misssatge = "";

            $frmUsername = $this->sanitize($_POST["username"]);
            $frmPassword = $this->sanitize($_POST["password"]);

            $frmTipus = $this->sanitize($_POST["tipusIdent"]);
            $frmDNI = $this->sanitize($_POST["dni"]);
            $frmNom = $this->sanitize($_POST["nom"]);
            $frmCognoms = $this->sanitize($_POST["cognoms"]);
            $frmData = $_POST["dataNaixement"];
            $frmSexe = $this->sanitize($_POST["sexe"]);

            $frmAdreca = $this->sanitize($_POST["adreca"]);
            $frmCodiPostal = $this->sanitize($_POST["codiPostal"]);
            $frmpoblacio = $this->sanitize($_POST["poblacio"]);
            $frmProvincia = $this->sanitize($_POST["provincia"]);
            $frmTelefon = $this->sanitize($_POST["telefon"]);

            if (! filter_var($frmUsername, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "El email no es correcto";
            }
            if (strlen($frmPassword) == 0) {
                $errors["password"] = "Introduce constraseña";
            }

            if (! in_array($frmTipus, [
                'DNI',
                'NIE',
                'Passport'
            ])) {
                $errors["tipusIdent"] = "Tipo Incorrecto";
            }
            if (strlen($frmDNI) != 9) {
                $errors["dni"] = "Identificacion Incorrecte";
            }
            if (strlen($frmNom) == 0) {
                $errors["nom"] = "Introduce nombre";
            }
            if (strlen($frmCognoms) == 0) {
                $errors["cognom"] = "Introduce apellido";
            }
            if (strlen($frmCognoms) == 0) {
                $errors["dataNaixement"] = "Fecha incorrecta";
            }
            if (! in_array($frmSexe, [
                'Masc',
                'Feme',
                'Otro'
            ])) {
                $errors["sexe"] = "Sexo incorrecto";
            }

            if (! empty($frmAdreca) && is_numeric($frmAdreca)) {
                $errors["adreca"] = "Direccion incorrecta";
            }
            if (! empty($frmCodiPostal) && is_numeric($frmCodiPostal)) {
                if (strlen($frmCodiPostal) != 5) {
                    $errors["codiPostal"] = "Codigo Postal incorrecto";
                }
            }
            if (! empty($frmpoblacio) && is_numeric($frmpoblacio)) {
                $errors["poblacio"] = "Poblacion incorrecta";
            }
            if (! empty($frmProvincia) && strlen($frmProvincia) == 0) {
                $errors["provincia"] = "Introduce provincia";
            }
            if (! empty($frmTelefon) && strlen($frmTelefon) != 9) {
                $errors["telefon"] = "Telefono incorrecto";
            }

            if ($this->userExists($frmUsername)) {
                $errors["username"] = "El usuario ya existe. Por favor, elige otro correo electrónico.";
                RegisterView::show($lang, $errors);
                return;
            }

            $frmImatge = $_FILES;
            $fileExt = $this->validateImageFile($frmImatge, $errors);

            $targetDirectory = "usersIMG/";
            $targetFile = $targetDirectory . $frmUsername . "." . $fileExt;

            move_uploaded_file($_FILES["imatge"]["tmp_name"], $targetFile);

            if (! isset($errors)) {

                $stringDate = date("Y-m-d H:i:s");

                $this->user = new User("", $frmUsername, $frmPassword, $frmTipus, $frmDNI, $frmNom, $frmCognoms, $frmData, $frmSexe, $targetFile, $stringDate, $stringDate, $frmAdreca, $frmCodiPostal, $frmpoblacio, $frmProvincia, $frmTelefon, 0, $this->getBrowser(), $this->getPlatform());

                $email = $this->user->getEmail();

                $mContacte = new UserModel();

                $mContacte->create($this->user);

                $this->contacte = new User("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

                $auth = new AutenticateController();
                $auth->show($email);
            } else {
                RegisterView::show($lang, $errors, $missatge);
            }
        } else {
            RegisterView::show($lang, $errors, $missatge);
        }
    }

    function validateImageFile($file, &$errors = null)
    {
        if (! isset($file['imatge']['tmp_name']) || ! is_uploaded_file($file['imatge']['tmp_name'])) {
            $errors['imatge'] = "No se ha seleccionado ningún archivo.";
            return;
        }

        $fileName = $file['imatge']['name'];
        $fileSize = $file['imatge']['size'];
        $fileType = $file['imatge']['type'];

        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowedExtensions = [
            'png'
        ];
        $maxFileSize = 2 * 1024 * 1024;
        $allowedMimeTypes = [
            'image/png'
        ];

        if (! in_array(strtolower($fileExt), $allowedExtensions)) {
            $errors['imatge'] = "El archivo debe ser una imagen con las extensiones permitidas: " . implode(', ', $allowedExtensions);
        } elseif ($fileSize > $maxFileSize) {
            $errors['imatge'] = "El tamaño del archivo excede el límite permitido (2MB).";
        } elseif (! in_array(strtolower($fileType), $allowedMimeTypes)) {
            $errors['imatge'] = "El tipo de archivo no es una imagen válido.";
        }

        return $fileExt;
    }

    function userExists($email)
    {
        $mContacte = new UserModel();
        $existingUser = $mContacte->getUserByEmail($email);

        return ($existingUser !== null);
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    function getBrowser()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browserInfo = get_browser($userAgent, true);

        if (! empty($browserInfo['browser'])) {
            return $browserInfo['browser'];
        } else {
            return "null";
        }
    }

    function getPlatform()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browserInfo = get_browser($userAgent, true);

        if (! empty($browserInfo['browser'])) {
            return $browserInfo['platform'];
        } else {
            return "null";
        }
    }
}