<?php
session_start();
require_once "../Class/Job.php";
$listJobs = Job::GetJobs(3);
$tempActiveTable=[
    0=>"In Active",
    1=>"Active"
];
$tempAprouveTable=[
    0=>"In Aprouve",
    1=>"Aprouve"
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="side">
            <div class="h-100">
                <div class="sidebar_logo d-flex align-items-end">
                  
                    <a href="#" class="nav-link text-white-50">Dashboard</a>
                   
                </div>

                <ul class="sidebar_nav">
                    <li class="sidebar_item ">
                        <a href="dashboard.php" class="sidebar_link"> <img src="img/1. overview.svg" alt="icon">Overview</a>
                    </li>
                    <li class="sidebar_item" style="width: 100%;">
                        <a href="candidat.php" class="sidebar_link"> <img src="img/agents.svg" alt="icon">Candidat</a>
                    </li>
                    <li class="sidebar_item active">
                        <a href="offre.php" class="sidebar_link"> <img src="img/task.svg" alt="icon">Offre</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="contact.php" class="sidebar_link"><img src="img/agent.svg" alt="icon">Contact</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="offre.php" class="sidebar_link"><img src="img/articles.svg" alt="icon">Offre To Apply</a>
                    </li>

                </ul>
                <div class="line"></div>
                <a href="#" class="sidebar_link"><img src="img/settings.svg" alt="">Settings</a>


            </div>
        </aside>
        <div class="main">
            <nav class="navbar justify-content-space-between pe-4 ps-2">
                <button class="btn open">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar  gap-4">
                    <div class="">
                        <input type="search" class="search " placeholder="Search">
                        <img class="search_icon" src="img/search.svg" alt="iconicon">
                    </div>
                    <!-- <img src="img/search.svg" alt="icon"> -->
                    <img class="notification" src="img/new.svg" alt="icon">
                    <div class="card new w-auto">
                        <div class="list-group list-group-light">
                            <div class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                                <p class="mt-auto">Notification</p><a href="#"><img src="img/settingsno.svg" alt="icon"></a>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1  day ago</small>
                                </div>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1  day ago</small>
                                </div>
                            </div>
                            <div class="list-group-item px-3 text-center"><a href="#">View all notifications</a></div>
                        </div>
                    </div>
                    <div class="inline"></div>
                    <div class="name">Admin</div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                                <img src="img/photo_admin.svg" alt="icon">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end position-absolute">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Account Setting</a>
                                <?php 
                                if(!isset($_SESSION['roleUser'])){
                                ?>
                                <a class="dropdown-item" href="../login.php">Login</a>
                                <?php }else{ ?>
                                <a class="dropdown-item" href="../Controller/controller.php?logout=ok">Log out</a>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <section class="Agents px-4">
                <input value='Add Offer' data-bs-toggle="modal" data-bs-target="#addOffer" class="btn btn-success  mb-4 me-4">                 
                <table class="agent table align-middle bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>description</th>
                            <th>entreprise</th>
                            <th>location</th>
                            <th>Is Active</th>
                            <th>Is Approve</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $indic=0;
                        foreach($listJobs as $job){
                        ?>
                        <tr class="freelancer">
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="../uploads/<?=$job['imageURL']?>" alt=""
                                        style="width: 45px; height: 45px" class="rounded-circle" />
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <p class="fw-bold mb-1 f_name"><?=$job['title'] ?></p>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title"><?=$job['description'] ?> </p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title"><?=$job['entreprise'] ?> </p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title"><?=$job['location'] ?> </p>
                            </td>
                            <td class="f_position"><?php echo ($job['IsActive']==1)? "Active":"In Active"; ?> </td>
                            <td class="f_position"><?php echo ($job['approve']==1)? "Aprouve":"In Aprouve"; ?> </td>
                            <td>
                                <a href="../Controller/controller.php?deletJob=<?=$job['jobID']?>"><img class="delet_user" src="img/user-x.svg" alt=""></a>
                                <img class="ms-2 edit" data-bs-toggle="modal" data-bs-target="#edit<?=$indic?>" src="img/edit.svg" alt="">
                            </td>
                            <div class="modal fade" id="edit<?=$indic?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="forms" method='POST' action="../Controller/controller.php">
                                                <div class="row mb-4">
                                                    <div class="">
                                                        <input placeholder="Title" value='<?=$job['title']?>' type="text" name='title'   class="form-control first_name" >
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="">
                                                        <input placeholder="Description" value='<?=$job['description']?>' type="text" name='description'  class="form-control first_name" >
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="">
                                                        <input placeholder="Entreprise" value='<?=$job['entreprise']?>' type="text" name='entreprise'  class="form-control first_name" >
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="">
                                                        <input placeholder="Location" value='<?=$job['location']?>' type="text" name='location'  class="form-control first_name" >
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" >Active / In Active</label>
                                                    <select name="IsActive" class="form-control email" id="">
                                                        <?php
                                                        
                                                        for($i=0;$i<count($tempActiveTable);$i++){
                                                        ?>
                                                        <option value="<?=$i?>" <?php echo ($i==$job['IsActive'])? 'selected':'' ?>><?=$tempActiveTable[$i]?></option>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" >Approve / In Approve</label>
                                                    <select name="approve" class="form-control email" id="">
                                                        <?php
                                                        for($i=0;$i<count($tempAprouveTable);$i++){
                                                        ?>
                                                        <option value="<?=$i?>" <?php echo ($i==$job['approve'])? 'selected':'' ?>><?=$tempAprouveTable[$i]?></option>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="id_Jobs" value='<?=$job['jobID']?>'>
                                                <div class="d-flex w-100 justify-content-center">
                                                    <input type="submit" name='updateJobs' value='Save Edit' class="btn btn-success  mb-4 me-4">
                                                    <button class="btn btn-danger btn-block mb-4 " data-bs-dismiss="modal">Annuler</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        <?php
                        $indic++;
                        }
                        ?>
                    </tbody>
                </table>

                
            </section>
            <div class="modal fade" id="addOffer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="forms" method='POST' enctype="multipart/form-data" action="../Controller/controller.php">
                                <div class="row mb-4">
                                    <div class="">
                                        <input  type="file" name='photo'   class="form-control first_name" >
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="">
                                        <input placeholder="Title" type="text" name='title'   class="form-control first_name" >
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="">
                                        <input placeholder="Description" type="text" name='description'  class="form-control first_name" >
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="">
                                        <input placeholder="Entreprise" type="text" name='entreprise'  class="form-control first_name" >
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="">
                                        <input placeholder="Location" type="text" name='location'  class="form-control first_name" >
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" >is active</label>
                                    <select name="IsActive" class="form-control email" id="">
                                        <option value="1">Active</option>
                                        <option value="0">non active</option>
                                       
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" >Role User</label>
                                    <select name="approve" class="form-control email" id="">
                                        <option value="1">Approve</option>
                                        <option value="0">Non approve</option>
                                    </select>
                                </div>
                                <div class="d-flex w-100 justify-content-center">
                                    <button type="submit" name='addOffer' value='' class="btn btn-success  mb-4 me-4">Add</button>
                                    <button class="btn btn-danger btn-block mb-4 " data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="dashboard.js"></script>
        <script src="agents.js"></script>
</body>

</html>