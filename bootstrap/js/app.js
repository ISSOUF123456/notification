$(function(){

    //action sur le boutton d'activation
    btnActiver();
    function btnActiver(){
        $('body').delegate('.btn_activer','click',function(e){
            //bloque l'action du lien
           e.preventDefault();
           var id = $(this).attr("href");
           var rep = confirm("voulez vous activer cette année academique ?");
          if(rep==true){
            $.ajax({
                url:"partials/action.php",
                method:"POST",
                data:{btnActiver:1,id_an:id},
                dataType:"html",
                success:function(result){
                    if (result=="ok") {
                        alert("Année activée avec success");
                        window.location.href="annee.php";
                    } else {
                        alert(result);
                    }
                }
               })
          } 
        })
    }
});