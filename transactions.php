<?php

    include 'connect/db_connexion.php';


    $rqt1 = "SELECT Count(*) FROM transactions";
    $result1 = mysqli_query($connexion, $rqt1);
    $row = mysqli_fetch_row($result1);
    $transactions_nbr = $row[0];

    $rqt2 = "SELECT * FROM transactions";
    $result2 = mysqli_query($connexion, $rqt2);
    $transactions = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    mysqli_free_result($result2);

    $t_a_n1 = $t_a_n2 = $amount = $description = '';
    $errors = array('account_number1'=>'','account_number2'=>'', 'amount'=>'');
    if(isset($_POST['add_transaction'])){
        if(empty($_POST['t_a_n1'])){
            $errors['account_number1'] = 'The sender field should not be empty';
        }
        else{
            $t_a_n1 = $_POST['t_a_n1'];
            if(!preg_match('/[^A-Z][a-z0-9]{9}/', $t_a_n1)){
                $errors['account_number1'] = 'Enter a valid account number (Ex : X123565258)';
            }
        }
        if(empty($_POST['t_a_n2'])){
            $errors['account_number2'] = 'The recipsionist field should not be empty';
        }
        else{
            $t_a_n2 = $_POST['t_a_n2'];
            if(!preg_match('/[^A-Z][a-z0-9]{9}/', $t_a_n1)){
                $errors['account_number2'] = 'Enter a valid account number (Ex : X123565258)';
            }
        }

        if(empty($_POST['t_amount'])){
            $errors['amount'] = 'The amount field should not be empty';
        }
        else{
            $amount = $_POST['amount'];
        }
        $description = $_POST['description'];
    
    
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
        <h2 id="module_msg">NEW TRANSACTIONS</h2>
        <form action="transactions.php" method="post">
            <div class="module_customers_inputs">
            <div>
                <input type="text" placeholder="Account Number 1 (From)" name="t_a_n1" value="<?php echo htmlspecialchars($t_a_n1) ?>">
                <div style="color :red; font-size:1.5vmin; text-align:center;"><?php echo $errors['account_number1'] ?></div>
            </div>
            <div>
                <input type="email" placeholder="Account Number 2 (To)" name="t_a_n2" value="<?php echo htmlspecialchars($t_a_n2) ?>">
                <div style="color :red; font-size:1.5vmin; text-align:center;"><?php echo $errors['account_number2'] ?></div>
            </div>
            <div>
                <input type="tel" placeholder="Amount" name="t_amount" value="<?php echo htmlspecialchars($amount) ?>">
                <div style="color :red; font-size:1.5vmin; text-align:center;"><?php echo $errors['amount'] ?></div>
            </div>
            <div>
                <input type="text" placeholder="Description (optional)" name="t_description" value="<?php echo htmlspecialchars($description) ?>">
                <div style="color :red; font-size:1.5vmin; text-align:center;"><?php echo $errors['description'] ?></div>
            </div>
        </div>
        <div class="module_customers_btns">
            <button id="cancel_btn">Cancel</button>
            <button class="add_btn" id="add_btn" name="add_transaction">Add</button>
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
        <div class="header_right full_screen">
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
                    <button><a href="#">DEPOSIT</a></button>
                    <button><a href="#">WITHDRAW</a></button>
                    <button><a href="#">STATISTIQUES</a></button>
                </div>
                </div>
            </div>
        </div>
        <div class="main_container_head2">
            <div class="main_container_head2_infos">
                <p><span><?php echo $transactions_nbr ?></span>  TRANSACTIONS</p>
            </div>
            <div class="main_container_head2_filter">
                    <div class="filter_container">
                        <div class="filter" >
                            <button id="filter_btn" class="filter_btn">Filter by</button>
                        </div>
                        <div class="filter_menu" id="filter_menu">
                            <button>Date</button>
                            <button>Amount</button>
                            <button>Account N°</button>
                        </div>
                    </div>
                <div class="add_customer">
                    <button id="show_module_customers">Send a Messsage</button>
                </div>
            </div>
        </div>
        <section class="transactions_section">
            <table>
                <thead>
                    <tr>
                        
                        <th>From</th>
                        <th>To</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>description</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($transactions)): ?>
                    <?php foreach($transactions as $transaction): ?>
                    <tr class="container_transaction">
                        <td><?php echo $transaction['account_number'] ?></td>
                        <td><?php echo $transaction['account_number2'] ?></td>
                        <td><?php echo $transaction['tran_date'] ?></td>
                        <td><?php echo $transaction['amount'] ?> MAD</td>
                        <td class="transaction_statuts"><?php echo ($transaction['transaction_confirmed'] == 2) ?  'Done' :  'Depending' ?></td>
                        <td><?php $transaction['description'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php endif ;?>
                    
                    
                </tbody>

            </table>
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