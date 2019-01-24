
<!DOCTYPE html>
<!--
17-1-2019
Thijs van der Wall
-->
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Contact</title>
        <link type="text/css" rel="stylesheet" href="../css/contactform.css" >
        <link type="text/css" rel="stylesheet" href="../css/style.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <a href="StartPage.php">
                        <img src="../img/stenden.png" alt="NHL_STENDEN"> 
                    </a> 
                </div>
                <div id="headertxt">
                    <div class="home">
                        <ul>
                            <li><a href="startpage.php">Home</a></li>
                        </ul>
                    </div>
                    <div class="login">
                        <ul>
                            <li><a href="logout.php" >Log out</a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="../Contact.php">NL</a></li>
                            <li class=""><a href="Contacts.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
                </div> 
            </div>
            <div id="middlebox">
                <div id="tilecontainer">
                    <div id="stylized" class="myform"> <!-- BEGIN FORM -->
                        <form id="form1" action="mailto:stendenict@stenden.net" method="POST">
                            <label> First name:
                            </label>
                            <input type="text" name="name">
                            <label>Email:
                            </label>
                            <input type="text" name="email">
                            <label>Phonenumber:
                            </label>
                            <input type="text" name="phone">
                            <div id="dropdown">
                                <label> Type of question:
                                </label>
                                <select name="Course" size="1">
                                    <option value="keuze1">Feature missing</option>
                                    <option value="keuze2">Site is slow</option>
                                    <option value="keuze3">Certain functions don't work</option>
                                    <option value="keuze4">Can't login</option>
                                    <option value="keuze5">Miscellaneous</option>
                                </select>
                            </div>
                            <label>Message (optioneel)
                            </label>
                            <textarea name="message" rows="6" cols="25"></textarea><br />
                            <button type="submit" name ="submit" value="Send" style="margin-top:15px;">Submit</button>
                            <div class="spacer"></div>
                        </form>
                    </div> <!-- end of form class -->
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </body>
</html>

