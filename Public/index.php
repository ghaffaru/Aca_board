<?php
    $module = $subject = $topic = $code = $file_tmp = $file_name = FALSE;
    require_once('../db_connect.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Aca Board</title>
        <link rel="stylesheet" type="text/css" href="style.css">  
        <link rel="stylesheet" type="text/css" href="grid.css">  
        <style>
            .error{
                color: red;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>FROM THE ACA BOARD, UGSMD</h1>
            <h3>just pasco...nothing else</h3>
            <a href="#to-post">Post Pasco</a>
        </header>
        <section class="row">
            <div class="row">
                    <form id="search-filters"  action="" method="post">
                        <select class="column span-1-of-2" name="modules">
                            <option value="">Select Module</option>
                            <option value="BAHS 231">BAHS 231</option>
                            <option value="BAHS 233">BAHS 233</option>
                            <option value="BAHS 235">BAHS 235</option>
                            <option value="BAHS 237">BAHS 237</option>
                            <option value="BAHS 232">BAHS 232</option>
                            <option value="BAHS 234">BAHS 234</option>
                            <option value="BAHS 236">BAHS 236</option>
                            <option value="BAHS 238">BAHS 238</option>
                            <option value="BAHS 331">BAHS 331</option>
                            <option value="BAHS 333">BAHS 333</option>
                            <option value="BAHS 335">BAHS 335</option>
                            <option value="BAHS 337">BAHS 337</option>
                            <option value="BAHS 332">BAHS 332</option>
                            <option value="BAHS 334">BAHS 334</option>
                            <option value="BAHS 336">BAHS 336</option>
                            <option value="BAHS 338">BAHS 338</option>
                        </select>
                        
                        <select class="column span-1-of-2" name="subjects">
                            <option value="">Select Subject</option>
                            <option value="Gross Anatomy">Gross Anatomy</option>
                            <option value="Embryology">Embryology</option>
                            <option value="Histology">Histology</option>
                            <option value="Physiology">Physiology</option>
                            <option value="Biochemistry">Biochemistry</option>
                            <option value="Pharmacology">Pharmacology</option>
                            <option value="Microbiology">Microbiology</option>
                            <option value="Pathology">Pathology</option>
                            <option value="Chemical Pathology">Chemical Pathology</option>
                            <option value="Haematology">Haematology</option>
                        </select>
                        <input class="topic" type="text" name="topics" placeholder='Topic'>
                        <input class="search" type="submit" name="search" value="Search">
                    </form>
            </div>
           
            
            <?php
                 if (isset($_POST['search'])){
                    if (isset($_POST['topics']) AND ($_POST['subjects'] == NULL) AND ($_POST['modules'] == NULL)){
                        $topic = strip_tags(trim($_POST['topics']));
            
                        $q = "SELECT modules.mod_id, mod_name, subjects.subj_id,subj_name,
                        topics.top_id,top_name, file_id, file_name ,date_entered
                        FROM modules,subjects,topics, files 
                        WHERE modules.mod_id=subjects.mod_id AND 
                        subjects.subj_id = topics.subj_id AND 
                        topics.top_id = files.top_id
                        AND top_name LIKE '%$topic%' 
                        ORDER BY date_entered DESC";
            
                        $r = mysqli_query($db,$q);
            
                        if (mysqli_num_rows($r) > 0){
                            while ($row = mysqli_fetch_assoc($r)){
                                $ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                                    ?>
                                    <a href="download_file.php?id=<?php echo $row['file_id'] . '.' . $ext; ?>">
                                    <div class="file">
                                    <div class="row file-topic"> 
                                    <?php echo $row['top_name']; ?>
                                    </div>
                                    <div>
                                    <span class="module"> 
                                        <?php echo $row['mod_name']; ?>
                                    </span>
                                    <span class="category">
                                        <?php echo $row['subj_name']; ?>
                                    </span>
                                    </div>
                                    </div><a> <?php
                            }
                        }
                    }elseif (empty($_POST['topics']) AND ($_POST['subjects'] == NULL) AND ($_POST['modules'] != NULL)){
                        $mod_name = $_POST['modules'];
                     $q = "SELECT modules.mod_id, mod_name, subjects.subj_id,subj_name,
                       topics.top_id,top_name, file_id, file_name ,date_entered
                       FROM modules,subjects,topics, files 
                       WHERE modules.mod_id=subjects.mod_id AND 
                       subjects.subj_id = topics.subj_id AND 
                       topics.top_id = files.top_id
                       AND mod_name='$mod_name' 
                       ORDER BY date_entered DESC";
           
                       $r = mysqli_query($db,$q);
           
                       if (mysqli_num_rows($r) > 0){
                           while ($row = mysqli_fetch_assoc($r)){
                               $ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                                   ?>
                                   <a href="download_file.php?id=<?php echo $row['file_id'] . '.' . $ext; ?>">
                                   <div class="file">
                                   <div class="row file-topic"> 
                                   <?php echo $row['top_name']; ?>
                                   </div>
                                   <div>
                                   <span class="module"> 
                                       <?php echo $row['mod_name']; ?>
                                   </span>
                                   <span class="category">
                                       <?php echo $row['subj_name']; ?>
                                   </span>
                                   </div>
                                   </div><a> <?php
                           }
                       }
                   }
                   elseif (empty($_POST['topics']) AND ($_POST['modules'] == NULL) AND ($_POST['subjects'] != NULL)){
                    $subj_name = $_POST['subjects'];
                    $q = "SELECT modules.mod_id, mod_name, subjects.subj_id,subj_name,
                    topics.top_id,top_name, file_id, file_name ,date_entered
                    FROM modules,subjects,topics, files 
                    WHERE modules.mod_id=subjects.mod_id AND 
                    subjects.subj_id = topics.subj_id AND 
                    topics.top_id = files.top_id
                    AND subj_name = '$subj_name'
                    ORDER BY date_entered DESC";
        
                    $r = mysqli_query($db,$q);
        
                    if (mysqli_num_rows($r) > 0){
                        while ($row = mysqli_fetch_assoc($r)){
                            $ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                                ?>
                                <a href="download_file.php?id=<?php echo $row['file_id'] . '.' . $ext; ?>">
                                <div class="file">
                                <div class="row file-topic"> 
                                <?php echo $row['top_name']; ?>
                                </div>
                                <div>
                                <span class="module"> 
                                    <?php echo $row['mod_name']; ?>
                                </span>
                                <span class="category">
                                    <?php echo $row['subj_name']; ?>
                                </span>
                                </div>
                                </div><a> <?php
                        }
                    }
                   }
                   elseif(empty($_POST['topics'] AND ($_POST['modules'] != NULL) AND ($_POST['subjects'] != NULL))){
                    $subj_name = $_POST['subjects'];
                    $mod_name = $_POST['modules'];
                    $q = "SELECT modules.mod_id, mod_name, subjects.subj_id,subj_name,
                    topics.top_id,top_name, file_id, file_name ,date_entered
                    FROM modules,subjects,topics, files 
                    WHERE modules.mod_id=subjects.mod_id AND 
                    subjects.subj_id = topics.subj_id AND 
                    topics.top_id = files.top_id
                    AND subj_name = '$subj_name'
                    AND mod_name = '$mod_name'
                    ORDER BY date_entered DESC";
        
                    $r = mysqli_query($db,$q);
        
                    if (mysqli_num_rows($r) > 0){
                        while ($row = mysqli_fetch_assoc($r)){
                            $ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                                ?>
                                <a href="download_file.php?id=<?php echo $row['file_id'] . '.' . $ext; ?>">
                                <div class="file">
                                <div class="row file-topic"> 
                                <?php echo $row['top_name']; ?>
                                </div>
                                <div>
                                <span class="module"> 
                                    <?php echo $row['mod_name']; ?>
                                </span>
                                <span class="category">
                                    <?php echo $row['subj_name']; ?>
                                </span>
                                </div>
                                </div><a> <?php
                        }
                    }
                   }
                   elseif (!empty($_POST['topics'] AND ($_POST['subjects'] != NULL) AND ($_POST['modules'] != NULL))){
                       $topic = strip_tags(trim($_POST['topics']));
                       $topic = mysqli_real_escape_string($db,$topic);
                       $subject = $_POST['subjects'];
                       $module = $_POST['modules'];
                       $q = "SELECT modules.mod_id, mod_name, subjects.subj_id,subj_name,
                    topics.top_id,top_name, file_id, file_name ,date_entered
                    FROM modules,subjects,topics, files 
                    WHERE modules.mod_id=subjects.mod_id AND 
                    subjects.subj_id = topics.subj_id AND 
                    topics.top_id = files.top_id
                    AND subj_name = '$subject'
                    AND mod_name = '$module'
                    AND top_name LIKE '%$topic%'
                    ORDER BY date_entered DESC";
        
                    $r = mysqli_query($db,$q);
        
                    if (mysqli_num_rows($r) > 0){
                        while ($row = mysqli_fetch_assoc($r)){
                            $ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                                ?>
                                <a href="download_file.php?id=<?php echo $row['file_id'] . '.' . $ext; ?>">
                                <div class="file">
                                <div class="row file-topic"> 
                                <?php echo $row['top_name']; ?>
                                </div>
                                <div>
                                <span class="module"> 
                                    <?php echo $row['mod_name']; ?>
                                </span>
                                <span class="category">
                                    <?php echo $row['subj_name']; ?>
                                </span>
                                </div>
                                </div><a> <?php
                        }
                   }
                }
            }
                else{
                $query = "SELECT modules.mod_id, mod_name, subjects.subj_id,subj_name,
                           topics.top_id,top_name, file_id, file_name ,date_entered
                           FROM modules,subjects,topics, files 
                           WHERE modules.mod_id=subjects.mod_id AND 
                           subjects.subj_id = topics.subj_id AND 
                           topics.top_id = files.top_id 
                           ORDER BY date_entered DESC";
                $result = mysqli_query($db,$query);
                
                if (mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                        $ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                        ?>
                        <a href="download_file.php?id=<?php echo $row['file_id'] . '.' . $ext; ?>">
                        <div class="file">
                        <div class="row file-topic"> 
                        <?php echo $row['top_name']; ?>
                        </div>
                        <div>
                        <span class="module"> 
                            <?php echo $row['mod_name']; ?>
                        </span>
                        <span class="category">
                            <?php echo $row['subj_name']; ?>
                        </span>
                        </div>
                        </div>
                        </a> <?php
                    }
                }
            }
            ?>
                        
                
           
            
          
            
        </section>
        
        <section class="row to-post" id="to-post">
            <h2>POST PASCO HERE!</h2>
            <h3>Aca board members ONLY!</h3>
            <form class="row" action="" method="post" enctype="multipart/form-data">
                <div>
                <select class="row" name="module">
                            <option value="">Select Module</option>
                            <option value="BAHS 231">BAHS 231</option>
                            <option value="BAHS 233">BAHS 233</option>
                            <option value="BAHS 235">BAHS 235</option>
                            <option value="BAHS 237">BAHS 237</option>
                            <option value="BAHS 232">BAHS 232</option>
                            <option value="BAHS 234">BAHS 234</option>
                            <option value="BAHS 236">BAHS 236</option>
                            <option value="BAHS 238">BAHS 238</option>
                            <option value="BAHS 331">BAHS 331</option>
                            <option value="BAHS 333">BAHS 333</option>
                            <option value="BAHS 335">BAHS 335</option>
                            <option value="BAHS 337">BAHS 337</option>
                            <option value="BAHS 332">BAHS 332</option>
                            <option value="BAHS 334">BAHS 334</option>
                            <option value="BAHS 336">BAHS 336</option>
                            <option value="BAHS 338">BAHS 338</option>
                        </select>
                        <?php
                            if (isset($_POST['post'])){
                                if ($_POST['module'] == NULL){
                                    echo '<p align="center" class="error">Please choose a module</p>';
                                }
                                else{
                                    $module = $_POST['module'];
                                }
                            }
                        ?>
                        </div>
                          <br>
                          <div>
                        <select class="row" name="subject">
                            <option value="">Select Subject</option>
                            <option value="Gross Anatomy">Gross Anatomy</option>
                            <option value="Embryology">Embryology</option>
                            <option value="Histology">Histology</option>
                            <option value="Physiology">Physiology</option>
                            <option value="Biochemistry">Biochemistry</option>
                            <option value="Pharmacology">Pharmacology</option>
                            <option value="Microbiology">Microbiology</option>
                            <option value="Pathology">Pathology</option>
                            <option value="Chemical Pathology">Chemical Pathology</option>
                            <option value="Haematology">Haematology</option>
                        </select>
                        <?php
                            if (isset($_POST['post'])){
                                if ($_POST['subject'] == NULL){
                                    echo '<p align="center" class="error">Please choose a subject</p>';
                                }
                                else{
                                    $subject = $_POST['subject'];
                                }
                            }
                        ?>  
                        </div>
                          <br>
                          <div>
                        <input class="post-topic" type="text" name="topic" placeholder='Topic / file name'>
                        <?php
                            if (isset($_POST['post'])){
                                if (empty($_POST['topic'])){
                                    echo '<p align="center" class="error">Please give a topic</p>';
                                }
                                else{
                                    $topic = strip_tags(trim($_POST['topic']));
                                }
                            }
                        ?></div><div><input class="code" type="text" name="code" placeholder='aca board code'>
                        <?php
                            if (isset($_POST['post'])){
                                if (empty($_POST['code'])){
                                    echo '<p align="center" class="error">Please provide the aca code</p>';
                                }
                                elseif (trim($_POST['code'] = 'aca200')){
                                    $code = strip_tags(trim($_POST['code']));
                                    
                                }
                                else{
                                    echo '<p align="center" class="error">Incorrect code</p>';
                                }
                            }
                        ?></div> <br>
                        <div>
                        <input class="file-upload" type="file" name="doc" />
                        <?php
                            if (isset($_POST['post'])){
                                if (is_uploaded_file($_FILES['doc']['tmp_name'])){
                                    $file_tmp = $_FILES['doc']['tmp_name'];
                                    $file_name = $_FILES['doc']['name'];
                                  //  echo 'FIle uploaded';
                                }
                                else{
                                    echo '<p align="center" class="error">Please upload your file</p>';          
                                }
                            }
                        ?>
                        </div>
                        
                        <input class="post" type="submit" name="post" value="POST!">
            </form>
        </section>
    </body>
    
    <?php
        if ($module && $subject && $topic && $code && $file_tmp && $file_name){
            //moving file
            $dir = '../Uploads/' . $file_name;
            $ext = pathinfo($dir, PATHINFO_EXTENSION);
            if (move_uploaded_file($file_tmp,$dir)){
               
                $q1 = "SELECT modules.mod_id, mod_name, subjects.subj_id,subj_name 
                       FROM modules,subjects
                       WHERE modules.mod_id=subjects.mod_id AND subj_name = '$subject' 
                       AND mod_name='$module'";
                $r1 = mysqli_query($db,$q1);
                while ($row = mysqli_fetch_assoc($r1)){
                    $subj_id = $row['subj_id'];
                    $q2 = "INSERT INTO topics(subj_id,top_name) VALUES (?,?)";
                    $stmt1 = mysqli_prepare($db,$q2);
                    mysqli_stmt_bind_param($stmt1,'is',$subj_id,$topic);
                    mysqli_stmt_execute($stmt1);
                    if (mysqli_stmt_affected_rows($stmt1) == 1){
                        $top_id = mysqli_stmt_insert_id($stmt1);
                        $q3 = "INSERT INTO files (top_id,file_name) VALUES (?,?)";
                       $stmt2 = mysqli_prepare($db,$q3);
                       mysqli_stmt_bind_param($stmt2,'is',$top_id,$file_name);
                       mysqli_stmt_execute($stmt2);
                       if (mysqli_stmt_affected_rows($stmt2) == 1){
                           $file_id = mysqli_stmt_insert_id($stmt2);

                           rename($dir,'../Uploads/'.$file_id . '.' . $ext);
                           ?>
                           <script>alert('File added');</script>
                           <?php
                       }
                        
                    }
                }
            }
            
        }
    ?>
</html>
    