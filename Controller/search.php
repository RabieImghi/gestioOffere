<?php
session_start();
require_once "../Class/Job.php";
$jobs = new Job();
if(isset($_GET['value'])){
    $searchValue = $_GET['value'];
    $searchType = $_GET['type'];
    $result=$jobs->SearchJob($searchValue,$searchType);

    foreach($result as $job){

?>
    <article class="postcard light green">
        <a class="postcard__img_link" href="#">
            <img class="postcard__img" src="uploads/<?=$job['imageURL']?>" alt="Image Title" />
        </a>
        <div class="postcard__text t-dark">
            <h3 class="postcard__title green"><a href="#"><?=$job["title"]?></a></h3>
            <div class="postcard__subtitle small">
                <time datetime="2020-05-25 12:00:00">
                    <i class="fas fa-calendar-alt mr-2"></i>Mon, May 26th 2023
                </time>
            </div>
            <div class="postcard__bar"></div>
            <div class="postcard__preview-txt"><?=$job["description"]?></div>
            <ul class="postcard__tagbox">
                <li class="tag__item">Enreprise : <?=$job["entreprise"]?></li>
                <li class="tag__item">Location : <?=$job["location"]?></li>
                <li class="tag__item play green">
                    <?php
                    if($job["approve"]==1){
                        echo "<span style='color:red'>Already aprouved</span>";
                    }else{
                        if(isset($_SESSION['idUser'])){
                    ?>
                        <form >
                            <button type='button' name='applyOffre' id='applyOffre<?=$job['jobID']?>' onclick="addOffer(<?=$job['jobID']?>)" value='<?=$_SESSION['idUser']?>/<?=$job["jobID"]?>' class="btn btn-success">Add Offer</button>   
                        </form>    
                        
                        <?php
                        }else{
                        ?>       
                        <a href="login.php" class="btn btn-success">Add Offer</a>
                        <?php } ?>
                    <?php
                    }
                    ?>
                    
                </li>
            </ul>
        </div>
    </article>
<?php
    }
}