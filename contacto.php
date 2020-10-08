<?php
include 'includes/header.php';
include 'navBar.php';
?>
<section>
<h2>CONTACTANOS!</h2>
    <div class="contenedor">
        <form class="contacto">
            <div class="formBackground clearfix">
                
                <div class="formContainer">
                    <label for="fname">Nombre:</label><br>
                    <input type="text" id="fname" name="fname"><br>
                </div><!--.formContainer-->
                
                <div class="formContainer">
                    <Label for="lname">Apellido:</Label><br>
                    <input type="text" id="lname" name="lname"><br>
                </div><!--.formContainer-->
                
                <div class="formContainer">
                    <label for="email">Email:</label><br>
                    <input type="text" id="email" name="email"><br>
                </div><!--.formContainer-->
                
                <div class="formContainer">
                    <label for="phoneNumber">Telefono (Opcional):</label><br>
                    <input type="text" name="phoneNumber" id="phoneNumber"><br>
                </div><!--.formContainer-->
                
                <div class="formContainer">
                    <label for="message">Mensaje:</label><br>
                    <textarea id="message" name="message"></textarea>
                </div><!--.formContainer-->
                
                <input type="submit" value="Enviar" class="submit-btn">
                
            </div><!--.formBackground-->
        </form><!--.contacto-->
    </div>
</section>
<?php
include 'includes/footer.php';
?>