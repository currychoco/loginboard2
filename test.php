<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    function testAjax(){
        $.ajax ({
        url : "/loginboard2/tes2t.php"
        })

        .done(function(){ console.log("done") })

        .fail(function(){ console.log("fail") })

        .always(function(){ console.log("always") })
    }
    
    function testAjax2(){
        $.ajax ({
            url : "/loginboard2/te2t.php",
            success : function() { console.log("success")},

            error : function() { console.log("error") },

            complete : function () { console.log("complete") }

        });
    }

    function testAjax3(){
        $.ajax ({
            url : "/loginboard2/test.php",
            success : function() { console.log("success")},

            error : function() { console.log("error") },

            complete : function () { console.log("complete") }

        })
        .done(function(){ console.log("done") })

        .fail(function(){ console.log("fail") })

        .always(function(){ console.log("always") });
    }

</script>
<?php
    echo "<script>testAjax3()</script>";