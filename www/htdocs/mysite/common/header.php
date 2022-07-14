<?php
//include '../../central/common/header.php';
require '../../central/config.php';
require '../../central/lang/lang.php';

unset($query);

include '../../central/common/get_post.php';
require 'ms-functions.php';

?>

<!doctype html>
<html lang="<?php echo $lang;?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $meta_encoding;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Expires" content="-1" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="robots" content="all" />

    <title>ABCD MySite</title>

    <!--Bootstrap-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />


    <!-- Stylesheets -->
    <link href="../assets/css/dashboard.css?<?php echo time();?>" rel="stylesheet">
   <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    <script>
    // Define various event handlers for Dialog
    var handleSubmit = function() {
        document.getElementById('firstBox').style.display = 'none';
        document.getElementById('secondBox').style.display = 'none';
        document.getElementById('answerBox').style.display = '';
        this.submit();
    };


    var handleSubmitRenew = function() {

        document.getElementById('firstBox').style.display = 'none';
        document.getElementById('secondBox').style.display = 'none';
        document.getElementById('answerBox').style.display = '';
        this.submit();
    };


    var handleSubmitReserves = function() {

        document.getElementById('firstBox').style.display = 'none';
        document.getElementById('answerBox').style.display = '';
        this.submit();
    };



    var handleCancel = function() {
        this.cancel();
    };

    var handleSuccess = function(o) {
        var response = o.responseText;
        document.getElementById("myanswer").innerHTML = response;
    };


    var handleFailure = function(o) {
        alert("Submission failed: " + o.status);
    };



    function CambiarLenguaje() {
        if (document.cambiolang.lenguaje.selectedIndex > 0) {
            lang = document.cambiolang.lenguaje.options[document.cambiolang.lenguaje.selectedIndex].value
            self.location.href = "iniciomysite.php?reinicio=s&lang=" + lang
        }
    }


    function CancelReservation(idTrans) {
        document.forms["formreservation"].waitid.value = idTrans;
        document.forms["formreservation"].userid.value = "<?php echo $_SESSION["userid"]; ?>";
    }


    function LoanRenovation(idTrans, library) {
        console.log('RENOVA');
        document.formrenovation.copyId.value = idTrans;
        document.formrenovation.userId.value = "<?php echo $_SESSION["userid"]; ?>";
        document.formrenovation.db.value = "<?php echo $_SESSION["db"]; ?>";
        document.formrenovation.library.value = library;
        document.formrenovation.usertype.value = "<?php echo $vectorAbrev['userClass']; ?>"
        document.formrenovation.copytype.value = document.getElementById('copytypeh' + idTrans).value;
        document.formrenovation.loanid.value = document.getElementById('loanidh' + idTrans).value;
        document.formrenovation.cantrenewals.value = document.getElementById('cantrenewalst').value;
        //document.formrenovation.suspensions.value = document.getElementById('suspensionst').value;
        //document.formrenovation.fines.value = document.getElementById('finest').value;
        document.formrenovation.endatev.value = document.getElementById('endatet' + idTrans).value;
        document.formrenovation.submit()

    }


    function PlaceReserve(recordId, objectType, library) {


        document.forms["formreserves"].userId.value = "<?php echo $_SESSION["userid"]; ?>";
        document.forms["formreserves"].db.value = "<?php echo $_SESSION["db"]; ?>";
        document.forms["formreserves"].recordId.value = recordId;
        if (typeof(document.forms["formshow"].volumeId) != 'undefined') {
            document.forms["formreserves"].volumeId.value = document.forms["formshow"].volumeId.value;
        }
        document.forms["formreserves"].objectCategory.value = document.forms["formshow"].objectType.value;
        document.forms["formreserves"].library.value = library;
        document.forms["formreserves"].usertype.value = "<?php echo $vectorAbrev['userClass']; ?>";

        document.forms["formreserves"].database.value = document.forms["formshow"].database.value;
    }



    function ReloadSite() {
        document.location.reload(true);
    }


    function clearOperation() {
        document.location.href = "iniciomysite.php?action=clear";
    }

    function GoToSite() {
        document.location.href = "iniciomysite.php?action=gotosite";
    }
    </script>

    <!-- AJAX para consulta de registro -->
    <script>
    function ajaxPublication(id, recordId, database) {
        div = document.getElementById(id);
        postData = "id=" + recordId + "&database=" + database;
        makeRequest();

    }

    var div = document.getElementById('container');



    var callback = {
        success: handleSuccess,
        failure: handleFailure
    };

    var sUrl = "../queryobjectservice.php";
    </script>

</head>

<body>
<header class="navbar navbar-dark text-light sticky-top bg-primary flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">
<?php
if (isset($def['LOGO_DEFAULT'])) {
    echo '<img class="bi me-2" height="32" role="img" src="/assets/images/logoabcd.png?' . time() . '" title="$institution_name">';
} elseif ((isset($def["LOGO"])) && (!empty($def["LOGO"]))) {
    echo '<img class="bi me-2" height="32" role="img" src="' . $folder_logo . $def["LOGO"] . '?' . time() . '" title="';
    if (isset($institution_name)) {
        echo $institution_name;
    }
    echo "'>";
} else {
    echo '<img class="bi me-2" height="32" role="img" src="/assets/images/logoabcd.png?' . time() . '" title="ABCD">';
}
?>
  </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed rounded-0 py-2 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<form class="nav col-12 col-lg mb-2 mx-md-2 justify-content-center mb-md-0" role="search">
    <input type="search" class="form-control form-control-dark rounded-1" placeholder="Search..." aria-label="Search">
</form>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logoutmysite.php"><?php echo $msgstr["logout"] ?>
</a>
    </div>
    
  </div>
</header>

 







        <?php
//$ayuda = $_SESSION["lang"] . "/mysite.html";
//include "../../central/common/inc_div-helper.php";
?>