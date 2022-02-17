<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Saving skydiver info...</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <main class="container mt-2">
            <?php
            // store user inputs in local variables using the $_POST array
            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $CSPANumber = $_POST['CSPANumber'];
            $COP = $_POST['COP'];
            $homeDropzone = $_POST['homeDropzone'];
            // flag to determine if all inputs were valid or not
            $valid = true;

            // input validation
            if (empty($firstName)) {
                echo "ERROR: First name is required.<br />";
                $valid = false;
            }
            else if (strlen($firstName) > 50) {
                echo "ERROR: First name must be 50 characters or less.<br />";
                $valid = false;
            }

            if (empty($lastName)) {
                echo "ERROR: Last name is required.<br />";
                $valid = false;
            }
            else if (strlen($lastName) > 50) {
                echo "ERROR: Last name must be 50 characters or less.<br />";
                $valid = false;
            }
            
            if (empty($CSPANumber)) {
                echo "ERROR: A valid CSPA number is required.<br />";
                $valid = false;
            }
            else if (!is_numeric($CSPANumber) || $CSPANumber < 1 || $CSPANumber > 99999) {
                echo "ERROR: Valid CSPA numbers range from 1 to 99999.<br />";
                $valid = false;
            }

            $validCOPList = array("Solo","A","B","C","D");
            if (empty($COP)) {
                echo "ERROR: You must indicate your highest certificate of proficiency obtained.<br />";
                $valid = false;
            }
            else if (!in_array($COP, $validCOPList)) {
                echo "ERROR: Certificate of proficiency must be chosen from the list.<br />";
                $valid = false;
            }

            if (empty($homeDropzone)) {
                echo "ERROR: You must provide your home dropzone.<br />";
                $valid = false;
            }
            else if (!is_numeric($homeDropzone) || $homeDropzone < 1) {
                echo "ERROR: Home dropzone must be greater than or equal to zero.<br />";
                $valid = false;
            }
            



            if ($valid) {
                // connect to the databse
                $db = new PDO('DB connection info hidden');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // write the SQL command to insert the form data into the database as a new record
                $sql = "INSERT INTO skydivers (firstName, lastName, CSPANumber, COP, homeDropzone)
                        VALUES (:firstName, :lastName, :CSPANumber, :COP, :homeDropzone)";

                // prepare the SQL command
                $cmd = $db->prepare($sql);

                // populate the SQL command with the user input
                $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 50);
                $cmd->bindParam('lastName', $lastName, PDO::PARAM_STR, 50);
                $cmd->bindParam('CSPANumber', $CSPANumber, PDO::PARAM_INT);
                $cmd->bindParam('COP', $COP, PDO::PARAM_STR);
                $cmd->bindParam('homeDropzone', $homeDropzone, PDO::PARAM_STR);

                // execute save command
                $cmd->execute();

                // disconnect from the database
                $db = null;
                
                //inform the user that the record was saved, and offer navigation buttons
                echo "<h3>Save successful.</h3>";
            }
            ?>
            <!-- navigation buttons -->
            <a href="skydiver-details.php" class="btn btn-primary col-md-4 mt-2">Enter Another Skydiver</a><br />
            <a href="skydivers.php" class="btn btn-outline-primary col-md-4 mt-2">View Existing Skydivers</a>
        </main>
    </body>
</html>