<?php 
include 'header.php';
?>
<script src="js/search.js"></script>
    </head>
    <body>
        <table>
            <tr>
                <td>                    
                    <input type="text" id="text">
                    <button id="search">Search</button>                    
                </td>
                <td>
                    <?php   
                    //If client has logged in 
                    //do not show Login and Register links
                    if(!isset($_SESSION['logged'])){
                    echo "<a href='LoginScreen.php'>Login</a>";
                    ?>
                </td>
                <td>
                    <?php
                    echo "<a href='RegisterScreen.php'>Register</a>";                    
                    }                    
                    else{
                        echo "<a href='LogOut.php'>Log out</a>";
                    }
                    ?>
                </td>
            </tr>                        
        </table>        
        <div id="divMessage"><p id="showMessage"></p></div> 
        <div class="col-sm-8 text-left" id="table"></div>
        <div id="divLogin">
        <?php 
        //Login screen that will be showen 
        //If client try to search for users but is not logged in        
        include "LoginScreen.php";
        ?>
        </div>
    </body>
</html>
