<?php session_start(); 
    if(!$_SESSION['loginChauffeur']){
        header("Location:connexionUser.php");
    }
    $messagerie=true;
    include_once("headerUser.php");
    include_once("main.php");
    
    if(isset($_GET['id']) AND (!empty($_GET['id']))){
        $getId=$_GET['id'];
        $recupAdmin=$pdo->prepare("select * from admin where idAdmin = ?");
        $recupAdmin->execute(array($getId));
        if($recupAdmin->rowCount()>0){
            if(isset($_POST['envoyer']) AND (!empty($_POST['message']))){ 
                    $message=htmlspecialchars($_POST['message']);
                    $insertMessage=$pdo->prepare('insert into messages(message,idDestinataire,idAuteur)values(?, ?, ?)');
                    $insertMessage->execute(array($message,$getId,$_SESSION['id']));
                    $heureEnvoi= date('Y-m-d H:i:s');
            }else{
                echo "Entrez votre message";
                }
        }else{
            echo "aucun utilisateur trouve"; 
        }
    }else{
        echo "aucun identifiant trouve";  
    }
    
?>

<main class="container">
        <div class="row">
            <div class="col-lg-4 mt-5">
                <aside style="position: fixed;">
                <form style="width: 100%;" action="" method="post" class="mt-5">
                    <div class="col-12 form-group">
                        <label for="message" class="form-label">message</label>
                        <textarea class="form-control" name="message" id="message" cols="20" rows="3"></textarea required>
                    </div>
                
                    <div class="col-lg-12 col-12 mt-4 mx-auto form-group mb-4">
                        <button type="submit" name="envoyer" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
                </aside>

            </div>
            <div class="col-lg-8 mt-5">
            <section id="messages" >
        <?php 
            $recupMessages =$pdo->prepare('select * from messages where idAuteur= ? AND idDestinataire = ? OR idAuteur= ? AND idDestinataire = ?');
            $recupMessages->execute(array($_SESSION['id'], $getId, $getId, $_SESSION['id']));
            while($message=$recupMessages->fetch()){
                if($message['idDestinataire']==$_SESSION['id']){
                    ?>
                    <div class="affichage d-flex">

                            <div class="action">
                            <p class="m-3"> <i><?php echo "message recu ";?></i></p>
                        
                            </div>
                        <div class="text-bg-secondary d-flex p-2 mt-2 mb-2">
                            <div class="text">
                              <p style=""><?php echo $message['message'];?></p>
                              
                            </div>
                           
                            
                        </div>
                        
                        </div>
                        
                    
    
                    <?php
                    }elseif ($message['idDestinataire'] == $getId){
                        ?>
                        <div class="affichage d-flex">
                        <div class="text-bg-success d-flex justify-content-end p-2 mt-2 mb-2">
                            <div class="text">
                              <p style="text-align:end;"><?php echo $message['message'];?></p>
                            </div>
                           
                            
                        </div>
                        <div class="action">
                                <p class="m-3"> <i><?php echo "message envoye ";?></i></p>
                        
                            </div>
                        </div>
                        
                    <?php
                    }
            }        
        ?>
    </section>
            </div>
        </div>
    </main>

