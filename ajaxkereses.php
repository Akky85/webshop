<?php require "header.php"; ?>

<div id="top">
    <img id="logo" src="" alt="">
    <?php require "menu.php"; ?>
</div>

<div id="left">
    <?php require "kategoria.php"; ?>
</div>

<div id="right">
    <h2>Termék keresése</h2>
    <form action="" method="post">
        <input type="text" name="search_text" class="search_text" placeholder="Kezd el gépelni....">
    </form>
    <div class="result"></div>
</div>
<script>
    $(function(){
        $(".search_text").keyup(function(){
            var text = $(".search_text").val();

            if(text !=""){
                $.ajax({
                    url: "fetch.php",
                    type: "post",
                    dataType: "text",
                    data: {search:text},
                    success : function(data){
                        $(".result").html(data);
                    }
                })
            }
            else{
                $(".result").html("");
            }
        })
    })
</script>

</body>
</html>