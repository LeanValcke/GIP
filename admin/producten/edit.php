<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>

<?php
ini_set('upload_max_filesize', '10M');
ini_set('file_uploads', 'On');
//ini_set('upload_tmp_dir', '/tmp');

//var_dump(sys_get_temp_dir ( ));
//
//var_dump($_POST);
//var_dump($_FILES);
//die();

// Initialiseren variabelen voor form zonder data
$productid = NULL;
$data = [
    'id' => NULL,
    'prijs' => NULL,
    'gamenaam' => NULL,
    'merchnaam' => NULL,
    'foto' => NULL,
    'beschrijving' => NULL,
    'gameid' => 0,
    'aantal' => 0,
];
$gameafdelingen = array();
$recordsaved = FALSE; // Wordt TRUE als bij reload een record werd gesaved (voor notificatie in html)
$validationError = FALSE;

// Data ophalen voor drop-down
$sql = "SELECT tblgameafdeling.GameID AS gameid, tblgameafdeling.Gamenaam AS gamenaam FROM tblgameafdeling";
$record = $dbh->query($sql);
$gameafdelingen = $record->fetchAll();

// Ingevoerde data valideren
function validateInputData(array $input)
{
    if (!empty($_POST['prijs'])
        && !empty(trim(htmlspecialchars($_POST['gamenaam'])))
        && !empty(trim(htmlspecialchars($_POST['merchnaam'])))
        && !empty(trim(htmlspecialchars($_POST['gameid'])))
        && !empty(trim(htmlspecialchars($_POST['beschrijving'])))
        && !empty(trim(htmlspecialchars($_POST['aantal'])))
    ) {
        $data['prijs'] = $_POST['prijs'];
        $data['gamenaam'] = $_POST['gamenaam'];
        $data['merchnaam'] = $_POST['merchnaam'];
        $data['beschrijving'] = $_POST['beschrijving'];

        if ($_POST['gameid'] > 0 && is_numeric($_POST['aantal'])) {
            $data['gameid'] = $_POST['gameid'];
            $data['aantal'] = $_POST['aantal'];
            return $data;
        }
        return false;
    }
}

