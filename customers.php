<?php
    include 'connect/db_connexion.php';


    $rqt1 = 'SELECT COUNT(*) FROM customers c
            JOIN accounts a ON c.customer_id = a.customer_id;';
    $result1 = mysqli_query($connexion, $rqt1);
    $row = mysqli_fetch_row($result1);
    $customers_nbr = $row[0];


    $rqt2 = 'SELECT c.customer_id,c.full_name, c.email, c.phone, a.account_number  FROM customers c
            JOIN accounts a ON c.customer_id = a.customer_id; ';
    $result2 = mysqli_query($connexion, $rqt2);
    $customers = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    mysqli_free_result($result2);

    $c_full_name = $c_email = $c_phone = $cin = '';
    $errors = array('full_name' => '', 'c_email' => '', 'phone'=> '', 'cin' => '');
        if(isset($_POST['submit'])){
            if(empty($_POST['c_full_name'])){
                $errors['full_name'] = 'The name field should not be empty';
            }
            else{
                $c_full_name = $_POST['c_full_name'];
                if(!preg_match('/[A-Za-z\s]+$/' ,$c_full_name)){
                    $errors['full_name'] = 'this field could contain just letters !';
                }
                elseif(str_word_count($c_full_name) < 2){
                    $errors['full_name'] = 'You should enter your full name (ex: Jean Dupont)';
                }
            }
            if(empty($_POST['c_email'])){
                $errors['c_email'] = 'The email field should not be empty';
            }
            else{
                $c_email = $_POST['c_email'];
                if(!filter_var($c_email, FILTER_VALIDATE_EMAIL)){
                    $errors['c_email'] = 'this field should be in correct format !';
                }
            }
            if(empty($_POST['c_phone'])){
                $errors['phone'] = 'The phone field should not be empty';
            }
            else{
                $c_phone = $_POST['c_phone'];
                if(!preg_match('/^(0|\+212)[5-7][0-9]{8}$/', $c_phone)){
                    $errors['phone'] = 'Format: 05XXXXXXXX ou +2125XXXXXXXX';
                }
            }
            if(empty($_POST['c_CIN'])){
                $errors['cin'] = 'The CIN field should not be empty';
            }
            else{
                $cin = $_POST['c_CIN'];
                if(!preg_match('/^[A-Z][0-9]{6}$/', $cin)){
                    $errors['cin'] = 'this field should be in correct format !';
                }
                elseif(strlen($cin) < 7 ){
                    $errors['cin'] = 'this field should be 7 letters at least !';

                }
            }
            if(!array_filter($errors)){


                    $full_name = mysqli_real_escape_string($connexion, $_POST['c_full_name']); 
                    $email = mysqli_real_escape_string($connexion, $_POST['c_email']); 
                    $phone = mysqli_real_escape_string($connexion, $_POST['c_phone']); 
                    $cin = mysqli_real_escape_string($connexion, $_POST['c_CIN']); 

                    $rqt3 = "INSERT INTO customers(full_name,email, phone, CIN) VALUES('$full_name', '$email', '$phone', '$cin')";

                    if(mysqli_query($connexion, $rqt3)){
                        header("location: customers.php");
                        exit;
                    }
                    else{
                        echo 'error produced' . mysqli_error($connexion);
                    }
                   
                
            }
            
            
            
        }


    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Bankly</title>
