<?php
$file = 'counter.txt';
// CREATE FILE
if(!file_exists($file)){
    $create = fopen($file, 'w') or die("Could not create the counter database.");
    file_put_contents( $file , '0' );
    fclose($create);
}
// WRITE FILE
if( isset($_POST['count']) ){
    $msg = htmlentities(strip_tags($_POST['count']), ENT_QUOTES);
    file_put_contents($file, $msg);
}
?>


<!DOCTYPE html>
<html>

<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<meta charset=utf-8 />
<title>Flat-File db counter with PHP and AJAX by roXon</title>
</head>
<body>

<button>click me</button>
<button>click me too!</button>
refresh the page , the counter should be memorized from our auto-generated database file! ;)
<br><b></b>

<script>
    function addCount( newCounterValue ){
        $.ajax( {
            type: "POST",
            data: {count : newCounterValue},
            cache: false,
                    async: false,
            success: function() {
                $('b').append('<br>Succesfully sent: '+ newCounterValue);
            }
        });
    }
    $(function(){
        $('button').click(function(){
            $.get('counter.txt', function(data) {
                // READ
                var counter = parseInt(data, 10) || 0;
                $('b').html('Retrieved counter from database = '+ data);
                // SEND
                addCount( ++counter ); // send preIncremented COUNTER
            });
        });
    });
</script>

</body>
</html>