function fotoLoader()
{
    $file = false;

    if (isset($_FILES['foto'])) {
        if (!intval($_FILES['foto']['error'])) {
            $image_dir = "merch/";
            $target_dir = SITE_DIR . '/img/' . $image_dir;
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $image_filedir = $image_dir . basename($_FILES["foto"]["name"]);
            $uploadOk = 1;

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["foto"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            //// Check if file already exists
            //            if (file_exists($target_file)) {
            //                echo "Sorry, file already exists.";
            //                $uploadOk = 0;
            //            }
            // Check file size
            if ($_FILES["foto"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";

                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["foto"]["name"]) . " has been uploaded.";
                    $file = $image_filedir;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
    return $file;
}

// CRUD checks
if (isset($_POST['succes']) || isset($_POST['annuleren'])) {
    $location = SITE_URL . '/admin/producten/index.php';
    header('location:' . $location);
} elseif (isset($_POST['edit']) && isset($_POST['productid'])) // Gegevens ophalen om de formulier te pré-fillen op basis van productid
{
    $productid = intval($_POST ['productid']);

    $sql = "SELECT tblproduct.ProductID AS id, tblproduct.ProductPrijs AS prijs, tblproduct.Gamenaam AS gamenaam, tblproduct.ProductAantal AS aantal, tblproduct.Merchnaam AS merchnaam, tblproduct.foto, tblproduct.Beschrijving as beschrijving, tblproduct.GameID AS gameid
            FROM tblproduct
            WHERE ProductID = {$productid}";
    $record = $dbh->query($sql);

    // Record ophalen uit database
    $data = $record->fetch();

    if ($data) {
//        var_dump($data);
    } else {
        echo "Error 404 - Geen product gevonden met deze naam";
        die();
    }
} elseif (isset($_POST['saveform']) && isset($_POST['productid'])) { // Bewaren na editen bestaand product (heeft een productid)
    $validatedData = validateInputData($data);
    $validatedData['id'] = $_POST['productid'];

    if ($validatedData) {
        $fotoloaded = fotoLoader();

        if($fotoloaded){
            $sql = "UPDATE tblproduct SET ProductPrijs = {$validatedData['prijs']},
                                  ProductAantal = {$validatedData['aantal']},
                                  Gamenaam = '{$validatedData['gamenaam']}',
                                  Merchnaam = '{$validatedData['merchnaam']}',
                                  GameID = {$validatedData['gameid']},
                                  foto = '{$fotoloaded}',
                                  Beschrijving = '{$validatedData['beschrijving']}' WHERE ProductID = {$validatedData['id']}";

        } else {
            $sql = "UPDATE tblproduct SET ProductPrijs = {$validatedData['prijs']},
                                  ProductAantal = {$validatedData['aantal']},
                                  Gamenaam = '{$validatedData['gamenaam']}',
                                  Merchnaam = '{$validatedData['merchnaam']}',
                                  GameID = {$validatedData['gameid']},
                                  Beschrijving = '{$validatedData['beschrijving']}' WHERE ProductID = {$validatedData['id']}";
        }

//        var_dump($sql);

        try {
            if ($dbh->query($sql)) {
                echo "Record updated successfully";
                $recordsaved = TRUE; // indien saven is gelukt...

                $sql = "SELECT tblproduct.ProductID AS id, tblproduct.ProductPrijs AS prijs, tblproduct.Gamenaam AS gamenaam, tblproduct.ProductAantal AS aantal, tblproduct.Merchnaam AS merchnaam, tblproduct.foto, tblproduct.Beschrijving as beschrijving, tblproduct.GameID AS gameid
            FROM tblproduct
            WHERE ProductID = {$validatedData['id']}";
                $record = $dbh->query($sql);

                // Record ophalen uit database
                $data = $record->fetch();

            } else {
                echo "Gegevens konden niet worden bewaard in database";
                die();
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    } else {
        $validationError = TRUE;
    };
} elseif (isset($_POST['saveform']) && !isset($_POST['productid'])) { // Saven nieuw product (heeft initieel geen productid)
    $validatedData = validateInputData($data);

//    var_dump($validatedData);

    if (validateInputData($data)) {
        $fotoloaded = fotoLoader();

        if($fotoloaded)
        {
            $sql = "INSERT INTO tblproduct (ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto, Beschrijving) VALUES
                ('{$validatedData['prijs']}','{$validatedData['aantal']}','{$validatedData['gamenaam']}','{$validatedData['merchnaam']}','{$validatedData['gameid']}','{$fotoloaded}','{$validatedData['beschrijving']}')";

        } else {
            $sql = "INSERT INTO tblproduct (ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto, Beschrijving) VALUES
                ('{$validatedData['prijs']}','{$validatedData['aantal']}','{$validatedData['gamenaam']}','{$validatedData['merchnaam']}','{$validatedData['gameid']}','no-image-available.png','{$validatedData['beschrijving']}')";

        }

        try {
            if ($dbh->query($sql)) {
                $recordsaved = TRUE; // save is gelukt...

                $id = $dbh->lastInsertId();
                $recordsaved = TRUE; // indien saven is gelukt...

                $sql = "SELECT tblproduct.ProductID AS id, tblproduct.ProductPrijs AS prijs, tblproduct.Gamenaam AS gamenaam, tblproduct.ProductAantal AS aantal, tblproduct.Merchnaam AS merchnaam, tblproduct.foto, tblproduct.Beschrijving as beschrijving, tblproduct.GameID AS gameid
            FROM tblproduct
            WHERE ProductID = {$id}";
                $record = $dbh->query($sql);

                // Record ophalen uit database
                $data = $record->fetch();
            } else {
                echo "Gegevens konden niet worden bewaard in database";
                die();
            }
        } catch (PDOException $e) {
            echo 'Registeren van nieuw product details is mislukt: ' . $e->getMessage();
        }
    } else {
        $validationError = TRUE;
    }
} else {
    // Nieuw record invoeren
}
?>

<html>
<head>
  <title>Producten</title>
  <link rel="icon" href="../img/Icon/DVP.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="img/favicon.ico" rel="shortcut icon"/>

  <!-- Google font -->
  <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
      rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../../css/font-awesome.min.css"/>
  <link rel="stylesheet" href="../../css/owl.carousel.min.css"/>
  <link rel="stylesheet" href="../../css/flaticon.css"/>
  <link rel="stylesheet" href="../../css/slicknav.min.css"/>
  <link rel="stylesheet" href="../../css/style.css"/>

  <script src="../../js/jquery-3.2.1.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/jquery.slicknav.min.js"></script>
  <script src="../../js/owl.carousel.min.js"></script>
  <script src="../../js/jquery-ui.min.js"></script>
  <script src="../../js/main.js"></script>

</head>
<body style="background-color:white;">
<?php $page = '';
require(SITE_DIR . '/Includes/navbar.php');
?>

<!---->
<!--        --><?php //} }
?>

<main class="container klantenlijst" style="margin-top: 150px;">
  <div class="row mt-3">
    <div class="col-12">
      <form method="post" action="edit.php" enctype="multipart/form-data">
        <div class="row">
          <div class="col-6">

              <?php if (isset($data['id'])) { ?>
                <div class="form-group">
                  <label for="productid">Product ID</label>
                  <input type="text" disabled class="form-control" id="productid" name="productid"
                         aria-describedby="productid"
                         value="<?php echo $data['id']; ?>">
                </div>
              <?php } ?>

            <div class="form-group">
              <label for="gamenaam">Gamenaam</label>
              <input type="text" class="form-control" id="gamenaam" name="gamenaam" placeholder="Gamenaam"
                     value="<?php echo $data['gamenaam']; ?>">
            </div>

            <div class="form-group">
              <label for="prijs">Prijs (€uro)</label>
              <input type="text" class="form-control" id="prijs" name="prijs" placeholder="Prijs"
                     value="<?php echo $data['prijs']; ?>">
            </div>

            <div class="form-group">
              <label for="prijs">Aantal op voorraad</label>
              <input type="number" class="form-control" id="aantal" name="aantal" placeholder="Aantal"
                     value="<?php echo $data['aantal']; ?>">
            </div>

            <div class="form-group">
              <label for="merchnaam">Merchandising naam</label>
              <input type="text" class="form-control" id="merchnaam" name="merchnaam" placeholder="Merchandising naam"
                     value="<?php echo $data['merchnaam']; ?>">
            </div>

            <div class="form-group">
              <label for="gameid">Game Afdeling</label>
              <select class="custom-select" id="gameid" name="gameid" aria-label="Game id">
                <option <?php $data["gameid"] == 0 ? "selected" : "" ?> value="0">Selecteer game afdeling</option>
                  <?php foreach ($gameafdelingen as $gameafdeling) {
                      $selected = $gameafdeling['gameid'] == $data['gameid'] ? "selected" : "";
                      echo "<option {$selected} value='{$gameafdeling['gameid']}'> {$gameafdeling['gamenaam']}</option>";
                  } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="beschrijving">Beschrijving</label>
              <textarea class="form-control" id="beschrijving" name="beschrijving"
                        rows="3"><?php echo $data['beschrijving']; ?></textarea>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="foto">Foto</label>
              <picture>
                <img id="foto" src="<?php if($data['foto'] !== NULL){echo URL_SUBFOLDER . '/img/' . $data['foto'];} else {echo URL_SUBFOLDER . '/img/no-image-available.png';} ?>"
                     alt="<?php echo $data['foto']; ?>" class="img-thumbnail">
              </picture>
            </div>

            <div class="form-group">
              <input type="file" class="custom-file-input" id="customFile" accept=".jpg,.jpeg,.png,.gif"
                     name="foto">
              <label class="btn btn-info" class="custom-file-label" for="customFile">Kies foto</label> <p>Max grootte aanbevolen: 500Kb</p>
            </div>

            <script>
                // jQuery / JS om het stukje foto te visualiseren (opladen zal gebeuren in de volgende $_POST tijdens het bewaren
                $(".custom-file-input").on("change", function () {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    var input = document.getElementById("customFile");
                    var fReader = new FileReader();
                    fReader.readAsDataURL(input.files[0]);
                    console.log(fReader);
                    fReader.onloadend = function (event) {
                        var img = document.getElementById("foto");
                        img.src = event.target.result;
                    }
                });
            </script>

          </div>
        </div>

        <button class="btn btn-info" name="saveform" value="true">Bewaren</button>

          <?php if ($recordsaved) { ?>
            <button class="btn btn-info" name="succes" value="true">Terug naar overzicht</button>
          <?php } else { ?>
            <button class="btn btn-info" name="annuleren" value="true">Annuleren</button>
          <?php } ?>
      </form>
    </div>
    <div class="col-12">
        <?php if ($recordsaved) { ?>
          <div class="alert alert-success" role="alert">
            Gegevens zijn succesvol bewaard!
          </div>
        <?php } ?>
        <?php if ($validationError) { ?>
          <div class="alert alert-danger" role="alert">
            Gegevens werden niet correct of onvolledig ingevoerd, probeer opnieuw!
          </div>
        <?php } ?>
    </div>

      <?php
      function pre_r($array)
      {
          echo '<pre>';
          print_r($array);
          echo '<pre>';
      }

      ?>
  </div>
</main>
</body>
</html>
<script>
    // Form fields die "disabled" staan, worden niet gepost. Dit is een workaround.
    $('form').submit(function (e) {
        $(':disabled').each(function (e) {
            $(this).removeAttr('disabled');
        })
    });
</script>