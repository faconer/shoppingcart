$(document).ready(function(){
    $(".quantity").change(function(){
        slm = $(this).val();
        masp = $(this).attr("data-masp");
        $.ajax({
            url:"../display/xuly-cart.php",
            type:"post",
            data:"slm="+slm+"&masp="+masp,
            asyn:true,
            success:function(kq){
                location.reload();
            }
        });
    });
});