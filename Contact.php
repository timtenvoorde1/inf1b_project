
<!DOCTYPE html>
<!--
17-1-2019
Thijs van der Wall
-->
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Contact</title>
        <link type="text/css" rel="stylesheet" href="css/contactform.css" >
        <link type="text/css" rel="stylesheet" href="css/style.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <a href="StartPage.php">
                        <img src="img/stenden.png" alt="NHL_STENDEN"> 
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
                            <li><a href="logout.php" >Uitloggen</a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="contact.php">NL</a></li>
                            <li class=""><a href="en/contact.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
            </div>
            <div id="middlebox">
                <div id="tilecontainer">
                    <div id="stylized" class="myform"> <!-- BEGIN FORM -->
                        <form id="form1" action="mailto:stendenict@stenden.net" method="POST">
                            <label> Voornaam
                            </label>
                            <input type="text" name="name">
                            <label>Email 
                            </label>
                            <input type="text" name="email">
                            <label>Telefoonnummer
                            </label>
                            <input type="text" name="phone">
                            <div id="dropdown">
                                <label> Type vraag:
                                </label>
                                <select name="Course" size="1">
                                    <option value="keuze1">Onderdeel mist</option>
                                    <option value="keuze2">Site is erg traag</option>
                                    <option value="keuze3">Bepaalde functies werken niet</option>
                                    <option value="keuze4">Kan niet inloggen</option>
                                    <option value="keuze5">Overig</option>
                                </select>
                            </div>
                            <label>Bericht (optioneel)
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

