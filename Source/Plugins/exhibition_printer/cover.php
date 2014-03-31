<!doctype html>
<html>
<head>
    <title>Cover page</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        @media screen {
            body {
                height:100%; width: 100%;
            }
            #content {
                height: 200px; width: 500px; 
                position:absolute; text-align: center;
                left:50%;
                top:50%;
                margin:-100px 0 0 -250px;
            }
        }
        @media print {
            body {
                
            }
            #content {
                position:relative; text-align: center;
                top: 400px; left: 0px;
            }
        }
    </style>
</head>
<body>
    <div id="content">
    <img src="http://137.226.58.17:8081/exhibition/wp-content/uploads/2014/03/logo.png">
        <h1>Hello, 
<?php 
    if ( isset($_GET["name"]) && ($_GET["name"] != "") ) {
        $name = $_GET["name"];
    } else {
        $name = "Guest";
    }
    echo $name;
?>
</h1>
<h2>
    Here you can find your favorite items from the exhibition.
</h2>
</div>

</body>
</html>
