<?php
    session_start();
    
    $messagerie=true;
    include_once("headers.php");
    include_once("main.php");
    
?>


    <main>
    <h1 data-aos="zoom-in-up" class="mt-5">Contacter-Assigner une tache <small style="font-size: 17px;">(Liste des chauffeurs)</small></h1>
        <?php 
            $recupChauffeur=$pdo->query("select * from chauffeurs");
            while($chauffeur=$recupChauffeur->fetch()){
        ?>
            <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3>Contactez <small style="font-size: 18px"><?php echo $chauffeur['nom'];?>- chauffeur No <?php echo $chauffeur['idChauffeur'];?> </small> </h3>
                            <h5>Login:<a href="messagePrives.php?id=<?php echo $chauffeur['idChauffeur'];?>"> <?php echo $chauffeur['loginChauffeur'];?></a></h5>
                        </div>
                    </div>
                </div>   
            </div>
            </div>
        <?php
            }
        
        ?>
    </main>


    <?php include_once("footer.php");?>