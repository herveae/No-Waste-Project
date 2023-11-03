<?php
    session_start();
    
    $messagerie=true;
    include_once("headerUser.php");
    include_once("main.php");
    
?>


    <main>
    <h1 data-aos="zoom-in-up" class="mt-5">Contacter-Assigner une tache <small style="font-size: 17px;">(Liste des administrateur)</small></h1>
        <?php 
            $recupAdmin=$pdo->query("select * from admin");
            while($admin=$recupAdmin->fetch()){
        ?>
            <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3>Contactez <small style="font-size: 18px"><?php echo $admin['nom'];?>- administrateur No <?php echo $admin['idAdmin'];?> </small> </h3>
                            <h5>Login:<a href="messagePrivesChauffeur.php?id=<?php echo $admin['idAdmin'];?>"> <?php echo $admin['login'];?></a></h5>
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