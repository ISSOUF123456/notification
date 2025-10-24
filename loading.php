<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>loading lazy</title>
</head>
<body>
<h1>chargement paresseux</h1>
<hr>
<?php 
for ($i=0; $i <= 20; $i++) { 

 ?>
 <img class="lazy"
  src="images/gif.gif" alt=""
   width="100" 
   height="100" 
   data-src="https://picsum.photos/1000/1000"
 dataset-srcset="https://picsum.photos/1000/1000">

 <?php 
} 
 ?>
 <script>
    let lazyimages = [].slice.call(document.querySelectorAll(".lazy"));
     if("IntersectionObserver" in window){
        let observer = new IntersectionObserver((entries,observer)=>{
            entries.forEach(function(entry)=>{
                if(entry.isIntersecting){
                    let lazyimage = entry.target;
                    lazyimage.src = lazyimage.dataset.src;
                    lazyimage.srcset = lazyimage.dataset.srcset;
                   lazyimage.classList.remove("lazy");
                   observer.unobserve(lazyimage);
              }
            });
        });
        lazyimages.forEach((lazyimage)=>{
            observer.observe(lazyimage);
        });
     }
 </script>
</body>
</html>