</head>
<body>
    <div class="module_customers" id="module_customers">
        <div class="menu_close_module" id="menu_close_module">
            <i class='bxr  bx-x' style='color:#ffffff'></i> 
        </div>
        <h2 id="module_msg" style="margin-bottom : 0">NEW CUSTOMER</h2>
        <form action="customers.php" method="post">
            <div class="module_customers_inputs">
            <div>
                <input type="text" placeholder="Full name" name="c_full_name" value="<?php echo $c_full_name ?>">
                <div style="color:red; font-size:1.7vmin; text-align:center;padding:0"><?php echo $errors['full_name'] ?></div>
            </div>
            <div>
                <input type="text" placeholder="Email" name="c_email" value="<?php echo $c_email ?>">
                <div style="color:red; font-size:1.7vmin; text-align:center;padding:0"><?php echo $errors['c_email'] ?></div>
            </div>
            <div>
                <input type="tel" placeholder="Phone" name="c_phone" value="<?php echo $c_phone ?>">
                <div style="color:red; font-size:1.7vmin; text-align:center;padding:0"><?php echo $errors['phone'] ?></div>
            </div>
            <div>
                <input type="text" placeholder="CIN" name="c_CIN" value="<?php echo $cin ?>">
                <div style="color:red; font-size:1.7vmin; text-align:center;padding:0"><?php echo $errors['cin'] ?></div>
            </div>
        </div>
        <div class="module_customers_btns">
            <button type="reset" id="cancel_btn">Cancel</button>
            <button class="add_btn" id="add_btn" name="submit">Add</button>
        </div>
        </form>
    </div>
    <div class="menu_content" id="menu_content">
        <h2>DASHBOARD</h2>
        <div class="menu_section">
            <a href="home.php">DASHBOARD</a>
            <i class='bxr  bx-apps' style='color:#ffffff'></i> 
        </div>
        <div class="menu_section">
            <a href="customers.php">CUSTOMERS</a>
            <i class='bxr  bx-people-handshake' style='color:#ffffff'></i> 
        </div>
        <div class="menu_section">
            <a href="accounts.php">ACCOUNTS</a>
            <i class='bxr  bx-bank' style='color:#ffffff'></i> 
        </div>
        <div class="menu_section">
            <a href="transactions.php">TRANSACTIONS</a>
            <i class='bxr  bx-arrow-right-left' style='color:#ffffff'></i> 
        </div>
        <div class="menu_section">
            <a href="chat.php">CHAT</a>
            <i class='bxr  bx-discussion' style='color:#ffffff'></i> 
        </div>
        <div class="menu_section last_item">
            <a>LOG OUT</a>
            <i class='bxr  bx-arrow-out-right-square-half' style='color:#ffffff'></i> 
        </div>
        <div class="container_menu_lang_btn">
            <div class="menu_bnts">
            <div class="container" id="container_dark_mode">
                <div class="cercle" id="content_dark_mode"></div>
            </div>
            <div class="langage_site" id="langage_site"><i class='bxr  bx-chevron-down' style='color:#ffffff'></i>  AR</div>
        </div>
        <div class="menu_language_btn" id="menu_language_btn">
                <div>English</div>
                <div>Francais</div>
                <div>العربية</div>
        </div>
        </div>
        <div class="menu_close" id="menu_close">
            <i class='bxr  bx-x' style='color:#ffffff'></i> 
        </div>
    </div>
    <header>
    <div class="point">$</div>
        <div class="header_logo">
            <div class="header_logo_imgr">
                <img src="imgs/bankly_logo.png" alt="">
            </div>
            <div class="header_logo_img">
                
            </div>
        </div>
        <div class="header_right" id="header_right_logos_customers">
            <div class="header_right_cercles">
                <div class="header_right_cercle1"><div class="header_right_cercle2">         <div class="header_right_full_cercle"></div></div></div>
                
       
            </div>
            <div class="header_right_logos">
                <div class="header_right_logos_cont">
                    <div class="header_right_logos_logo1 logo1">
                    <img src="imgs/img1.png" alt="">
                    </div>
                    <div class="header_right_logos_logo1 logo2">
                    <img src="imgs/img2.png" alt="">
                    </div>
                </div>
                <div class="header_right_logos_cont1">
                    <div class="header_right_logos_logo1 logo3">
                    <img src="imgs/img3.png" alt="" style="display: none;">
                    </div>
                    <div class="header_right_logos_logo1 logo4">
                    <img src="imgs/img4.png" alt="">
                    </div>
                </div>
                <div class="header_right_logos_cont2">
                    <div class="header_right_logos_logo1 logo5">
                    <img src="imgs/img3.png" alt="">
                    </div>
                    <div class="header_right_logos_logo1 logo6">
                    <img src="imgs/img4.png" alt="">
                    </div>
                </div>
                
            </div>
        </div>
        <button class="menu" id="menu">
            <i class='bxr  bx-menu'></i> 
        </button>
        
    </header>
    
    <main>
        <div class="main_container_head" id="main_container_head">
            <div class="main_container_head_p1">
                <input type="search" placeholder="Search a transaction">
                <i class='bxr  bx-search' style='color:#004E64'></i> 
            </div>
            <div class="main_container_head_p2">
                <i class='bxr  bx-bell-ring' style='color:#004E64'></i> 
                <div class="main_main_container_head_p2_settings">
                    <i class='bxr  bx-spanner' style='color:#ffffff' id="settings_btn"></i> 
                
                <div class="main_container_head_p2_settings" id="container_settings">
                    <button>ALL CUSTOMERS</button>
                    <button>STATISTIQUES</button>
                    <button>RAPPORTS</button>
                </div>
                </div>
            </div>
        </div>
        <div class="main_container_head2">
            <div class="main_container_head2_infos">
                <p id="statistiques"><span><?php echo $customers_nbr ?> </span>  CUSTOMERS</p>
            </div>
            <div class="main_container_head2_filter">
                    <div class="filter_container">
                        <div class="filter">
                            <button id="filter_btn" class="filter_btn">Filter by</button>
                        </div>
                        <div class="filter_menu" id="filter_menu">
                            <button>Owners name</button>
                            <button>Join Date</button>
                            <button>Balance</button>
                        </div>
                    </div>
                <div class="add_customer">
                    <button id="show_module_customers">Send a Messsage</button>
                </div>
            </div>
        </div>
        <section class="customers_section">
            <?php if(!empty($customers)): ?>
                <?php foreach($customers as $customer): ?>
            <div class="customers_section_customer" id="customers_section_customer">
                <div class="customers_section_customer_img">
                    <img src="imgs/profile.png" alt="">
                </div>
                <div class="customers_section_customer_infos">
                    <h3><?= htmlspecialchars($customer['full_name']) ?></h3>
                    <p><?= htmlspecialchars($customer['account_number']) ?></p>
                </div>
                <div class="container_container_infos">
                    <div>
                        <div class="container_infos">
                            <i class='bxr  bx-envelope' style='color:#004E64'></i>
                            <p><?= htmlspecialchars($customer['email']) ?></p>
                        </div>
                        <div class="container_infos">
                            <i class='bxr  bx-phone' style='color:#004E64'></i> 
                            <p><?= htmlspecialchars($customer['phone']) ?></p>
                        </div>
                    </div>
                    <div class="modify_infos">
                        <a href="customers.php?id=<?= htmlspecialchars($customer['customer_id'] ) ?>"><i class='bxr  bx-pencil' style='color:#004E64'></i> </a>
                    </div>
                </div>
                <div class="details_btn">
                    <i class='bxr  bx-dots-horizontal-rounded' style='color:#004E64'></i> 
                </div>
            </div>
            
            <?php endforeach; ?>
            <?php else : ?>
                <p class="no_customer"> No customers yet</p>
            <?php endif; ?>
            <?php mysqli_close($connexion); ?>
        </section>
    </main>

    <footer>
        <h1>LET US PLAN YOUR FINANCIAL DREAM FOR YOU</h1>
        <div class="infos_container">
            <div class="infos_container_left" >
                <i class='bxr  bx-envelope' style='color: #fefefe; font-size: 3vmin ;font-weight: bold;'></i> 
                <a href="mailTo : mouadsbaer@gmail.com" style='color: #fefefe; z-index: 99;'>mouadsbaer@gmail.com</a>
            </div>
            
            <div class="infos_container_right" style="display: flex; flex-direction: column; gap: 10px;">
                 <div><a href="https://www.linkedin.com/in/mouad-sbaer-1499a0374/"><i class="fa-brands fa-linkedin" style="color: #fefefe; font-size: 3vmin;"></i></a></div>
                <div><a href="#"><i class="fa-brands fa-facebook" style='color: #fefefe; font-size: 3vmin;'></i></a></div>
                <div><a href="#"><i class="fa-brands fa-instagram" style="color: #fefefe; font-size: 3vmin;"></i></a></div>
    
            </div>
        </div>
        <div class="cercle_mother" style="overflow: hidden; position: absolute;">
            <div class="rectongle_son" style="color: whitesmoke; text-align: center; background: linear-gradient(to bottom , #efefef , rgb(190, 190, 190));">MS</div>
            <div class="cercle_daughter" style="position: absolute;background-color: #004E64;">
                <div class="infos_container_center" style="z-index: 99;display: flex; flex-direction: column; padding: 35px 20px; gap: 10px;">
                    <div class="infos_container_center_cont">
                        <i class="fa-brands fa-github" style="color: #fefefe;"></i>
                        <a href="https://github.com/mouadsbaer" style='color: #fefefe; font-size: 2vmin; font-weight: bold;'>mouad saber</a>
                    </div>
                    <div class="infos_container_center_cont" style="display: flex;">
                        <i class='bxr  bx-phone bx-flip-horizontal' style='color: #fefefe;'></i> 
                        <a href="tel : +2120618733244" style='color: #fefefe;  font-size: 2vmin; font-weight: bold;'>+212618733244</a>
                    </div>
                    <div class="infos_container_center_cont">
                        <i class='bxr  bx-location-alt-2' style='color: #fefefe;'></i> 
                        <a href="https://youcode.ma/" style='color: #fefefe; font-size: 2vmin; font-weight: bold;'>You Code</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/main.js"></script>
    <script src="js/module.js"></script>
    <script src="js/menu&dark_mode.js"></script>
    <script src="js/language.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/filter.js"></script>
</body>
</html>