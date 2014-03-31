<!doctype html>
<html>
<head>
    <title>Table of contents</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        @media screen {
            body {
                height:100%; width: 100%;
            }
            #content {
                height: 400px; width: 500px; 
                position:absolute; text-align: center;
                left:50%;
                top:50%;
                margin:-200px 0 0 -250px;
            }
            ul {
            	text-align: left;
            }
        }
        @media print {
            body {
                
            }
            #content {
                position:relative; text-align: center;
                top: 0px; left: 0px;
            }
            
            ul {
            	text-align: left;
            }
        }
    </style>
</head>
<body>
    <div id="content">
    <img src="http://137.226.58.17:8081/exhibition/wp-content/uploads/2014/03/logo.png">
        <h1>Favorite items of 
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

<?php 
    if ( isset($_GET["content"]) && ($_GET["content"] != "") ) {
    	$string = $_GET["content"];
        $contents = explode( ";" , $string );
        echo "<ul>";
        foreach ($contents as $content) {
        	echo "<li>" . $content . "</li>";
        }
        echo "</ul>";
    } else {
        echo "You have not liked any item in the exhibition.";
    }
?>

</h2>
</div>

</body>
</html>
